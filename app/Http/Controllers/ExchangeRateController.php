<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExchangeRate;

class ExchangeRateController extends Controller
{
    public function index(){

        $exchangeRates = ExchangeRate::get()->sortByDesc('material');
        /*dd($members);*/

        return view('ark.exchangeRates', compact('exchangeRates'));
    }

    public function currencyEditor(){

        return view('ark.currencyEditor');
    }
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'material'  => 'required',
            'worth' => 'required|integer'
        ]);

        ExchangeRate::create($attributes);

        return redirect('/exchangeRates');
    }

    public function show(ExchangeRate $exchangeRate)
    {
        return view('ark.editExchangeRate', compact('exchangeRate'));
    }

    public function update(ExchangeRate $exchangeRate)
    {

        $exchangeRate->update([
            'material' => \request('material'),
            'worth' => \request('worth'),
            ]);

        return redirect('/exchangeRates')->with('success', $exchangeRate->material . ' updated. The Currency Converter will not function properly, please contact the Web Admin to make this correction');
    }
}
