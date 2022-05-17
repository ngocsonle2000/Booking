@extends('layouts.index')
@section('title', 'Trang Chủ')
@section('main')
<div class="hero-wrap" style="background-image: url('{{ url('public/home') }}/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        <span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="rooms.html">Room</a></span> <span>Room Single</span>
                    </p>
                    <h1 class="mb-4 bread"></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">


        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12 " >
                        <div class="single-slider owl-carousel">
                            @foreach ($RoomHotel as $data )
                                @php
                                    $image = explode('|', $data -> image_list)
                                @endphp
                                @foreach ($image as $image_list )
                                    <div class="item">
                                        <div class="room-img" style="border-radius: 10px;  background-image: url({{ url('public/upload') }}/{{ $image_list }})"></div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                    </div>
                    <div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
                        @php
                            $hotel = DB::table('hotels')->where('slug', $slug)->get();
                        @endphp
                        @foreach ($hotel as $Content )
                            {!! $Content -> content !!}
                        @endforeach
                    </div>
                    <div class="col-md-12 room-single  mb-5 mt-4 ">
                        <h5> <i class="fa fa-list" aria-hidden="true"></i> Chọn Phòng</h5>
                        @foreach($RoomHotel  as $data)
                            <div class="card md-12 container card_booking" style="max-width: 100%; color: black; border-color: #998051; border-radius: 10px">
                                <h4>
                                    {{ $data -> name }}
                                </h4>
                                <table>
                                    <tr>
                                        <th class="col-md-3"> </th>
                                        <th class="col-md-3">Tiện ích</th>
                                        <th class="col-md-2">Sức chứa</th>
                                        <th class="col-md-2">Số phòng </th>
                                        <th class="col-md-3">Gía Phòng</th>
                                        <th class="col-md-2"></th>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3" >
                                            <img src="{{ url('public/upload') }}/{{ $data -> image }}" alt="" style="max-width: 100%; border-radius: 10px">

                                            <a  href="#" data-toggle="modal" data-target=".evaluate-{{ $data->id }}"> Xem chi tiết </a>


                                        </td>
                                        <td class="col-md-3"  style="color: #998051">
                                            @php
                                                $TienNghi = explode('|', $data  -> TienNghi)
                                            @endphp
                                            @foreach ($TienNghi as $ListTN)
                                                <i class="fa fa-check-circle-o" aria-hidden="true" style="color: #32a923"></i>
                                                {{$ListTN }} <br>
                                            @endforeach
                                        </td>
                                        <td class="col-md-2" >
                                            {{ $data -> capacity }}
                                        </td>
                                        <td class="col-md-2" >
                                            @if (($data -> capacity) > request()->get('guests'))
                                                @php
                                                    $ceill = 1;
                                                @endphp
                                                <input type="number" class="form-control" value="{{ $ceill }}" style="border-radius: 10px">
                                            @else
                                                @php
                                                    $ceill = ceil(request()->get('guests')/$data -> capacity);
                                                @endphp
                                                <input type="number" class="form-control" value="{{$ceill}}" style="border-radius: 10px">
                                            @endif
                                        </td>
                                        <td class="col-md-3" >
                                            @if (!request()->get('checkout'))
                                                <h4 style="color: red">
                                                    @if ($data -> sale_price)
                                                            {{ $data -> sale_price }}$
                                                    @else
                                                            {{ $data -> price }}$
                                                    @endif
                                                </h4>
                                            @elseif($data -> sale_price)
                                                <strike>{{ $data -> price }}$</strike>
                                                <h4 style="color: red">
                                                    @php
                                                        $ceill = ceil(request()->get('guests')/$data -> capacity);
                                                        $date = abs(strtotime(request()->get('checkout')) - strtotime(request()->get('checkin')));
                                                        $numDay = floor($date / (60*60*24));
                                                        $price = $data -> sale_price;
                                                        if ($ceill) {
                                                            $count = $ceill*$data->sale_price*$numDay;
                                                            echo  $count.'$';
                                                        }else{
                                                            $count = $data->sale_price*$numDay;
                                                            echo $count.'$';
                                                        }
                                                    @endphp
                                                </h4>
                                            @else
                                                <h4 style="color: red">
                                                    @php
                                                        $ceill = ceil(request()->get('guests')/$data -> capacity);
                                                        $date = abs(strtotime(request()->get('checkout')) - strtotime(request()->get('checkin')));
                                                        $numDay = floor($date / (60*60*24));
                                                        $price = $data -> price;
                                                        if ($ceill) {
                                                            $count = $ceill* $data->price *$numDay;
                                                            echo $count.'$';
                                                        }else{
                                                            $count = $data->price*$numDay;
                                                            echo $count.'$';
                                                        }
                                                    @endphp
                                                </h4>
                                            @endif
                                        </td>
                                        <td class="col-md-2" >
                                            <a style="color: #f5f5f5"
                                            @if (Auth::guard('custom')->check())
                                                @if (request()->get('checkin'))
                                                    href="{{ route('home.room_details',
                                                [
                                                    $data      -> id,
                                                    $data      -> slug_hotel,
                                                    'priceRoom' => $price,
                                                    'ceill'    => $ceill,
                                                    'count'    => $count,
                                                    'checkin'  => request()->get('checkin'),
                                                    'checkout' => request()->get('checkout'),
                                                    'numDay'   => $numDay,
                                                    'guests'   => request()->get('guests'),
                                                    'nameRoom' => $data ->name,
                                                ])}}"
                                            @else
                                                onclick = "return confirm('Bạn cần nhập ngày đến và đi')"
                                            @endif
                                            @else
                                                onclick="return confirm('Bạn cần phải đăng nhập để đặt phòng')"
                                            @endif
                                                type="submit" class="btn btn-primary"
                                            >
                                                Đặt Phòng
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal fade evaluate-{{ $data->id }} " tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                <div class="modal-dialog modal-lg modal-admin" style="color: black">
                                    <div class="modal-content ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                ok
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{ $data -> name }}</h4>
                                                <table class="row">
                                                    <tr>
                                                        <td class="col-md-4">
                                                            <span><i class="fa fa-users" aria-hidden="true"></i>&nbsp; {{ $data -> capacity }} người</span>
                                                        </td>
                                                        <td class="col-md-4">
                                                            <span><i class="fa fa-arrows-alt" aria-hidden="true"></i> {{ $data -> area }} m2</span>
                                                        </td>
                                                        <td class="col-md-4">
                                                            <span><i class="fa fa-bed" aria-hidden="true"></i> {{ $data -> bed }} </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div>
                                                    <p><b>Tiện nghi phòng</b></p>
                                                    <ul class="TienNghi">
                                                        @php
                                                            $TienNghi = explode('|', $data  -> TienNghi)
                                                        @endphp
                                                        @foreach ($TienNghi as $dataTN)
                                                            <li style="list-style-type: none;">
                                                                <span>{{ $dataTN }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div style="margin-top: 10%" >
                                                    <strike style="margin-left: 68%"> {{ $data -> price }}$ </strike>
                                                    <h4 style="color: red; font-size: x-large; margin-left: 64%">
                                                        <b>
                                                            @if (request()->get('checkout'))
                                                                @php
                                                                    echo $count.'$'
                                                                @endphp
                                                           @else
                                                                @if($data -> sale_price)
                                                                    {{ $data -> sale_price }}$
                                                                @else
                                                                    {{ $data -> price }}$
                                                                    @endif
                                                           @endif
                                                        </b>
                                                    </h4>
                                                    <p  style="margin-left: 50%; ">
                                                        (Giá cho
                                                        @if (request()->get('checkout'))
                                                            @php
                                                                echo $numDay.' đêm, '.request()->get('guests').' người'
                                                            @endphp
                                                        @else
                                                            1 đêm, 1 người
                                                        @endif
                                                        )
                                                    </p>
                                                    <a style="color: #f5f5f5; margin-left: 60%"
                                                        @if (Auth::guard('custom')->check())
                                                            @if (request()->get('checkin'))
                                                                href="{{ route('home.room_details',
                                                            [
                                                                $data      -> id,
                                                                $data      -> slug_hotel,
                                                                'priceRoom' => $price,
                                                                'ceill'    => $ceill,
                                                                'count'    => $count,
                                                                'checkin'  => request()->get('checkin'),
                                                                'checkout' => request()->get('checkout'),
                                                                'numDay'   => $numDay,
                                                                'guests'   => request()->get('guests'),
                                                                'nameRoom' => $data ->name,
                                                            ])}}"
                                                        @else
                                                            onclick = "return confirm('Bạn cần nhập ngày đến và đi')"
                                                        @endif
                                                        @else
                                                            onclick="return confirm('Bạn cần phải đăng nhập để đặt phòng')"
                                                        @endif
                                                            type="submit" class="btn btn-primary"
                                                        >
                                                            Đặt Phòng
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <br>
                        @endforeach
                    </div>
                    <div class="col-md-12 room-single ftco-animate mb-5 mt-5">
                        <h4 class="mb-4">Review &amp; Ratings</h4>
                        @php
                            $viewComment = DB::table('comments')->where('idHotel', $id)->count();
                            echo '<b>Đang hiển thị '.$viewComment.' nhận xét</b>'
                        @endphp

                        <hr>

                            @foreach ($dataHotel as $comment)
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>
                                        @foreach ($comment -> User as $dataUser )
                                            {{ $dataUser -> username }}

                                        @endforeach
                                    </b></p>
                                    <span>
                                        @foreach ($comment -> Code as $dataCode)
                                            <p>
                                                <i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp;
                                                {{ $dataCode -> NameRoom }}
                                            </p>
                                            <p>
                                                <i class="fa fa-calendar" aria-hidden="true"></i></i>&nbsp; Ngày Đến: {{ $dataCode -> NextDay }}
                                            </p>
                                            <p>
                                                <i class="fa fa-calendar" aria-hidden="true"></i></i>&nbsp; Ngày Đi: {{ $dataCode -> OutDay }}
                                            </p>
                                        @endforeach

                                    </span>
                                </div>
                                <div class="col-md-8">
                                    <div class="container" style="border-radius: 10px; background-color: #f5f5f5">
                                        <p>
                                            <b>"{{ $comment-> Comment}}"</b>
                                        </p>
                                        <hr>
                                        Đã nhận xét vào ngày
                                        @php
                                            $covertDate = date('d-m-Y', strtotime($comment -> created_at));
                                            echo $covertDate;
                                        @endphp

                                    </div>
                                    @php
                                        $checkComment = DB::table('comments')->where('parent_id', $comment->id)->get();
                                    @endphp
                                    @foreach ($checkComment as $dataCheck )
                                        @if ($dataCheck)
                                            <div class="row" style="margin-left: 0">
                                                <div class="box arrow-top col-md-8">
                                                    {{ $dataCheck -> Comment }}
                                                </div>
                                                <div class="col-md-4 box-name" style="margin-top: 5%">
                                                    <p><b>Phản hồi của chổ nghỉ</b></p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div><hr>
                            </div><br>
                            @endforeach

                    </div>
                    <div class="col-md-12 room-single ftco-animate mb-5 mt-5">
                        <h4 class="mb-4">Khách sạn tương tự</h4>
                        <div class="row">
                            @php
                                $similar = DB::table('hotels')->where('city', $city )->whereNotIn('slug', [$slug])->take(3)->get();
                            @endphp
                            @foreach ($similar as $dataSimilar)
                                <div class="col-sm col-md-4  ">
                                    <div class="room similar">
                                        <a href="{{ route('home.hotel_room', [ $dataSimilar->slug,  $dataSimilar->id,  $dataSimilar->city]) }}" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{ url('public/upload') }}/{{ $dataSimilar->img }});">

                                        </a>
                                        <div class="text p-3 text-center">
                                            <h3 class="mb-3"><a href="rooms.html">{{ $dataSimilar -> name }}</a></h3>
                                            <p>
                                                <span class="price mr-2">
                                                    @php
                                                        $check = DB::table('kindrooms')->where('idHotel', $dataSimilar -> id)->min('price');
                                                        echo $check.'$';
                                                    @endphp
                                                </span>
                                                <span class="per">1 đêm, 1 người</span></p>
                                            <hr />
                                            <p class="pt-1">
                                                <a href="{{ route('home.hotel_room', [ $dataSimilar->slug,  $dataSimilar->id,  $dataSimilar->city]) }}" class="btn-custom">Xem ngay <span class="icon-long-arrow-right"></span></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- .col-md-8 -->
        </div>
    </div>
</section>
<!-- .section -->
@stop


