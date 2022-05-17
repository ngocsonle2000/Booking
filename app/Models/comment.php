<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'CodeOrders',
        'Comment',
        'Ratings',
        'idHotel',
        'idUser',
    ];
    public function Code(){
        return $this -> hasMany(bookroom::class, 'CodeOrders', 'CodeOrders');
    }
    public function User(){
        return $this -> hasMany(customer::class, 'id', 'idUser');
    }
    public function Admin(){
        return $this -> hasMany(customer::class, 'id', 'idAdmin');
    }
}
