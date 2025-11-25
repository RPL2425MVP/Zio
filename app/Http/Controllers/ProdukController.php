<?php

namespace App\Http\Controllers;

use App\Models\DataProduk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function show($id)
    {
        // Ambil produk + relasi
        $produk = DataProduk::with(['foto', 'kategori'])
            ->where('id_produk', $id)
            ->where('stok', '>', 0)
            ->firstOrFail();

        // Rekomendasi produk dari kategori yang sama (opsional)
        $rekomendasi = DataProduk::with('foto')
            ->where('id_kategori', $produk->id_kategori)
            ->where('id_produk', '!=', $produk->id_produk)
            ->where('stok', '>', 0)
            ->limit(4)
            ->get();

        return view('pages.produk.detail', compact('produk', 'rekomendasi'));
    }

    


    public function produkList(Request $request)
    {
        $query = DataProduk::with(['foto', 'kategori'])
            ->where('stok', '>', 0);

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $listProduk = $query->get();
        $produkChunked = $listProduk->chunk(5);


        $categories = Kategori::all();

        return view('pages.produk.list', compact('produkChunked', 'categories'));
    }

}
