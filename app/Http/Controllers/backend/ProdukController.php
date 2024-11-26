<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;

class ProdukController extends Controller
{
    public function index(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $produk   = Produk::where('kategori_id', $id)->get();
        return view('backend.Produk.index', compact('kategori', 'produk'));
    }

    public function create($id)
    {
        $produk = Produk::all();
        $kategori = Kategori::findOrFail($id);
        return view('backend.Produk.create', compact('produk', 'kategori'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required',
            'stock'         => 'required',
            'price'         => 'required',
            'decription'   => 'required',
            'kategori_id'   => 'required',
        ]);

        Produk::create(
            [
                'name'         => $request->name,
                'stock'         => $request->stock,
                'price'         => $request->price,
                'decription'   => $request->decription,
                'kategori_id'   => $request->kategori_id
            ]
        );

        return redirect()->route('beProduk.index', $request->kategori_id)->with(['Success' => 'Data Berhasil Disimpan']);
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view('backend.Produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'         => 'required',
            'stock'         => 'required',
            'price'         => 'required',
            'decription'   => 'required',

        ]);

        $produk = Produk::findOrFail($id);

        $produk->update([
            'name'         => $request->name,
            'stock'         => $request->stock,
            'price'         => $request->price,
            'decription'   => $request->decription,
        ]);

        return redirect()->route('beProduk.index', $produk->kategori_id)->with('success', 'Data Berhasil Diubah');
    }


    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori_id = $produk->kategori_id;
        $produk->delete();

        return redirect()->route('beProduk.index', ['id' => $kategori_id])->with('success', 'Data Berhail Dihapus!');
    }
}
