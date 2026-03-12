@extends('layouts.admin')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --orange: #d35400;
            --orange-light: #e8680a;
            --orange-pale: rgba(211, 84, 0, 0.08);
            --dark: #1a1008;
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

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.83rem;
            font-weight: 600;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.25s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn-back:hover {
            border-color: var(--orange);
            color: var(--orange);
            box-shadow: 0 4px 14px rgba(211, 84, 0, 0.12);
        }

        /* ── DETAIL CARD ── */
        .detail-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(211, 84, 0, 0.06);
        }

        .detail-card-header {
            background: var(--dark);
            padding: 20px 28px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .detail-header-icon {
            width: 38px;
            height: 38px;
            background: var(--orange);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .detail-header-title {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1.05rem;
            font-weight: 700;
            color: white;
        }

        .detail-card-body {
            padding: 28px;
        }

        /* ── INFO ROWS ── */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 28px;
        }

        .info-box {
            background: #faf7f4;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px 18px;
        }

        .info-box-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 5px;
        }

        .info-box-value {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--dark);
        }

        .info-box-value.orange {
            color: var(--orange);
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
        }

        /* ── TABLE ── */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .detail-table thead tr {
            background: #faf7f4;
        }

        .detail-table th {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .detail-table td {
            padding: 13px 16px;
            font-size: 0.875rem;
            color: var(--dark);
            border-bottom: 1px solid #faf7f4;
            vertical-align: middle;
        }

        .detail-table tbody tr:last-child td {
            border-bottom: none;
        }

        .detail-table tbody tr:hover td {
            background: #fdf9f6;
        }

        .produk-name-cell {
            font-weight: 600;
        }

        .harga-cell {
            color: var(--text-muted);
        }

        .qty-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--orange-pale);
            color: var(--orange);
            font-weight: 700;
            font-size: 0.8rem;
            min-width: 28px;
            height: 28px;
            border-radius: 8px;
            padding: 0 8px;
        }

        .total-cell {
            font-weight: 700;
            color: var(--dark);
        }

        /* ── TOTAL ROW ── */
        .total-section {
            border-top: 2px solid var(--border);
            padding-top: 20px;
            margin-top: 4px;
            display: flex;
            justify-content: flex-end;
        }

        .total-box {
            background: #faf7f4;
            border-radius: 14px;
            padding: 18px 28px;
            display: flex;
            align-items: center;
            gap: 32px;
            min-width: 280px;
        }

        .total-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(5, 5, 5, 0.45);
        }

        .total-value {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--orange);
            white-space: nowrap;
        }
    </style>

    <div class="container-fluid px-4 py-2">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Detail <em>Transaksi</em></h1>
            </div>
            <a href="{{ route('transaksi.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- DETAIL CARD --}}
        <div class="detail-card">

            <div class="detail-card-header">
                <div class="detail-header-icon"><i class="fas fa-receipt"></i></div>
                <div class="detail-header-title">Detail Transaksi</div>
            </div>

            <div class="detail-card-body">

                {{-- Info Grid --}}
                <div class="info-grid">
                    <div class="info-box">
                        <div class="info-box-label">Kode Transaksi</div>
                        <div class="info-box-value orange">{{ $transaksi->kode_transaksi }}</div>
                    </div>
                    <div class="info-box">
                        <div class="info-box-label">Metode Pembayaran</div>
                        <div class="info-box-value">{{ strtoupper($transaksi->metode_pembayaran) }}</div>
                    </div>
                </div>

                {{-- Table --}}
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Qty</th>
                            <th style="text-align:right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi->detail as $i => $item)
                            <tr>
                                <td style="color:var(--text-sub);font-size:0.78rem">{{ $i + 1 }}</td>
                                <td class="produk-name-cell">{{ $item->produk->nama_produk }}</td>
                                <td class="harga-cell">Rp {{ number_format($item->harga_satuan) }}</td>
                                <td><span class="qty-badge">{{ $item->jumlah }}</span></td>
                                <td class="total-cell" style="text-align:right">Rp {{ number_format($item->total_harga) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Total --}}
                <div class="total-section">
                    <div class="total-box">
                        <a href="{{ route('transaksi.cetak', $transaksi->id) }}" target="_blank" class="btn-back"
                            style="background:var(--orange);color:#fff;border-color:var(--orange);">
                            <i class="fas fa-print"></i> Cetak Struk
                        </a>
                        <div class="total-label">Grand Total</div>
                        <div class="total-value">Rp {{ number_format($transaksi->subtotal) }}</div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
