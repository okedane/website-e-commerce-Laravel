<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategories = Kategori::get();
        return view('backend.kategori.index', compact('kategories'));
    }

    public function create()
    {
        return view('backend.kategori.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|max:30|string',
            'description'   => 'required|max:255|string',
            'image'         => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/uploads/category', $imageName);
        }


        Kategori::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'image'         => $imageName ?? null,
        ]);


        return redirect()->route('beCategory')->with(['success' => 'Data Berhasil Disimpan !']);
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('backend.kategori.edit', compact('kategori'));
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:30|string',
            'description' => 'required|max:255|string',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Inisialisasi variabel untuk gambar
        $imageName = $kategori->image; // Simpan nama gambar lama

        // Proses gambar jika ada yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($imageName && Storage::exists('public/uploads/category/' . $imageName)) {
                Storage::delete('public/uploads/category/' . $imageName);
            }

            // Simpan gambar baru
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/uploads/category', $imageName);
        }

        // Update data kategori
        $kategori->update([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imageName,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('beCategory')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        // Temukan kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($kategori->image && Storage::exists('public/uploads/category/' . $kategori->image)) {
            Storage::delete('public/uploads/category/' . $kategori->image);
        }

        // Hapus kategori dari database
        $kategori->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('beCategory')->with('success', 'Data Berhasil Dihapus!');
    }
}
