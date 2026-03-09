<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->integer('subtotal');
            $table->enum('metode_pembayaran', ['cash', 'qris']);
            $table->integer('uang_customer')->nullable();
            $table->integer('kembalian')->nullable();
            $table->string('snap_token')->nullable(); // token snap midtrans
            $table->string('transaction_status')->default('pending'); // pending, settlement, expire
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
