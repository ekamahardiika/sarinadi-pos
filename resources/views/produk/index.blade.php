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

                            <form action="{{ route('produk.destroy', $item->id) }}" 
                                  method="POST" 
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus produk?')">
                                    Hapus
                                </button>
                            </form>

                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection