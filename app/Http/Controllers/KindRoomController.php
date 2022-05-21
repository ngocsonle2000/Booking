<?php

namespace App\Http\Controllers;

use App\Http\Requests\KindRoom\CreateKRequest;
use App\Models\Hotel;
use App\Models\KindRoom;
use App\Models\TienNghi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class KindRoomController extends Controller
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
        $data_KindRoom = KindRoom::where('idUser', Auth::guard('custom')->user()->id)->search()->paginate('10');
        return view('user.KindRoom.index', compact('data_KindRoom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotel = Hotel::where('idUser', Auth::guard('custom')->user()->id)->get();
        $Comfort = TienNghi::where('idAdmin', Auth::guard('custom')->user()->id)->get();
        return view('user.KindRoom.create', compact('hotel', 'Comfort'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateKRequest $request)
    {
        if(KindRoom::where([
            ['name', '=' ,$request-> name],
            ['idHotel', '=', $request -> idHotel],
        ])->exists()){
            return back()->with('error', 'Loại phòng của chi nhanh này đã tồn tại');
        }
        else{
            $idTienNghi = implode('|', $request->input('TienNghi'));
            $ext = $request -> file_upload-> extension();
            $file_name = time().$request->slug.'-'.'avatar.'.$ext;


            if($file = $request->file('image_list')){
                $list_image = array();
                foreach($file as $image){
                    $name_image = md5($image);
                    $exti = strtolower($image->getClientOriginalExtension());
                    $image_name = $name_image.'.'.$exti;
                    $image -> move(public_path('upload'), $image_name);
                    $list_image[] = $image_name;
                }
            }
            if(KindRoom::insert([
                'name'       => $request -> name,
                'quantity'   => $request -> quantity,
                'TienNghi'   => $idTienNghi,
                'area'       => $request -> area,
                'capacity'   => $request -> capacity,
                'bed'        => $request ->bed,
                'status'     => $request -> status,
                'price'      => $request ->price,
                'sale_price' => $request ->sale_price,
                'image'      =>  $file_name,
                'image_list' => implode('|', $list_image),
                'idUser'     => Auth::guard('custom')->user()->id,
                'idHotel'    => $request -> idHotel,
                'slug'       => $request -> slug,
                'slug_hotel' => $request -> slug_hotel,
            ])){
                $request -> file_upload  ->move(public_path('upload'), $file_name);

                return redirect()->route('KindRoom.index')->with('success', 'Thêm mới thành công');
            }else{
                return redirect()->back()->with('error','Lỗi không thể thêm mới');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KindRoom  $kindRoom
     * @return \Illuminate\Http\Response
     */
    public function show(KindRoom $KindRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KindRoom  $kindRoom
     * @return \Illuminate\Http\Response
     */
    //Biến KindRoom phải trùng tên với model KindRoom
    public function edit(KindRoom $KindRoom)
    {
        $hotel = Hotel::where('idUser', Auth::guard('custom')->user()->id)->get();
        return view('user.KindRoom.edit', compact('KindRoom', 'hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KindRoom  $kindRoom
     * @return \Illuminate\Http\Response
     */
    // if($request->has('file_upload')){
    //     $name = $KindRoom -> image;
    //     $idTienNghi = implode('|', $request->input('TienNghi'));
    //     $ext = $request -> file_upload-> extension();
    //     $file_name = time().$request->name.'-'.'avatar.'.$ext;
    //     if(file::delete(public_path('/upload/'.$name))){
    //         $request -> file_upload  ->move(public_path('upload'), $file_name);
    //     }else{
    //         return redirect()->back()->with('error', 'Cập nhập hình đại diện lỗi');
    //     }

    // }


    public function update(Request $request, KindRoom $KindRoom)
    {
        if($request->has('file_upload') && $request->has('image_list')){
            $name = $KindRoom -> image;
            $name_list = explode('|', $KindRoom -> image_list);
            $idTienNghi = implode('|', $request->input('TienNghi'));
            $ext = $request -> file_upload-> extension();
            $file_name = time().$request->slug.'-'.'avatar.'.$ext;

            if(file::delete(public_path('/upload/'.$name))){
                $request -> file_upload  ->move(public_path('upload'), $file_name);
            }else{
                return redirect()->back()->with('error', 'Cập nhập hình đại diện lỗi');
            }
            foreach($name_list as $list){
                file::delete(public_path('/upload/'.$list));
            }

            $list_image = array();
            foreach($request->file('image_list') as $image){
                $name_image = md5($image);
                $exti = strtolower($image->getClientOriginalExtension());
                $image_name = $name_image.'.'.$exti;
                $image -> move(public_path('upload'), $image_name);
                $list_image[] = $image_name;
            }

            if($KindRoom -> update([
                'name'       => $request -> name,
                'quantity'   => $request -> quantity,
                'TienNghi'   => $idTienNghi,
                'area'       => $request -> area,
                'capacity'   => $request -> capacity,
                'bed'        => $request ->bed,
                'status'     => $request -> status,
                'price'      => $request ->price,
                'sale_price' => $request ->sale_price,
                'image'      => $file_name,
                'image_list' => implode('|', $list_image),
                'content'    => $request->content,
                'idUser'     => Auth::guard('custom')->user()->id,
                'idHotel'    => $request -> idHotel,
                'slug'       => $request -> slug,
                'slug_hotel' => $request -> slug_hotel,
            ]))
            {
                return redirect()->route('KindRoom.index')->with('success','Cập nhập thành công');
            }else{
                return redirect()->back()->with('error','Lỗi Cập Nhập 1');
            }
        }elseif($request->has('file_upload')){
            $name = $KindRoom -> image;
            $idTienNghi = implode('|', $request->input('TienNghi'));
            $ext = $request -> file_upload-> extension();
            $file_name = time().$request->slug.'-'.'avatar.'.$ext;

            if(file::delete(public_path('/upload/'.$name))){
                $request -> file_upload  ->move(public_path('upload'), $file_name);
                if($KindRoom -> update([
                    'name'       => $request -> name,
                    'quantity'   => $request -> quantity,
                    'TienNghi'   => $idTienNghi,
                    'area'       => $request -> area,
                    'capacity'   => $request -> capacity,
                    'bed'        => $request ->bed,
                    'status'     => $request -> status,
                    'price'      => $request ->price,
                    'sale_price' => $request ->sale_price,
                    'image'      => $file_name,
                    'content'    => $request->content,
                    'idUser'     => Auth::guard('custom')->user()->id,
                    'idHotel'    => $request -> idHotel,
                    'slug'       => $request -> slug,
                    'slug_hotel' => $request -> slug_hotel,
                ]))
                {
                    return redirect()->route('KindRoom.index')->with('success','Cập nhập thành công');
                }else{
                    return redirect()->back()->with('error','Lỗi Cập Nhập');
                }
            }else{
                return redirect()->back()->with('error', 'Cập nhập hình đại diện lỗi');
            }

        }elseif($file = $request->file('image_list')){
            $name_list = explode('|', $KindRoom -> image_list);
            $idTienNghi = implode('|', $request->input('TienNghi'));
            $list_image = array();
            foreach($name_list as $list){
                file::delete(public_path('/upload/'.$list));
            }
            foreach($file as $image){
                $name_image = md5($image);
                $exti = strtolower($image->getClientOriginalExtension());
                $image_name = $name_image.'.'.$exti;
                $image -> move(public_path('upload'), $image_name);
                $list_image[] = $image_name;
            }

            if($KindRoom -> update([
                'name'       => $request -> name,
                'quantity'   => $request -> quantity,
                'TienNghi'   => $idTienNghi,
                'area'       => $request -> area,
                'capacity'   => $request -> capacity,
                'bed'        => $request ->bed,
                'status'     => $request -> status,
                'price'      => $request ->price,
                'sale_price' => $request ->sale_price,
                'image_list' => implode('|', $list_image),
                'content'    => $request->content,
                'idUser'     => Auth::guard('custom')->user()->id,
                'idHotel'    => $request -> idHotel,
                'slug'       => $request -> slug,
                'slug_hotel' => $request -> slug_hotel,

            ])){
                return redirect()->route('KindRoom.index')->with('success', 'Cập nhập album thành công');
            }else{
                return redirect()->back()->with('error', 'Cập nhập album lỗi lỗi');
            }
        }else{
            $idTienNghi = implode('|', $request->input('TienNghi'));
            if($KindRoom -> update([
                'name'       => $request -> name,
                'quantity'   => $request -> quantity,
                'TienNghi'   => $idTienNghi,
                'area'       => $request -> area,
                'capacity'   => $request -> capacity,
                'bed'        => $request ->bed,
                'status'     => $request -> status,
                'price'      => $request ->price,
                'sale_price' => $request ->sale_price,
                'content'    => $request->content,
                'idUser'     => Auth::guard('custom')->user()->id,
                'idHotel'    => $request -> idHotel,
                'slug'       => $request -> slug,
                'slug_hotel' => $request -> slug_hotel,
            ]))
            {
                return redirect()->route('KindRoom.index')->with('success','Cập nhập thành công');
            }else{
                return redirect()->back()->with('error','Lỗi Cập Nhập');
            }
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KindRoom  $kindRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(KindRoom $KindRoom)
    {
        $ex = explode('|', $KindRoom -> image_list);
        $imgAvt = $KindRoom -> image;
        if($KindRoom->delete()){
            foreach($ex as $data){
                file::delete(public_path('/upload/'.$data));
            }
            file::delete(public_path('/upload/'.$imgAvt));
            return redirect()->route('KindRoom.index')->with('success', 'Xóa phòng thành công');
        }else{
            return redirect()->back()->with('error', 'Xóa không thành công');
        }
    }
}

