@extends('layouts.admin')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

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

        /* ── PRODUCT CARD ── */
        .produk-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s;
            box-shadow: 0 2px 12px rgba(211, 84, 0, 0.05);
            height: 100%;
        }

        .produk-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(211, 84, 0, 0.12);
        }

        .produk-card.produk-habis {
            opacity: 0.55;
            filter: grayscale(0.3);
        }

        .produk-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: block;
        }

        .produk-body {
            padding: 14px 16px 6px;
            text-align: center;
        }

        .produk-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--dark);
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .produk-price {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1rem;
            font-weight: 700;
            color: var(--orange);
            margin-bottom: 4px;
        }

        .produk-stok {
            font-size: 0.75rem;
            color: var(--text-sub);
        }

        .produk-footer {
            padding: 10px 14px 14px;
        }

        .btn-tambah {
            width: 100%;
            padding: 9px;
            border: none;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: var(--orange);
            color: white;
            box-shadow: 0 4px 14px rgba(211, 84, 0, 0.25);
        }

        .btn-tambah:hover:not(:disabled) {
            background: var(--orange-light);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(211, 84, 0, 0.35);
        }

        .btn-tambah:disabled {
            background: #e0d8d0;
            color: var(--text-sub);
            box-shadow: none;
            cursor: not-allowed;
        }

        /* ── ORDER PANEL ── */
        .order-panel {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(211, 84, 0, 0.06);
            position: sticky;
            top: 80px;
        }

        .order-panel-header {
            background: var(--dark);
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .order-panel-icon {
            width: 34px;
            height: 34px;
            background: var(--orange);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .order-panel-title {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1rem;
            font-weight: 700;
            color: white;
        }

        .order-panel-body {
            padding: 18px 20px;
        }

        /* Cart table */
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .cart-table th {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 0 10px;
            border-bottom: 1px solid var(--border);
        }

        .cart-table td {
            padding: 10px 0;
            font-size: 0.82rem;
            color: var(--dark);
            border-bottom: 1px solid #faf7f4;
            vertical-align: middle;
        }

        .cart-table tbody:empty::after {
            content: 'Belum ada item';
            display: block;
            text-align: center;
            color: var(--text-sub);
            font-size: 0.8rem;
            padding: 20px 0;
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .qty-btn {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .qty-btn.minus {
            background: rgba(192, 57, 43, 0.1);
            color: var(--red);
        }

        .qty-btn.minus:hover {
            background: var(--red);
            color: white;
        }

        .qty-btn.plus {
            background: rgba(39, 174, 96, 0.1);
            color: var(--green);
        }

        .qty-btn.plus:hover {
            background: var(--green);
            color: white;
        }

        .qty-num {
            font-weight: 700;
            min-width: 18px;
            text-align: center;
            font-size: 0.88rem;
        }

        /* Divider */
        .order-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 14px 0;
        }

        /* Form fields */
        .field-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 6px;
            display: block;
        }

        .field-select,
        .field-input {
            width: 100%;
            padding: 10px 14px;
            background: #faf7f4;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.875rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }

        .field-select:focus,
        .field-input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(211, 84, 0, 0.12);
        }

        /* Summary rows */
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .summary-row .label {
            color: var(--text-muted);
        }

        .summary-row .value {
            font-weight: 700;
            color: var(--dark);
        }

        .summary-row.total .label {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--orange);
        }

        .summary-row.total .value {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1.2rem;
            color: var(--orange);
        }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: var(--orange);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 6px 20px rgba(211, 84, 0, 0.3);
            margin-top: 16px;
        }

        .btn-submit:hover {
            background: var(--orange-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(211, 84, 0, 0.4);
        }
    </style>

    <div class="container-fluid px-4 py-2">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Tran<em>saksi<em></h1>
            </div>
        </div>

        <div class="row g-4">

            {{-- LIST PRODUK --}}
            <div class="col-md-8">
                <div class="row g-3">
                    @foreach ($produk as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="produk-card {{ $item->stok <= 0 ? 'produk-habis' : '' }}">

                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/300x160/f0ece8/d35400?text=No+Image' }}"
                                    class="produk-img" alt="{{ $item->nama_produk }}">

                                <div class="produk-body">
                                    <div class="produk-name">{{ $item->nama_produk }}</div>
                                    <div class="produk-price">Rp {{ number_format($item->harga) }}</div>
                                    <div class="produk-stok" id="stok-{{ $item->id }}">Stok: {{ $item->stok }}</div>
                                </div>

                                <div class="produk-footer">
                                    <button
                                        class="btn-tambah add-cart
                                    {{ $item->stok <= 0 ? 'disabled' : '' }}"
                                        data-id="{{ $item->id }}" data-nama="{{ $item->nama_produk }}"
                                        data-harga="{{ $item->harga }}" data-stok="{{ $item->stok }}"
                                        id="btn-produk-{{ $item->id }}"
                                        @if ($item->stok <= 0) disabled @endif>
                                        @if ($item->stok <= 0)
                                            <i class="fas fa-times-circle"></i> Stok Habis
                                        @else
                                            <i class="fas fa-plus"></i> Tambah
                                        @endif
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ORDER PANEL --}}
            <div class="col-md-4">
                <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
                    @csrf

                    <div class="order-panel">

                        <div class="order-panel-header">
                            <div class="order-panel-icon"><i class="fas fa-receipt"></i></div>
                            <div class="order-panel-title">Order List</div>
                        </div>

                        <div class="order-panel-body">

                            {{-- Cart Table --}}
                            <table class="cart-table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th style="text-align:right">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-body"></tbody>
                            </table>

                            <hr class="order-divider">

                            {{-- Metode Pembayaran --}}
                            <div class="mb-3">
                                <label class="field-label">Metode Pembayaran</label>
                                <select class="field-select" name="metode_pembayaran" id="metode_pembayaran">
                                    <option value="cash">Cash</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>

                            {{-- Uang Customer --}}
                            <div class="mb-3" id="uang_customer_group">
                                <label class="field-label">Uang Customer</label>
                                <input type="number" class="field-input" name="uang_customer" id="uang_customer"
                                    placeholder="Rp 0">
                            </div>

                            <hr class="order-divider">

                            {{-- Summary --}}
                            <div class="summary-row">
                                <span class="label">Subtotal</span>
                                <span class="value" id="subtotal">Rp 0</span>
                            </div>
                            <div class="summary-row total">
                                <span class="label">Kembalian</span>
                                <span class="value" id="kembalian">Rp 0</span>
                            </div>

                            <div id="hidden-inputs"></div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-check-circle"></i> Simpan Transaksi
                            </button>

                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
        let cart = []
        let subtotalGlobal = 0

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number)
        }

        function renderCart() {
            let html = ""
            let subtotal = 0

            cart.forEach((item, index) => {
                let total = item.qty * item.harga
                subtotal += total
                html += `
            <tr>
                <td style="max-width:100px;word-break:break-word">${item.nama}</td>
                <td>
                    <div class="qty-control">
                        <button type="button" class="qty-btn minus" onclick="decreaseQty(${index})">−</button>
                        <span class="qty-num">${item.qty}</span>
                        <button type="button" class="qty-btn plus" onclick="increaseQty(${index})">+</button>
                    </div>
                </td>
                <td style="text-align:right;white-space:nowrap">Rp ${formatRupiah(total)}</td>
            </tr>`
            })

            subtotalGlobal = subtotal
            document.getElementById("cart-body").innerHTML = html
            document.getElementById("subtotal").innerText = "Rp " + formatRupiah(subtotal)
            updateStockUI()
            hitungKembalian()
        }

        function updateStockUI() {
            document.querySelectorAll(".add-cart").forEach(btn => {
                let id = btn.dataset.id
                let stok = parseInt(btn.dataset.stok)
                let itemCart = cart.find(i => i.id == id)
                let qty = itemCart ? itemCart.qty : 0
                let sisa = stok - qty

                let stokText = document.getElementById("stok-" + id)
                if (stokText) stokText.innerText = "Stok: " + sisa

                if (sisa <= 0) {
                    btn.disabled = true
                    btn.innerHTML = '<i class="fas fa-times-circle"></i> Stok Habis'
                    btn.style.background = '#e0d8d0'
                    btn.style.color = '#b0bec5'
                    btn.style.boxShadow = 'none'
                } else {
                    btn.disabled = false
                    btn.innerHTML = '<i class="fas fa-plus"></i> Tambah'
                    btn.style.background = ''
                    btn.style.color = ''
                    btn.style.boxShadow = ''
                }
            })
        }

        document.querySelectorAll(".add-cart").forEach(btn => {
            btn.addEventListener("click", function() {
                let id = this.dataset.id
                let nama = this.dataset.nama
                let harga = parseInt(this.dataset.harga)
                let stok = parseInt(this.dataset.stok)
                let item = cart.find(i => i.id == id)
                let qty = item ? item.qty : 0

                if (qty >= stok) {
                    alert("Stok habis");
                    return
                }

                if (item) {
                    item.qty++
                } else {
                    cart.push({
                        id,
                        nama,
                        harga,
                        qty: 1,
                        stok
                    })
                }

                renderCart()
            })
        })

        function increaseQty(index) {
            if (cart[index].qty >= cart[index].stok) {
                alert("Stok tidak cukup");
                return
            }
            cart[index].qty++
            renderCart()
        }

        function decreaseQty(index) {
            cart[index].qty--
            if (cart[index].qty <= 0) cart.splice(index, 1)
            renderCart()
        }

        function hitungKembalian() {
            let metode = document.getElementById("metode_pembayaran").value
            let uangGroup = document.getElementById("uang_customer_group")
            let uangInput = document.getElementById("uang_customer")

            if (metode === "qris") {
                uangGroup.style.display = "none"
                document.getElementById("kembalian").innerText = "--"
                return
            } else {
                uangGroup.style.display = "block"
            }

            let uang = parseInt(uangInput.value) || 0
            let kembalian = uang - subtotalGlobal

            document.getElementById("kembalian").innerText =
                kembalian < 0 ? "Uang Kurang" : "Rp " + formatRupiah(kembalian)
        }

        document.getElementById("uang_customer").addEventListener("input", hitungKembalian)
        document.getElementById("metode_pembayaran").addEventListener("change", hitungKembalian)

        document.getElementById("formTransaksi").addEventListener("submit", function() {
            let container = document.getElementById("hidden-inputs")
            container.innerHTML = ""
            cart.forEach(item => {
                container.innerHTML += `
            <input type="hidden" name="produk_id[]" value="${item.id}">
            <input type="hidden" name="jumlah[]" value="${item.qty}">`
            })
        })
    </script>
@endsection
