<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Bank_transaction;

class BankController extends Controller
{
    public function index(){

        $banks = Bank::first();
        $dailyTransactions = Bank_transaction::whereDay('created_at', '=', date('d'))->count();
        $monthlyTransactions = Bank_transaction::whereMonth('created_at', '=', date('m'))->count();
        $yearlyTransactions = Bank_transaction::whereYear('created_at', '=', date('Y'))->count();

        return view('bank.bank', compact('banks', 'dailyTransactions', 'monthlyTransactions', 'yearlyTransactions'));
    }

    public function update(Request $request){
        request()->validate([
            'funds' => 'integer|nullable',
            'rate' => 'numeric|min:0|nullable',
        ]);

        $bank = Bank::first();
        $newBal = $bank->balance + $request->funds;

        $bank->balance = $newBal;
        $bank->interest_rate = request('rate');

        $bank->save();

        Bank_transaction::create([
            'transaction_amount' => $request->funds,
            'payer_id' => '0',
            'receiver_id' => 'bank',
            'reason' => 'Bank always has money',
            'product_id' => null,
        ]);

        return redirect('/bank')->with('success', 'Transaction Complete');
    }
}
