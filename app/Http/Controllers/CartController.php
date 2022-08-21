<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id);
        $carts = $carts->get();
        $total = $carts->sum('harga');
        return view('cart', compact('carts','total'));
    }
    public function addCart(Request $request, $id)
    {
        $stok = Produk::where('id', $id)->first()->stok;
        if($stok < $request->qty) {
            return redirect()->back()->with('error','Stok Barang Tidak Cukup!');
        }
        $harga = Produk::where('id', $id)->first()->harga;

        $cart = new Cart();
        $dataCart = Cart::where('produk_id', $id)->where('user_id', Auth::user()->id)->first();
        if($dataCart != null) {
            $dataCart->harga = $dataCart->harga + $harga * $request->qty;
            $dataCart->qty = $dataCart->qty + $request->qty;
            $dataCart->save();
        } else {
            $cart->produk_id = $id;
            $cart->harga = $harga * $request->qty;
            $cart->user_id = Auth::user()->id;
            $cart->qty = $request->qty;
            $cart->save();
        }

        if($cart != null || $dataCart != null) {
            return redirect()->route('cart.index')->with('success','Data Cart Berhasil Di Tambahkan');
        } else {
            return redirect()->back()->with('error','Data Cart Gagal Di Tambahkan');
        }



    }

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);

        if($cart != null) {
            $cart->delete();
            return redirect()->route('cart.index')->with('success','Data Cart Berhasil Di Hapus');
        } else {
            return redirect()->route('cart.index')->with('success','Data Cart Gagal Di Hapus');
        }
    }
}
