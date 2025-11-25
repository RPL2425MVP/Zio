<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataProduk;
use App\Models\FotoProduk;
use App\Models\Kategori;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $pakaian = Kategori::create(['nama_kategori' => 'Pakaian']);
        $aksesoris = Kategori::create(['nama_kategori' => 'Aksesoris']);

        $produkData = [
            ['Kaos Polos', $pakaian->id_kategori, 'Pakaian', 95000, 50],
            ['Topi Bucket', $aksesoris->id_kategori, 'Aksesoris', 75000, 30],
            ['Tas Kanvas', $aksesoris->id_kategori, 'Aksesoris', 200000, 20],
            ['Celana Jeans', $pakaian->id_kategori, 'Pakaian', 180000, 25],
            ['Kaos Couple', $pakaian->id_kategori, 'Pakaian', 110000, 40],
            ['Dompet Kulit', $aksesoris->id_kategori, 'Aksesoris', 150000, 15],
            ['Jaket Kulit', $aksesoris->id_kategori, 'Aksesoris', 150000, 15],
            ['Rompi Kulit', $aksesoris->id_kategori, 'Aksesoris', 150000, 15],
            ['Celana Kulit', $aksesoris->id_kategori, 'Aksesoris', 150000, 15],
            ['Kantong Kulit', $aksesoris->id_kategori, 'Aksesoris', 150000, 15],
        ];

        foreach ($produkData as $data) {
            $produk = DataProduk::create([
                'nama_produk' => $data[0],
                'id_kategori' => $data[1],
                'jenis' => $data[2],
                'harga' => $data[3],
                'stok' => $data[4],
                'deskripsi' => 'Deskripsi produk ' . $data[0],
            ]);

            FotoProduk::create([
                'id_produkfoto' => $produk->id_produk,
                'foto' => 'foto_produk/baju.webp',
            ]);
        }
    }
}