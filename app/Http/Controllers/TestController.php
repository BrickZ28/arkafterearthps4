<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dino;


class TestController extends Controller
{
    public function dinoImage(){
        $dinos = Dino::orderBy('name')->paginate(10);
        $adminDinoSearch = 'all';
        $viewDinos = '';

        return view('test.test', compact('dinos', 'adminDinoSearch', 'viewDinos'));
    }

    public function addImagetest(){
        return view('test.addImagetest');
    }

    public function addImage(Request $request)
    {

        $path = $request->file('dinoImg')->store(
            'file',
            'spaces'
        );
        dd($path);
        //add new dino to the database first we validate
        $attributes = request()->validate([
            'name'  => 'required',
            'price' => 'required|integer',
            'level' => 'required|integer',
            'platform' => 'required',
            'qty' => 'required',
            'details' => 'nullable'

        ]);


        //create new Dino instance


        Dino::create($attributes);

        return redirect()->action('DinoController@index');
    }
}
