<?php

namespace App\Models;

use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';

    protected $fillable = [
        'kode_transaksi',
        'subtotal',
        'metode_pembayaran',
        'uang_customer',
        'kembalian'
    ];

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
