<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function show()
    {
        $id_user = Auth::user()->id_user;
        $items = Keranjang::where('id_user', $id_user)->with('produk')->get();

        if ($items->isEmpty()) {
            return redirect('/keranjang')->with('error', 'Keranjang kosong!');
        }

        // Filter item yang produknya masih ada
        $validItems = $items->filter(fn($item) => $item->produk !== null);
        if ($validItems->isEmpty()) {
            return redirect('/keranjang')->with('error', 'Produk di keranjang tidak valid!');
        }

        $total = $validItems->sum(fn($item) => $item->produk->harga * $item->jumlah);

        return view('pages.produk.checkout', compact('total'));
    }

    public function proses(Request $request)
    {
        $id_user = Auth::user()->id_user;
        $items = Keranjang::where('id_user', $id_user)->with('produk')->get();

        $validItems = $items->filter(fn($item) => $item->produk !== null);
        if ($validItems->isEmpty()) {
            return redirect('/keranjang')->with('error', 'Tidak ada item valid untuk checkout!');
        }

        $total = $validItems->sum(fn($item) => $item->produk->harga * $item->jumlah);

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
                'id_transaksi' => Str::random(10),
                'id_user' => $id_user,
                'tanggal_transaksi' => now(),
                'total_harga' => $total,
                'status' => 'pending'
            ]);

            foreach ($validItems as $item) {
                TransaksiDetail::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $item->id_produk,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->produk->harga,
                    
                ]);
            }

            Keranjang::where('id_user', $id_user)->delete();

            DB::commit();

            return redirect()->route('checkout.invoice', ['id' => $transaksi->id_transaksi]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout error: ' . $e->getMessage());
            // Untuk development:
            return back()->with('error', 'Error: ' . $e->getMessage());
            // Untuk production, ganti dengan:
            // return back()->with('error', 'Gagal checkout. Silakan coba lagi.');
        }
    }

    public function invoice($id)
    {
        $transaksi = Transaksi::with('detail.produk', 'user')
            ->where('id_transaksi', $id)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        return view('pages.produk.invoice', compact('transaksi'));
    }



    public function downloadPdf($id)
    {
        $transaksi = Transaksi::with('detail.produk', 'user')
            ->where('id_transaksi', $id)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        $pdf = Pdf::loadView('pages.produk.invoice-pdf', compact('transaksi'))
                ->setPaper('a4', 'portrait');

        return $pdf->download("invoice_{$id}.pdf");
    }
}