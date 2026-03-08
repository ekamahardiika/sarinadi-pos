<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('transaksi.index', compact('produk'));
    }

    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $subtotal = 0;

            foreach ($request->produk_id as $key => $produk_id) {

                $produk = Produk::findOrFail($produk_id);

                $jumlah = $request->jumlah[$key];

                $total = $produk->harga * $jumlah;

                $subtotal += $total;

                $detail[] = [
                    'produk_id' => $produk_id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $produk->harga,
                    'total_harga' => $total
                ];
            }

            $kembalian = null;

            if ($request->metode_pembayaran == 'cash') {
                $kembalian = $request->uang_customer - $subtotal;
            }

            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TRX'.time(),
                'subtotal' => $subtotal,
                'metode_pembayaran' => $request->metode_pembayaran,
                'uang_customer' => $request->uang_customer,
                'kembalian' => $kembalian
            ]);

            foreach ($detail as $item) {

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga_satuan'],
                    'total_harga' => $item['total_harga']
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success','Transaksi berhasil');

        } catch (\Exception $e) {

            DB::rollback();

            return back()->with('error',$e->getMessage());
        }
    }

    public function riwayat()
    {
        $transaksi = Transaksi::latest()->get();
        return view('transaksi.riwayat', compact('transaksi'));
    }

    public function detail($id)
    {
        $transaksi = Transaksi::with('detail.produk')->findOrFail($id);
        return view('transaksi.detail', compact('transaksi'));
    }
}