<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dino;

class DinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dinos = Dino::paginate(10)->sortByDesc('name');
        /*dd($members);*/

        return view('ark.dinos', compact('dinos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ark.addDino');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name'  => 'required',
            'price' => 'required|integer',
            'level' => 'required|integer'
        ]);

        Dino::create($attributes);

        return redirect('/dinos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dino $dino)
    {
        return view('ark.editDino', compact('dino'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Dino $dino)
    {
        $dino->update([
            'name' => \request('name'),
            'price' => \request('price'),
            'qty' => \request('qty'),
            'level' => \request('level'),
            'platform' => \request('platform')
        ]);

        return redirect('/dinos')->with('success', $dino->name . ' updated');
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
}
