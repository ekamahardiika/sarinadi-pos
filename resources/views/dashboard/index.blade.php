@extends('layouts.admin')

@section('content')

<style>
    :root {
        --blue-primary: #4A90D9;
        --green-accent: #27AE60;
        --orange-accent: #F39C12;
        --card-shadow: 0 2px 12px rgba(0,0,0,0.08);
        --radius: 10px;
    }

    .dashboard-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2c3e50;
        letter-spacing: -0.3px;
    }

    .btn-generate {
        background: var(--blue-primary);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 8px 18px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
    }
    .btn-generate:hover { background: #357abd; color: #fff; }

    /* Stat Cards */
    .stat-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        padding: 20px 24px;
        border-top: 3px solid var(--blue-primary);
        position: relative;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    }
    .stat-card.green  { border-top-color: var(--green-accent); }
    .stat-card.orange { border-top-color: var(--orange-accent); }

    .stat-label {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #95a5a6;
        margin-bottom: 6px;
    }
    .stat-card.green  .stat-label { color: var(--green-accent); }
    .stat-card.orange .stat-label { color: var(--orange-accent); }

    .stat-value {
        font-size: 1.65rem;
        font-weight: 800;
        color: #2c3e50;
        line-height: 1.1;
    }

    .stat-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2rem;
        opacity: 0.12;
        color: #2c3e50;
    }

    .stat-sub {
        font-size: 0.75rem;
        color: #b0bec5;
        margin-top: 4px;
    }

    /* Chart Card */
    .chart-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        padding: 24px 28px;
    }
    .chart-card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 16px;
    }
    .chart-card-title .dot {
        display: inline-block;
        width: 10px; height: 10px;
        border-radius: 50%;
        background: var(--blue-primary);
        margin-right: 8px;
    }
</style>

<div class="container-fluid px-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="dashboard-title mb-0">Dashboard</h1>
        <button class="btn-generate">
            <i class="fas fa-download"></i> Generate Report
        </button>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">

        {{-- Earnings Monthly --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-label">Earnings (Monthly)</div>
                <div class="stat-value">Rp {{ number_format($earningsMonthly ?? 40000000, 0, ',', '.') }}</div>
                <div class="stat-sub">Bulan ini</div>
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
            </div>
        </div>

        {{-- Earnings Annual --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card green">
                <div class="stat-label">Earnings (Annual)</div>
                <div class="stat-value">Rp {{ number_format($earningsAnnual ?? 215000000, 0, ',', '.') }}</div>
                <div class="stat-sub">Tahun {{ date('Y') }}</div>
                <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
            </div>
        </div>

        {{-- Total Transactions --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card orange">
                <div class="stat-label">Total Transaksi</div>
                <div class="stat-value">{{ number_format($totalTransactions ?? 1284, 0, '.') }}</div>
                <div class="stat-sub">Hari ini: {{ $todayTransactions ?? 18 }} transaksi</div>
                <div class="stat-icon"><i class="fas fa-exchange-alt"></i></div>
            </div>
        </div>

        {{-- Pending Requests --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card" style="border-top-color:#e74c3c;">
                <div class="stat-label" style="color:#e74c3c;">Pending Requests</div>
                <div class="stat-value">{{ $pendingRequests ?? 18 }}</div>
                <div class="stat-sub">Menunggu konfirmasi</div>
                <div class="stat-icon"><i class="fas fa-comments"></i></div>
            </div>
        </div>

    </div>

    {{-- Chart Row --}}
    <div class="row g-3">

        {{-- Earnings Overview Chart --}}
        <div class="col-12">
            <div class="chart-card">
                <div class="chart-card-title">
                    <span class="dot"></span> Earnings Overview
                </div>
                <canvas id="earningsChart" height="60"></canvas>
            </div>
        </div>

    </div>

</div>

{{-- Chart.js --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Earnings Line Chart ──────────────────────────────
    const earningsCtx = document.getElementById('earningsChart').getContext('2d');

    const gradient = earningsCtx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(74,144,217,0.25)');
    gradient.addColorStop(1, 'rgba(74,144,217,0)');

    new Chart(earningsCtx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Earnings',
                data: {!! json_encode($monthlyData ?? [0, 10000000, 14000000, 9000000, 20000000, 18000000, 24000000, 22000000, 30000000, 26000000, 24000000, 40000000]) !!},
                fill: true,
                backgroundColor: gradient,
                borderColor: '#4A90D9',
                borderWidth: 2.5,
                pointBackgroundColor: '#4A90D9',
                pointRadius: 4,
                pointHoverRadius: 6,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: v => 'Rp ' + (v/1000000).toFixed(0) + 'jt',
                        font: { size: 11 },
                        color: '#999'
                    },
                    grid: { color: '#f0f0f0' }
                },
                x: {
                    ticks: { font: { size: 11 }, color: '#999' },
                    grid: { display: false }
                }
            }
        }
    });

});
</script>
@endpush

@endsection