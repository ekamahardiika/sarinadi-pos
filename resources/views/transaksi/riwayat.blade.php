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

    </div>

    <div class="card shadow">

        <div class="card-header">
            <h4>Riwayat Transaksi</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($transaksi as $trx)

                    <tr>

                        <td>
                            {{ $trx->kode_transaksi }}
                        </td>

                        <td>
                            Rp {{ number_format($trx->subtotal) }}
                        </td>

                        <td>
                            {{ strtoupper($trx->metode_pembayaran) }}
                        </td>

                        <td>

                            <a href="{{ route('transaksi.show',$trx->id) }}" class="btn btn-sm btn-primary">

                                Detail

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection