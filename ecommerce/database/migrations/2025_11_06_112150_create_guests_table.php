<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // account_user (guest/user)
        Schema::create('account_user', function (Blueprint $table) {
            $table->id('id_user'); // BIGINT UNSIGNED AUTO_INCREMENT
            $table->string('nama', 100);
            $table->string('no_telp');
            $table->string('email', 200)->unique();
            $table->string('password', 100);
            $table->string('provinsi', 100);
            $table->string('kota', 100);
            $table->string('daerah', 100);
            $table->string('kode_pos', 10);
            $table->timestamps();
        });

        // account_admin
        Schema::create('account_admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // kategori
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori');
        });

        // data_produk
        Schema::create('data_produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->string('jenis');
            $table->integer('harga'); // atau decimal(10,2) jika perlu
            $table->integer('stok')->default(0); // ✅ sesuai PDF: "sto k" → stok
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });

        // foto_produk
        Schema::create('foto_produk', function (Blueprint $table) {
            $table->id('id_foto');
            $table->unsignedBigInteger('id_produkfoto');
            $table->string('foto');

            $table->foreign('id_produkfoto')->references('id_produk')->on('data_produk')->onDelete('cascade');
        });

        // keranjang
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah')->default(1);
            $table->timestamp('tanggal_ditambahkan')->useCurrent();

            $table->foreign('id_user')->references('id_user')->on('account_user')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('data_produk')->onDelete('cascade');
        });

        // transaksi (tanpa detail_transaksi)
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_user');
            $table->timestamp('tanggal_transaksi')->useCurrent();
            $table->integer('total_harga');
            $table->enum('status', ['pending', 'dibayar', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');

            $table->foreign('id_user')->references('id_user')->on('account_user')->onDelete('cascade');
        });

        // ulasan
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_produk');
            $table->integer('rating'); // 1–5
            $table->text('komentar')->nullable();
            $table->timestamp('tanggal_ulasan')->useCurrent();

            $table->foreign('id_user')->references('id_user')->on('account_user')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('data_produk')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan');
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('keranjang');
        Schema::dropIfExists('foto_produk');
        Schema::dropIfExists('data_produk');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('account_admin');
        Schema::dropIfExists('account_user');
    }
};