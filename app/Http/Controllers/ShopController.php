<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $produk = Produk::all();

        return view('shop', compact('produk'));
    }
}
