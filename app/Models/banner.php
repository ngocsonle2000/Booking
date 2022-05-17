<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
       'image',
       'content',
    ];
    public function scopeSearch($query)
    {
        if($key = request()->key){
            $query = $query -> where('CodeOrders', 'like', '%'.$key.'%');
        }
        return $query;
    }
}
