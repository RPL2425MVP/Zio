<?php

namespace App\Http\Controllers;

use App\Models\DataProduk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua produk + foto pertama masing-masing
        $products = DataProduk::with('foto')->get();

        // Kelompokkan produk per 5 item untuk carousel
        $chunks = $products->chunk(5);

        return view('welcome', compact('chunks'));
    }
}