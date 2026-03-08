<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        $detail = DetailTransaksi::with('produk','transaksi')->get();

        return view('detail_transaksi.index', compact('detail'));
    }
}