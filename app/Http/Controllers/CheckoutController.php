<?php

namespace App\Http\Controllers;

use App\Cart;
use Exception;
use App\Produk;
use App\Transaksi;
use Midtrans\Snap;
use Midtrans\Config;
use App\TransaksiDetail;
use App\Helpers\ApiHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id);
        $carts = $carts->get();
        $total = $carts->sum('harga');

        $response = ApiHelper::apiGet('https://api.rajaongkir.com/starter/province');
        $response = json_decode($response);
        $data = $response->rajaongkir->results;

        return view('checkout', compact('carts','total','data'));
    }

    public function getKota(Request $request)
    {
        $response = ApiHelper::apiGet('https://api.rajaongkir.com/starter/city?province='.$request->province);
        $response = json_decode($response);
        $data = $response->rajaongkir->results;
        return response()->json($data);
    }

    public function ongkir(Request $request)
    {
        $body = [
            'json' => [
                'origin' => "151",
                'destination' => $request->kota_id,
                'weight' => 1000,
                'courier' => $request->kurir,
            ],
        ];

        $response = ApiHelper::apiPost('https://api.rajaongkir.com/starter/cost', $body);
        $response = json_decode($response);
        $data = $response->rajaongkir->results[0];

        return response()->json($data);
    }

    public function checkoutPost(Request $request)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $kode = 'INV-'.mt_rand(00000,99999);

        $ongkir = $request->ongkir;
        $carts = Cart::where('user_id', Auth::user()->id);
        $carts = $carts->get();
        $harga = $carts->sum('harga');

        $total_harga = $harga + $ongkir;

        $data_layanan = $request->layanan;
        $layanan = explode(' ', $data_layanan);
        // insert ke transaction
        $transaksi = new Transaksi();
        $transaksi->user_id = Auth::user()->id;
        $transaksi->ekspedisi = Str::upper($request->kurir).' | '.$layanan[0];
        $transaksi->kode = $kode;
        $transaksi->harga = $harga;
        $transaksi->total_harga = $total_harga;
        $transaksi->ongkos_kirim = $ongkir;
        $transaksi->alamat_pengiriman = $request->alamat;
        $transaksi->provinsi = $request->provinsi;
        $transaksi->kota = $request->kota;
        $transaksi->status = 'PENDING';

        // midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => $kode,
                'gross_amount' => (int) $total_harga,
            ],

            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'callbacks' => [
                'finish' => 'https://murnicollection.my.id/success',
            ],
            'enable_payments' => ['bca_va','permata_va','bni_va','bri_va','gopay'],
            'vtweb' => [],
        ];

        try {
            //ambil halaman payment midtrans

            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

            $transaksi->link_pembayaran = $paymentUrl;
            $transaksi->save();
             // insert ke detail
            foreach ($carts as $key => $cart) {
                $transaksiDetail = new TransaksiDetail();
                $transaksiDetail->transaksi_id = $transaksi->id;
                $transaksiDetail->produk_id = $cart->produk->id;
                $transaksiDetail->harga = $cart->produk->harga;
                $transaksiDetail->qty = $cart->qty;
                $transaksiDetail->save();
            }
            if($transaksi != null) {
                 // delete cart
                Cart::where('user_id', Auth::user()->id)->delete();
                return response()->json([
                    'message' => 'Transaksi Berhasil di Buat',
                    'status'  => 'success',
                    'url' => $paymentUrl,
                ]);
            } else {
                return response()->json([
                    'message' => 'Transaksi Gagal di Buat, Coba Lagi Ya',
                    'status'  => 'gagal',
                    'url' => url('/'),
                ]);
            }
            //reditect halaman midtrans
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => 'gagal',
                'url' => url('/'),
            ]);
        }


    }
}
