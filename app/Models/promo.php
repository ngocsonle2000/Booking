<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promo extends Model
{
    use HasFactory;
    protected $table = 'promo';
    protected $fillable = [
        'name',
        'code',
        'time',
        'start_day',
        'end_day',
        'number',
        'idHotel',
        'idKindRoom',
        'idUser',
        'condition_promo',
        'Status'
    ];
    public function Hotel(){
        return $this -> hasMany(Hotel::class, 'id', 'idHotel');
    }
    public function KindRoom(){
        return $this -> hasMany(KindRoom::class, 'id', 'idKindRoom');
    }
}
