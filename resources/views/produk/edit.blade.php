@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-4">Edit Produk</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Produk --}}
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text"
                           name="nama_produk"
                           class="form-control @error('nama_produk') is-invalid @enderror"
                           value="{{ old('nama_produk', $produk->nama_produk) }}">

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
                           value="{{ old('harga', $produk->harga) }}">

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
                           value="{{ old('stok', $produk->stok) }}">

                    @error('stok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Gambar Lama --}}
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label>
                    <br>

                    @if($produk->gambar)
                        <img src="{{ asset('storage/'.$produk->gambar) }}" width="120" class="mb-2">
                    @else
                        <p class="text-muted">Belum ada gambar</p>
                    @endif
                </div>


                {{-- Upload Gambar Baru --}}
                <div class="mb-3">
                    <label class="form-label">Ganti Gambar</label>

                    <input type="file"
                           name="gambar"
                           class="form-control"
                           accept="image/*"
                           onchange="previewImage(event)">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar
                    </small>

                    <div class="mt-3">
                        <img id="preview" width="120" style="display:none;">
                    </div>
                </div>


                {{-- Tombol --}}
                <div class="mt-4">

                    <button type="submit" class="btn btn-success">
                        Update Produk
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