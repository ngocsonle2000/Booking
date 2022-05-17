<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'image',
        'slug',
        'idUser'
    ];
    public function Custom(){
        return $this -> hasMany(customer::class, 'id', 'idUser');
    }

}
