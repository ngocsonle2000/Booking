<?php

namespace App\Models;

use App\Models\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $timestamps = FALSE;
    protected $table = 'customer';
    protected $fillable = [
        'username',
        'password',
        'email',
        'phone',
        'adrress',
        'level',
        'Status'
    ];

    // public function hasPermission($route){
    //     $check = $this->routeList();
    //     $roles = $this->getRoles();
    //     return in_array($route, $check) ? true : false;

    //     // return true;
    // }
    // public function routeList(){
    //     $data = [];
    //     foreach($this -> getRoles as $role){
    //         $perm = json_decode($role->permissions);
    //         foreach($perm as $permission){
    //             //trùng route thì loại
    //             if(!in_array($permission, $data)){
    //                 array_push($data, $permission);
    //             }

    //         }
    //     }
    //     return $data;
    // }
    // public function getRoles(){
    //     return $this->belongsToMany(Roles::class, 'user_roles', 'user_id', 'role_id');
    // }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
