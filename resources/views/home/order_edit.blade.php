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
                            Đơn đặt chỗ
                        </p>
                        <h1 class="mb-4 bread"></h1>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

    <div class="container">
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
            <form action="{{ route('home.UpdateOrder', $codeOrder) }}" method="post">
                @csrf
                @foreach ($OrderEdit as $data)
                    <input type="text" name="PriceRoom" value="{{ $data->PriceRoom }}" id="PriceRoom"
                        style="display: none">
                    <div class="row">
                        <div class="card col-md-6" style="margin-right: 2%">
                            <h4>Thông tin phòng:</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Ngày đến: </label>
                                    <input type="date" value="{{ $data->NextDay }}" name="checkin" id="checkin"
                                        style="background: #f8f7f9; border-color: #7fc975; border: none;">
                                </div>
                                <div class="col-md-6">
                                    <label>Ngày đi: </label>
                                    <input type="date" value="{{ $data->OutDay }}" name="checkout" id="checkout"
                                        style="background: #f8f7f9; border-color: #7fc975; border: none;">
                                </div>
                            </div>
                            @foreach ($data->Hotel as $nameHotel)
                                <label>Tên khách sạn:{{ $nameHotel->name }}</label>
                                <label>Địa chỉ: {{ $nameHotel->city }}</label>
                            @endforeach

                            @foreach ($data->KindRoom as $nameRoom)

                                <label>Tên phòng: {{ $nameRoom->name }} </label>
                                <label for="">Sức chứa: <span id="capacity">{{ $nameRoom->capacity }}</span></label>
                            @endforeach
                            <label>Số lượng khách: </label>
                            <input type="number" value="{{ $data->Guests }}" name="Guests" id="guests">
                            <label>Số lượng phòng: </label>
                            <input type="text" value="{{ $data->RoomQuantity }}" name="RoomQuantity" id="RoomQuantity">
                            <label>Gía phòng: <span style="color: red" id="CountPrice">{{ $data->CountPrice }}$</span>
                                <input type="text" name="CountPrice" id="hidenPrice" style="display: none">
                                </label>
                            <label> Tiện nghi phòng: </label>
                            @foreach ($data->KindRoom as $TienNghi)
                                <ul class="TienNghi">

                                    @php
                                        $nameTN = explode('|', $TienNghi->TienNghi);
                                    @endphp
                                    @foreach ($nameTN as $name)
                                        <li style="list-style-type: none;">
                                            <i class="fa fa-check" aria-hidden="true" style="color: #32a923"></i>
                                            {{ $name }}
                                        </li>
                                    @endforeach

                                </ul>
                            @endforeach

                            <label>Yêu cầu khác:</label>
                            <textarea name="note">{{ $data->Note }}</textarea>

                        </div>
                        <div class="col-md-5 card">
                            <h4>Thông tin khách hàng:</h4>
                            <label>Tên khách hàng: </label>
                            <input type="text" value="{{ $data->NameCustom }}" name="name"
                                style="background: #f8f7f9; border-color: #7fc975; border: none; width: 70%">
                            <label>Địa chỉ email: </label>
                            <input type="text" value="{{ $data->Email }}" name="email"
                                style="background: #f8f7f9; border-color: #7fc975; border: none; width: 70%">
                            <label>Số điện thoại: </label>
                            <input type="text" value="{{ $data->Phone }}" name="phone"
                                style="background: #f8f7f9; border-color: #7fc975; border: none; width: 70%">
                            <label>Địa chỉ: </label>
                            <input type="text" value="{{ $data->Adrress }}" name="adrress"
                                style="background: #f8f7f9; border-color: #7fc975; border: none; width: 70%"><br>
                            <button class="btn btn-primary" type="submit"
                                style="width: 30%; margin-top: 25%; margin-left: 70%">Cập nhập</button>
                        </div>
                    </div>
                @endforeach
            </form>
    </div>
    <script>
        const slk = document.getElementById("guests");
        const capacity = document.getElementById("capacity");
        const RoomQuantity = document.getElementById("RoomQuantity");
        const PriceRoom = document.getElementById("PriceRoom");
        const CountPrice = document.getElementById("CountPrice");
        const hidenPrice = document.getElementById("hidenPrice");
        const checkin = document.getElementById("checkin");
        const checkout = document.getElementById("checkout");

        slk.addEventListener("input", myScript);
        checkin.addEventListener("input", myScript);
        checkout.addEventListener("input", myScript);
        function myScript() {
            // event.preventDefault();

            RoomQuantity.value = Math.round(slk.value / capacity.textContent);
            var datein = new Date(checkin.value);
            var dateout =  new Date(checkout.value);
            var date = Math.round((dateout - datein)/1000/60/60/24);
            CountPrice.textContent = `${date * RoomQuantity.value * PriceRoom.value}$`;
            hidenPrice.value = date * RoomQuantity.value * PriceRoom.value;
        }
    </script>
@stop
