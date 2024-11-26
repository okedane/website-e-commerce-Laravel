<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\KategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});


 //BE category
 Route::get('/admin/category', [KategoriController::class, 'index'])->name('beCategory');
 Route::get('admin/category/create', [KategoriController::class, 'create'])->name('beCategori.create');
 Route::post('/admin/category', [KategoriController::class, 'store'])->name('beCategory.store');

 Route::get('/admin/kategori-edit/{id}', [KategoriController::class, 'edit'])->name('beCategory.edit');
 Route::put('/admin/kategori-update/{id}', [KategoriController::class, 'update'])->name('beCategory.update');

 Route::delete('/admin/kategori-Delete/{id}', [KategoriController::class, 'destroy'])->name('beCategory.destroy');