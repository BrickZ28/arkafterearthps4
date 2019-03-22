<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Dino;


class ImageController extends Controller
{
    public function create(){
        $categories = \DB::table('categories')->get();
        return view('images.create', compact('categories'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        if (!empty($request->file('img'))) {
            $oeFile = $request->file('img')->getClientOriginalName();
            $path = $request->file('img')->storeAs(
                $request->category,
                $oeFile,
                'spaces'
            );

            Image::create([
                'category' => request('category'),
                'name' => request('name'),
                'link' => 'https://ark-afterearth.sfo2.digitaloceanspaces.com/' . $request->category . '/' . $oeFile
            ]);
            return redirect('/images/create')->with('success', 'File ' . $oeFile . ' added');
        }
    }
}
