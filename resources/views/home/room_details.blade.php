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
                            <span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a
                                    href="rooms.html"></a></span> <span>Room Single</span>
                        </p>
                        <h1 class="mb-4 bread"></h1>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($room_details as $data)
            <div class="container " style="color: black; margin-top: 1%">
                <form
                    action="{{ route('home.sendMail', [
                        'ceill'     => request()->get('ceill'),
                        'count'     => request()->get('count'),
                        'checkin'   => date('Y-m-d', strtotime(request()->get('checkin'))),
                        'checkout'  => date('Y-m-d', strtotime(request()->get('checkout'))),
                        'email'     => Auth::guard('custom')->user()->email,
                        'name'      => Auth::guard('custom')->user()->username,
                        'phone'     => Auth::guard('custom')->user()->phone,
                        'idRoom'    => $data->id,
                        'idHotel'   => $data->idHotel,
                        'idUser'    => Auth::guard('custom')->user()->id,
                        'idAdmin'   => $data->idUser,
                        'numDay'    => request()->get('numDay'),
                        'guests'    => request()->get('guests'),
                        'nameRoom'  => request()->get('nameRoom'),
                        'priceRoom' => request()->get('priceRoom'),
                    ]) }}"
                    method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-7 ">
                            <div class="card card_deatils cssanimation2 fadeInBottom2">
                                <div class="card-body">
                                    <h4><b><i class="fa fa-user" aria-hidden="true"></i> Thông tin liên lạc</b></h4>
                                    <label for="">Họ và tên: </label><br>
                                    <input style="background: #f0ebeb; border-color: #7fc975; border: none; width: 70%"
                                        name="name" type="text" value="{{ Auth::guard('custom')->user()->username }} "
                                        readonly>
                                    <br><label for="">Email: </label><br>
                                    <input style="background: #f0ebeb; border-color: #7fc975; border: none; width: 70%"
                                        type="email" name="email" value="{{ Auth::guard('custom')->user()->email }} "
                                        readonly>
                                    <br><label for="">Số điện thoại: </label><br>
                                    <input style="background: #f0ebeb; border-color: #7fc975; border: none; width: 70%"
                                        name="phone" type="text" value="{{ Auth::guard('custom')->user()->phone }} "
                                        readonly>
                                    <br><label for="">Địa chỉ: </label><br>
                                    <input style="background: #f0ebeb; border-color: #7fc975; border: none; width: 70%"
                                        name="adrress" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card_deatils cssanimation2 fadeInBottom2">
                                <div class="card-body">
                                    <h4 for=""><b>Thông tin phòng: {{ request()->get('nameRoom') }}</b> </h4>
                                    <p>Ngày đến: {{ request()->get('checkin') }}</p>
                                    <p>Ngày đi: {{ request()->get('checkout') }}</p>
                                    <p>Số giường: {{ $data->bed }}</p>
                                    <p>Số phòng: {{ request()->get('ceill') }} Phòng</p>
                                    <p>Diện tích: {{ $data->area }}m<sup>2</sup></p>
                                    <h4 for=""><b>Tiện nghi: </b> </h4>
                                    @php
                                        $TienNghi = explode('|', $data->TienNghi);
                                    @endphp
                                    @foreach ($TienNghi as $ListTN)
                                        <i class="fa fa-check-circle-o" aria-hidden="true" style="color: #32a923"></i>
                                        {{ $ListTN }} <br>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card card_deatils cssanimation2 fadeInBottom2">
                                <div class="card-body">
                                    <h4><b>Yêu cầu đặc biệt</b></h4>
                                    <p>Các yêu cầu đặc biệt không đảm bảo sẽ được đáp ứng – tuy nhiên, chỗ nghỉ sẽ cố gắng
                                        hết sức
                                        để thực hiện. Bạn luôn có thể gửi yêu cầu đặc biệt sau khi hoàn tất đặt phòng của
                                        mình!</p>
                                    <p><b>Vui lòng ghi yêu cầu của bạn vào đây:</b></p>
                                    <textarea name="note" id="" cols="75%" rows="3" class="form-control"
                                        style="margin: 1%; border-radius: 10px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card_deatils cssanimation2 fadeInBottom2">
                                <div class="card-body">
                                    <h4><b>Thanh toán: </b></h4>
                                    @if ($data->sale_price)
                                        <p>Gía gốc(1 đêm x 1 phòng): <strike> {{ $data->price }}$</strike></p>
                                        <p>Gía khuyến mãi(1 đêm x 1 phòng): {{ $data->sale_price }}$</p>
                                        <p><b>Mã khuyến mãi: </b></p>
                                        <form autocomplete="off" method="post" class="form-inline">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input name="CodePromo" id="promoDetails"
                                                        class="form-control promoDetails" style="border-radius: 10px">
                                                    <input type="text" id="idKindRoom" value="{{ $id }}"
                                                        style="display: none">
                                                    <input type="text" id="idHotel" value="{{ $data->idHotel }}"
                                                        style="display: none">
                                                    <input type="text" value="{{ request()->get('count') }}" id="count"
                                                        style="display: none">
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-primary " type="button" id="btn-promo">Áp
                                                        dụng</button>
                                                </div>
                                            </div>
                                            <div id="promoDiv">

                                            </div>
                                        </form>
                                        <div id="priceCount">
                                            <p style="margin-left: 55%; margin-top: 20%; color: red; font-size: 20px">
                                                <b>
                                                    {{ request()->get('count') }}$/{{ request()->get('numDay') }} đêm
                                                </b>
                                            </p>
                                        </div>
                                    @else
                                        <p>Gía phòng(1 đêm x 1 phòng): {{ $data->price }}$</p>
                                        <p><b>Mã khuyến mãi: </b></p>
                                        <form autocomplete="off" method="post" class="form-inline">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input name="CodePromo" id="promoDetails"
                                                        class="form-control promoDetails" style="border-radius: 10px">
                                                    <input type="text" id="idKindRoom" value="{{ $id }}"
                                                        style="display: none">
                                                    <input type="text" id="idHotel" value="{{ $data->idHotel }}"
                                                        style="display: none">
                                                    <input type="text" value="{{ request()->get('count') }}" id="count"
                                                        style="display: none">
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-primary " type="button" id="btn-promo">Áp
                                                        dụng</button>
                                                </div>
                                            </div>
                                            <div id="promoDiv">

                                            </div>
                                        </form>
                                        <div id="priceCount">
                                            <p style="margin-left: 55%; margin-top: 20%; color: red; font-size: 20px">
                                                <b>
                                                    {{ request()->get('count') }}$/{{ request()->get('numDay') }} đêm
                                                </b>
                                            </p>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary" style="margin-left: 70%">Đặt
                                        phòng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach

    @stop
