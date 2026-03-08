@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-4">Tambah Produk</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Produk --}}
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text"
                           name="nama_produk"
                           class="form-control @error('nama_produk') is-invalid @enderror"
                           value="{{ old('nama_produk') }}"
                           placeholder="Masukkan nama produk">

                    @error('nama_produk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Harga --}}
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number"
                           name="harga"
                           class="form-control @error('harga') is-invalid @enderror"
                           value="{{ old('harga') }}"
                           placeholder="Masukkan harga">

                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Stok --}}
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number"
                           name="stok"
                           class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok') }}"
                           placeholder="Masukkan jumlah stok">

                    @error('stok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Gambar --}}
                <div class="mb-3">
                    <label class="form-label">Gambar Produk</label>

                    <input type="file"
                           name="gambar"
                           class="form-control"
                           accept="image/*"
                           onchange="previewImage(event)">

                    <small class="text-muted">
                        Format: JPG, PNG, JPEG
                    </small>

                    <div class="mt-3">
                        <img id="preview" width="120" style="display:none;">
                    </div>
                </div>


                {{-- Tombol --}}
                <div class="mt-4">

                    <button type="submit" class="btn btn-success">
                        Simpan Produk
                    </button>

                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection


@push('scripts')
<script>

function previewImage(event)
{
    let reader = new FileReader();

    reader.onload = function(){
        let output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    }

    reader.readAsDataURL(event.target.files[0]);
}

</script>
@endpush