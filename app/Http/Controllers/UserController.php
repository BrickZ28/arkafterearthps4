<?php

namespace App\Http\Controllers;

use App\Dino;
use App\DinoRequest;
use App\Mail\newUser;
use App\Mail\SendPin;
use App\Role;
use App\Permission;
use App\Rules\HasKit;
use App\Rules\HavePermission;
use App\Rules\InsufficientFunds;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;
use App\Bank;
use App\Bank_transaction;
use Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $members = User::with('roles', 'permissions')->paginate(10);

        /*dd($members);*/
        return view('ark.manageUser', compact('members'));
    }

    public function search()
    {
        $query=request('search_text');
        $members = User::where('name', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('ark.manageUser',compact('members'));
    }

    public function searchToSend()
    {
        $query=request('search_text');
        $users = User::where('name', 'LIKE', '%' . $query . '%')->paginate(5);
        $banks_info = Bank::get();

        foreach($banks_info as $bank) {
            $usersBal = Auth::user()->gem_balance;
            $interestEarned = ($usersBal * ($bank->interest_rate / 100)) ;
            return view('ark.manageMyFunds', compact('users', 'banks_info', 'interestEarned'));
        }


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //memeber instance with relations
        $member = User::with('roles', 'permissions')->find($id);

        //gets the list of perms the user doesnt have
        $noPerms = \DB::table('permissions')
            ->whereNotExists(function ($query) use ($id){
               $query->select(\DB::raw(1))
               ->from('user_permissions')
                   ->whereRaw('permissions.id = user_permissions.permission_id')
                   ->where('user_permissions.user_id', '=',$id );
            })
            ->get();

        //get list of the roles and then perms
        $roles = Role::all();
        $permissions = Permission::all();

        return view('ark.editMember', compact('member', 'roles', 'permissions', 'noPerms'));
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
        //update the user info first find and instantiate
        $member = User::find($id);
        $bank = Bank::first();
        $transaction = '';
        //grab the users highest level kit and set
        $levelKit = $member->level_kit;
        $pvpLevelKit = $member->pvp_level_kit;
        $pveLevelKit = $member->pve_level_kit;

        //ensure sufficient funds
        if($request->gemamount > 0){
            request()->validate([
                'gemamount' => [new InsufficientFunds($bank->balance)]
            ]);
            $transaction = 'transaction';
        }


        //grabbing the keys
        $member->tribeName_pvp = request('pvp');
        $member->tribeName_pve = request('pve');
        $member->has_pvp_starter = request('pvpstarter');
        $member->has_pve_starter = request('pvestarter');
        $member->level_kit = request('levelKit');
        $member->pvp_level_kit = request('pvplevelKit');
        $member->pve_level_kit = request('pvelevelKit');
        $member->email = request('email');
        $member->gem_balance += $request->gemamount;
        //if the entered level kit is less than what they have return the error
        if($member->level_kit < $levelKit){
            request()->validate([
                'levelKit' => [new HasKit($member->level_kit)]
            ]);
        }
        if($member->pvp_level_kit < $pvpLevelKit){
            request()->validate([
                'pvplevelKit' => [new HasKit($member->pvp_level_kit)]
            ]);
        }
        if($member->pve_level_kit < $pveLevelKit){
            request()->validate([
                'pvelevelKit' => [new HasKit($member->pve_level_kit)]
            ]);
        }
        //if the no start kit buttonunchecked set it to 0
        if( $member->has_pvp_starter === NULL){
            $member->has_pvp_starter = 0;
        }
        //if the no start kit buttonunchecked set it to 0
        if( $member->has_pve_starter === NULL){
            $member->has_pve_starter = 0;
        }

        request()->validate([
            'pve' => 'required',
            'pvp' => 'required',
            'email' => 'email',
            ]);


        $member->save();
        //deduct from bank
        $bank->balance -= $request->gemamount;
        $bank->save();

        if($request->gemamount > 0){ //insert into transactions
            Bank_transaction::create([
                'transaction_amount' => $request->gemamount,
                'payer_id' => '0',
                'receiver_id' => $member->id,
                'reason' => 'Bank Payment',
                'product_id' => null,
            ]); }


        //get and request all the perms and roles
        $member->role = request('role');
        $member->roles()->sync($member->role);
        $permsAdd = request('permissionA');
        $permsRem = request('permissionR');

        //if we are adding a perm and it has something add it to the user
        if ($permsAdd !== NULL) {
           \DB::table('user_permissions')
               ->insert([
                   'user_id' => $id,
                   'permission_id' => $permsAdd
               ]);
        }
        //if removing perm and NOT adding a new perm count the rows
        if ($permsRem !== NULL && $permsAdd === NULL) {
            $count = \DB::table('user_permissions')
                ->where('user_id', '=', $id)
                ->count();
            // if we got a row it means  they only have 1 per and we cant remove all perms so send an error
            if($count === 1) {
                request()->validate([
                    'permissionR' => ['required', new HavePermission]
                ]);
            }
            //else we remove the perm
            \DB::table('user_permissions')
                ->where('user_id', '=', $id)
                ->where('permission_id', '=', $permsRem)
                ->delete();
        }
        //if adding a perm then add it
        elseif ($permsRem !== NULL) {
            \DB::table('user_permissions')
                ->where('user_id', '=', $id)
                ->where('permission_id', '=', $permsRem)
                ->delete();
        }

        return redirect('/manageUser')->with($transaction, $request->gemamount . ' gems sent to ' . $member->name)->with('success', 'Member update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user =User::find($id);
        \DB::table('dino_requests')->
            where('user_id', '=', $id)->delete();
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();

        return redirect('/manageUser');
    }

    public function sendpin(Request $request){

        request()->validate([
            'style' => ['required']
        ]);

         \Mail::to($request->email)->send( new SendPin($request->pin, $request->gate, $request->style));
         return redirect('/manageUser')->with('success', 'Pin and gate Sent to ' . $request->name . ' at ' . $request->email);
    }

    public function fundsManage(){

        $users =optional( User::find(Auth::user()->id))->paginate(5);
        $banks_info = Bank::get();

        foreach($banks_info as $bank) {
            $usersBal = Auth::user()->gem_balance;
            $interestEarned = ($usersBal * ($bank->interest_rate / 100)) ;
            return view('ark.manageMyFunds', compact('users', 'banks_info', 'interestEarned'));
        }
        return 0;
    }

    public function userToUserFundsTransaction(Request $request){

        $payer = User::find(Auth::user()->id);
        $receiver = User::find($request->receiver);


        request()->validate([
            'amount' => 'integer',
            'receiver' => Rule::notIn([$payer->id])//cant send to yourself
            ]);

        //if the user doesnt have the funds return
        if($payer->gem_balance < $request->amount){
            request()->validate([
                'amount' => [new InsufficientFunds($payer->balance)]
            ]);
        }

        //deduct funds from user
        $payer->gem_balance -= $request->amount;
        $payer->save();
        //add funds to receiver
        $receiver->gem_balance += $request->amount;
        $receiver->save();

        //insert into bank transaction table
        Bank_transaction::create([
            'transaction_amount' => $request->amount,
            'payer_id' => $payer->id,
            'receiver_id' => $receiver->id,
            'reason' => $request->reason,
            'product_id' => null,
        ]);

        return redirect('/manageMyFunds')->with('success', 'You have successfully sent ' . $receiver->name . ' ' .  $request->amount . ' gems');
    }

    public function userToBankFundsTransaction(Request $request){

        $payer = User::find($request->id);
        $bank = Bank::first();

        request()->validate([
            'amount' => 'integer|nullable',
            'receiver' => Rule::notIn([$payer->id])//cant send to yourself
        ]);

        //if the user doesnt have the funds return
        if($payer->gem_balance < $request->amount){
            request()->validate([
                'amount' => [new InsufficientFunds($payer->balance)]
            ]);
        }
        //deduct funds from user
        $payer->gem_balance -= $request->amount;
        $payer->save();
        //add funds to bank
        $bank->balance += $request->amount;
        $bank->save();
        //insert into bank transaction table
        Bank_transaction::create([
            'transaction_amount' => $request->amount,
            'payer_id' => $payer->id,
            'receiver_id' => 'bank',
            'reason' => $request->reason,
            'product_id' => null,
        ]);

        return redirect('/manageMyFunds')->with('success', 'You have successfully sent the bank' . $request->amount . ' gems');
    }

    public function myTransactions(){

        //$user = User::find(Auth::user()->id)->first();

        //$earns = User::with('transactionspay')->paginate(10);

        $earns = \DB::table('bank_transactions')
            ->leftJoin('users', 'payer_id', '=', 'users.user_id')
            ->get();


        //dd($transactions);
        return view('ark.myTransactions', compact('earns'));
    }
}
