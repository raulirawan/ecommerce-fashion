<?php

namespace App\Http\Controllers\Admin;

use App\Produk;
use App\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function listProduk()
    {
        $listProduk = Kategori::with(['produk'])->has('produk')->get();
        return view('admin.produk.list-produk', compact('listProduk'));
    }
    public function index($id)
    {
        $produk = Produk::where('kategori_id',$id)->get();
        return view('admin.produk.index', compact('produk'));
    }

    public function store(Request $request)
    {
        $data = new Produk();
        $data->nama_produk = $request->nama_produk;
        $data->slug = Str::slug($request->nama_produk);
        $data->kategori_id = $request->kategori_id;
        $data->stok = $request->stok;
        $data->harga = $request->harga;

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $tujuan_upload = 'image/produk/';
            $nama_file = time()."_".$file->getClientOriginalName();
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload,$nama_file);

            $data->gambar = $tujuan_upload.$nama_file;
        }

        $data->save();

        if($data != null) {
            return redirect()->route('admin.produk.index', $request->kategori_id)->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.produk.index', $request->kategori_id)->with('error','Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = Produk::findOrFail($id);

        $data->nama_produk = $request->nama_produk;
        $data->slug = Str::slug($request->nama_produk);
        $data->kategori_id = $request->kategori_id;
        $data->stok = $request->stok;
        $data->harga = $request->harga;

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $tujuan_upload = 'image/produk/';
            $nama_file = time()."_".$file->getClientOriginalName();
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload,$nama_file);
            if(file_exists($data->gambar)) {
                unlink($data->gambar);
            }
            $data->gambar = $tujuan_upload.$nama_file;
        }

        $data->save();

        if($data != null) {
            return redirect()->route('admin.produk.index', $request->kategori_id)->with('success','Data Berhasil di Update');
        } else {
            return redirect()->route('admin.produk.index', $request->kategori_id)->with('error','Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Produk::findOrFail($id);
        $kategori_id = $data->kategori_id;
        if($data != null) {
            if(file_exists($data->gambar)) {
                unlink($data->gambar);
            }
            $data->delete();
            return redirect()->route('admin.produk.index', $kategori_id)->with('success','Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.produk.index', $kategori_id)->with('error','Data Gagal di Hapus');
        }
    }
}
