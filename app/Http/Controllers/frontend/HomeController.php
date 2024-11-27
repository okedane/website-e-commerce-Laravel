<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller; // Tambahkan ini
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $category = Kategori::get();
        return view('frontend.home', compact('category'));
    }
}
