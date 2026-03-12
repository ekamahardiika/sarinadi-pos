<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk - {{ $transaksi->kode_transaksi }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=DM+Sans:wght@400;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0ece8;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 40px 20px;
            font-family: 'DM Sans', sans-serif;
        }

        .struk-wrapper {
            width: 320px;
        }

        /* ── PAPER ── */
        .struk {
            background: #fff;
            width: 100%;
            padding: 28px 24px 24px;
            position: relative;
            filter: drop-shadow(0 8px 32px rgba(211, 84, 0, 0.18));
        }

        /* Zigzag top */
        .struk::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 0;
            right: 0;
            height: 10px;
            background:
                linear-gradient(135deg, #fff 33.33%, transparent 33.33%) 0 0,
                linear-gradient(-135deg, #fff 33.33%, transparent 33.33%) 0 0;
            background-size: 16px 10px;
            background-color: transparent;
        }

        /* Zigzag bottom */
        .struk::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 10px;
            background:
                linear-gradient(315deg, #fff 33.33%, transparent 33.33%) 0 0,
                linear-gradient(-315deg, #fff 33.33%, transparent 33.33%) 0 0;
            background-size: 16px 10px;
            background-color: transparent;
        }

        /* ── LOGO AREA ── */
        .struk-logo {
            text-align: center;
            margin-bottom: 8px;
            /* dikecilkan dari 16px */
        }

        .struk-logo .brand {
            font-family: 'Share Tech Mono', monospace;
            font-size: 1rem;
            /* dikecilkan dari 1.5rem */
            font-weight: 700;
            color: #d35400;
            letter-spacing: 0.05em;
        }

        .struk-logo .tagline {
            font-size: 0.58rem;
            /* dikecilkan dari 0.68rem */
            color: #aaa;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .struk-logo .address {
            font-size: 0.62rem;
            color: #aaa;
            line-height: 1.5;
        }

        /* ── DIVIDER ── */
        .divider {
            border: none;
            border-top: 1px dashed #ddd;
            margin: 12px 0;
        }

        /* ── META ── */
        .meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.72rem;
            color: #888;
            margin-bottom: 4px;
        }

        .meta-row .val {
            font-weight: 600;
            color: #333;
            font-size: 0.75rem;
        }

        .kode-transaksi {
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.8rem;
            color: #d35400;
            font-weight: 700;
        }

        /* ── ITEMS ── */
        .items-header {
            display: grid;
            grid-template-columns: 1fr 40px 90px;
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #aaa;
            padding: 6px 0 4px;
        }

        .item-row {
            display: grid;
            grid-template-columns: 1fr 40px 90px;
            font-size: 0.78rem;
            padding: 5px 0;
            border-bottom: 1px dotted #f0ece8;
            align-items: start;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: 600;
            color: #1a1008;
            line-height: 1.3;
        }

        .item-sub {
            font-size: 0.65rem;
            color: #aaa;
            margin-top: 1px;
        }

        .item-qty {
            text-align: center;
            font-weight: 700;
            color: #d35400;
            padding-top: 1px;
        }

        .item-total {
            text-align: right;
            font-weight: 600;
            color: #333;
            padding-top: 1px;
        }

        /* ── TOTALS ── */
        .totals-section {
            margin-top: 4px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.78rem;
            padding: 3px 0;
            color: #666;
        }

        .totals-row.grand {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1008;
            padding: 8px 0 4px;
        }

        .totals-row.grand .amount {
            color: #d35400;
            font-family: 'Share Tech Mono', monospace;
            font-size: 1.05rem;
        }

        .totals-row.kembalian .amount {
            color: #27ae60;
            font-weight: 700;
        }

        /* ── FOOTER ── */
        .struk-footer {
            text-align: center;
            margin-top: 16px;
        }

        .struk-footer .thank-you {
            font-size: 0.78rem;
            font-weight: 700;
            color: #d35400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .struk-footer .sub {
            font-size: 0.65rem;
            color: #bbb;
            margin-top: 3px;
        }

        /* ── PRINT BUTTON ── */
        .print-btn {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 14px;
            background: #d35400;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background 0.2s;
        }

        .print-btn:hover {
            background: #b84600;
        }

        @media print {
            @page {
                size: 80mm auto;
                /* lebar kertas thermal 80mm, tinggi otomatis */
                margin: 0;
            }

            body {
                background: white;
                padding: 0;
                display: block;
            }

            .struk-wrapper {
                width: 80mm;
            }

            .struk {
                filter: none;
                box-shadow: none;
                padding: 8px 10px;
                width: 80mm;
            }

            .print-btn {
                display: none;
            }

            .struk::before,
            .struk::after {
                display: none;
            }

            .struk-logo .brand {
                font-size: 0.9rem;
            }

            .struk-logo .address {
                font-size: 0.55rem;
            }
        }
    </style>
</head>

<body>

    <div class="struk-wrapper">
        <div class="struk">

            {{-- Logo --}}
            <div class="struk-logo">
                <div class="brand">Warung Babi Guling Sari Nadi</div>
                <div class="address">Jl. Diponogoro No. 747 Pesanggaran, Denpasar, Bali</div>
                <div class="address">(0361) 710637</div>
            </div>

            <hr class="divider">

            {{-- Meta --}}
            <div class="meta-row">
                <span>Kode</span>
                <span class="kode-transaksi">{{ $transaksi->kode_transaksi }}</span>
            </div>
            <div class="meta-row">
                <span>Tanggal</span>
                <span class="val">{{ $transaksi->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div class="meta-row">
                <span>Pembayaran</span>
                <span class="val">{{ strtoupper($transaksi->metode_pembayaran) }}</span>
            </div>

            <hr class="divider">

            {{-- Items Header --}}
            <div class="items-header">
                <span>Item</span>
                <span style="text-align:center">Qty</span>
                <span style="text-align:right">Total</span>
            </div>

            {{-- Items --}}
            @foreach ($transaksi->detail as $item)
                <div class="item-row">
                    <div>
                        <div class="item-name">{{ $item->produk->nama_produk }}</div>
                        <div class="item-sub">Rp {{ number_format($item->harga_satuan) }} / pcs</div>
                    </div>
                    <div class="item-qty">{{ $item->jumlah }}</div>
                    <div class="item-total">Rp {{ number_format($item->total_harga) }}</div>
                </div>
            @endforeach

            <hr class="divider">

            {{-- Totals --}}
            <div class="totals-section">
                <div class="totals-row grand">
                    <span>TOTAL</span>
                    <span class="amount">Rp {{ number_format($transaksi->subtotal) }}</span>
                </div>

                @if ($transaksi->metode_pembayaran == 'cash')
                    <div class="totals-row">
                        <span>Bayar</span>
                        <span>Rp {{ number_format($transaksi->uang_customer) }}</span>
                    </div>
                    <div class="totals-row kembalian">
                        <span>Kembalian</span>
                        <span class="amount">Rp {{ number_format($transaksi->kembalian) }}</span>
                    </div>
                @endif
            </div>

            <hr class="divider">

            {{-- Footer --}}
            <div class="struk-footer">
                <div class="thank-you">Terima Kasih!</div>
                <div class="sub">Simpan struk ini sebagai bukti pembayaran</div>
            </div>

        </div>

        <button class="print-btn" onclick="window.print()">
            🖨️ &nbsp; Cetak Struk
        </button>
    </div>

</body>

</html>
