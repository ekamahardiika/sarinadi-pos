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
            --blue: #2980b9;
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
        }

        /* ── DATA TABLE ── */
        .riwayat-table {
            width: 100%;
            border-collapse: collapse;
        }

        .riwayat-table thead tr {
            background: #faf7f4;
            border-bottom: 2px solid var(--border);
        }

        .riwayat-table th {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 13px 18px;
            white-space: nowrap;
        }

        .riwayat-table td {
            padding: 13px 18px;
            font-size: 0.875rem;
            color: var(--dark);
            border-bottom: 1px solid #faf7f4;
            vertical-align: middle;
        }

        .riwayat-table tbody tr:last-child td {
            border-bottom: none;
        }

        .riwayat-table tbody tr:hover td {
            background: #fdf9f6;
        }

        .no-cell {
            color: var(--text-sub);
            font-size: 0.78rem;
            font-weight: 600;
        }

        .kode-cell {
            font-family: 'DM Sans', monospace;
            font-weight: 700;
            color: var(--orange);
            letter-spacing: 0.03em;
        }

        .total-cell {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--dark);
        }

        /* ── BADGES ── */
        .metode-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .badge-cash {
            background: rgba(39, 174, 96, 0.12);
            color: var(--green);
            border: 1px solid rgba(39, 174, 96, 0.2);
        }

        .badge-qris {
            background: rgba(41, 128, 185, 0.12);
            color: var(--blue);
            border: 1px solid rgba(41, 128, 185, 0.2);
        }

        /* ── DETAIL BUTTON ── */
        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: var(--orange-pale);
            border: 1px solid rgba(211, 84, 0, 0.2);
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--orange);
            text-decoration: none;
            transition: all 0.25s;
        }

        .btn-detail:hover {
            background: var(--orange);
            color: white;
            border-color: var(--orange);
            box-shadow: 0 4px 14px rgba(211, 84, 0, 0.25);
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
            font-size: 0.78rem;
            color: var(--text-muted);
            padding-top: 10px;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            /* padding-top: 6px; */
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            font-size: 0.8rem !important;
            font-family: 'DM Sans', sans-serif !important;
            /* border: 1px solid var(--border) !important; */
            background: #fff !important;
            color: var(--dark) !important;
            /* margin: 0 2px !important; */
            /* padding: 4px 10px !important; */
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
            box-shadow: 0 4px 12px rgba(211, 84, 0, 0.3) !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled,
        div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled:hover {
            color: var(--text-sub) !important;
        }

        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length {
            padding: 16px 20px 0;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding: 12px 20px 16px;
        }
    </style>

    <div class="container-fluid px-4 py-2">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Riwayat <em>Transaksi</em></h1>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="table-card">

            <div class="table-card-header">
                <div class="table-header-icon"><i class="fas fa-history"></i></div>
                <div class="table-header-title">Semua Transaksi</div>
            </div>

            <div class="p-0">
                <table class="riwayat-table datatable">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Kode Transaksi</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $trx)
                            <tr>
                                <td class="no-cell">{{ $loop->iteration }}</td>
                                <td class="kode-cell">{{ $trx->kode_transaksi }}</td>
                                <td class="total-cell">Rp {{ number_format($trx->subtotal) }}</td>
                                <td>
                                    @if (strtoupper($trx->metode_pembayaran) == 'CASH')
                                        <span class="metode-badge badge-cash">
                                            <i class="fas fa-money-bill-wave"></i> CASH
                                        </span>
                                    @else
                                        <span class="metode-badge badge-qris">
                                            <i class="fas fa-qrcode"></i> QRIS
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('transaksi.show', $trx->id) }}" class="btn-detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('.datatable')) {
                $('.datatable').DataTable({
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        paginate: {
                            previous: "Prev",
                            next: "Next"
                        }
                    }
                });
            }
        });
    </script>
@endpush
