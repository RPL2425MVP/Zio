<?php

namespace App\Http\Controllers;

use App\Models\DataProduk;
use App\Models\Guest;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuestController extends Controller
{
    public function index(){
        
       $produkList = DataProduk::with(['foto', 'kategori'])
    ->where('stok', '>', 0)
    ->limit(10)
    ->get();
    $produkChunked = $produkList->chunk(5);
    return view('pages.user.index', compact('produkChunked'));
    }

    public function regist(){
        return view('pages.user.register');
    }
    public function signup(Request $dataUser){
        $dataUser->validate([
            'nama'=>'required',
            'no_telp'=>'required',
            'email'=>'required',
            'password'=>'required',
            'provinsi'=>'required',
            'kota'=>'required',
            'daerah'=>'required',
            'kode_pos'=>'required',

        ]);

        Guest::create([
            'nama'=>$dataUser->nama,
            'no_telp'=>$dataUser->no_telp,
            'email'=>$dataUser->email,
            'password' => Hash::make($dataUser->password),
            'provinsi'=>$dataUser->provinsi,
            'kota'=>$dataUser->kota,
            'daerah'=>$dataUser->daerah,
            'kode_pos'=>$dataUser->kode_pos,
        ]);
        return redirect('/');
    }
    public function showLoginForm(){
        return view('pages.user.login');
    }
    public function login(Request $login){
         $login->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 1. Cari user berdasarkan email
    $user = Guest::where('email', $login->email)->first();

    // 2. Jika user ada DAN password cocok → login
    if ($user && Hash::check($login->password, $user->password)) {
        Auth::login($user); // login manual
        $login->session()->regenerate();
        return redirect('/index');
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
    }
    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Anda telah logout.');
    }
    public function indexProfile(){
        $id_user = Auth::user()->id_user;
        $bio=Guest::where('id_user',$id_user)->firstOrFail();
        return view('pages.user.profile', compact('bio'));
    }

     public function editField($field)
    {
        $allowedFields = ['nama', 'email', 'telepon', 'alamat', 'kode_pos'];
        if (!in_array($field, $allowedFields)) {
            abort(404);
        }

        $user = Auth::user();
        return view('pages.user.editnama', compact('field', 'user'));
    }

    public function updateField(Request $request, $field)
    {
        $id_user = Auth::id();
        $bio = Guest::findOrFail($id_user);
        $allowedFields = ['nama', 'email', 'telepon', 'kode_pos'];
        if (!in_array($field, $allowedFields)) {
            return redirect()->back()->withErrors(['error' => 'Field tidak diizinkan']);
        }

        // Validasi berdasarkan field
        $rules = [];
        switch ($field) {
            case 'nama':
                $rules = ['value' => 'required|string|max:255'];
                break;
            case 'email':
                $rules = ['value' => 'required|email|unique:account_user,email,' . $bio->id_user . ',id_user'];
                break;
            case 'telepon':
                $rules = ['value' => 'nullable|string|max:20'];
                break;
            case 'kode_pos':
                $rules = ['value' => 'nullable|string|max:10'];
                break;
        }

        $request->validate($rules);

        // Update hanya field yang diminta
        $bio->update([$field => $request->value]);

        return redirect()->route('user.profile')
                         ->with('success', ucfirst($field) . ' berhasil diperbarui!');
    }
    public function editAlamat()
    {
        $user = Auth::user();
        return view('pages.user.editalamat', compact('user'));
    }

    public function updateAlamat(Request $request)
    {
        // Ambil ID user yang login
        $id_user = Auth::id();

        // Cari data dari model Guest (bukan dari session!)
        $bio = Guest::findOrFail($id_user);

        // Validasi
        $request->validate([
            'provinsi' => 'required|string|max:100',
            'kota'     => 'required|string|max:100',
            'daerah'   => 'required|string|max:150',
        ]);

        // Update
        $bio->update([
            'provinsi' => $request->provinsi,
            'kota'     => $request->kota,
            'daerah'   => $request->daerah,
        ]);

        return redirect()->route('user.profile')->with('success', 'Alamat berhasil diperbarui!');
    }
    
    public function showPesanan(){
        $id_user=Auth::user()->id_user;
        $pesanan = Transaksi::where('id_user', $id_user)
        ->with('detail.produk')
        ->get();

        return view('pages.user.pesanan', compact('pesanan','id_user'));
    }
}
