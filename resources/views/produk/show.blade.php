@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Detail Produk</h3>

        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">

                <!-- Gambar Produk -->
                <div class="col-md-4 text-center">

                    @if($produk->gambar)
                        <img src="{{ asset('storage/'.$produk->gambar) }}" 
                             class="img-fluid rounded"
                             style="max-height:250px;">
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif

                </div>

                <!-- Detail Produk -->
                <div class="col-md-8">

                    <table class="table table-bordered">

                        <tr>
                            <th width="200">Nama Produk</th>
                            <td>{{ $produk->nama_produk }}</td>
                        </tr>

                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($produk->harga,0,',','.') }}</td>
                        </tr>

                        <tr>
                            <th>Stok</th>
                            <td>{{ $produk->stok }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                @if($produk->stok > 0)
                                    <span class="badge bg-success">Tersedia</span>
                                @else
                                    <span class="badge bg-danger">Stok Habis</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Dibuat</th>
                            <td>{{ $produk->created_at->format('d M Y H:i') }}</td>
                        </tr>

                    </table>

                    <div class="d-flex gap-2">

                        <a href="{{ route('produk.edit', $produk->id) }}" 
                           class="btn btn-warning">
                            Edit Produk
                        </a>

                        <button 
                            class="btn btn-danger btnHapus"
                            data-id="{{ $produk->id }}"
                            data-nama="{{ $produk->nama_produk }}">
                            Hapus Produk
                        </button>

                    </div>

                </div>

            </div>

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