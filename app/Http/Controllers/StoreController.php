<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::with('storeOwner')->orderBy('id')->paginate(10);
        return view('stores.allStores', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countStores = \DB::table('stores')
            ->where('owner_id', '=', \Auth::id())
            ->count();

        if ($countStores > 0){
            return back()->with('failed', 'You are only authorized one(1) store');
        }
        else{
            request()->validate([
                'storeName' => 'required',
                'storeItem' => 'required',
                'storeLocation' => 'required'
            ]);

            Store::create([
                'name' => $request->storeName,
                'items' => $request->storeItem,
                'owner_id' => $request->storeOwner,
                'play_style' => 'pve',
                'location' => $request->storeLocation,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stores = Store::with('items')
        ->where('id', '=', $id)
        ->orderBy('id')
        ->paginate(10);

        return  view('stores.show', compact('stores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        $item='';

        return view('stores.edit', compact('store', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //* Show the Store and its items */
    public function shop(){
        $shops = Store::with('items')->orderBy('id')->paginate(10);


        return view('stores.shop', compact('shops'));
    }
}
