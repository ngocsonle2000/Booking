<?php

namespace App\Http\Controllers;

use App\Models\CommentBlog;
use Illuminate\Http\Request;

class CommentBlogController extends Controller
{
    public function post(Request $request){
        if(request()->get('parent_id')){
            if(CommentBlog::insert([
                'comment'   => $request->comment,
                'idBlog'    => request()->get('idBlog'),
                'idUser'    => request()->get('idUser'),
                'parent_id' => request()->get('parent_id'),
            ])){
                return redirect()->back();
            }
        }else{
            if(CommentBlog::insert([
                'comment' => $request->comment,
                'idBlog'  => request()->get('idBlog'),
                'idUser'  => request()->get('idUser'),
            ])){
                return redirect()->back();
            }
        }
    }
}
