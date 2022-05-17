<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AccommodationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.Accommdation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Accommdation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ext = $request -> file_upload -> extension();
        $file_name = time().$request->name.'-'.'accommodation.'.$ext;
        $request -> file_upload  ->move(public_path('upload'), $file_name);

        if(Accommodation::insert([
            'name'  => $request->name,
            'image' => $file_name,
            'slug'  => $request->slug,
        ])){
            return redirect()->route('admin.accommodation.index')->with('success', 'Thêm thành công');
        }else{
            return redirect()->back()->with('error', 'Không thể thêm mới');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function show(Accommodation $accommodation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function edit(Accommodation $accommodation)
    {

        return view('admin.Accommdation.edit', compact('accommodation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        if($request->has('file_upload')){
            $name = $accommodation->image;
            $ext = $request -> file_upload -> extension();
            $file_name = time().$request->name.'-'.'accommodation.'.$ext;
            if (File::delete(public_path('upload/'.$name))){
                if($accommodation -> update([
                    'name' => $request -> name,
                    'image' => $file_name,
                    'slug' => $request->slug,
                ])){
                    $request -> file_upload  ->move(public_path('upload'), $file_name);
                    return redirect()->route('admin.accommodation.index')->with('success', 'Cập nhập thành công');
                }else{
                    redirect()->back()->with('error', 'Cập nhập thất bại');
                }
            }else{
                redirect()->back()->with('error', 'Lỗi');
            }
        }else{
            if($accommodation -> update([
                'name' => $request -> name,
                'slug' => $request->slug,
            ])){
                redirect()->route('admin.accommodation.index')->with('success', 'Cập nhập thành công 1');
            }else{
                redirect()->back()->with('error', 'Cập nhập thất bại 1');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accommodation $accommodation)
    {
        //
    }
}
