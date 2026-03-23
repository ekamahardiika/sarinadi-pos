<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{

    public function index()
    {
        $produk = Produk::all();

        return view('transaksi.index', compact('produk'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|array',
            'jumlah' => 'required|array',
            'metode_pembayaran' => 'required'
        ]);

        $subtotal = 0;

        // hitung subtotal
        foreach ($request->produk_id as $i => $id) {

            $produk = Produk::findOrFail($id);

            $subtotal += $produk->harga * $request->jumlah[$i];
        }

        // hitung kembalian (jika cash)
        $uangCustomer = $request->uang_customer ?? 0;
        $kembalian = $request->metode_pembayaran == 'cash'
            ? $uangCustomer - $subtotal
            : 0;

        // simpan transaksi
        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-' . time(),
            'subtotal' => $subtotal,
            'metode_pembayaran' => $request->metode_pembayaran,
            'uang_customer' => $uangCustomer,
            'kembalian' => $kembalian
        ]);


        // simpan detail transaksi
        foreach ($request->produk_id as $i => $id) {

            $produk = Produk::findOrFail($id);

            $jumlah = $request->jumlah[$i];
            $harga = $produk->harga;
            $total = $jumlah * $harga;

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $id,
                'nama_produk' => $produk->nama_produk,
                'jumlah' => $jumlah,
                'harga_satuan' => $harga,
                'total_harga' => $total
            ]);

            // kurangi stok
            $produk->decrement('stok', $jumlah);
        }

        if ($request->metode_pembayaran == 'cash') {
            return redirect()->route('transaksi.show', $transaksi->id);
        }

        // dd(config('midtrans.serverKey'));
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaksi->kode_transaksi,
                'gross_amount' => $subtotal,
            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaksi->snap_token = $snapToken;
        // dd(config('midtrans'));
        $transaksi->save();

        return redirect()->route('transaksi.index', $transaksi->id)->with([
            'snapToken' => $snapToken,
            'transaksi_id' => $transaksi->id
        ]);;
    }



    public function riwayat()
    {
        $transaksi = Transaksi::latest()->get();

        return view('transaksi.riwayat', compact('transaksi'));
    }



    public function show($id)
    {
        $transaksi = Transaksi::with('detail.produk')->findOrFail($id);

        return view('transaksi.detail', compact('transaksi'));
    }

    public function cetak($id)
    {
        $transaksi = Transaksi::with('detail.produk')->findOrFail($id);

        return view('transaksi.cetak', compact('transaksi'));
    }
}
