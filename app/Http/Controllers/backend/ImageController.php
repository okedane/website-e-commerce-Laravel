<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function index(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $image  = Image::where('produk_id', $id)->get();
        return view('backend.Image.index', compact('produk', 'image'));
    }

    public function create($id)
    {
        $produk = Produk::findOrFail($id);
        return view('backend.Image.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_path'         => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
            'produk_id'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = $image->hashName();
            $image->storeAs('public/uploads/produk', $imageName);
        }

        Image::create([
            'image_path'         => $imageName ?? null,
            'produk_id'          => $request->produk_id,
        ]);

        return redirect()->route('beImage.index', $request->produk_id)->with(['success' => 'Data Berhasil Disimpan !']);
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('backend.Image.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image_path' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = Image::findOrFail($id);
        $imageName = $image->image_path;

        if ($request->hasFile('image_path')) {
            if ($imageName && Storage::exists('public/uploads/produk/' . $imageName)) {
                Storage::delete('public/uploads/produk/' . $imageName);
            }

            $imageFile = $request->file('image_path');
            $imageName = $imageFile->hashName();
            $imageFile->storeAs('public/uploads/produk', $imageName);
        }

        $image->update([
            'image_path' => $imageName,
        ]);

        return redirect()->route('beImage.index', $image->produk_id)->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $produk_id = $image->produk_id;

        if ($image->image_path && Storage::exists('public/uploads/produk/' . $image->image_path)) {
            Storage::delete('public/uploads/produk/' . $image->image_path);
        }

        $image->delete();
        return redirect()->route('beImage.index', ['id' => $produk_id])->with('success', 'Data Berhasil Dihapus!');
    }
}
