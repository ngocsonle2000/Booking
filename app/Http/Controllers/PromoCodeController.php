<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(promo $promo)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $dataPromo = promo::orderBy('created_at', 'DESC')->where('idAdmin', Auth::guard('custom')->user()->id)->get();
        foreach($dataPromo as $key => $PromoStatus){
            if($PromoStatus -> end_day >= $now){
                $promo->update(['Status' => 1]);
            }else{
                echo 'lôi';
            }
        }
        return view('user.Promo.index', compact('dataPromo', 'now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataHotel = Hotel::where('idUser', Auth::guard('custom')->user()->id)->get();
        return view('user.Promo.create', compact('dataHotel'));
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
            'name'       => 'required|unique:promo',
            'code'       => 'required|unique:promo',
            'condition'  => 'required',
            'number'     => 'required',
            'start_day'  => 'required',
            'end_day'    => 'required',
            'price'      => 'required',
        ],[
            'name.required'      => 'Tên mã giảm giá không thể để trống',
            'code.required'      => 'Mã giảm giá không thể để trống',
            'name.unique'        => 'Tên mã giảm giá đã tồn tại',
            'code.unique'        => 'Mã giảm giá đã tồn tại',
            'condition.required' => 'Phải chọn điều kiện giảm giá',
            'number.required'    => 'Số lượng mã giảm giá không thể để trống',
            'start_day.required' => 'Ngày bắt đầu không thể để trống',
            'end_day.required'   => 'Ngày kết thúc không thể để trống',
            'price.required'     => 'Số tiền hoặc số % không được để trống',
        ]);
        if(promo::insert([
            'name'              => $request->name,
            'code'              => $request->code,
            'start_day'         => $request->start_day,
            'end_day'           => $request->end_day,
            'condition_promo'   => $request->condition,
            'number'            => $request->number,
            'price'             => $request->price,
            'idHotel'           => $request->HotelBrand,
            'idKindRoom'        => $request->HotelRoom,
        ])){
            return redirect()->route('Promo.index')->with('success', 'Thêm mã giảm giá thành công');
        }else{
            return back()->with('error', 'Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(promo $Promo)
    {
        $dataHotelID = Hotel::where('idUser', Auth::guard('custom')->user()->id)->get();
        return view('user.Promo.edit', compact('Promo', 'dataHotelID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, promo $Promo)
    {
        if($Promo ->update([
            'name'              => $request->name,
            'code'              => $request->code,
            'start_day'         => $request->start_day,
            'end_day'           => $request->end_day,
            'condition_promo'   => $request->condition,
            'number'            => $request->number,
            'price'             => $request->price,
            'idHotel'           => $request->HotelBrand,
            'idKindRoom'        => $request->HotelRoom,
        ])){
            return redirect()->route('Promo.index')->with('success', 'Cập nhập mã giảm giá thành công');
        }else{
            return back()->with('error', 'Cập nhập thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(promo $promo)
    {
        //
    }
}
