<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dino;

class TestController extends Controller
{
    public function dinoImage(){
        $dinos = Dino::paginate(10);
        $adminDinoSearch = 'all';
        $viewDinos = '';

        return view('test.test', compact('dinos', 'adminDinoSearch', 'viewDinos'));
    }
}
