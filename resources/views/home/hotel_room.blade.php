@extends('layouts.home')
@section('main')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image:  url('{{ url('public/site') }}/images/bg_1.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="index.html">Home <i class="fa fa-chevron-right"></i></a>
                    </span>
                    <span>Khách Sạn <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">
                    {{-- @foreach ($RoomHotel -> Hotel  as $hotel )
                        {{ $Hotel -> name }}
                    @endforeach --}}
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-wrap-1 ftco-animate">
                    <form action="#" class="search-property-1">
                        <div class="row no-gutters">
                            <div class="col-lg d-flex">
                                <div class="form-group p-4 border-0">
                                    <label for="#">Thành Phố</label>
                                    <div class="form-field">
                                        <div class="icon"><span class="fa fa-search"></span></div>
                                        <input type="text" class="form-control" placeholder="Search place" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg d-flex">
                                <div class="form-group p-4">
                                    <label for="#">Ngày Đến</label>
                                    <div class="form-field">
                                        <div class="icon"><span class="fa fa-calendar"></span></div>
                                        <input type="text" class="form-control checkin_date" placeholder="Check In Date" value="{{ request()->get('checkin') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg d-flex">
                                <div class="form-group p-4">
                                    <label for="#">Ngày đi</label>
                                    <div class="form-field">
                                        <div class="icon"><span class="fa fa-calendar"></span></div>
                                        <input type="text" class="form-control checkout_date" placeholder="Check Out Date" value="{{ request()->get('checkout') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg d-flex">
                                <div class="form-group p-4">
                                    <label for="#">Số người</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <input type="text" class="form-control" placeholder="Số người" value="{{ request()->get('guests') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg d-flex">
                                <div class="form-group d-flex w-100 border-0">
                                    <div class="form-field w-100 align-items-center d-flex">
                                        <input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ Session::get('error') }}
</div>
@endif @if (Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ Session::get('success') }}
</div>
@endif

<br>
<div class="container">
    <div class="row">
        <div class="container">
            <div class="col-md-9">
                <div class="demo">
                    <ul id="lightSlider">
                        @foreach ($RoomHotel as $data)
                            @php
                                $image = explode('|', $data -> image_list);
                            @endphp
                            @foreach ($image as $image_show)
                                <li class="listimage"  data-thumb="{{ url('public/upload') }}/{{ $image_show }}">
                                    <img class="imageslide" src="{{ url('public/upload') }}/{{ $image_show }}" />
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                h
            </div>
        </div>
    </div>
    <div class="container">
        <h5> <i class="fa fa-list" aria-hidden="true"></i> Chọn Phòng</h5>
        @foreach($RoomHotel  as $data)
            <div class="card md-12" style="max-width: 100%; color: black">
                <h4>
                   {{ $data -> name }}
                </h4>
                <table>
                    <th>Hình ảnh </th>
                    <th>Tiện ích</th>
                    <th>Sức chứa</th>
                    <th>Số lượng phòng </th>
                    <th>Gía Phòng</th>
                    <th></th>
                    <tr>
                        <td class="col-md-4">
                            <img src="{{ url('public/upload') }}/{{ $data -> image }}" alt="" style="max-width: 100%">
                        </td>
                        <td class="col-md-2">
                            @php
                                $TienNghi = explode('|', $data  -> TienNghi)
                            @endphp
                            @foreach ($TienNghi as $ListTN)
                                <i class="fa fa-check-circle-o" aria-hidden="true" style="color: #32a923"></i>
                                {{$ListTN }} <br>
                            @endforeach

                        </td>
                        <td class="col-md-1">
                            {{ $data -> capacity }}
                        </td>
                        <td class="col-md-2">
                            @if (($data -> capacity) > request()->get('guests'))
                                @php
                                    $ceill = 1;
                                @endphp
                               <input type="number" class="form-control" value="{{ $ceill }}" >
                            @else
                                @php
                                    $ceill = ceil(request()->get('guests')/$data -> capacity);
                                @endphp
                                <input type="number" class="form-control" value="{{$ceill}}">
                           @endif
                        </td>
                        <td class="col-md-2">
                            @if($data -> sale_price)
                                <strike>{{ $data -> price }}</strike>
                                <h4 style="color: red">
                                    @php
                                        $ceill = ceil(request()->get('guests')/$data -> capacity);
                                        $date = abs(strtotime(request()->get('checkout')) - strtotime(request()->get('checkin')));
                                        $numDay = floor($date / (60*60*24));
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
                                        if ($ceill) {
                                            $count = $ceill*$data->price*$numDay;
                                            echo $count.'$';
                                        }else{
                                            $count = $data->price*$numDay;
                                            echo $count.'$';
                                        }
                                    @endphp
                                </h4>
                            @endif
                        </td>
                        <td class="col md-3">
                            <a
                                @if (Auth::guard('custom')->check())
                                    href="{{ route('home.room_details',
                                        [
                                            $data      -> id,
                                            $data      -> slug_hotel,
                                            'ceill'    => $ceill,
                                            'count'    => $count,
                                            'checkin'  => request()->get('checkin'),
                                            'checkout' => request()->get('checkout'),
                                            'numDay'   => $numDay,
                                            'guests'   =>  request()->get('guests'),
                                        ])}}"
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

            </div><br>
        @endforeach
    </div>
</div>
@stop
