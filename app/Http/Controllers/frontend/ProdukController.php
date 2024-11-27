<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Kategori;
use App\Models\Produk;
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
}
