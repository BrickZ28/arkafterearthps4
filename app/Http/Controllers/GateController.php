<?php

namespace App\Http\Controllers;

use App\Gate;
use App\Rules\SameGateStyle;
use App\User;
use Illuminate\Http\Request;
use function PhpParser\filesInDir;
use Illuminate\Support\Facades\Auth;

class GateController extends Controller
{
    public function index(){
        $pveGates = Gate::with('usergate', 'givenBy')->where('style', '=', 'pve')->orderBy('gate')->paginate('5');

        $pvpGates = Gate::with('usergate', 'givenBy')->where('style', '=', 'pvp')->orderBy('gate')->paginate('5');

        return view('gates.gates', compact('pveGates', 'pvpGates'));
    }

    public function create(){
        return view('gates.create');
    }
    public function store(){
        //add new dino to the database first we validate
        $attributes = request()->validate([
            'gate'  => 'required|max:9',
            'pin' => 'nullable|integer|unique:gates,pin|max:9999|min:0000',
            'style' => 'required',
            'admin' => 'required'
        ]);

        $findRepeat = \DB::table('gates')
            ->where('gate', '=', \request('gate'))
            ->where('style', '=', \request('style'))->count();

        if ($findRepeat > 0){
            request()->validate([
                'gate' => ['required', new SameGateStyle()]
            ]);
        }

        //te new  instance
        Gate::create($attributes);

        return redirect('/gates/create')->with('success', 'Gate successfully created');
    }

    public function edit($id){

        $gate = Gate::find($id);

        return view('gates.edit', compact('gate'));
    }

    public function update(Request $request){

        request()->validate([
            'pin' => 'nullable|integer|unique:gates,pin|max:9999',
        ]);

        $gate = Gate::find(request('id'));
        $gate->pin = request('pin');
        $gate->admin = \Auth::id();
        $gate->player = null;

        $gate->save();

        return redirect('/gates')->with('success', 'Gate ' . $gate->gate . ' successufully updated and no longer assigned to a player');
    }

    public function destroy($id){
        $gate =Gate::find($id);
        $gate->delete();

        return redirect('/gates')->with('success', 'Gate ' . $gate->gate . ' for ' . $gate->style . ' deleted');
    }
}
