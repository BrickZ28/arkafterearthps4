<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Bank_transaction;


class UserHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(){

        $user = Auth::user(); //get the current user

        //daily gem of 50
        if ($user->daily_currency === 0){
            $user->gem_balance += 50;
            $user->daily_currency = 1;
            $user->save();

            Bank_transaction::create([
                'transaction_amount' => 50,
                'payer_id' => 0,
                'receiver_id' => $user->id,
                'reason' => 'Daily Bonus',
                'dino_id' => null,
                'admin_payer' => null,
            ]);

        }

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

        $user->update([
                'ip' => \Request::getClientIp()
            ]);


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
