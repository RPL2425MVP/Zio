<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id('id_detail');
            $table->string('id_transaksi');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah');
            $table->integer('harga_satuan'); // simpan harga saat transaksi (karena harga bisa berubah nanti)

            
            $table->foreign('id_produk')->references('id_produk')->on('data_produk')->onDelete('restrict');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_detail');
    }
};
