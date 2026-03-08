@extends('layouts.admin')

@section('content')
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
@endsection