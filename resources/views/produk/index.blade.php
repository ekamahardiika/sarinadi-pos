@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Produk</h3>

        <a href="{{ route('produk.create') }}" class="btn btn-primary">
            Tambah Produk
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped datatable">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th width="100">Gambar</th>
                        <th>Nama Produk</th>
                        <th width="150">Harga</th>
                        <th width="80">Stok</th>
                        <th width="120">Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($produk as $item)
                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td class="text-center">
                            @if($item->gambar)
                                <img src="{{ asset('storage/'.$item->gambar) }}" width="60">
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $item->nama_produk }}</td>

                        <td>Rp {{ number_format($item->harga,0,',','.') }}</td>

                        <td>{{ $item->stok }}</td>

                        <td>
                            @if($item->stok > 0)
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </td>

                        <td>

                            <a href="{{ route('produk.show', $item->id) }}" 
                               class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="{{ route('produk.edit', $item->id) }}" 
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <button 
                                class="btn btn-danger btn-sm btnHapus"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama_produk }}">
                                Hapus
                            </button>

                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>


<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Apakah Anda yakin ingin menghapus produk
                <strong id="namaProduk"></strong> ?
            </div>

            <div class="modal-footer">

                <form id="formHapus" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>

$(document).on('click','.btnHapus',function(){

    let id = $(this).data('id');
    let nama = $(this).data('nama');

    $('#namaProduk').text(nama);

    let url = "/produk/" + id;

    $('#formHapus').attr('action', url);

    $('#modalHapus').modal('show');

});

</script>
@endpush