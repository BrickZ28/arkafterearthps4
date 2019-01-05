<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;


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

        $noPerms = \DB::table('permissions')
            ->whereNotExists(function ($query) use ($id){
               $query->select(\DB::raw(1))
               ->from('user_permissions')
                   ->whereRaw('permissions.id = user_permissions.permission_id')
                   ->where('user_permissions.user_id', '=',$id );
            })
            ->get();

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
        $member = User::find($id);

        $member->tribeName_pvp = request('pvp');
        $member->tribeName_pve = request('pve');

        request()->validate([
            'pve' => 'required',
            'pvp' => 'required',
            ]);

        $member->save();

        $member->role = request('role');
        $member->roles()->sync($member->role);
        $permsAdd = request('permissionA');
        $permsRem = request('permissionR');
        if ($permsAdd !== NULL) {
           \DB::table('user_permissions')
               ->insert([
                   'user_id' => $id,
                   'permission_id' => $permsAdd
               ]);
        }
        if ($permsRem !== NULL && $permsAdd === NULL) {
            $count = \DB::table('user_permissions')
                ->where('user_id', '=', $id)
                ->count();

            if($count === 1) {
                request()->validate([
                    'permissionR.permissionR' => 'permissionR'
                ]);
            }
            \DB::table('user_permissions')
                ->where('user_id', '=', $id)
                ->where('permission_id', '=', $permsRem)
                ->delete();
        }
        elseif ($permsRem !== NULL) {
            \DB::table('user_permissions')
                ->where('user_id', '=', $id)
                ->where('permission_id', '=', $permsRem)
                ->delete();
        }

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
