@extends('layouts.admin')

<style>
    .dashboard-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2c3e50;
        letter-spacing: -0.3px;
    }

    .badge-cash {
        background-color: #28a745;
        color: #fff;
    }

    .badge-qris {
        background-color: #007bff;
        color: #fff;
    }
</style>

@section('content')
    <div class="container">

        {{-- Header --}}
        <div class="d-flex justify-content-between mb-4">
            <h1 class="dashboard-title">Riwayat Transaksi</h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped datatable">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Kode</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $trx)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $trx->kode_transaksi }}</td>
                                <td>Rp {{ number_format($trx->subtotal) }}</td>
                                <td>
                                    @if (strtoupper($trx->metode_pembayaran) == 'CASH')
                                        <span class="badge badge-cash">CASH</span>
                                    @else
                                        <span class="badge badge-qris">QRIS</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('transaksi.show', $trx->id) }}"
                                        class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // $(document).ready(function() {
        //     $('.datatable').DataTable({
        //         pageLength: 10,
        //         lengthMenu: [5, 10, 25, 50],
        //         language: {
        //             search: "Cari:",
        //             lengthMenu: "Tampilkan _MENU_ data",
        //             info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        //             paginate: {
        //                 previous: "Prev",
        //                 next: "Next"
        //             }
        //         }
        //     });
        // });

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
