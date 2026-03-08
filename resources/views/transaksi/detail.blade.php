@extends('layouts.admin')

<style>
    .dashboard-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2c3e50;
        letter-spacing: -0.3px;
    }
</style>

@section('content')
    <div class="container">

        {{-- Header --}}
        <div class="d-flex justify-content-between mb-4">

            <h1 class="dashboard-title">Detail Transaksi</h1>

            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                ← Kembali Ke Transaksi
            </a>

        </div>

        <div class="card shadow">

            <div class="card-header">
                <h4>Detail Transaksi</h4>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <strong>Kode Transaksi :</strong>
                    {{ $transaksi->kode_transaksi }}
                </div>

                <div class="mb-3">
                    <strong>Metode Pembayaran :</strong>
                    {{ strtoupper($transaksi->metode_pembayaran) }}
                </div>

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($transaksi->detail as $item)
                            <tr>

                                <td>
                                    {{ $item->produk->nama_produk }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->harga_satuan) }}
                                </td>

                                <td>
                                    {{ $item->jumlah }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->total_harga) }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

                <hr>

                <div class="d-flex justify-content-between">
                    <strong>Total :</strong>
                    <strong>Rp {{ number_format($transaksi->subtotal) }}</strong>
                </div>

            </div>

        </div>

    </div>
@endsection
