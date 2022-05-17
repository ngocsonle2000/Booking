<?php

namespace App\Http\Controllers;

use App\Models\banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('custom');
    }
    public function index()
    {
        $dataBanner = banner::all();

        return view('admin.Banner.index', compact('dataBanner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ext = $request -> file_upload-> extension();
        $file_name = time().$request->name.'-'.'banner.'.$ext;
        $request -> file_upload  -> move(public_path('upload'), $file_name);
        if(banner::insert([
            'image' => $file_name,
            'content' => $request -> content,
        ])){
            return redirect()->route('admin.banner.index')->with('success', 'Thêm thành công');
        }else{
            return redirect()->back()->with('error', 'Không thể cập nhập');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(banner $banner)
    {
        return view('admin.Banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, banner $banner)
    {
        $name = $banner -> image;
        $ext = $request -> file_upload-> extension();
        $file_name = time().$request->name.'-'.'banner.'.$ext;
        $request -> file_upload  -> move(public_path('upload'), $file_name);

        if (File::delete(public_path('/upload/' . $name))){
            if($banner->update([
                'image' => $file_name,
                'content' => $request ->content
            ])){
                return redirect()->route('admin.banner.index')->with('success', 'Cập nhập thành công');
            }else{
                return redirect()->back()->with('error', 'Lỗi cập nhập');
            }
        }else{
            redirect()->back()->with('error', 'Lỗi hình');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(banner $banner)
    {
        //
    }
}
