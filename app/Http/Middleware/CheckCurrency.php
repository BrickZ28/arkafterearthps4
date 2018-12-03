<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;

class CheckCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //validate entries are there and amount is numeric
        $request->validate([
            'currency'=> 'required',
            'amount' => 'required|numeric',
        ]);

        //make sure there is at least 1000 pearls
        if($request->currency === 'pearls'){
            if($request->amount < '1000'){
                $msg = 'Must be at least 1000 Black Pearls';
                return back()->withErrors(compact('msg'))->withInput(Input::all());
            }
        }

        //make sure there is at least 3000 metal
        if($request->currency === 'metal'){
            if($request->amount < '3000'){
                $msg = 'Must be at least 3000 Metal Ingots';
                return back()->withErrors(compact('msg'))->withInput(Input::all());
            }
        }

        //ensures that multiples are in 100 to align with gems
        if($request->amount % 100 !== 0){
            $msg = 'Must be at least in multiples of 100';
            return back()->withErrors(compact('msg'))->withInput(Input::all());
        }
        return $next($request);
    }
}
