<?php

namespace App\Http\Controllers;

use App\Http\Requests\Hotel\HotelRequest;
use App\Models\accommodation;
use App\Models\city;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class HotelControler extends Controller
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
        $hotel = Hotel::where('idUser', Auth::guard('custom')->user()->id)->get();
        return view('user.Hotel.index', compact('hotel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.Hotel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelRequest $request)
    {
        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $ext =  $file->extension();
            $file_name = time() . $request->slug . '.' . $ext;

            $file->move(public_path('upload'), $file_name);

            if (Hotel::create([
                'name'          => $request->name,
                'accommodation' => $request->accommodation,
                'city'          => $request->city,
                'adrress'       => $request->adrress,
                'img'           => $file_name,
                'RoomQuanity'   => $request->RoomQuanity,
                'content'       => $request->content,
                'slug'          => $request->slug,
                'idUser'        => Auth::guard('custom')->user()->id,
            ])) {
                return redirect()->route('Hotel.index')->with('success', 'Thêm mới thành công');
            } else {
                dd('Looix');
            }
        }else{
            dd('Lôi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $Hotel)
    {
        $city = city::orderBy('name', 'DESC')->get();
        return view('user.Hotel.edit', compact('Hotel', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $Hotel)
    {

        if ($request->has('file_upload')) {
            $name = $Hotel->img;
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time() . $request->slug . '.' . $ext;

            $file->move(public_path('upload'), $file_name);

            if (File::delete(public_path('/upload/' . $name)))
                if ($Hotel->update([
                    'name'          => $request->name,
                    'accommodation' => $request->accommodation,
                    'city'          => $request->city,
                    'adrress'       => $request->address,
                    'img'           => $file_name,
                    'RoomQuanity'   => $request->RoomQuanity,
                    'content'       => $request->content,
                    'slug'          => $request->slug,
                ])) {
                    return redirect()->route('Hotel.index')->with('success', 'Cập nhập thành công');
                } else {
                    return redirect()->back()->with('error', 'Cập nhập không thành công');
                }
        } else {
            if ($Hotel->update([
                'name'          => $request->name,
                'accommodation' => $request->accommodation,
                'city'          => $request->city,
                'adrress'       => $request->address,
                'RoomQuanity'   => $request->RoomQuanity,
                'content'       => $request->content,
                'slug'          => $request->slug,
            ])) {
                return redirect()->route('Hotel.index')->with('success', 'Cập nhập thành công');
            } else {
                return redirect()->back()->with('error', 'Cập nhập không thành công');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $Hotel)
    {

        $imgAvt = $Hotel -> img;
        if($Hotel->delete()){

            file::delete(public_path('/upload/'.$imgAvt));
            return redirect()->route('Hotel.destroy')->with('success', 'Xóa phòng thành công');
        }else{
            return redirect()->back()->with('error', 'Xóa không thành công');
        }
    }
}
