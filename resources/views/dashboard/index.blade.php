@extends('layouts.admin')

@section('content')
    <style>
        :root {
            --blue-primary: #4A90D9;
            --green-accent: #27AE60;
            --orange-accent: #F39C12;
            --card-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
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
        }

        .stat-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            padding: 20px 24px;
            border-top: 3px solid var(--blue-primary);
            position: relative;
            overflow: hidden;
        }

        .stat-card.green {
            border-top-color: var(--green-accent);
        }

        .stat-card.orange {
            border-top-color: var(--orange-accent);
        }

        .stat-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #95a5a6;
            margin-bottom: 6px;
        }

        .stat-card.green .stat-label {
            color: var(--green-accent);
        }

        .stat-card.orange .stat-label {
            color: var(--orange-accent);
        }

        .stat-value {
            font-size: 1.65rem;
            font-weight: 800;
            color: #2c3e50;
        }

        .stat-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            opacity: 0.12;
        }

        .stat-sub {
            font-size: 0.75rem;
            color: #b0bec5;
            margin-top: 4px;
        }

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
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--blue-primary);
            margin-right: 8px;
        }
    </style>


    <div class="container-fluid px-4">

        {{-- HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="dashboard-title mb-0">Dashboard</h1>
        </div>


        {{-- STATISTICS --}}
        <div class="row g-3 mb-4">

            {{-- Earnings Daily --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">

                    <div class="stat-label">Earnings (Daily)</div>

                    <div class="stat-value">
                        Rp {{ number_format($earningsDaily, 0, ',', '.') }}
                    </div>

                    <div class="stat-sub">
                        Hari ini
                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>

                </div>
            </div>


            {{-- Earnings Monthly --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card green">

                    <div class="stat-label">Earnings (Monthly)</div>

                    <div class="stat-value">
                        Rp {{ number_format($earningsMonthly, 0, ',', '.') }}
                    </div>

                    <div class="stat-sub">
                        Bulan {{ date('F') }}
                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>

                </div>
            </div>


            {{-- Earnings Annual --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card orange">

                    <div class="stat-label">Earnings (Annual)</div>

                    <div class="stat-value">
                        Rp {{ number_format($earningsAnnual, 0, ',', '.') }}
                    </div>

                    <div class="stat-sub">
                        Tahun {{ date('Y') }}
                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-coins"></i>
                    </div>

                </div>
            </div>


            {{-- Total Transactions --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card" style="border-top-color:#e74c3c;">

                    <div class="stat-label" style="color:#e74c3c;">
                        Total Transactions
                    </div>

                    <div class="stat-value">
                        {{ number_format($totalTransactions) }}
                    </div>

                    <div class="stat-sub">
                        Hari ini : {{ $todayTransactions }} transaksi
                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>

                </div>
            </div>

        </div>


        {{-- CHART --}}
        <div class="row g-3">

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


    {{-- CHART SCRIPT --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                const ctx = document.getElementById("earningsChart").getContext("2d");

                const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, "rgba(74,144,217,0.25)");
                gradient.addColorStop(1, "rgba(74,144,217,0)");

                new Chart(ctx, {

                    type: "line",

                    data: {
                        labels: [
                            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                        ],

                        datasets: [{

                            label: "Earnings",

                            data: {!! json_encode($monthlyData) !!},

                            fill: true,

                            backgroundColor: gradient,

                            borderColor: "#4A90D9",

                            borderWidth: 2.5,

                            pointBackgroundColor: "#4A90D9",

                            pointRadius: 4,

                            tension: 0.4

                        }]

                    },

                    options: {
                        responsive: true,

                        plugins: {
                            legend: {
                                display: false
                            }
                        },

                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: v => "Rp " + (v / 1000000).toFixed(0) + "jt"
                                },
                                grid: {
                                    color: "#f0f0f0"
                                }
                            },

                            x: {
                                grid: {
                                    display: false
                                }
                            }

                        }

                    }

                });

            });
        </script>
    @endpush
@endsection
