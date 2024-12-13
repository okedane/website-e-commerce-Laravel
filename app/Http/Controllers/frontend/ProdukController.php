<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $produks = Produk::where('kategori_id', $id)->with('image')->get();
        return view('frontend.produk.index', compact('kategori', 'produks'));
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        $image  = Image::where('produk_id', $id)->get();
        return view('frontend.produk.show', compact('produk', 'image'));
    }

    public function checkout(Request $request, $id)
    {
        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Validasi kategori (pastikan produk memiliki kategori)
        $kategoriId = $produk->kategori_id; // Asumsi ada relasi kategori_id di tabel produk

        if ($kategoriId != $request->input('kategori_id')) {
            return redirect()->back()->with('error', 'Produk tidak sesuai dengan kategori.');
        }

        // Validasi stok
        if ($produk->stock <= 0) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        // Kurangi stok
        $produk->stock -= 1;
        $produk->save();

        Transaction::create([
            'user_id'     => auth()->id(), // ID user yang melakukan checkout
            'produk_id'   => $produk->id,  // ID produk yang dibeli
            'quantity'    => 1,           // Jumlah produk yang dibeli (1 per checkout)
            'total_price' => $produk->price, // Total harga
        ]);



        // Redirect ke halaman kategori/show/{id}
        return redirect()->route('feShow', ['id' => $produk->id])->with('success', 'Checkout berhasil, stok berkurang.');

    }



}
