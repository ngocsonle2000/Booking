<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotels';
    protected $fillable = [
        'name',
        'accommodation',
        'city',
        'adrress',
        'img',
        'RoomQuanity',
        'content',
        'idUser',
        'slug',
        'Status'
    ];
    public function Room(){
        return $this -> hasMany(KindRoom::class, 'idHotel', 'id');
    }
    public function City(){
        return $this -> hasMany(city::class, 'slug', 'city');
    }
    public function accommodations(){
        return $this -> hasMany(Accommodation::class, 'id', 'accommodation');
    }
    public function scopeSearch($query)
    {
        if($key = request()->key){
            $query = $query -> where('name', 'like', '%'.$key.'%');
        }
        return $query;
    }

}
