<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TienNghi extends Model
{
    use HasFactory;
    protected $table = 'TienNghis';
    protected $fillable = [
        'name',
        'idHotel',
        'idAdmin',
        'slug',
    ];
    public function Hotel(){
        return $this -> hasMany(Hotel::class, 'id', 'idHotel');
    }

}
