<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentBlog extends Model
{
    use HasFactory;
    protected $table = 'commetnblog';
    protected $fillable = [
        'comment',
        'idBlog',
        'idUser',
        'parent_id',
        'slug_blog',
    ];
    public function customer(){
        return $this -> hasMany(customer::class, 'id', 'idUser');
    }
}
