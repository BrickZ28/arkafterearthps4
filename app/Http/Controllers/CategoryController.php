<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Tests\EventListener\SaveSessionListenerTest;

class CategoryController extends Controller
{
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        request()->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'folder_attribute' => strtolower($request->name . '-images'),
        ]);

        return redirect('/category/create')->with('success', $request->name . ' added to database');
    }
}
