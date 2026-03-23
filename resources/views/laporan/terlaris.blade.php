@extends('layouts.admin')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --orange: #d35400;
            --orange-light: #e8680a;
            --orange-pale: rgba(211, 84, 0, 0.08);
            --dark: #1a1008;
            --green: #27ae60;
            --red: #c0392b;
            --text-muted: #7f8c8d;
            --text-sub: #b0bec5;
            --border: #f0ece8;
        }

        body,
        * {
            font-family: var(--font-body);
            font-display: var(--font-body);
        }

        /* ── HEADER ── */
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }

        .page-eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-eyebrow::before {
            content: '';
            width: 20px;
            height: 2px;
            background: var(--orange);
            border-radius: 2px;
        }

        .page-title {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
        }

        .page-title em {
            color: var(--orange);
            font-style: italic;
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px 22px;
            margin-bottom: 24px;
            box-shadow: 0 2px 12px rgba(211, 84, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-label i {
            color: var(--orange);
        }

        .filter-select,
        .filter-input {
            padding: 8px 14px;
            background: #faf7f4;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.85rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            outline: none;
            transition: all 0.25s;
            height: 38px;
        }

        .filter-select:focus,
        .filter-input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(211, 84, 0, 0.1);
            background: #fff;
        }

        .filter-divider {
            width: 1px;
            height: 28px;
            background: var(--border);
        }

        .btn-excel {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 18px;
            background: rgba(39, 174, 96, 0.1);
            color: var(--green);
            border: 1px solid rgba(39, 174, 96, 0.2);
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s;
            white-space: nowrap;
            height: 38px;
        }

        .btn-excel:hover {
            background: var(--green);
            color: white;
            border-color: var(--green);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.25);
        }

        .btn-pdf {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 18px;
            background: rgba(192, 57, 43, 0.08);
            color: var(--red);
            border: 1px solid rgba(192, 57, 43, 0.2);
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s;
            white-space: nowrap;
            height: 38px;
        }

        .btn-pdf:hover {
            background: var(--red);
            color: white;
            border-color: var(--red);
            box-shadow: 0 4px 12px rgba(192, 57, 43, 0.25);
        }

        /* ── TABLE CARD ── */
        .table-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(211, 84, 0, 0.06);
        }

        .table-card-header {
            background: var(--dark);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-header-icon {
            width: 34px;
            height: 34px;
            background: var(--orange);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .table-header-title {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1rem;
            font-weight: 700;
            color: white;
            flex: 1;
        }

        .table-header-badge {
            background: var(--orange-pale);
            border: 1px solid rgba(211, 84, 0, 0.25);
            color: var(--orange);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 20px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* ── TABLE ── */
        .laporan-table {
            width: 100%;
            border-collapse: collapse;
        }

        .laporan-table thead tr {
            background: #faf7f4;
            border-bottom: 2px solid var(--border);
        }

        .laporan-table th {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 13px 18px;
            white-space: nowrap;
        }

        .laporan-table td {
            padding: 13px 18px;
            font-size: 0.875rem;
            color: var(--dark);
            border-bottom: 1px solid #faf7f4;
            vertical-align: middle;
        }

        .laporan-table tbody tr:last-child td {
            border-bottom: none;
        }

        .laporan-table tbody tr:hover td {
            background: #fdf9f6;
        }

        .no-cell {
            color: var(--text-sub);
            font-size: 0.78rem;
            font-weight: 600;
        }

        .produk-cell {
            font-weight: 600;
            color: var(--dark);
        }

        .terjual-cell {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--dark);
        }

        .terjual-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            background: var(--orange-pale);
            border: 1px solid rgba(211, 84, 0, 0.2);
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--orange);
        }

        .pendapatan-cell {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--dark);
        }

        .empty-row td {
            text-align: center;
            color: var(--text-sub);
            padding: 40px !important;
            font-size: 0.85rem;
        }

        /* ── RANK BADGE ── */
        .rank-1 {
            color: #c0392b;
            font-weight: 900;
            font-size: 1rem;
        }

        .rank-2 {
            color: #c57a00;
            font-weight: 900;
            font-size: 0.95rem;
        }

        .rank-3 {
            color: #f39c12;
            font-weight: 900;
            font-size: 0.9rem;
        }

        .rank-other {
            color: var(--text-sub);
            font-size: 0.78rem;
            font-weight: 600;
        }

        /* ── TFOOT TOTAL ── */
        .laporan-table tfoot tr {
            /* background: var(--dark); */
        }

        .laporan-table tfoot th {
            padding: 15px 18px;
            padding-right: 25px !important;
            width: fit-content;
            color: rgba(0, 0, 0, 0.6);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-align: center;
            border: none;
        }

        .laporan-table tfoot th.total-number {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1.2rem;
            font-weight: 900;
            color: var(--orange);
            letter-spacing: 0;
            text-transform: none;
            text-align: center;
        }

        /* ── DATATABLE OVERRIDES ── */
        div.dataTables_wrapper div.dataTables_filter input {
            background: #faf7f4;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            outline: none;
            transition: border-color 0.2s;
        }

        div.dataTables_wrapper div.dataTables_filter input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(211, 84, 0, 0.1);
        }

        div.dataTables_wrapper div.dataTables_length select {
            background: #faf7f4;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 0.85rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            outline: none;
        }

        div.dataTables_wrapper div.dataTables_info {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            font-size: 0.72rem !important;
            font-family: 'DM Sans', sans-serif !important;
            border: 1px solid var(--border) !important;
            background: #fff !important;
            color: var(--dark) !important;
            margin: 0 1px !important;
            padding: 2px 8px !important;
            line-height: 1.6 !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button:hover {
            background: var(--orange-pale) !important;
            border-color: var(--orange) !important;
            color: var(--orange) !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button.current,
        div.dataTables_wrapper div.dataTables_paginate .paginate_button.current:hover {
            background: var(--orange) !important;
            border-color: var(--orange) !important;
            color: white !important;
            font-weight: 700 !important;
            box-shadow: 0 2px 8px rgba(211, 84, 0, 0.25) !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled,
        div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled:hover {
            color: var(--text-sub) !important;
        }

        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length {
            padding: 14px 20px 0;
        }

        .dataTables_wrapper .dataTables_info {
            padding: 10px 20px 14px;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding: 8px 20px 14px;
        }
    </style>

    <div class="container-fluid px-4 py-2">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Produk <em>Terlaris</em></h1>
            </div>
        </div>

        {{-- FILTER BAR --}}
        <div class="filter-bar">
            <form id="filterForm" style="display:contents;">

                <span class="filter-label"><i class="fas fa-filter"></i> Filter</span>

                <select name="filter" id="filterSelect" class="filter-select">
                    <option value="harian" {{ $filter == 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ $filter == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>

                <input type="date" name="date" class="filter-input filter-harian" value="{{ $date ?? '' }}"
                    style="display:none;">

                <select name="month" class="filter-select filter-bulanan" style="display:none;">
                    @php
                        $months = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember',
                        ];
                    @endphp
                    @foreach ($months as $num => $name)
                        <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}
                        </option>
                    @endforeach
                </select>

                <input type="number" name="year" min="2000" max="2100" class="filter-input filter-year"
                    value="{{ $year ?? '' }}" placeholder="Tahun" style="width:90px; display:none;">

                <div class="filter-divider"></div>

                <a id="btnExcel" href="#" class="btn-excel">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a id="btnPdf" href="#" class="btn-pdf">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>

            </form>
        </div>

        {{-- TABLE CARD --}}
        <div class="table-card">

            <div class="table-card-header">
                <div class="table-header-icon"><i class="fas fa-fire"></i></div>
                <div class="table-header-title">Produk Terlaris</div>
                <div class="table-header-badge" id="filterBadge">{{ ucfirst($filter) }}</div>
            </div>

            <div id="tableWrapper">
                <table class="laporan-table" id="tabelTerlaris">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Produk</th>
                            <th width="120">Terjual</th>
                            <th width="180">Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $row)
                            <tr>
                                <td>
                                    @if ($row['no'] == 1)
                                        <span class="rank-1">{{ $row['no'] }}</span>
                                    @elseif($row['no'] == 2)
                                        <span class="rank-2">{{ $row['no'] }}</span>
                                    @elseif($row['no'] == 3)
                                        <span class="rank-3">{{ $row['no'] }}</span>
                                    @else
                                        <span class="rank-other">{{ $row['no'] }}</span>
                                    @endif
                                </td>
                                <td class="produk-cell">{{ $row['produk'] }}</td>
                                <td>
                                    <span class="terjual-badge">
                                        <i class="fas fa-shopping-bag"></i> {{ $row['terjual'] }}
                                    </span>
                                </td>
                                <td class="pendapatan-cell">Rp {{ number_format($row['pendapatan'], 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="4">
                                    <i class="fas fa-inbox"
                                        style="font-size:2rem;color:var(--text-sub);display:block;margin-bottom:8px;"></i>
                                    Tidak ada data untuk periode ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th class="total-number" id="totalTerjual">{{ $laporan->sum('terjual') }}</th>
                            <th class="total-number" id="totalPendapatan">Rp
                                {{ number_format($laporan->sum('pendapatan'), 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            function updateFilterInputs() {
                var val = $('#filterSelect').val();
                $('.filter-harian, .filter-bulanan, .filter-year').hide();
                if (val == 'harian') {
                    $('.filter-harian, .filter-year').show();
                }
                if (val == 'bulanan') {
                    $('.filter-bulanan, .filter-year').show();
                }
                if (val == 'tahunan') {
                    $('.filter-year').show();
                }

                const labels = {
                    harian: 'Harian',
                    bulanan: 'Bulanan',
                    tahunan: 'Tahunan'
                };
                $('#filterBadge').text(labels[val] || val);
            }

            function updateExportButtons() {
                var params = $('#filterForm').serialize();
                var baseUrl = "{{ route('laporan.produk.terlaris') }}";
                $('#btnExcel').attr('href', baseUrl + '?' + params + '&export=excel');
                $('#btnPdf').attr('href', baseUrl + '?' + params + '&export=pdf');
            }

            function initDataTable() {
                if ($.fn.DataTable.isDataTable('#tabelTerlaris')) {
                    $('#tabelTerlaris').DataTable().destroy();
                }
                $('#tabelTerlaris').DataTable({
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        emptyTable: "Tidak ada data yang tersedia",
                        paginate: {
                            previous: "Prev",
                            next: "Next"
                        }
                    }
                });
            }

            function fetchData() {
                var params = $('#filterForm').serialize();
                var baseUrl = "{{ route('laporan.produk.terlaris') }}";
                $.get(baseUrl, params, function(html) {
                    var $res = $(html);
                    var newTbody = $res.find('#tabelTerlaris tbody').html();
                    var newTotalTerjual = $res.find('#totalTerjual').text();
                    var newTotalPendapatan = $res.find('#totalPendapatan').text();

                    if ($.fn.DataTable.isDataTable('#tabelTerlaris')) {
                        $('#tabelTerlaris').DataTable().destroy();
                    }
                    $('#tabelTerlaris tbody').html(newTbody);
                    $('#totalTerjual').text(newTotalTerjual);
                    $('#totalPendapatan').text(newTotalPendapatan);
                    initDataTable();
                    updateExportButtons();
                });
            }

            $('#filterSelect').on('change', function() {
                updateFilterInputs();
                fetchData();
            });

            $('#filterForm input, #filterForm select').not('#filterSelect').on('change', fetchData);

            updateFilterInputs();
            updateExportButtons();
            initDataTable();
        });
    </script>
@endpush
