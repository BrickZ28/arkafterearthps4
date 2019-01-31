<?php

namespace App;

use App\Mail\newUser;
use App\Mail\SendWelcome;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Permission;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pve()
    {
        return $this->belongsToMany(Tribe::class, 'tribe_users');
    }
    public function pvp()
    {
        return $this->belongsToMany(Tribe::class, 'tribe_users');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'user_permissions');
    }

    public function hasRole(...$roles)
    {
        // dd($roles);

        foreach($roles as $role)
        {
            if($this->roles->contains('name',$role))
            {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return $this->hasPermissionThroughRole($permission) || (bool) $this->permissions->where('name',$permission->name)->count();
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach($permission->roles as $role)
        {
            if($this->roles->contains($role))
            {
                return true;
            }
        }
        return false;
    }

    public function givePermission(...$permission)
    {
        $permissions = $this->getPermissions(array_flatten($permission));
        if($permissions === null)
        {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function getPermissions(array $permissions)
    {
        return Permission::whereIn('name',$permissions)->get();
    }

    public function removePermission(...$permission)
    {
        $permissions = $this->getPermissions(array_flatten($permission));
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function modifyPermission(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermission($permissions);
    }

    public function dinoRequest(){
        return $this->hasMany('App\DinoRequest', 'user_id');
    }

    public function markEmailAsVerified()
    {
        $owners = User::whereHas('roles', function ($q){
            $q->where('role_id', '=', '1');
        })
            ->get();

        foreach($owners as $owner){
            \Mail::to($owner->email)->send(new newUser($this->name));
        }

        \Mail::to($this->email)->send(new SendWelcome($this->name));

        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function transactionspay(){
        return $this->hasMany('App\Bank_transaction', 'payer_id');
    }
    public function transactionsget(){
        return $this->hasMany('App\Bank_transaction', 'receiver_id');
    }

    public function gate(){
        return $this->hasOne('App\Gate', 'player', 'id');
    }
    public function gateAdmin(){
        return $this->hasOne('App\Gate', 'admin', 'id');
    }

}
