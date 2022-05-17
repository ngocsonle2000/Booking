<?php

namespace App\Http\Controllers;

use App\Models\bookroom;
use App\Models\Hotel;
use App\Models\KindRoom;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DasboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('custom');
    }
    public function index(Request $request)
    {
        // 'hotel' => Hotel::where('idUser', Auth::guard('custom')->user()->id)->get(),
        // $count = Room::where('id', 'idHotel')->count();
        // $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')-> startOfMonth()->toDateString();
        // $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        // $statistic = bookroom::whereBetween('OutDay', [$dauthangnay, $now])->where('PaymentStatus', '0')->get();
        // foreach($statistic as $key => $val){
        //     $chart_data[] = array(
        //         'name' => $val -> OutDay,
        //         'y'    => $val -> CountPrice,
        //     );

        // }
        // echo $data = json_encode($chart_data);
        // session()->put("dauthang",json_encode($chart_data));
        // if($request -> session()->has('dauthang')){
        //     // dd(session('dauthang'));
        // }else{
        //     dd('Lỗi');
        // }

        $hotel = Hotel::where('idUser', Auth::guard('custom')->user()->id)->get();
        return view('user.dasboard', compact('hotel'));
    }
    public function hotel($id)
    {
        $data_KindRoom  = KindRoom::where('idHotel', $id)->get();
        return view('user.KindRoom.index', compact('data_KindRoom'));
    }
}
