<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KindRoom extends Model
{
    use HasFactory;
    protected $table = 'kindrooms';
    protected $fillable = [
        'name',
        'quantity',
        'TienNghi',
        'area',
        'capacity',
        'bed',
        'status',
        'price',
        'sale_price',
        'image',
        'image_list',
        'content',
        'idUser',
        'idHotel',
        'slug',
        'slug_hotel'
    ];
    public function Hotel(){
        return $this -> hasMany(Hotel::class, 'id', 'idHotel');
    }
    public function Comfort(){
        return $this -> hasMany(TienNghi::class, 'id', 'idTienNghi');
    }
    public function scopeSearch($query)
    {
        if($key = request()->key){
            $query = $query -> where('name', 'like', '%'.$key.'%');
        }
        return $query;
    }
    // public function Search($query)
    // {
    //     if($city = request()->key && $checkin = request()-> checkin && $chekout = request()->checkout){
    //         $query = $query -> where('name', 'like', '%'.$key.'%');
    //     }
    //     return $query;
    // }
}
