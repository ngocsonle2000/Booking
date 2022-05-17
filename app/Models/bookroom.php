<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookroom extends Model
{
    use HasFactory;
    protected $table = 'bookrooms';
    protected $fillable = [
        'CodeOrders',
        'NameRoom',
        'NameCustom',
        'IdKindRoom',
        'IdHotel',
        'idAdmin',
        'idUser',
        'Email',
        'Phone',
        'Adrress',
        'Guests',
        'NextDay',
        'OutDay',
        'RoomQuantity',
        'PriceRoom',
        'CountPrice',
        'CodePromo',
        'CountPromo',
        'PaymentStatus',
        'Note',
    ];
    public function KindRoom(){
        return $this -> hasMany(KindRoom::class, 'id', 'IdKindRoom');
    }
    public function Hotel(){
        return $this -> hasMany(Hotel::class, 'id', 'IdHotel');
    }
    public function scopeSearch($queryBook)
    {
        if($key = request()->key){
            $queryBook = $queryBook -> where('CodeOrders', 'like', '%'.$key.'%');
        }
        elseif($key = request()->brand_value){
            $queryBook = $queryBook -> where('idHotel', 'like', '%'.$key.'%');
        }elseif($key = request()->DateFrom){
            $queryBook = $queryBook -> where('NextDay', 'like', '%'.$key.'%');
        }elseif($key = request()->DateTo){
            $queryBook = $queryBook -> where('OutDay', 'like', '%'.$key.'%');
        }
        return $queryBook;
    }
}
