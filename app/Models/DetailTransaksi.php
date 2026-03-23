<?php

namespace App\Models;

use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// DetailTransaksi.php
class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksis';

    protected $fillable = [
        'transaksi_id',
        'produk_id',   // nullable sekarang
        'jumlah',
        'harga_satuan',
        'total_harga'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class)->withDefault([
            'nama_produk' => 'Produk Dihapus',
            'harga' => 0,
            'stok' => 0,
            'gambar' => null,
        ]);
    }
}
