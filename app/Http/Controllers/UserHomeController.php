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
        $this->middleware(['auth', 'verified']);
    }

    public function index(){

        $user = Auth::user(); //get the current user

        $last_pvp = User::where('tribeName_pvp', '=', $user->tribeName_pvp)->orderBy('updated_at', 'desc')->first();//last person updated in users pvp tribe
        $last_pve = User::where('tribeName_pve', '=', $user->tribeName_pve)->orderBy('updated_at', 'desc')->first();//last person updated in users pve tribe

        /*if(empty($last_pve)){$last_pve->name = 'N/A';}
        if(empty($last_pvp)){$last_pvp->name = 'N/A';}*/


        $joined = Carbon::parse($user->created_at)->format('M jS Y');

        $pvpCount =  User::where('tribeName_pvp', '=', $user->tribeName_pvp)->count();//# of pvp tribe members
        $pveCount =  User::where('tribeName_pve', '=', $user->tribeName_pve)->count();//# of pve tribe members

        $tribecount =  $pvpCount + $pveCount;//all tribe member total

        $newDinos = \DB::table('dinos')
            ->select('created_at')
            ->whereDate('created_at', '>', Carbon::now()->subDays(7))
            ->count();

        $numRequest = \DB::table('dino_requests')
            ->where('status', '=', 'completed')
            ->whereDate('updated_at', '>', Carbon::now()->subDays(7))
            ->count();

        return view('ark.userHome', compact('tribecount', 'newDinos', 'numRequest', 'last_pve', 'last_pvp', 'joined'));

    }

    public function edit ($request){

        return  view('ark.myProfile');
    }

    public function updateSelf($id)
    {
        $member = \Auth::user();

        request()->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $member->name = request()->name;
        $member->email = request()->email;

        $member->save();
        return redirect('/myProfile/' . $id)->with('success', 'Profile Successfully Updated');

    }
}
