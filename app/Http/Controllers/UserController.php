<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\User;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::with('roles', 'permissions')->paginate(10)->sortByDesc('user_roles.role_id');

        /*dd($members);*/
        return view('ark.manageUser', compact('members'));
    }

    public function search()
    {
        $query=request('search_text');
        $members = User::where('name', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('ark.manageUser',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = User::with('roles', 'permissions')->find($id);
        $roles = Role::all();
        $permissions = Permission::all();


        return view('ark.editMember', compact('member', 'roles', 'permissions'));
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
        $member = User::find($id);


        $member->tribeName_pvp = request('pvp');
        $member->tribeName_pve = request('pve');
        request()->validate([
            'pve' => 'required',
            'pvp' => 'required'
        ]);
        $member->save();

        $member->role = request('role');
        $member->roles()->sync($member->role);
        $member->permission = request('permission');
        $member->permissions()->sync($member->permission);

        return redirect('/manageUser');

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


}
