<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\DataProduk;
use App\Models\FotoProduk;
use App\Models\Guest;
use App\Models\Kategori;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function tbProduk(){
        $dataProduk=DataProduk::with(['foto', 'kategori'])
        ->get();
        return view('pages.admin.tableProduk', compact('dataProduk'));
    }

    public function editProduk($id){
        $data=DataProduk::with('foto','kategori')
        ->findOrFail($id);
        $listKategori = Kategori::all();
        return view('pages.admin.editProduk',compact('data','listKategori'));
    }

    public function updateProduk(Request $request, $id){

$request->validate([
        'nama_produk' => 'required|string|max:255',
        'id_kategori' => 'required|exists:kategori,id_kategori',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        'deskripsi_product' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $produk = DataProduk::findOrFail($id);
    $produk->update([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'jenis' => $request->jenis,
        'stok' => $request->stok,
        'deskripsi' => $request->deskripsi_product,
        'id_kategori' => $request->id_kategori,
    ]);

    // Handle foto
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName(); // misal: 1732567890_baju.webp
        $path = 'foto_produk/' . $filename; // path relatif ke public/

        // Pindahkan file ke folder publik
        $file->move(public_path('storage/foto_produk'), $filename);

        // Hapus foto lama jika ada
        if ($produk->foto) {
            $oldPath = public_path($produk->foto->foto); // misal: storage/foto_produk/baju.webp
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            $produk->foto->delete();
        }

        // Simpan path baru ke tabel foto_produk
        FotoProduk::create([
            'id_produkfoto' => $produk->id_produk,
            'foto' => $path // misal: storage/foto_produk/1732567890_baju.webp
        ]);
        }

    return redirect()->route('tbProduk.show')->with('success', 'Produk berhasil diperbarui!');
    }
    // Tampilkan form tambah produk
    public function createProduk()
    {
        $listKategori = Kategori::all();
        return view('pages.admin.createProduk', compact('listKategori'));
    }

    // Simpan produk baru
    public function storeProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'jenis' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi_product' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Simpan data produk
        $produk = DataProduk::create([
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $request->id_kategori,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi_product,
        ]);

        // Simpan foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'foto_produk/' . $filename;

            // Pindahkan file ke public/storage/foto_produk
            $file->move(public_path('storage/foto_produk'), $filename);

            // Simpan ke tabel foto_produk
            FotoProduk::create([
                'id_produkfoto' => $produk->id_produk,
                'foto' => $path,
            ]);
        }

        return redirect()->route('tbProduk.show')->with('success', 'Produk berhasil ditambahkan!');
    }
     public function indexUsers()
    {
        $users = Guest::all();
        return view('pages.admin.tableUser', compact('users'));
    }

    // Tampilkan semua isi keranjang (semua user)
    public function indexKeranjang()
    {
        $keranjangItems = Keranjang::with(['user', 'produk'])
            ->orderBy('tanggal_ditambahkan', 'desc')
            ->get();
        return view('pages.admin.tableKeranjang', compact('keranjangItems'));
    }

    // Hapus user (opsional)
    public function destroyUser($id_user)
    {
        Guest::where('id_user', $id_user)->delete();
        return redirect()->back()->with('success', 'Akun berhasil dihapus.');
    }

    // Hapus item keranjang
    public function destroyKeranjang($id_keranjang)
    {
        Keranjang::where('id_keranjang', $id_keranjang)->delete();
        return redirect()->back()->with('success', 'Item keranjang dihapus.');
    }
}
