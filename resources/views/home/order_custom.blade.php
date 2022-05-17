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
    </div>
    <br>
    <div class="container">
        <div>
            <form action="">
                <label for=""><b>Mã đặt phòng</b></label><br>
                <input type="text" name="key" placeholder="Nhập mã đặt chỗ"
                    style="border-radius: 20px; border-style: solid">
                <button type="submit" class="btn btn-primary">Tìm</button>
            </form>
        </div>
        <br>
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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Đơn hàng chưa hoàn thành</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Đơn hàng đã hoàn thành</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @if ($order_info)
                        @foreach ($order_info as $data)
                            @if ($data->OutDay > date('Y-m-d'))
                                <div class="card card_deatils cssanimation2 fadeInBottom2">
                                    <div class="card-body">
                                        <table class="row" style="color: black">
                                            <tr class="col-md-12">
                                                <td class="col-md-5">
                                                    @foreach ($data->Hotel as $image)
                                                        <img src="{{ url('public/upload') }}/{{ $image->img }}" alt=""
                                                            style="width: 100%; height: 100% , border-radius: 10px" >
                                                    @endforeach
                                                </td>
                                                <td class="col-md-7">
                                                    <table class="row">
                                                        <tr>
                                                            <td class="row">
                                                                <div class="col-md-8">
                                                                    <h4>
                                                                        @foreach ($data->Hotel as $nameHotel)
                                                                            <a
                                                                                href="{{ route('home.hotel_room', [$nameHotel->slug, $nameHotel->id, $nameHotel -> city]) }}">
                                                                                {{ $nameHotel->name }}
                                                                            </a>
                                                                        @endforeach
                                                                    </h4>
                                                                    <p style="">Loại phòng: {{ $data->NameRoom }}</p>
                                                                    <p>Mã đặt phòng: {{ $data->CodeOrders }}</p>
                                                                    <p style="color: #32a941">
                                                                        Tình trạng đặt phòng:
                                                                        @if ($data->PaymentStatus == 1)
                                                                            Thanh toán tại cho nơi lưu trú lúc nhận phòng
                                                                        @else
                                                                            Đã thanh toán
                                                                        @endif
                                                                    </p>
                                                                    <h5 style="color: #32a941; ">
                                                                        <i class="far fa-check-circle"></i> Chưa hoàn thành
                                                                    </h5>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p> {{ $data->NextDay }}|{{ $data->OutDay }}</p>
                                                                    <h4 style="color: red; margin-left: 35%">
                                                                        {{ $data->CountPrice }}$
                                                                    </h4>
                                                                </div>
                                                                <a href="{{ route('home.EditOrder', $data->CodeOrders) }}"
                                                                    class="btn btn-primary"
                                                                    style="margin-left: 75%; color: white; margin-bottom: 1%">
                                                                    Sửa thông tin
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endif
                            <br>
                        @endforeach
                    @else
                        <h4>Chưa có đơn hàng nào</h4>
                    @endif
                </div>
                {{-- Tab chưa hoàn thành --}}
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>
                    @foreach ($order_info as $data)
                        @if ($data->OutDay < date('Y-m-d'))
                            <div class="card card_deatils cssanimation2 fadeInBottom2" style="border: none">
                             <div class="card-body">
                                <table class="row" style="color: black">
                                    <tr class="col-md-12">
                                        <td class="col-md-5">
                                            @foreach ($data->Hotel as $image)
                                                <img src="{{ url('public/upload') }}/{{ $image->img }}" alt=""
                                                    style="width: 100%; height: 100%; border-radius: 10px">
                                            @endforeach
                                        </td>
                                        <td class="col-md-7">
                                            <table class="row">
                                                <tr>
                                                    <td class="row">
                                                        <div class="col-md-8" style="width: 100%;">
                                                            <h4>
                                                                @foreach ($data->Hotel as $nameHotel)
                                                                    <a
                                                                        href="{{ route('home.hotel_room', [$nameHotel->slug, $nameHotel->id, $nameHotel -> city]) }}">
                                                                        {{ $nameHotel->name }}
                                                                    </a>
                                                                @endforeach
                                                            </h4>
                                                            <p style="">Loại phòng: {{ $data->NameRoom }}</p>
                                                            <p>Mã đặt phòng: {{ $data->CodeOrders }}</p>
                                                            <p style="color: #32a941">
                                                                Tình trạng đặt phòng:
                                                                @if ($data->PaymentStatus == 1)
                                                                    Thanh toán tại cho nơi lưu trú lúc nhận phòng
                                                                @else
                                                                    Đã thanh toán
                                                                @endif
                                                            </p>
                                                            <h5 style="color: #32a941; ">
                                                                <i class="far fa-check-circle"></i> Đã hoàn thành
                                                            </h5>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p> {{ $data->NextDay }}|{{ $data->OutDay }}</p>
                                                            <h4 style="color: red; margin-left: 35%">
                                                                {{ $data->CountPrice }}$
                                                            </h4>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                             </div>
                                @php
                                    $check = DB::table('comments')
                                        ->where('CodeOrders', $data->CodeOrders)
                                        ->first();
                                    // $check = DB::table('comment')->find( $data -> CodeOrders, 'CodeOrders')->first();
                                @endphp
                                @if ($check)
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target=".evaluate-{{ $check->id }}"
                                        style="margin-left: 80%; color: white; margin-bottom: 1%">
                                        Sửa nội dung đánh giá
                                    </button>
                                    <div class="modal fade evaluate-{{ $check->id }} " tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                @foreach ($data->Hotel as $nameHotel)
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                            {{ $nameHotel->name }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <div class="col-md-4">
                                                            <p style="">Loại phòng: {{ $data->NameRoom }}</p>
                                                            <p>Mã đặt phòng: {{ $data->CodeOrders }}</p>
                                                            <p>Ngày đến: {{ $data->NextDay }}</p>
                                                            <p>Ngày đi: {{ $data->OutDay }}</p>
                                                            <p>Gía phòng: {{ $data->CountPrice }}$</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                        </div>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <form action="{{ route('comment.update', $check->id) }}"
                                                            class="row" method="POST">
                                                            @csrf @method('PUT')
                                                            <div class="col-md-7">
                                                                <h5>Viết đánh giá</h5>
                                                                <input type="text" class="form-control" name="comment"
                                                                    value="{{ $check->Comment }}"><br>
                                                                <button class="btn btn-primary"
                                                                    style="margin-left: 80%">Nhận
                                                                    xét</button>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h5>Xếp hạng</h5>
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input"
                                                                        value="5"
                                                                        @if ($check->Ratings == 5) checked @endif
                                                                        name="rate">
                                                                    <label class="form-check-label" for="exampleCheck1">
                                                                        <p class="rate"><span><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i></span></p>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input"
                                                                        value="4" name="rate"
                                                                        @if ($check->Ratings == 4) checked @endif>
                                                                    <label class="form-check-label" for="exampleCheck1">
                                                                        <p class="rate"><span><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star-o"></i></span></p>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input"
                                                                        value="3" name="rate"
                                                                        @if ($check->Ratings == 3) checked @endif>
                                                                    <label class="form-check-label" for="exampleCheck1">
                                                                        <p class="rate"><span><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star-o"></i><i
                                                                                    class="icon-star-o"></i></span></p>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input"
                                                                        value="2" name="rate"
                                                                        @if ($check->Ratings == 2) checked @endif>
                                                                    <label class="form-check-label" for="exampleCheck1">
                                                                        <p class="rate"><span><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star-o"></i><i
                                                                                    class="icon-star-o"></i><i
                                                                                    class="icon-star-o"></i></span></p>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input"
                                                                        value="1" name="rate"
                                                                        @if ($check->Ratings == 1) checked @endif>
                                                                    <label class="form-check-label" for="exampleCheck1">
                                                                        <p class="rate"><span><i
                                                                                    class="icon-star"></i><i
                                                                                    class="icon-star-o"></i><i
                                                                                    class="icon-star-o"></i><i
                                                                                    class="icon-star-o"></i><i
                                                                                    class="icon-star-o"></i></span></p>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target=".evaluate-{{ $data->id }}"
                                        style="margin-left: 80%; color: white; margin-bottom: 1%">
                                        Đánh giá
                                    </button>
                                @endif
                                <div class="modal fade evaluate-{{ $data->id }} " tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            @foreach ($data->Hotel as $nameHotel)
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        {{ $nameHotel->name }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body row">
                                                    <div class="col-md-4">
                                                        <p style="">Loại phòng: {{ $data->NameRoom }}</p>
                                                        <p>Mã đặt phòng: {{ $data->CodeOrders }}</p>
                                                        <p>Ngày đến: {{ $data->NextDay }}</p>
                                                        <p>Ngày đi: {{ $data->OutDay }}</p>
                                                        <p>Gía phòng: {{ $data->CountPrice }}$</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                    </div>
                                                </div>
                                                <div class="modal-body ">
                                                    <form
                                                        action="{{ route('comment.post', [$data->CodeOrders, $data->IdHotel, $data -> idAdmin]) }}"
                                                        class="row" method="POST">
                                                        @csrf
                                                        <div class="col-md-7">
                                                            <h5>Viết đánh giá</h5>
                                                            <input type="text" class="form-control" name="comment"><br>
                                                            <button class="btn btn-primary" style="margin-left: 80%">Nhận
                                                                xét</button>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <h5>Xếp hạng</h5>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" value="5"
                                                                    name="rate">
                                                                <label class="form-check-label" for="exampleCheck1">
                                                                    <p class="rate"><span><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i></span></p>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" value="4"
                                                                    name="rate">
                                                                <label class="form-check-label" for="exampleCheck1">
                                                                    <p class="rate"><span><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star-o"></i></span></p>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" value="3"
                                                                    name="rate">
                                                                <label class="form-check-label" for="exampleCheck1">
                                                                    <p class="rate"><span><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star-o"></i><i
                                                                                class="icon-star-o"></i></span></p>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" value="2"
                                                                    name="rate">
                                                                <label class="form-check-label" for="exampleCheck1">
                                                                    <p class="rate"><span><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star-o"></i><i
                                                                                class="icon-star-o"></i><i
                                                                                class="icon-star-o"></i></span></p>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" value="1"
                                                                    name="rate">
                                                                <label class="form-check-label" for="exampleCheck1">
                                                                    <p class="rate"><span><i
                                                                                class="icon-star"></i><i
                                                                                class="icon-star-o"></i><i
                                                                                class="icon-star-o"></i><i
                                                                                class="icon-star-o"></i><i
                                                                                class="icon-star-o"></i></span></p>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                    @endforeach
                </div>
            </div>
    </div>
    {{-- Modal --}}
@stop
