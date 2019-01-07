<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckCurrency;


class CurrencyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ark.converter');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //setting vars
        $refund = '';
        $currency = $request->currency;
        $amount = $request->amount;

        //if its pearls do the conversion
        if($currency === 'pearls'){
            $gems = $amount / 10;
            $remainder = substr($gems, -2);
            // if there is change due
            if ($remainder > 0){
                $gems -= $remainder;
                $remainder *= 10;
            }
            //set refund status and return results
            $refund = $remainder . ' ' . $currency;
            return view('ark.converted', compact('currency','amount', 'gems', 'refund', 'remainder'));
        }

        //converting the metal
        $gems = $amount / 30;

        $remainder = substr(ceil($gems), -2);

        //if change is due
        if ($remainder > 0){
            $gems =round($gems/100) * 100;

            $remainder *= 30;
            $remainder -= $remainder % 50;
        }

        //set refund status and return results
        $refund = 'Please refund '. $remainder . ' ' . $currency;
        return view('ark.converted', compact('currency','amount', 'gems', 'refund', 'remainder'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
