<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\KategoriController;
use App\Http\Controllers\backend\ProdukController as BackendProdukController;
use App\Http\Controllers\backend\ImageController as BackendImageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProdukController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
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

// Route::get('/login', function () {
//     return view('dashboard');
// });


Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});




Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    //BE category
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('userAkses:admin');
    Route::get('/admin/category', [KategoriController::class, 'index'])->name('beCategory')->middleware('userAkses:admin');
    Route::get('admin/category/create', [KategoriController::class, 'create'])->name('beCategori.create')->middleware('userAkses:admin');
    Route::post('/admin/category', [KategoriController::class, 'store'])->name('beCategory.store')->middleware('userAkses:admin');

    Route::get('/admin/kategori-edit/{id}', [KategoriController::class, 'edit'])->name('beCategory.edit')->middleware('userAkses:admin');
    Route::put('/admin/kategori-update/{id}', [KategoriController::class, 'update'])->name('beCategory.update')->middleware('userAkses:admin');

    Route::delete('/admin/kategori-Delete/{id}', [KategoriController::class, 'destroy'])->name('beCategory.destroy')->middleware('userAkses:admin');


    //be Produk
    Route::get('/admin/produk/{id}', [BackendProdukController::class, 'index'])->name('beProduk.index')->middleware('userAkses:admin');
    Route::get('/admin/produk-create/{id}', [BackendProdukController::class, 'create'])->name('beProduk.create')->middleware('userAkses:admin');
    Route::post('/admin/produk-store', [BackendProdukController::class, 'store'])->name('beProduk.store')->middleware('userAkses:admin');
    Route::get('/admin/produk-edit/{id}', [BackendProdukController::class, 'edit'])->name('beProduk.edit')->middleware('userAkses:admin');
    Route::put('/admin/produk-update/{id}', [BackendProdukController::class, 'update'])->name('beProduk.update')->middleware('userAkses:admin');
    Route::delete('/admin/produk-Delete/{id}', [BackendProdukController::class, 'destroy'])->name('beProduk.destroy')->middleware('userAkses:admin');

    Route::get('/admin/image/{id}', [BackendImageController::class, 'index'])->name('beImage.index')->middleware('userAkses:admin');
    Route::get('/admin/image-create/{id}', [BackendImageController::class, 'create'])->name('beImage.create')->middleware('userAkses:admin');
    Route::post('/admin/image-store', [BackendImageController::class, 'store'])->name('beImage.store')->middleware('userAkses:admin');

    Route::get('/admin/image-edit/{id}', [BackendImageController::class, 'edit'])->name('beImage.edit')->middleware('userAkses:admin');
    Route::put('/admin/image-update/{id}', [BackendImageController::class, 'update'])->name('beImage.update')->middleware('userAkses:admin');
    Route::delete('/admin/image-Delete/{id}', [BackendImageController::class, 'destroy'])->name('beImage.destroy')->middleware('userAkses:admin');

    
    // FE
    Route::get('/home', [HomeController::class, 'index'])->middleware('userAkses:customer')->name('customer.dashboard');;
    Route::get('/kategori/{id}', [ProdukController::class, 'index'])->name('feProduk')->middleware('userAkses:customer');

    Route::get('/kategori/show/{id}', [ProdukController::class, 'show'])->name('feShow')->middleware('userAkses:customer');
    Route::post('/checkout/{id}', [ProdukController::class, 'checkout'])->name('produk.checkout')->middleware('userAkses:customer');
});


