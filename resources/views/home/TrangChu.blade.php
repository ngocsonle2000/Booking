@extends('layouts.index')
@section('title', 'Trang Chủ')
@section('main')

    <section class="home-slider owl-carousel">
        @foreach ($banner as $data)
            <div class="slider-item" style="background-image:url({{ url('public/upload') }}/{{ $data->image }});">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-center">
                        <div class="col-md-12 ftco-animate text-center">
                            <div class="text mb-5 pb-3">
                                <h1 class="mb-3">{!! $data->content !!}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <section class="ftco-booking">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('home.search') }}" class="booking-form">
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <div class="form-group p-4 align-self-stretch d-flex align-items-end" style="border-radius: 10px">
                                    <div class="wrap">
                                        <label for="#">Ngày Đến</label>
                                        <input type="date" id = "start" class="form-control " value=""   placeholder="Chọn ngày đến"
                                            name="checkin">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex">
                                <div class="form-group p-4 align-self-stretch d-flex align-items-end" style="border-radius: 10px">
                                    <div class="wrap">
                                        <label for="#">Ngày Đi</label>
                                        <input type="date" class="form-control" id="dateOut" placeholder="Chọn ngày đi"
                                            name="checkout">
                                    </div>
                                </div>
                            </div>
                            <script>
                                const start = document.getElementById("start");
                                const dateOut = document.getElementById("dateOut");
                                start.addEventListener("input", myScript);
                                const date = new Date();
                                start.min = date.getFullYear()+'-0'+(date.getMonth()+1)+'-'+date.getDate();
                                function myScript() {
                                    dateOut.min = (start.value);
                                }
                            </script>
                            <div class="col-md d-flex">
                                <div class="form-group p-4 align-self-stretch d-flex align-items-end" style="border-radius: 10px">
                                    <div class="wrap">
                                        <label for="#">Thành Phố</label>

                                        <select class="form-control" name="city">
                                            <option value="">Thành Phố </option>
                                            @foreach ($city as $dataCity )
                                                <option value="{{ $dataCity -> slug }}">{{ $dataCity -> name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md d-flex">
                                <div class="form-group p-4 align-self-stretch d-flex align-items-end" style="border-radius: 10px">
                                    <div class="wrap">
                                        <label for="#">Số Khách</label>
                                        <input type="text" class="form-control " placeholder="Số Khách" name="guests">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md d-flex">
                                <div class="form-group d-flex align-self-stretch" style="border-radius: 10px">
                                    <input type="submit" value="Tìm kiếm"
                                        class="btn btn-primary py-3 px-4 align-self-stretch"style="border-radius: 10px" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container ">
            <div class="row">
                @foreach ($city as $dataCity)
                    <div class="col-lg-3" >
                        <a href="{{ route('home.City', $dataCity -> slug) }}">
                            <img src="{{ url('public/upload') }}/{{ $dataCity->image }}" class=" grayscale"
                            style="position: absolute; width: 95%; height: 280%; border-radius: 10px">
                        </a>
                        <div style="position: relative; color: white; padding-left: 3%">
                            <h4 style="color: white"><b>{{ $dataCity->name }}</b></h4>
                            @php
                                $countCity = DB::table('hotels')
                                    ->where('city', $dataCity->slug)
                                    ->count();
                            @endphp
                            <p><b>Chỗ ở: {{ $countCity }}</b></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>



    </section>
    <section class="ftco-section section-card">
        <div class="swiper mySwiper container">
            <div class="swiper-wrapper content">
                @foreach ($accom as $dataAccom)
                    <div class="swiper-slide card-acc">
                        <a href="{{ route('home.accommodation', $dataAccom -> slug) }}">
                            <img src="{{ url('public/upload') }}/{{ $dataAccom->image }}" alt="">
                        </a>
                        <div>
                            @php
                                $countAccom = DB::table('hotels')
                                    ->where('accommodation', $dataAccom->slug)
                                    ->count();
                            @endphp
                            <h5><b>{{ $dataAccom->name }}</b></h5>
                            <span style="color: #838383">{{ $countAccom }} Chỗ nghỉ</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </section>
    {{-- <section class="ftco-section" >
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services py-4 d-block text-center">
                        <div class="d-flex justify-content-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-reception-bell"></span>
                            </div>
                        </div>
                        <div class="media-body p-2 mt-2">
                            <h3 class="heading mb-3">25/7 Front Desk</h3>
                            <p>A small river named Duden flows by their place and supplies.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services py-4 d-block text-center">
                        <div class="d-flex justify-content-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-serving-dish"></span>
                            </div>
                        </div>
                        <div class="media-body p-2 mt-2">
                            <h3 class="heading mb-3">Restaurant Bar</h3>
                            <p>A small river named Duden flows by their place and supplies.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-sel Searchf-stretch ftco-animate">
                    <div class="media block-6 services py-4 d-block text-center">
                        <div class="d-flex justify-content-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-car"></span>
                            </div>
                        </div>
                        <div class="media-body p-2 mt-2">
                            <h3 class="heading mb-3">Transfer Services</h3>
                            <p>A small river named Duden flows by their place and supplies.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services py-4 d-block text-center">
                        <div class="d-flex justify-content-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-spa"></span>
                            </div>
                        </div>
                        <div class="media-body p-2 mt-2">
                            <h3 class="heading mb-3">Spa Suites</h3>
                            <p>A small river named Duden flows by their place and supplies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Our Rooms</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                    <div class="room">
                        <a href="rooms.html" class="img d-flex justify-content-center align-items-center"
                            style="background-image: url({{ url('public/home') }}/images/room-1.jpg);">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="icon-search2"></span>
                            </div>
                        </a>
                        <div class="text p-3 text-center">
                            <h3 class="mb-3"><a href="rooms.html">Suite Room</a></h3>
                            <p><span class="price mr-2">$120.00</span> <span class="per">per night</span></p>
                            <hr>
                            <p class="pt-1"><a href="room-single.html" class="btn-custom">View Room Details
                                    <span class="icon-long-arrow-right"></span></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                    <div class="room">
                        <a href="rooms.html" class="img d-flex justify-content-center align-items-center"
                            style="background-image: url({{ url('public/home') }}/images/room-2.jpg);">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="icon-search2"></span>
                            </div>
                        </a>
                        <div class="text p-3 text-center">
                            <h3 class="mb-3"><a href="rooms.html">Family Room</a></h3>
                            <p><span class="price mr-2">$20.00</span> <span class="per">per night</span></p>
                            <hr>
                            <p class="pt-1"><a href="room-single.html" class="btn-custom">View Room Details
                                    <span class="icon-long-arrow-right"></span></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                    <div class="room">
                        <a href="rooms.html" class="img d-flex justify-content-center align-items-center"
                            style="background-image: url({{ url('public/home') }}/images/room-3.jpg);">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="icon-search2"></span>
                            </div>
                        </a>
                        <div class="text p-3 text-center">
                            <h3 class="mb-3"><a href="rooms.html">Deluxe Room</a></h3>
                            <p><span class="price mr-2">$150.00</span> <span class="per">per night</span>
                            </p>
                            <hr>
                            <p class="pt-1"><a href="room-single.html" class="btn-custom">View Room Details
                                    <span class="icon-long-arrow-right"></span></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                    <div class="room">
                        <a href="rooms.html" class="img d-flex justify-content-center align-items-center"
                            style="background-image: url({{ url('public/home') }}/images/room-4.jpg);">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="icon-search2"></span>
                            </div>
                        </a>
                        <div class="text p-3 text-center">
                            <h3 class="mb-3"><a href="rooms.html">Classic Room</a></h3>
                            <p><span class="price mr-2">$130.00</span> <span class="per">per night</span>
                            </p>
                            <hr>
                            <p class="pt-1"><a href="room-single.html" class="btn-custom">View Room Details
                                    <span class="icon-long-arrow-right"></span></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                    <div class="room">
                        <a href="rooms.html" class="img d-flex justify-content-center align-items-center"
                            style="background-image: url({{ url('public/home') }}/images/room-5.jpg);">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="icon-search2"></span>
                            </div>
                        </a>
                        <div class="text p-3 text-center">
                            <h3 class="mb-3"><a href="rooms.html">Superior Room</a></h3>
                            <p><span class="price mr-2">$300.00</span> <span class="per">per night</span>
                            </p>
                            <hr>
                            <p class="pt-1"><a href="room-single.html" class="btn-custom">View Room Details
                                    <span class="icon-long-arrow-right"></span></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                    <div class="room">
                        <a href="rooms.html" class="img d-flex justify-content-center align-items-center"
                            style="background-image: url({{ url('public/home') }}/images/room-6.jpg);">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="icon-search2"></span>
                            </div>
                        </a>
                        <div class="text p-3 text-center">
                            <h3 class="mb-3"><a href="rooms.html">Luxury Room</a></h3>
                            <p><span class="price mr-2">$500.00</span> <span class="per">per night</span>
                            </p>
                            <hr>
                            <p class="pt-1"><a href="room-single.html" class="btn-custom">View Room Details
                                    <span class="icon-long-arrow-right"></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- <section class="ftco-section ftco-counter img" id="section-counter"
        style="background-image: url({{ url('public/home') }}/images/bg_1.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="50000">0</strong>
                                    <span>Happy Guests</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="3000">0</strong>
                                    <span>Rooms</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="1000">0</strong>
                                    <span>Staffs</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="100">0</strong>
                                    <span>Destination</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 ftco-animate">
                    <div class="row ftco-animate">
                        <div class="col-md-12">
                            <div class="carousel-testimony owl-carousel ftco-owl">
                                <div class="item">
                                    <div class="testimony-wrap py-4 pb-5">
                                        <div class="user-img mb-4"
                                            style="background-image: url({{ url('public/home') }}/images/person_1.jpg)">
                                            <span class="quote d-flex align-items-center justify-content-center">
                                                <i class="icon-quote-left"></i>
                                            </span>
                                        </div>
                                        <div class="text text-center">
                                            <p class="mb-4">A small river named Duden flows by their place and
                                                supplies it with the necessary regelialia. It is a paradisematic country, in
                                                which roasted parts of sentences fly into your mouth.</p>
                                            <p class="name">Nathan Smith</p>
                                            <span class="position">Guests</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimony-wrap py-4 pb-5">
                                        <div class="user-img mb-4"
                                            style="background-image: url({{ url('public/home') }}/images/person_2.jpg)">
                                            <span class="quote d-flex align-items-center justify-content-center">
                                                <i class="icon-quote-left"></i>
                                            </span>
                                        </div>
                                        <div class="text text-center">
                                            <p class="mb-4">A small river named Duden flows by their place and
                                                supplies it with the necessary regelialia. It is a paradisematic country, in
                                                which roasted parts of sentences fly into your mouth.</p>
                                            <p class="name">Nathan Smith</p>
                                            <span class="position">Guests</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimony-wrap py-4 pb-5">
                                        <div class="user-img mb-4"
                                            style="background-image: url({{ url('public/home') }}/images/person_3.jpg)">
                                            <span class="quote d-flex align-items-center justify-content-center">
                                                <i class="icon-quote-left"></i>
                                            </span>
                                        </div>
                                        <div class="text text-center">
                                            <p class="mb-4">A small river named Duden flows by their place and
                                                supplies it with the necessary regelialia. It is a paradisematic country, in
                                                which roasted parts of sentences fly into your mouth.</p>
                                            <p class="name">Nathan Smith</p>
                                            <span class="position">Guests</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimony-wrap py-4 pb-5">
                                        <div class="user-img mb-4"
                                            style="background-image: url({{ url('public/home') }}/images/person_1.jpg)">
                                            <span class="quote d-flex align-items-center justify-content-center">
                                                <i class="icon-quote-left"></i>
                                            </span>
                                        </div>
                                        <div class="text text-center">
                                            <p class="mb-4">A small river named Duden flows by their place and
                                                supplies it with the necessary regelialia. It is a paradisematic country, in
                                                which roasted parts of sentences fly into your mouth.</p>
                                            <p class="name">Nathan Smith</p>
                                            <span class="position">Guests</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimony-wrap py-4 pb-5">
                                        <div class="user-img mb-4"
                                            style="background-image: url({{ url('public/home') }}/images/person_1.jpg)">
                                            <span class="quote d-flex align-items-center justify-content-center">
                                                <i class="icon-quote-left"></i>
                                            </span>
                                        </div>
                                        <div class="text text-center">
                                            <p class="mb-4">A small river named Duden flows by their place and
                                                supplies it with the necessary regelialia. It is a paradisematic country, in
                                                which roasted parts of sentences fly into your mouth.</p>
                                            <p class="name">Nathan Smith</p>
                                            <span class="position">Guests</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Blog gần đây</h2>
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($post as $dataPost)
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch">
                            <a href="{{ route('home.post') }}/{{ $dataPost->slug }}" class="block-20"
                                style="background-image: url('{{ url('public/upload') }}/{{ $dataPost->image }}');">
                            </a>
                            <div class="text mt-3 d-block">
                                <h3 class="heading mt-3"><a
                                        href="{{ route('home.post') }}/{{ $dataPost->slug }}">{{ $dataPost->title }}</a>
                                </h3>
                                <div class="meta mb-3">
                                    <div>
                                        <a href="#">
                                            @php
                                                echo date_format($dataPost->created_at, 'd-m-Y  ');
                                            @endphp
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#">
                                            @foreach ($dataPost->Custom as $cus)
                                                {{ $cus->username }}
                                            @endforeach
                                        </a>
                                    </div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@stop
