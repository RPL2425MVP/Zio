<?php

namespace App\Http\Controllers;

use App\Models\DataProduk;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuestController extends Controller
{
    public function index(){
        
       $produkList = DataProduk::with(['foto', 'kategori'])
    ->where('stok', '>', 0)
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
}
