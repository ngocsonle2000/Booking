<?php

namespace App\Http\Controllers;


use App\Models\accommodation;
use App\Models\banner;
use App\Models\bookroom;
use App\Models\city;
use App\Models\comment;
use App\Models\Hotel;
use App\Models\KindRoom;
use App\Models\post;
use App\Models\promo;
use App\Models\TienNghi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use DB;

class HomeController extends Controller
{
    public function index()
    {

        $post = post::orderBy('created_at', 'DESC')->take(4)->get();
        $accom = accommodation::all();
        $city = city::all()->take(4);

        return view('home.TrangChu', compact('post', 'accom', 'city'));
    }
    public function hotel_room($slug, $id, $city)
    {
        $RoomHotel = KindRoom::where('slug_hotel', $slug)->get();
        $dataHotel = comment::where('idHotel', $id)->get();
        return view('home.room_detail', compact('RoomHotel', 'slug', 'dataHotel', 'id', 'city'));
    }
    public function room_details($id, $slug, Request $request)
    {
        $room_details = KindRoom::where('id', $id)->get();
        return view('home.room_details', compact('room_details', 'id'));
    }

    public function search(Request $request)
    {
        // if (request()->get('checkout')) {
        //     if(!Auth::guard('custom')->check()){
        //         $searchRoom = Hotel::where([
        //             ['city', $request->city],
        //             ['Status', 0],
        //         ])->whereNotIn('idUser', [Auth::guard('custom')->user()->id])->get();
        //         return view('home.room', compact('searchRoom'));
        //     }else{
        //         $searchRoom = Hotel::where([
        //             ['city', $request->city],
        //             ['Status', 0],
        //         ])->get();
        //         return view('home.room', compact('searchRoom'));
        //     }

        // }
        // // elseif(request()->get('accommodation') || request()->get('rate')){
        // //     $data = explode(',', request()->get('accommodation'));
        // //     $dataRate = explode(',', request()->get('accommodation'));
        // //     return view('home.room', compact('data', 'dataRate'));
        // // }
        // else {

        //     return view('home.room');
        // }

        if (Auth::guard('custom')->check()) {
            $searchRoom = Hotel::where([
                // ['city', $request->city],
                ['Status', 0],
            ])->whereNotIn('idUser', [Auth::guard('custom')->user()->id])->get();

            return view('home.room', compact('searchRoom'));
        } else {

            $searchRoom = Hotel::where('Status', 0)->get();
            return view('home.room', compact('searchRoom'));
        }
    }
    public function City($slug)
    {
        $data = Hotel::where('city', $slug)->get();
        return view('home.CityFilter', compact('data'));
    }
    public function accommodation($slug)
    {
        $data = Hotel::where('accommodation', $slug)->get();
        return view('home.CityFilter', compact('data'));
    }
    public function sendMail(Request $request)
    {

        // if($request->CodePromo){
        //     $checkPromo = promo::where('code', $request->CodePromo)->first();
        //     $checkPromo -> time =  $checkPromo->time + 1;
        //     $checkPromo -> idUser =  Auth::guard('custom')->user()->id.',';
        //     $checkPromo->save();
        // }
        $infoRoom = KindRoom::where('id', request()->get('idRoom'))->get();
        // Mail::send('home.sendMail', compact('infoRoom'), function ($mail) {
        //     $mail->subject('Xác Nhận Đặt Phòng');
        //     $mail->to(request()->get('email'), request()->get('name'));
        // });
        return view('home.sendMail',  compact('infoRoom'));
        // $code = rand(10000000, 99999999) . Auth::guard('custom')->user()->id;
        // if (bookroom::create([
        //     'CodeOrders'    => $code,
        //     'NameRoom'      =>  $request->nameRoom,
        //     'NameCustom'    =>  $request->name,
        //     'IdKindRoom'    =>  $request->idRoom,
        //     'IdHotel'       =>  $request->idHotel,
        //     'idAdmin'       =>  $request->idAdmin,
        //     'idUser'        =>  $request->idUser,
        //     'Email'         =>  $request->email,
        //     'Phone'         =>  $request->phone,
        //     'Adrress'       =>  $request->adrress,
        //     'Guests'        =>  $request->guests,
        //     'NextDay'       =>  $request->checkin,
        //     'OutDay'        =>  $request->checkout,
        //     'RoomQuantity'  =>  $request->ceill,
        //     'PriceRoom'     =>  $request->priceRoom,
        //     'CountPrice'    =>  $request->count,
        //     'CountPromo'    =>  $request->CountPromo,
        //     'CodePromo'     =>  $request->CodePromo,
        //     'PaymentStatus' => '1',
        //     'Note'          =>  $request->note
        // ])) {

            // $infoRoom = KindRoom::where('id', request()->get('idRoom'))->get();
            // Mail::send('home.sendMail', compact('infoRoom'), function ($mail) {
            //     $mail->subject('Xác Nhận Đặt Phòng');
            //     $mail->to(request()->get('email'), request()->get('name'));
            // });
            // return redirect()->route('home.order')->with('success', 'Đặt phòng thành công');
        // }
    }

    public function post()
    {
        $data_post = post::orderBy('created_at', 'ASC')->paginate(6);
        return view('home.post', compact('data_post'));
    }

    public function post_details($slug)
    {
        $details = post::where('slug', $slug)->get();
        return view('home.post_details', compact('details'));
    }

    public function order()
    {
        if (request()->get('key')) {
            $order_info = bookroom::where('CodeOrders', request()->get('key'))->get();
            return view('home.order_custom', compact('order_info'));
        } else {
            $order_info = bookroom::where('idUser', Auth::guard('custom')->user()->id)->get();
            return view('home.order_custom', compact('order_info'));
        }
    }
    public function EditOrder($codeOrder)
    {
        $OrderEdit = bookroom::where('CodeOrders', $codeOrder)->get();
        return view('home.order_edit', compact('OrderEdit', 'codeOrder'));
    }
    public function UpdateOrder(Request $request, $CodeOrders)
    {
        if ($request->checkin > $request->checkout) {
            return redirect()->back()->with('error', 'Chọn lại ngày của mình');
        } else {
            if (bookroom::where('CodeOrders', $CodeOrders)
                ->update([
                    'NameCustom'    =>  $request->name,
                    'Email'         =>  $request->email,
                    'Phone'         =>  $request->phone,
                    'Adrress'       =>  $request->adrress,
                    'Guests'        =>  $request->Guests,
                    'NextDay'       =>  $request->checkin,
                    'OutDay'        =>  $request->checkout,
                    'RoomQuantity'  =>  $request->RoomQuantity,
                    'CountPrice'    =>  $request->CountPrice,
                    'Note'          =>  $request->note
                ])
            ) {
                return redirect()->route('home.order')->with('success', 'Cập nhập thành công');
            } else {
                return redirect()->back()->with('error', 'Lỗi cập nhập');
            }
        }
    }
}
