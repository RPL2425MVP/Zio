<?php

namespace App\Http\Controllers;

use App\Models\DataProduk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua produk + foto pertama masing-masing
        

        return view('welcome', compact('chunks'));
    }
}