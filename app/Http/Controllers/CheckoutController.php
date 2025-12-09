<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $id_user = Auth::user()->id_user;
        $items = Keranjang::where('id_user', $id_user)->with('produk')->get();

        if ($items->isEmpty()) {
            return redirect('/keranjang')->with('error', 'Keranjang kosong!');
        }

        $total = $items->sum(fn($item) => $item->produk->harga * $item->jumlah);

        return view('pages.produk.checkout', compact('total'));
    }

    public function proses(Request $request)
    {
        $id_user = Auth::user()->id_user;
        $items = Keranjang::where('id_user', $id_user)->with('produk')->get();

        if ($items->isEmpty()) {
            return redirect('/keranjang')->with('error', 'Tidak ada item untuk checkout!');
        }

        $total = $items->sum(fn($item) => $item->produk->harga * $item->jumlah);

        DB::beginTransaction();
        try {
            // Simpan hanya ke transaksi (tanpa detail)
            DB::table('transaksi')->insert([
                'id_user' => $id_user,
                'tanggal_transaksi' => now(),
                'total_harga' => $total,
                'status' => 'pending'
            ]);

            // Hapus semua item keranjang
            Keranjang::where('id_user', $id_user)->delete();

            DB::commit();

            return redirect('/index')->with('success', 'Checkout berhasil! Silakan cek riwayat pembelian Anda.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal melakukan checkout. Silakan coba lagi.');
        }
    }
}