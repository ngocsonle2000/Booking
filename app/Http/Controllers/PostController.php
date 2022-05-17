<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = post::where('idUser', Auth::guard('custom')->user()->id)->get();

        return view('user.Post.index', compact('post') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.Post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ],[
            'title.required' => 'Tên tiêu đề không thể để trống',
            'content.required' => 'Nội dung không thể để trống',
            'image.required' => 'Hình đại diện không được để trống',
        ]);
        $ext = $request -> image -> extension();
        $file_name = time().$request->title.'-'.'avatar.'.$ext;
        $request -> image  ->move(public_path('upload'), $file_name);
        if(post::create([
            'title' => $request-> title,
            'content' => $request ->content,
            'image' => $file_name,
            'slug' => $request -> slug,
            'idUser' => Auth::guard('custom')->user()->id,
        ])){
            return redirect()->back()->with('success', 'Thêm bài viết thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     * $Post phải in hoa
     */
    public function edit(post $Post)
    {
        return view('user.Post.edit', compact('Post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $Post)
    {
        if($request->has('image')){
            $name = $Post->image;

            if($name){
                File::delete(public_path('/upload/'.$name));
            }

            $ext = $request -> image -> extension();
            $file_name = time().$request->title.'-'.'avatar.'.$ext;
            $request -> image  ->move(public_path('upload'), $file_name);
            if($Post -> update([
                'title' => $request-> title,
                'content' => $request -> content,
                'image' => $file_name,
            ])){
                return redirect()->back()->with('success', 'Cập nhập thành công');
            }

        }else{
           if($Post -> update([
               'title' => $request-> title,
               'content' => $request -> content,
           ])){
               return redirect()->back()->with('success', 'Cập nhập thành công');
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
