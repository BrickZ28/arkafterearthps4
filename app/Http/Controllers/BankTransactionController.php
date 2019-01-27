<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank_transaction;
use App\User;

class BankTransactionController extends Controller
{
    public function index(){

        $transactions = Bank_transaction::with('payer', 'receiver')->paginate(10);

        return view('bank.transactions', compact('transactions'));
    }

    public function searchTransactions()
    {
        $q=request('search_text');

        $transactions = Bank_transaction::whereHas('payer', function($query) use($q) {
            $query->where('name', 'like', '%'.$q.'%');
        })->orWhereHas('receiver', function($query) use($q) {
            $query->where('reason', 'like', '%'.$q.'%');
        })->orWhere('transaction_amount', 'LIKE', '%' . $q . '%')->paginate(10);

        return view('bank.transactions',compact('transactions'));
    }
}
