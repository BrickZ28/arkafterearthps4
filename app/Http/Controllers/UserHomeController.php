<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class UserHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $user = Auth::user(); //get the current user

        $last_pvp = User::where('tribeName_pvp', '=', $user->tribeName_pvp)->orderBy('updated_at', 'desc')->first();//last person updated in users pvp tribe
        $last_pve = User::where('tribeName_pvp', '=', $user->tribeName_pve)->orderBy('updated_at', 'desc')->first();//last person updated in users pve tribe

        $joined = Carbon::parse($user->created_at)->format('M jS Y');

        $pvpCount =  User::where('tribeName_pvp', '=', $user->tribeName_pvp)->count();//# of pvp tribe members
        $pveCount =  User::where('tribeName_pve', '=', $user->tribeName_pve)->count();//# of pve tribe members

        $tribecount =  $pvpCount + $pveCount;//all tribe member total

        return view('ark.userHome', compact('tribecount', 'last_pve', 'last_pvp', 'joined'));

    }

    public function edit ($request){

        return  view('ark.myProfile');
    }
}
