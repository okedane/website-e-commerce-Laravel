<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'produk'])->latest()->get();
        return view('backend.trasnsactions.index', compact('transactions'));
    }

}
