<?php

namespace App\Http\Controllers;

use App\Models\city;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nameCity = city::orderBy('name', 'ASC')->get();
        return view('admin.City.index', compact('nameCity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.City.cretae');
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
            'file_upload'  => 'required',
            'name' => 'required',
        ],[
            'file_upload.required' => 'Hình không thể để trống',
            'name.required' => 'Tên thành phố không thể để trống',
        ]);
        $ext = $request -> file_upload-> extension();
        $file_name = time().$request->name.'-'.'city.'.$ext;
        $request -> file_upload  -> move(public_path('upload'), $file_name);
        if(city::insert([
            'image'  => $file_name,
            'name' => $request -> name,
            'slug' => $request -> slug,
        ])){
            return redirect()->route('admin.city.index')->with('success', 'Thêm thành công');
        }else{
            return redirect()->back()->with('error', 'Không thể thêm');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function show(city $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(city $city)
    {

        return view('admin.City.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, city $city)
    {

        if($request -> has('file_upload')){
            $name = $city->image;
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().$request->name.'-'.'city.'.$ext;


            if(File::delete(public_path('upload/'.$name))){
                if($city -> update([
                    'image'  => $file_name,
                    'name'   => $request->name,
                    'slug'   => $request->slug,
                ])){
                    $file->move(public_path('upload'), $file_name);
                    return redirect()->route('admin.city.index')->with('success', 'Cập nhập thành công');
                }else{
                    return back()->with('error', 'Lỗi cập nhập');
                }
            }else{
                return back()->with('error', 'Không thể xóa hình cũ');
            }

        }else{
            if($city -> update([
                'name' => $request -> name,
                'slug'   => $request->slug,
            ])){
                return redirect()->route('admin.city.index')->with('success', 'Cập nhập thành công');
            }else{
                return back()->with('error', 'Lỗi cập nhập');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(city $city)
    {
        //
    }
}
