<?php

namespace App\Http\Controllers;

use App\Mail\DinoRequestCompleted;
use App\Mail\DinoRequested;
use App\Mail\DinoRequestedAdmin;
use App\Mail\DinoRequestUpdated;
use App\User;
use Illuminate\Http\Request;
use App\Dino;
use App\DinoRequest;
use Illuminate\Support\Facades\Auth;
use App\Bank_transaction;
use App\Bank;
use phpDocumentor\Reflection\Types\Null_;



class DinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());


        //finds and list all dinos
        $dinos = \DB::table('dinos')
        ->where('available', '=', '1')
            ->where('price', '<=', $user->gem_balance)
            ->where('qty', '>', '0')
        ->paginate(10);
        /*dd($members);*/
        $viewDinos = '';
        $adminDinoSearch = '';

        return view('ark.dinos', compact('dinos', 'viewDinos', 'adminDinoSearch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //add new dino page
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
        //show dino to be edited
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
        //complete the dinoRequest first we find the dino request and join the related user
        $dinoRequests = DinoRequest::with('users', 'dinos')->find($id);

        //find the dino from the request and create model
        $dino = Dino::find($dinoRequests->dinos->id);
        //get the users name
        $user = $dinoRequests->users->name;
        $dinoName = $dino->name;
        $qty = $dinoRequests->qty;

        $dinoQty = $dino->qty- $dinoRequests->qty;

        //update the dino qty DB cant go negatinve so we reset to 0 if its a negative number
        if($dinoQty < 1){
            $dinoQty = 0;
        }
        $dino->update([
            'qty' => $dinoQty
        ]);
        //change the status to complete
        $dinoRequests->update([
            'status' => 'completed'
        ]);

        //email for completed request
        \Mail::to($dinoRequests->users->email)->send( new DinoRequestCompleted($qty, $user, $dinoName));

        return redirect('/dinoRequests')->with('success', 'Dino Request '. $dinoRequests->id . ' completed');
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
        //edit a dino reuest and update with what ever is put in
        $dino->update([
            'name' => \request('name'),
            'price' => \request('price'),
            'qty' => \request('qty'),
            'level' => \request('level'),
            'platform' => \request('platform'),
            'details' => \request('details'),
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
        $dino = Dino::find($id);
        $dino->available = 0;

        $dino->save();

        return redirect('/dinos');
    }

    public function requestDino(Dino $dino)
    {
        //look up the specified dino request
        $dino = Dino::find(request('id'));

        $count = 1;

        return view('ark.dinoRequest', compact('dino', 'count'));
    }

    public function requestDinoSend(Request $request)
    {
        //Request a Dino funtion first get the quantity and make sure there is something there
        request()->validate([
            'qty'  => 'required|integer|min:0',
        ]);

        //get the qty and go to function to get price
        $total = $this->dinoGemTotal(request()->id, request()->qty);

        //find dino platform
        $platform = Dino::find(request()->id);

        //new request controller for the dino
        $dino = new DinoRequest;
        //who is requesting this
        $dino->user_id = \Auth::id();
        //dino ID number
        $dino->dino_id = \request()->id;
        $dino->qty = \request()->qty;
        $dino->status = 'new';
        $dino->updated_by = \Auth::id();
        $dino->total = $total;
        $dinoName = request()->name;
        $dino->save();

        $dinosNewQty = $platform->qty - 1;
        if ($dinosNewQty < 1){
            $platform->qty = $dinosNewQty;
            $platform->available = 0;
            $platform->save();
        }
        else{
            $platform->qty = $dinosNewQty;
            $platform->save();
        }

        $qty = $dino->qty;
        $user = Auth::user();
        //requstoers name
        $requestor = Auth::user()->name;
        //Gets a list of pvp dino sellers for email

        if ($platform->platform === 'PVP') {
            $sellers = User::whereHas('permissions', function ($q) {
                $q->where('name', 'PVP Dino Seller');
            })->get();
        }
        //gets list of Pve dino sellers
        else {
            $sellers = User::whereHas('permissions', function ($q) {
                $q->where('name', 'PVE Dino Seller');
            })->get();
        }
        $when = now();

        /*$seller='test';
        \Mail::to('brickz28@comcast.net')->later($when, new DinoRequestedAdmin($qty, $total, $requestor, $dinoName));*/ //testing line of code
        //email to each seller, Note this function needs disable when testing mass email use above function
        foreach($sellers as $seller){
            \Mail::to($seller->email)->later($when, new DinoRequestedAdmin($qty, $total, $requestor, $dinoName));
        }

        \Mail::to(\Auth::user()->email)->later($when, new DinoRequested($user, $total, $dinoName, $qty));



        return redirect('/dinos')->with('success', request()->name . ' request submitted.  ' . 'Amount DUE: ' . $total . ' Gems');

    }

    public function dinoGemTotal($id, $qty)
    {
        //calculate dino cost

        //create dino instance
        $cost = Dino::find($id);

        //price of dino cost times the qty
        $total = $cost->price * $qty;

        return ($total);

    }

    public function dinoRequests(){

        $dinoRequests = DinoRequest::with('users', 'dinos')->
            where('status', '!=', 'completed')->
            where('status', '!=', 'cancelled')->
            paginate(10);

        /* dd($dinoRequests);*/

        return view('ark.dinoRequests', compact('dinoRequests'));
    }

    public function dinoRequestView($id){

        $dinoRequest = DinoRequest::with('users', 'dinos')->find($id);

        return view('ark.dinoRequestView', compact('dinoRequest'));

    }

    public function dinoRequestEdit($id)
    {
        //Edit the dino request, first get model of request
        $dinoRequest = DinoRequest::find($id);
        $dinoName = $dinoRequest->dinos->name;

        //validate the edits
        request()->validate([
            'qty'  => 'required|integer|min:0',
            'status' => 'required',
        ]);

        //update the total
        $total = $this->dinoGemTotal($dinoRequest->dinos->id, request()->qty);

        //change the status
        $status = \request('status');

        $dinoRequest->qty = \request()->qty;

        //if its new and we did something change it to view else keep it the same
        if($status === 'new'){
            $dinoRequest->status = 'viewed';
        }
        else{
            $dinoRequest->status = \request('status');
        }

        $dinoRequest->updated_by = \Auth::id();
        $dinoRequest->total = $total;
        //if paid box unchecked set to 0 else we set to 1 to show as paid
        if (\request('paid') === Null){
            $dinoRequest->paid = 0;
        }
        else{
            $dinoRequest->paid = \request('paid');
        }

        //save it
        $dinoRequest->save();

        $qty = $dinoRequest->qty;

        $requestor = $dinoRequest->users->name;

        //send out emails
        \Mail::to($dinoRequest->users->email)->send( new DinoRequestUpdated($qty, $total, $dinoRequest->status, $requestor, $dinoName));

        return redirect('/dinoRequests')->with('success', request()->name . ' request updated.  ' );
    }

    public function searchDino()
    {
        $query=request('search_text');

        $dinos = Dino::where('name', 'LIKE', '%' . $query . '%')->
            orWhere('platform', 'LIKE', '%' . $query . '%')->
            paginate(10);
        $adminDinoSearch = '';

        return view('ark.dinos',compact('dinos', 'adminDinoSearch'));
    }

    public function pveLimitedsearchDinos(){
        $query=request('search_text');

        $dinos = Dino::where('name', 'LIKE', '%' . $query . '%')->
        where('platform', '=', 'PVE')->
        paginate(10);
        $adminDinoSearch = '';

        return view('ark.dinos',compact('dinos', 'adminDinoSearch'));
    }

    public function pvpLimitedsearchDinos(){
        $query=request('search_text');

        $dinos = Dino::where('name', 'LIKE', '%' . $query . '%')->
        where('platform', '=', 'PVP')->
        paginate(10);
        $adminDinoSearch = '';

        return view('ark.dinos',compact('dinos', 'adminDinoSearch'));
    }

    public function searchRequest()
    {
        $q=request('search_text');

        $dinoRequests = DinoRequest::whereHas('users', function($query) use($q) {
            $query->where('name', 'like', '%'.$q.'%');
        })->orWhereHas('dinos', function($query) use($q) {
            $query->where('name', 'like', '%'.$q.'%');
        })->orWhere('status', 'LIKE', '%' . $q . '%')->paginate(10);

        return view('ark.dinoRequests',compact('dinoRequests'));
    }

    public function dinoRequestsCompleted(){

        $dinoRequests = DinoRequest::with('users', 'dinos')->
        where('status', '=', 'completed')->
            orWhereDoesntHave('dinos')->
            has('dinos')->
        paginate(10);

        /* dd($dinoRequests);*/

        return view('ark.completedDinoRequest', compact('dinoRequests'));
    }

    public function pveDinos()
    {
        $user = User::find(Auth::id());

        $dinos = \DB::table('dinos')->
            where('platform', '=', 'pve')
            ->where('price', '<=', $user->gem_balance)
            ->where('qty', '>', '0')
            ->paginate(10);

        $viewDinos = 'PVE';
        $adminDinoSearch = '';

        return view('ark.pveDinos', compact('dinos', 'viewDinos', 'adminDinoSearch'));
    }

    public function pveDinosAdmin(){
        $dinos = \DB::table('dinos')->
        where('platform', '=', 'pve')
            ->paginate(10);

        $adminDinoSearch = 'pve';

        return view('ark.dinos', compact('dinos', 'adminDinoSearch'));

    }

    public function pvpDinosAdmin(){
        $dinos = \DB::table('dinos')->
        where('platform', '=', 'pvp')
            ->paginate(10);

        $adminDinoSearch = 'pvp';

        return view('ark.dinos', compact('dinos', 'adminDinoSearch'));

    }

    public function dinosAdmin(){
        $dinos = Dino::paginate(10);
        $adminDinoSearch = '';

        return view('ark.dinos', compact('dinos', 'adminDinoSearch'));

    }

    public function pvpDinos()
    {
        $user = User::find(Auth::id());

        $dinos = \DB::table('dinos')->
        where('platform', '=', 'pvp')
            ->where('price', '<=', $user->gem_balance)
            ->where('qty', '>', '0')
        ->paginate(10);

        $viewDinos = 'PVP';

        return view('ark.pvpDinos', compact('dinos', 'viewDinos'));
    }

    public function myRequests(){
        $dinoRequests = DinoRequest::with('dinos')->
            where('user_id', '=', Auth::id())->
            paginate(10);

        return view('ark.myRequests', compact('dinoRequests'));
    }

    public function payForDino($id){

        $dino = DinoRequest::find($id);
        $user = User::find(Auth::user()->id);
        $bank = Bank::first();
        $dinos = Dino::find($dino->dino_id);

        if($user->gem_balance < $dino->total){
            return redirect('/myRequests')->with('funds', 'You do not have enough funds in the bank');
        }

        $user->gem_balance -= $dino->total;
        $user->save();

        $dino->paid = 1;
        $dino->save();

        $bank->balance += $dino->total;
        $bank->save();

        Bank_transaction::create([
            'transaction_amount' => $dino->total,
            'payer_id' => $user->id,
            'receiver_id' => 'bank',
            'reason' => 'Paid for Dino',
            'dino_id' => $dinos->name,
        ]);

        $dinosNewQty = $dinos->qty - 1;

        if ($dinosNewQty < 1){
            $dinos->available = 0;
            $dinos->save();
        }
        else{
            $dinos->qty = $dinosNewQty;
            $dinos->save();
        }

        return redirect('/myRequests')->with('success', 'You have paid for your dino');
    }
}
