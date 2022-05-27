@extends('layouts.index')
@section('title', 'Trang Chủ')
@section('main')
    <div class="hero-wrap" style="background-image: url('{{ url('public/home') }}/images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
                <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                    <div class="text">
                        <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span>
                            <span>About</span>
                        </p>
                        <h1 class="mb-4 bread">Rooms</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 sidebar">
                        <div class="sidebar-wrap bg-light ftco-animate">
                            <h3 class="heading mb-4">Tìm</h3>

                            <form autocomplete="off" method="post">
                                @csrf
                                <div class="fields">
                                    <div class="form-group">
                                        <input type="text"  name="checkin"
                                            class="form-control checkin_date" placeholder="Ngày đến" id="date_to">
                                    </div>
                                    <div class="form-group">
                                        <input type="text"  name="checkout"
                                            class="form-control checkout_date" placeholder="Ngày đi" id="date_form">
                                    </div>
                                    <div class="form-group">
                                        <div class="select-wrap one-third">
                                            <select class="form-control" name="city" id="city">
                                                <option value="">Thành Phố </option>
                                                @foreach ($city as $dataCity )
                                                    <option value="{{ $dataCity -> slug }}">{{ $dataCity -> name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="select-wrap one-third">
                                            <input type="text" class="form-control" placeholder="Số người" name="guests" id="guests">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="range-slider">

                                            <span>
                                                <p> <span>0$</span> -<span id="demo">$</span></p>

                                            </span>
                                            <input type="range" min="0" max="20000" value="1000" class="slider"
                                                id="myRange" name="price"><br>

                                            </svg>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary py-3 px-5" id="btn_search">Search</button>
                                        <script>
                                            var slider = document.getElementById("myRange");
                                            var output = document.getElementById("demo");

                                            output.innerHTML = slider.value;

                                            slider.oninput = function() {
                                                output.innerHTML = this.value;
                                            }
                                        </script>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="sidebar-wrap bg-light ftco-animate">
                            <form action="{{ route('home.search') }}">
                                <h3>Chọn lọc theo:</h3>
                                <hr>
                                <h3 class="heading mb-4">Loại chỗ ở</h3>
                                @foreach ($accommodations as $dataAccommodation)
                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                            value="{{ $dataAccommodation->id }}" onclick="myScript()" name="accommodation"
                                            @if (request()->get('accommodation'))
                                        @php
                                            $check = explode(',', request()->get('accommodation'));
                                        @endphp
                                        @foreach ($check as $dataCheck)
                                            @if ($dataCheck == $dataAccommodation->id)
                                                checked
                                            @endif
                                        @endforeach
                                @endif
                                >
                                <label class="form-check-label" for="exampleCheck1">
                                    {{ $dataAccommodation->name }}
                                </label>
                        </div>
    @endforeach
    <hr>
    <h3 class="heading mb-4">Xếp hạng</h3>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="5" name="rate" onclick=" myScript()">
        <label class="form-check-label" for="exampleCheck1">
            <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                        class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></span></p>
        </label>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="4" name="rate" onclick=" checkRate()">
        <label class="form-check-label" for="exampleCheck1">
            <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                        class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i></span></p>
        </label>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="3" name="rate" onclick=" checkRate()">
        <label class="form-check-label" for="exampleCheck1">
            <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                        class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
        </label>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="2" name="rate" onclick=" checkRate()">
        <label class="form-check-label" for="exampleCheck1">
            <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                        class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
        </label>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="rate" onclick=" checkRate()">
        <label class="form-check-label" for="exampleCheck1">
            <p class="rate"><span><i class="icon-star"></i><i class="icon-star-o"></i><i
                        class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
        </label>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary py-3 px-5">Lọc</button>
    </div>
    </form>

    </div>
    </div>
    <div class="col-lg-9">
        <div class="row" id="searchHotel">
            @foreach ($data as $dataCity)
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div style="width: auto;">
                                <img src="{{ url('public/upload') }}/{{ $dataCity->img }}" alt=""
                                class="img " style="width: 200px; height: 200px; margin: 3%; border-radius: 3%">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-7" style="margin-left: 2%" >
                                    <h4 >{{ $dataCity -> name }}</h4>
                                    <a href="#" >{{ $dataCity -> adrress }}</a><br>
                                    @foreach ($data_TienNghi as $TienNghi)
                                        @php
                                            $explode = explode('|', $TienNghi -> idHotel);
                                        @endphp
                                        @foreach ($explode as $idExplode)
                                            @if ($TienNghi-> idAdmin == $dataCity -> idUser && ($idExplode == $dataCity -> id || $idExplode == 0))
                                                <span style="color: rgb(6, 175, 6)">{{ $TienNghi -> name }}</span><br>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                                <div class="col-md-4" style="margin-left: 6%">
                                    <div style="margin-left: 20%">
                                        <h4>
                                            Tuyệt vời
                                        </h4>
                                        @php
                                            $commentTotal = DB::table('comments')->where('idHotel', $dataCity->id)->count();
                                            if($commentTotal == 0){

                                            }else{
                                                echo $commentTotal.' đánh giá';
                                            }
                                        @endphp
                                    </div>
                                    <div style="margin-top: 25%; margin-left: 20%">
                                        <h4 style="color: red; margin-left: 20% ">
                                            @php
                                                $check = DB::table('kindrooms')
                                                    ->where('idHotel', $dataCity->id)
                                                    ->min('price');
                                                echo $check . '$';
                                            @endphp
                                        </h4>
                                        <a href="{{ route('home.hotel_room', [$dataCity->slug, $dataCity->id, $dataCity->city]) }}"
                                            class="btn btn-primary">Xem Phòng</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm col-md-6 col-lg-6 ftco-animate">
                    <div class="room">
                        <a href="rooms-single.html" class="img d-flex justify-content-center align-items-center">
                            <img src="{{ url('public/upload') }}/{{ $dataCity->img }}" alt="" class="img "
                                style="width: 100%">
                        </a>
                        <div class="text p-3 text-center">
                            <h3 class="mb-3"><a href="rooms-single.html">{{ $dataCity->name }}</a></h3>
                            <p>
                                <span class="price mr-2">
                                    @php
                                        $check = DB::table('kindrooms')->where('idHotel', $dataCity -> id)->min('price');
                                        echo $check.'$';
                                    @endphp
                                </span>
                                <span class="per">
                                    1 đêm, 1 người
                                </span>

                            </p>
                            <hr>
                            <p class="pt-1">
                                <a href="{{ route('home.hotel_room', [$dataCity -> slug, $dataCity -> id, $dataCity->city]) }}" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a>
                            </p>
                        </div>
                    </div>
                </div> --}}
            @endforeach
        </div>
    </div>
    </section>
    <script>
        function myScript() {
            // Khai báo tham số
            var checkAcc = document.getElementsByName('accommodation');
            var rateCheck = document.getElementsByName('rate');
            var arrRate = [];
            // Lặp qua từng checkbox để lấy giá trị
            var arr = [];

            var brand = [];
            var checkRate = [];
            for (var i = 0; i < checkAcc.length; i++) {
                if (checkAcc[i].checked === true) {
                    arr.push(checkAcc[i].value);
                }
            }
            arr.reverse();

            if (arr != null) {
                brand += '?accommodation=' + arr.toString();
                console.log(brand);
                // window.location.href = brand ;
            } else {
                console.log('ok');
            }
            // window.location.href = brand ;




        }

        function checkRate() {
            var rateCheck = document.getElementsByName('rate');
            var arrRate = [];
            var brand = [];
            for (var i = 0; i < rateCheck.length; i++) {
                if (rateCheck[i].checked === true) {
                    arrRate.push(rateCheck[i].value);
                }
            }
            arrRate.reverse();
            brand += '?rate=' + arrRate.toString();
            window.location.href = brand;
        }
    </script>

@stop
@section('js')

@stop
