<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'permissions'];
    public function permission(){
        return $this -> hasMany(permission::class, 'id', 'permissions');
    }
}
