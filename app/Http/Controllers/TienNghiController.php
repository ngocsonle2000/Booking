<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\TienNghi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TienNghiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Comfort = TienNghi::where('idAdmin', Auth::guard('custom')->user()->id)->get();
        return view('user.Comfort.index', compact('Comfort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Hotel = Hotel::where('idUser', Auth::guard('custom')->user()->id)->get();
        return view('user.Comfort.create', compact('Hotel'));
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
            'name'    => [ 'required', Rule::unique('tiennghis')->where(function ($query){
                return $query->where('idAdmin', Auth::guard('custom')->user()->id);
            }),],
            'idHotel' => 'required',
        ],[
            'name.unique'       => 'Tên tiện nghi đã tồn tại',
            'name.required'     => 'Tên không thể để trống',
            'idHotel.required'  => 'Chi nhánh không thể để trống',
        ]);

        if(TienNghi::insert([
            'name'      => $request -> name,
            'idHotel'   => implode('|', $request->input('idHotel')),
            'idAdmin'   => Auth::guard('custom')->user()->id,
            'slug'      => $request->slug,
        ])){
            return redirect()->route('Comfort.index')->with('success', 'Thêm tiện nghi thành công');
        }else{
            return back()->with('error', 'Không thể thêm tiện nghi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TienNghi  $tienNghi
     * @return \Illuminate\Http\Response
     */
    public function show(TienNghi $tienNghi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TienNghi  $tienNghi
     * @return \Illuminate\Http\Response
     */
    public function edit(TienNghi $TienNghi)
    {
        dd($TienNghi);
        return view('user.Comfort.edit', compact('TienNghi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TienNghi  $tienNghi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TienNghi $tienNghi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TienNghi  $tienNghi
     * @return \Illuminate\Http\Response
     */
    public function destroy(TienNghi $tienNghi)
    {
        //
    }
}
