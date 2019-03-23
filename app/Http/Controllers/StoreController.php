<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use App\Category;
use App\Image;

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
                'storeLocation' => 'required',
                'map' => 'required'
            ]);

            Store::create([
                'name' => $request->storeName,
                'description' => $request->storeItem,
                'owner_id' => $request->storeOwner,
                'play_style' => 'pve',
                'location' => $request->storeLocation,
                'map' => $request->map,
            ]);

            return back()->with('success', 'Store created');
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
        $categories = Category::all();
        $images = Image::all();

        return view('stores.edit', compact('store', 'item', 'categories', 'images'));
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
    public function shop(Request $request){
        $shops = \DB::table('items')
            ->leftJoin('stores', 'items.store_id', '=', 'stores.id')
            ->leftJoin('images', 'items.item_img', '=', 'images.id')
            ->where('items.store_id', '=', $request->id)
            ->orderBy('items.id')
            ->paginate(10);

        return view('stores.shop', compact('shops'));
    }
}
