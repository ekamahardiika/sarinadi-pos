@extends('layouts.admin')

<style>
    .dashboard-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2c3e50;
    }

    /* Produk stok habis */
    .produk-habis {
        background: #f5f5f5;
        opacity: 0.7;
    }
</style>

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">

            <h1 class="dashboard-title">Transaksi</h1>

        </div>

        <div class="row">

            {{-- LIST PRODUK --}}
            <div class="col-md-8">

                <div class="row">

                    @foreach ($produk as $item)
                        <div class="col-lg-4 col-md-6 mb-4">

                            <div class="card shadow-sm h-100 {{ $item->stok <= 0 ? 'produk-habis' : '' }}">

                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/150' }}"
                                    class="card-img-top" style="height:170px;object-fit:cover;">

                                <div class="card-body text-center">

                                    <h6 class="fw-bold">
                                        {{ $item->nama_produk }}
                                    </h6>

                                    <p class="text-success fw-bold">
                                        Rp {{ number_format($item->harga) }}
                                    </p>

                                    <small class="text-muted" id="stok-{{ $item->id }}">
                                        Stok : {{ $item->stok }}
                                    </small>

                                </div>

                                <div class="card-footer bg-white border-0 text-center">

                                    <button
                                        class="btn btn-sm w-100 add-cart
{{ $item->stok <= 0 ? 'btn-secondary' : 'btn-primary' }}"
                                        data-id="{{ $item->id }}" data-nama="{{ $item->nama_produk }}"
                                        data-harga="{{ $item->harga }}" data-stok="{{ $item->stok }}"
                                        id="btn-produk-{{ $item->id }}"
                                        @if ($item->stok <= 0) disabled @endif>

                                        @if ($item->stok <= 0)
                                            Stok Habis
                                        @else
                                            + Tambah
                                        @endif

                                    </button>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>


            {{-- ORDER LIST --}}
            <div class="col-md-4">

                <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
                    @csrf

                    <div class="card shadow-sm">

                        <div class="card-header">
                            <h5 class="mb-0">Order List</h5>
                        </div>

                        <div class="card-body">

                            <table class="table table-sm">

                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody id="cart-body"></tbody>

                            </table>

                            <hr>

                            <div class="mb-3">
                                <label class="form-label">Metode Pembayaran</label>

                                <select class="form-control" name="metode_pembayaran" id="metode_pembayaran">
                                    <option value="cash">Cash</option>
                                    <option value="qris">QRIS</option>
                                </select>

                            </div>

                            <div class="mb-3" id="uang_customer_group">

                                <label class="form-label">Uang Customer</label>

                                <input type="number" class="form-control" name="uang_customer" id="uang_customer">

                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong id="subtotal">Rp 0</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Kembalian</span>
                                <span id="kembalian">Rp 0</span>
                            </div>

                            <div id="hidden-inputs"></div>

                            <button type="submit" class="btn btn-success w-100">
                                Simpan Transaksi
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>


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

<td>${item.nama}</td>

<td>

<div class="d-flex gap-2">

<button type="button"
class="btn btn-sm btn-danger"
onclick="decreaseQty(${index})">
-
</button>

<span class="fw-bold">
${item.qty}
</span>

<button type="button"
class="btn btn-sm btn-success"
onclick="increaseQty(${index})">
+
</button>

</div>

</td>

<td>
Rp ${formatRupiah(total)}
</td>

</tr>

`

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

                if (stokText) {
                    stokText.innerText = "Stok : " + sisa
                }

                if (sisa <= 0) {

                    btn.disabled = true
                    btn.innerText = "Stok Habis"
                    btn.classList.remove("btn-primary")
                    btn.classList.add("btn-secondary")

                } else {

                    btn.disabled = false
                    btn.innerText = "+ Tambah"
                    btn.classList.remove("btn-secondary")
                    btn.classList.add("btn-primary")

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
                    alert("Stok habis")
                    return
                }

                if (item) {

                    item.qty++

                } else {

                    cart.push({
                        id: id,
                        nama: nama,
                        harga: harga,
                        qty: 1,
                        stok: stok
                    })

                }

                renderCart()

            })

        })


        function increaseQty(index) {

            if (cart[index].qty >= cart[index].stok) {
                alert("Stok tidak cukup")
                return
            }

            cart[index].qty++

            renderCart()

        }


        function decreaseQty(index) {

            cart[index].qty--

            if (cart[index].qty <= 0) {
                cart.splice(index, 1)
            }

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

            if (kembalian < 0) {

                document.getElementById("kembalian").innerText = "Uang Kurang"

            } else {

                document.getElementById("kembalian").innerText = "Rp " + formatRupiah(kembalian)

            }

        }


        document.getElementById("uang_customer")
            .addEventListener("input", hitungKembalian)

        document.getElementById("metode_pembayaran")
            .addEventListener("change", hitungKembalian)


        document.getElementById("formTransaksi")
            .addEventListener("submit", function() {

                let container = document.getElementById("hidden-inputs")

                container.innerHTML = ""

                cart.forEach(item => {

                    container.innerHTML += `

<input type="hidden" name="produk_id[]" value="${item.id}">
<input type="hidden" name="jumlah[]" value="${item.qty}">

`

                })

            })
    </script>
@endsection
