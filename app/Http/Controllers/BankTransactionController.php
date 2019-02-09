<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank_transaction;
use App\User;
use Auth;


class BankTransactionController extends Controller
{
    public function index(){

        $transactions = \DB::table('bank_transactions')
            ->leftJoin('users as up', 'up.id', '=', 'payer_id')
            ->select('bank_transactions.id', 'bank_transactions.transaction_amount', 'bank_transactions.payer_id', 'bank_transactions.receiver_id', 'bank_transactions.dino_id', 'bank_transactions.reason', 'bank_transactions.created_at', 'up.name as payer', 'ug.name as receiver', 'admin.name as admin')
            ->leftJoin('users as ug', 'ug.id', '=', 'receiver_id')
            ->leftJoin('users as admin', 'admin.id', '=', 'admin_payer')
            ->orderBy('bank_transactions.id', 'desc')
            ->paginate(10);



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

    public function payFromUserstransactions(){
        $earns = \DB::table('users')
            ->join('bank_transactions', 'users.id', '=', 'bank_transactions.payer_id')
            ->select('users.name', 'bank_transactions.id', 'bank_transactions.transaction_amount', 'bank_transactions.dino_id', 'bank_transactions.reason', 'bank_transactions.created_at')
            ->where('receiver_id', '=', Auth::id())
            ->paginate(5);

        $earnsBank = \DB::table('bank_transactions')
            ->where('payer_id', '=', '0')
            ->where('receiver_id', '=', Auth::id())
            ->paginate(5);



        return view('ark.inTransactions', compact('earns', 'earnsBank'));
    }

    public function payToUserstransactions(){
        $pays = \DB::table('users')
            ->join('bank_transactions', 'users.id', '=', 'bank_transactions.receiver_id')
            ->select('users.name', 'bank_transactions.id', 'bank_transactions.transaction_amount', 'bank_transactions.dino_id', 'bank_transactions.reason', 'bank_transactions.created_at')
            ->where('payer_id', '=', Auth::id())
            ->paginate(5);

        $bankPays = \DB::table('bank_transactions')
            ->where('receiver_id', '=', 0)
            ->where('payer_id', '=', Auth::id())
            ->paginate(5);



        return view('ark.outTransactions', compact('pays', 'bankPays' ));
    }

    public function searchTransactionsToBank(){

        $pays = \DB::table('users')
            ->join('bank_transactions', 'users.id', '=', 'bank_transactions.receiver_id')
            ->select('users.name', 'bank_transactions.id', 'bank_transactions.transaction_amount', 'bank_transactions.dino_id', 'bank_transactions.reason', 'bank_transactions.created_at')
            ->where('payer_id', '=', Auth::id())
            ->paginate(5);

        $query=request('search_text');
        $bankPays = \DB::table('bank_transactions')
            ->where('receiver_id', '=', 0)
            ->where('payer_id', '=', Auth::id())
            ->where('bank_transactions.reason', 'LIKE', '%' . $query . '%' )
            ->orWhere('bank_transactions.id', 'LIKE', '%' . $query . '%' )
            ->paginate(5);

        return view('ark.outTransactions', compact('pays', 'bankPays' ));

    }

    public function searchTransactionsByUser()
    {
        $query=request('search_text');
        $earns = \DB::table('users')
            ->join('bank_transactions', 'users.id', '=', 'bank_transactions.payer_id')
            ->select('users.name', 'bank_transactions.id', 'bank_transactions.transaction_amount', 'bank_transactions.dino_id', 'bank_transactions.reason', 'bank_transactions.created_at')
            ->where('receiver_id', '=', Auth::id())
            ->where(function ($q){
                $query=request('search_text');
                $q->where('users.name', 'LIKE', '%' . $query . '%' )
                    ->orWhere('bank_transactions.id', 'LIKE', '%' . $query . '%' )
                ;
            })
            ->paginate(5);

        $earnsBank = \DB::table('bank_transactions')
            ->where('payer_id', '=', '0')
            ->where('receiver_id', '=', Auth::id())
            ->paginate(5);

        return view('ark.inTransactions',compact('earns', 'earnsBank'));
    }

    public function searchTransactionsFromBank()
    {

        $earns = \DB::table('users')
            ->join('bank_transactions', 'users.id', '=', 'bank_transactions.payer_id')
            ->select('users.name', 'bank_transactions.id', 'bank_transactions.transaction_amount', 'bank_transactions.dino_id', 'bank_transactions.reason', 'bank_transactions.created_at')
            ->where('receiver_id', '=', Auth::id())
            ->paginate(5);


        $earnsBank = \DB::table('bank_transactions')
            ->where('payer_id', '=', '0')
            ->where('receiver_id', '=', Auth::id())
            ->where(function ($q){
                $query=request('search_text');
                $q->where('bank_transactions.transaction_amount', 'LIKE', '%' . $query . '%' )
                ->orWhere('bank_transactions.id', 'LIKE', '%' . $query . '%' );
            })
            ->paginate(5);

        return view('ark.inTransactions',compact('earns', 'earnsBank'));
    }

    public function searchTransactionsPyUser()
    {

        $pays = \DB::table('bank_transactions')
            ->join('users', 'bank_transactions.receiver_id', '=', 'users.id')
            ->select('users.name', 'bank_transactions.id', 'bank_transactions.transaction_amount', 'bank_transactions.dino_id', 'bank_transactions.reason', 'bank_transactions.created_at')
            ->where('payer_id', '=', Auth::id())
            ->where(function ($q){
                $query=request('search_text');
                $q->where('bank_transactions.transaction_amount', 'LIKE', '%' . $query . '%' )
                    ->orWhere('bank_transactions.id', 'LIKE', '%' . $query . '%' );
            })
            ->paginate(5);

        $bankPays = \DB::table('bank_transactions')
            ->where('receiver_id', '=', 0)
            ->where('payer_id', '=', Auth::id())
            ->paginate(5);

        return view('ark.outTransactions',compact('pays', 'bankPays'));
    }
}
