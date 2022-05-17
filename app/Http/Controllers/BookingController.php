<?php

namespace App\Http\Controllers;


use App\Models\bookroom;
use App\Models\Hotel;
use App\Models\KindRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel = Hotel::where('idUser', Auth::guard('custom')->user()->id)->get();
        $dataOrder = bookroom::where('idAdmin', Auth::guard('custom')->user()->id)->search()->get();
        return view('user.Booking.index', compact('dataOrder', 'hotel'));

        // foreach($arr as $data){
        //     dd($data);
        //     $OrderBooking = bookroom::where('idHotel', $data->id)->search()->get();
        // }
        // dd($OrderBooking);
        // if($OrderBooking){
        //     return view('user.Booking.index', compact('OrderBooking'));
        // }else{
        //     dd('k');
        // }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(bookroom $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(bookroom $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bookroom $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(bookroom $book)
    {
        //
    }
}
