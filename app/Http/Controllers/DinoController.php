<?php

namespace App\Http\Controllers;

use App\Mail\DinoRequested;
use App\Mail\DinoRequestedAdmin;
use App\Mail\DinoRequestUpdated;
use App\User;
use Illuminate\Http\Request;
use App\Dino;
use App\DinoRequest;
use Illuminate\Support\Facades\Auth;


class DinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dinos = Dino::paginate(10);
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
        $dinoRequests = DinoRequest::find($id);

        $dino = Dino::find($dinoRequests->dino_id);

        $dinoQty = $dino->qty- $dinoRequests->qty;

        if($dinoQty < 1){
            $dinoQty = 0;
        }
        $dino->update([
            'qty' => $dinoQty
        ]);


        $dinoRequests->update([
            'status' => 'completed'
        ]);
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
        $dino->update([
            'name' => \request('name'),
            'price' => \request('price'),
            'qty' => \request('qty'),
            'level' => \request('level'),
            'platform' => \request('platform'),
            'details' => \request('details')
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

    public function requestDino(Dino $dino)
    {
        $dino = Dino::find(request('id'));

        return view('ark.dinoRequest', compact('dino'));
    }

    public function requestDinoSend(Request $request){

        $attributes = request()->validate([
            'qty'  => 'required|integer|min:0',
        ]);

        $total = $this->dinoGemTotal(request()->id, request()->qty);

        $dino = new DinoRequest;
        $dino->user_id = \Auth::id();
        $dino->dino_id = \request()->id;
        $dino->qty = \request()->qty;
        $dino->status = 'new';
        $dino->updated_by = \Auth::id();
        $dino->total = $total;
        $dinoName = request()->name;

        $dino->save();
        $qty = $dino->qty;
        $when = now()->addMinute(1);

        $user = Auth::user();
        $requestor = Auth::user()->name;
        $sellers = User::whereHas('permissions', function($q)
        {
            $q->where('name', 'PVP Dino Seller');
        })->get();

        /*$seller='test';
        \Mail::to('brickz28@comcast.net')->later($when, new DinoRequestedAdmin($qty, $total, $requestor, $dinoName));*/ //testing line of code
        foreach($sellers as $seller){
            \Mail::to($seller->email)->later($when, new DinoRequestedAdmin($qty, $total, $requestor, $dinoName));
        }

        \Mail::to(\Auth::user()->email)->later($when, new DinoRequested($user, $total, $dinoName, $qty));


        return redirect('/dinos')->with('success', request()->name . ' request submitted.  ' . 'Amount DUE: ' . $total . ' Gems');

    }

    public function dinoGemTotal($id, $qty){

        $cost = Dino::find($id);

        $total = $cost->price * $qty;

        return ($total);

    }

    public function dinoRequests(){

        $dinoRequests = DinoRequest::with('users', 'dinos')->where('status', '!=', 'completed')->paginate(10);

        /* dd($dinoRequests);*/

        return view('ark.dinoRequests', compact('dinoRequests'));
    }

    public function dinoRequestView($id){

        $dinoRequest = DinoRequest::with('users', 'dinos')->find($id);

        return view('ark.dinoRequestView', compact('dinoRequest'));

    }

    public function dinoRequestEdit($id){

        $dinoRequest = DinoRequest::find($id);
        $dinoName = $dinoRequest->dinos->name;


        request()->validate([
            'qty'  => 'required|integer|min:0',
            'status' => 'required'
        ]);

        $total = $this->dinoGemTotal($dinoRequest->dinos->id, request()->qty);

        $status = \request('status');

        $dinoRequest->qty = \request()->qty;

        if($status === 'new'){
            $dinoRequest->status = 'viewed';
        }
        else{
            $dinoRequest->status = \request('status');
        }

        $dinoRequest->updated_by = \Auth::id();
        $dinoRequest->total = $total;

        $dinoRequest->save();

        $qty = $dinoRequest->qty;

        $requestor = $dinoRequest->users->name;

        \Mail::to($dinoRequest->users->email)->send( new DinoRequestUpdated($qty, $total, $dinoRequest->status, $requestor, $dinoName));

        return redirect('/dinoRequests')->with('success', request()->name . ' request updated.  ' );
    }

    public function searchDino()
    {
        $query=request('search_text');

        $dinos = Dino::where('name', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('ark.dinos',compact('dinos'));
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
}
