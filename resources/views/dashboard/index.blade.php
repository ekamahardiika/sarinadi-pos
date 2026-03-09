@extends('layouts.admin')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --orange: #d35400;
            --orange-light: #e8680a;
            --orange-pale: rgba(211, 84, 0, 0.08);
            --dark: #1a1008;
            --border-soft: rgba(0, 0, 0, 0.07);
            --text-dark: #2c3e50;
            --text-muted: #7f8c8d;
            --text-sub: #b0bec5;
            --green: #27ae60;
            --blue: #2980b9;
            --red: #c0392b;
        }

        body,
        .main-content,
        #content,
        #content-wrapper,
        #page-content-wrapper {
            font-family: 'DM Sans', sans-serif !important;
        }

        /* ── HEADER ── */
        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0ece8;
        }

        .dashboard-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
            letter-spacing: -0.3px;
        }

        .dashboard-title em {
            color: var(--orange);
            font-style: italic;
        }

        .dashboard-date {
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .dashboard-date i {
            color: var(--orange);
        }

        /* ── STAT CARDS ── */
        .stat-card {
            background: #ffffff;
            border: 1px solid #f0ece8;
            border-radius: 18px;
            padding: 22px 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(211, 84, 0, 0.06);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(211, 84, 0, 0.12);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--orange);
            border-radius: 18px 18px 0 0;
        }

        .stat-card.green::before {
            background: var(--green);
        }

        .stat-card.blue::before {
            background: var(--blue);
        }

        .stat-card.red::before {
            background: var(--red);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(211, 84, 0, 0.07) 0%, transparent 70%);
            pointer-events: none;
        }

        .stat-card.green::after {
            background: radial-gradient(circle, rgba(39, 174, 96, 0.07) 0%, transparent 70%);
        }

        .stat-card.blue::after {
            background: radial-gradient(circle, rgba(41, 128, 185, 0.07) 0%, transparent 70%);
        }

        .stat-card.red::after {
            background: radial-gradient(circle, rgba(192, 57, 43, 0.07) 0%, transparent 70%);
        }

        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .stat-icon-wrap {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--orange-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--orange);
            flex-shrink: 0;
        }

        .stat-card.green .stat-icon-wrap {
            background: rgba(39, 174, 96, 0.1);
            color: var(--green);
        }

        .stat-card.blue .stat-icon-wrap {
            background: rgba(41, 128, 185, 0.1);
            color: var(--blue);
        }

        .stat-card.red .stat-icon-wrap {
            background: rgba(192, 57, 43, 0.1);
            color: var(--red);
        }

        .stat-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.65rem;
            font-weight: 900;
            color: var(--dark);
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-sub {
            font-size: 0.75rem;
            color: var(--text-sub);
        }

        /* ── CHART CARD ── */
        .chart-card {
            background: #ffffff;
            border: 1px solid #f0ece8;
            border-radius: 18px;
            padding: 28px 28px 24px;
            box-shadow: 0 2px 16px rgba(211, 84, 0, 0.06);
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .chart-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-title-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--orange);
            box-shadow: 0 0 8px rgba(211, 84, 0, 0.4);
        }

        .chart-badge {
            background: var(--orange-pale);
            border: 1px solid rgba(211, 84, 0, 0.2);
            color: var(--orange);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            letter-spacing: 0.05em;
        }

        /* ── EYEBROW ── */
        .section-eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-eyebrow::before {
            content: '';
            width: 24px;
            height: 2px;
            background: var(--orange);
            border-radius: 2px;
        }
    </style>

    <div class="container-fluid px-4 py-2">

        {{-- HEADER --}}
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title">Dash<em>board<em></h1>
            </div>
            <div class="dashboard-date">
                <i class="fas fa-calendar-alt"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="row g-3 mb-4">

            {{-- Earnings Daily --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Earnings Daily</div>
                            <div class="stat-value">Rp {{ number_format($earningsDaily, 0, ',', '.') }}</div>
                            <div class="stat-sub">Hari ini</div>
                        </div>
                        <div class="stat-icon-wrap">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Earnings Monthly --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card green">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Earnings Monthly</div>
                            <div class="stat-value">Rp {{ number_format($earningsMonthly, 0, ',', '.') }}</div>
                            <div class="stat-sub">Bulan {{ date('F') }}</div>
                        </div>
                        <div class="stat-icon-wrap">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Earnings Annual --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card blue">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Earnings Annual</div>
                            <div class="stat-value">Rp {{ number_format($earningsAnnual, 0, ',', '.') }}</div>
                            <div class="stat-sub">Tahun {{ date('Y') }}</div>
                        </div>
                        <div class="stat-icon-wrap">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Transactions --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card red">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Total Transactions</div>
                            <div class="stat-value">{{ number_format($totalTransactions) }}</div>
                            <div class="stat-sub">Hari ini: {{ $todayTransactions }} transaksi</div>
                        </div>
                        <div class="stat-icon-wrap">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- CHART --}}
        <div class="row g-3">
            <div class="col-12">
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">
                            <div class="chart-title-dot"></div>
                            Earnings Overview
                        </div>
                        <div class="chart-badge">{{ date('Y') }}</div>
                    </div>
                    <canvas id="earningsChart" height="60"></canvas>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById("earningsChart").getContext("2d");

                const gradient = ctx.createLinearGradient(0, 0, 0, 320);
                gradient.addColorStop(0, "rgba(211,84,0,0.2)");
                gradient.addColorStop(1, "rgba(211,84,0,0)");

                new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                            'Dec'
                        ],
                        datasets: [{
                            label: "Earnings",
                            data: {!! json_encode($monthlyData) !!},
                            fill: true,
                            backgroundColor: gradient,
                            borderColor: "#d35400",
                            borderWidth: 2.5,
                            pointBackgroundColor: "#d35400",
                            pointBorderColor: "#ffffff",
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: "#1a1008",
                                borderColor: "rgba(211,84,0,0.3)",
                                borderWidth: 1,
                                titleColor: "#fff",
                                bodyColor: "rgba(255,255,255,0.7)",
                                padding: 12,
                                callbacks: {
                                    label: ctx => " Rp " + ctx.parsed.y.toLocaleString('id-ID')
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: "#95a5a6",
                                    callback: v => "Rp " + (v / 1000000).toFixed(0) + "jt"
                                },
                                grid: {
                                    color: "#f5f0eb"
                                }
                            },
                            x: {
                                ticks: {
                                    color: "#95a5a6"
                                },
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
