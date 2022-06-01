<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Produk;
use App\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $pendapatan = Transaksi::where('status','SUCCESS')->sum('harga');
        $pendapatan = intval($pendapatan);
        $produk = Produk::count();
        $success = Transaksi::where('status','SUCCESS')->count();
        $customer = User::where('roles','CUSTOMER')->count();
        return view('admin.dashboard', compact('pendapatan','produk','success','customer'));
    }
}
