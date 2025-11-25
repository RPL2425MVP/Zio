<?php

namespace App\Http\Controllers;

use App\Models\DataProduk;
use App\Models\Keranjang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{

     public function tambah(Request $request, $id_produk)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = DataProduk::where('id_produk', $id_produk)
            ->where('stok', '>', 0)
            ->firstOrFail();

        // Cek stok
        if ($request->jumlah > $produk->stok) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Ambil id_user (jika login)
        $id_user = Auth::user()->id_user;

        // Cek apakah item sudah ada di keranjang
        $keranjangItem = Keranjang::where('id_user', $id_user)
            ->where('id_produk', $id_produk)
            ->first();

        if ($keranjangItem) {
            // Update jumlah
            $totalJumlah = $keranjangItem->jumlah + $request->jumlah;
            if ($totalJumlah > $produk->stok) {
                return back()->with('error', 'Stok tidak mencukupi.');
            }
            $keranjangItem->jumlah = $totalJumlah;
            $keranjangItem->save();
        } else {
            // Tambah baru
            Keranjang::create([
                'id_user' => $id_user,
                'id_produk' => $id_produk,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect('/keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    
    public function index()
    {
        // Ambil keranjang berdasarkan user (jika login)
        $id_user = Auth::user()->id_user;

        $keranjangItems = Keranjang::with('produk.foto')
            ->where('id_user', $id_user)
            ->get();

        $total = 0;
        foreach ($keranjangItems as $item) {
            $total += $item->produk->harga * $item->jumlah;
        }

        return view('pages.produk.keranjang', compact('keranjangItems', 'total'));
    }


    public function ubahQty(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_keranjang' => 'required|exists:keranjang,id_keranjang',
            'aksi'         => 'required|in:tambah,kurangi',
        ]);

        // Ambil item keranjang milik user yang sedang login
        $item = Keranjang::where('id_keranjang', $request->id_keranjang)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        if ($request->aksi === 'tambah') {
            $produk = DataProduk::find($item->id_produk);
            if ($item->jumlah >= $produk->stok) {
                return back()->with('error', 'Stok tidak mencukupi untuk ' . $produk->nama_produk);
            }
            $item->jumlah += 1;
            $item->save();
        } 
        elseif ($request->aksi === 'kurangi') {
            if ($item->jumlah <= 1) {
                // 🔥 HAPUS ITEM JIKA JUMLAH = 1 DAN DIKURANGI
                $item->delete();
                return back()->with('success', 'Produk dihapus dari keranjang.');
            }
            $item->jumlah -= 1;
            $item->save();
        }

        return back();
    }
}
