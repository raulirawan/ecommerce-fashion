<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Kategori;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $produk = Kategori::with(['produk'])->has('produk')->get();


        return view('shop', compact('produk'));
    }
}
