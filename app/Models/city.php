<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;
    protected $table = 'citys';
    protected $fillable = [
        'name',
        'image',
        'slug',
    ];
    public function scopeSearch($query)
    {
        if($key = request()->key){
            $query = $query -> where('name', 'like', '%'.$key.'%');
        }
        return $query;
    }
}
