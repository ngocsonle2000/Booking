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
            <div class="sidebar-wrap bg-light ftco-animate card_booking">
               <h3 class="heading mb-4">Tìm</h3>
               <form action="{{ route('home.search') }}">
                  <div class="fields">
                     <div class="form-group">
                        <input type="text" id="checkin_date" name="checkin"
                           class="form-control checkin_date" placeholder="Ngày đến">
                     </div>
                     <div class="form-group">
                        <input type="text" id="checkin_date" name="checkout"
                           class="form-control checkout_date" placeholder="Ngày đi">
                     </div>
                     <div class="form-group">
                        <div class="select-wrap one-third">
                           {{--
                           <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                           --}}
                           <input type="text" id="checkin_date" class="form-control"
                              placeholder="Thành phố" name="city">
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="select-wrap one-third">
                           <input type="text" class="form-control" placeholder="Số người" name="guests">
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
                        <button type="submit" class="btn btn-primary py-3 px-5">Search</button>
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
            <div class="sidebar-wrap bg-light ftco-animate card_booking">
               <form action="{{ route('home.search') }}">
                  <h3>Chọn lọc theo:</h3>
                  <hr>
                  <h3 class="heading mb-4">Loại chỗ ở</h3>
                  @foreach ($accommodations as $dataAccommodation)
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input"
                     value="{{ $dataAccommodation->slug }}" onclick="myScript()"
                     name="accommodation"
                     @if (request()->get('accommodation')) @php
                     $check = explode(',', request()->get('accommodation'));
                     @endphp
                     @foreach ($check as $dataCheck)
                     @if ($dataCheck == $dataAccommodation->slug)
                     checked @endif
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
                     <input type="checkbox" class="form-check-input" value="5" name="rate"
                     @if (request()->get('rate')) @php
                     $checkRate = explode(',', request()->get('rate'));
                     @endphp
                     @foreach ($checkRate as $dataCheck)
                     @if ($dataCheck == 5)
                     checked @endif
                     @endforeach
                     @endif
                     onclick=" checkRate()">
                     <label class="form-check-label" for="exampleCheck1">
                        <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                           class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></span></p>
                     </label>
                  </div>
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input" value="4" name="rate"
                     @if (request()->get('rate')) @php
                     $checkRate = explode(',', request()->get('rate'));
                     @endphp
                     @foreach ($checkRate as $dataCheck)
                     @if ($dataCheck == 4)
                     checked @endif
                     @endforeach
                     @endif
                     onclick=" checkRate()">
                     <label class="form-check-label" for="exampleCheck1">
                        <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                           class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i></span></p>
                     </label>
                  </div>
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input" value="3" name="rate"
                     @if (request()->get('rate')) @php
                     $checkRate = explode(',', request()->get('rate'));
                     @endphp
                     @foreach ($checkRate as $dataCheck)
                     @if ($dataCheck == 3)
                     checked @endif
                     @endforeach
                     @endif
                     onclick=" checkRate()">
                     <label class="form-check-label" for="exampleCheck1">
                        <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                           class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
                     </label>
                  </div>
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input" value="2" name="rate"
                     @if (request()->get('rate')) @php
                     $checkRate = explode(',', request()->get('rate'));
                     @endphp
                     @foreach ($checkRate as $dataCheck)
                     @if ($dataCheck == 2)
                     checked @endif
                     @endforeach
                     @endif
                     onclick=" checkRate()">
                     <label class="form-check-label" for="exampleCheck1">
                        <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                           class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
                     </label>
                  </div>
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input" value="1" name="rate"
                     @if (request()->get('rate')) @php
                     $checkRate = explode(',', request()->get('rate'));
                     @endphp
                     @foreach ($checkRate as $dataCheck)
                     @if ($dataCheck == 1)
                     checked @endif
                     @endforeach
                     @endif
                     onclick=" checkRate()">
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
            <div class="row">
               @if (request()->get('checkout'))
                    @foreach ($searchRoom as $room_data)
                    <div class="col-sm col-md-6 col-lg-6 ftco-animate card_booking">
                        <div class="room">
                            <a href="rooms-single.html" class="img d-flex justify-content-center align-items-center">
                            <img src="{{ url('public/upload') }}/{{ $room_data->img }}" alt=""
                                class="img " style="width: 100%">
                            </a>
                            <div class="text p-3 text-center">
                                <h3 class="mb-3"><a
                                href="{{ route('home.hotel_room', [
                                $room_data->slug,
                                $room_data->id,
                                $room_data->city,
                                'checkin' => request()->get('checkin'),
                                'checkout' => request()->get('checkout'),
                                'guests' => request()->get('guests'),
                                ]) }}">{{ $room_data->name }}</a>
                                </h3>
                                <p>
                                <span class="price mr-2">
                                @php
                                $date = abs(strtotime(request()->get('checkout')) - strtotime(request()->get('checkin')));
                                $numDay = floor($date / (60 * 60 * 24));
                                if (
                                DB::table('kindrooms')
                                ->where([['idHotel', $room_data->id], ['sale_price', '>', 0]])
                                ->min('sale_price')
                                ) {
                                $price_sale = DB::table('kindrooms')
                                ->where([['idHotel', $room_data->id]])
                                ->min('sale_price');
                                $count = $price_sale * $numDay;
                                echo $count . '$';
                                } else {
                                $price = DB::table('kindrooms')
                                ->where([['idHotel', $room_data->id]])
                                ->min('price');
                                $count = $price * $numDay;
                                echo $count . '$';
                                }
                                @endphp
                                </span><span class="per">
                                @php
                                echo $numDay . ' đêm, ' . request()->get('guests') . ' người';
                                @endphp
                                </span>
                                </p>
                                <hr>
                                <p class="pt-1">
                                <a href="{{ route('home.hotel_room', [
                                    $room_data->slug,
                                    $room_data->id,
                                    $room_data->city,
                                    'checkin' => request()->get('checkin'),
                                    'checkout' => request()->get('checkout'),
                                    'guests' => request()->get('guests'),
                                    ]) }}"
                                    class="btn-custom">Xem Ngay <span class="icon-long-arrow-right"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
               @elseif (request()->get('accommodation'))
                    @php
                        $check = explode(',', request()->get('accommodation'));
                    @endphp
                    @foreach ($check as $dataCheck)
                        @php
                            $hotelAccommodation = DB::table('hotels')
                            ->where('accommodation', $dataCheck)
                            ->get();
                        @endphp
                        @foreach ($hotelAccommodation as $checkData)
                            <div class="col-sm col-md-6 col-lg-6 ftco-animate">
                                <div class="room">
                                    <a href="{{ route('home.hotel_room', [$checkData->slug, $checkData->id, $checkData->city]) }}"
                                        class="img d-flex justify-content-center align-items-center">
                                    <img src="{{ url('public/upload') }}/{{ $checkData->img }}" alt=""
                                        class="img " style="width: 100%">
                                    </a>
                                </div>
                                <div class="text p-3 text-center">
                                    <h3 class="mb-3"><a href="rooms-single.html">{{ $checkData->name }}</a></h3>
                                    <p> Chọn ngày để xem giá </p>
                                    <hr>
                                    <p class="pt-1">
                                        <a href="{{ route('home.hotel_room', [$checkData->slug, $checkData->id, $checkData->city]) }}"
                                        class="btn-custom">Xem Ngay <span class="icon-long-arrow-right"></span></a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @else
                    @foreach ($data_Hotel as $hotel)
                        <div class="col-sm col-md-6 col-lg-6 ftco-animate card_booking">
                            <div class="room">
                                <a href="{{ route('home.hotel_room', [$hotel->slug, $hotel->id, $hotel->city]) }}"
                                    class="img d-flex justify-content-center align-items-center">
                                <img src="{{ url('public/upload') }}/{{ $hotel->img }}" alt=""
                                    class="img " style="width: 100%">
                                </a>
                            </div>
                            <div class="text p-3 text-center">
                                <h3 class="mb-3"><a href="rooms-single.html">{{ $hotel->name }}</a></h3>
                                <p>
                                    <span class="price mr-2">
                                    @php
                                    $check = DB::table('kindrooms')
                                    ->where('idHotel', $hotel->id)
                                    ->min('price');
                                    echo $check . '$';
                                    @endphp
                                    </span>
                                    <span class="per">
                                    1 đêm, 1 người
                                    </span>
                                </p>
                                <hr>
                                <p class="pt-1">
                                    <a href="{{ route('home.hotel_room', [$hotel->slug, $hotel->id, $hotel->city]) }}"
                                    class="btn-custom">Xem Ngay <span class="icon-long-arrow-right"></span></a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
         </div>
      </div>
   </div>
</section>
<script>
   function myScript() {
       // Khai báo tham số
       var checkAcc = document.getElementsByName('accommodation');
       // Lặp qua từng checkbox để lấy giá trị
       var arr = [];

       var brand = [];
       for (var i = 0; i < checkAcc.length; i++) {
           if (checkAcc[i].checked === true) {
               arr.push(checkAcc[i].value);
           }
       }
       arr.reverse();
       loh = location.search;
       console.log(loh);
       console.log(arr);
       if (location.search == '') {
           // brand += '?accommodation=' +arr.toString();
           // window.location.href = brand ;
           console.log('acc');
       } else {
           if (arr.length == 0) {
               // brand += 'accommodation=' +arr.toString();
               // window.location.search = brand ;
               console.log('acc ok')
           } else {
               // brand += '&accommodation='+ arr.toString();
               // window.location.search += brand ;
               console.log('acc loi')
           }
       }
   }

   function checkRate() {
       var rateCheck = document.getElementsByName('rate');
       var arrRate = [];

       var brandRate = [];
       for (var i = 0; i < rateCheck.length; i++) {
                   if (rateCheck[i].checked === true) {
                       arrRate.push(rateCheck[i].value);
                   }
               }
       arrRate.reverse();

       if (location.search == '') {
           brandRate += '?rate=' + arrRate.toString();
           window.location.href = brandRate;
       } else {
           if (arrRate.length !== 0) {

               brandRate += 'rate=' + arrRate.toString();
               window.location.search = brandRate;
               console.log('rand ok')
           } else {
               brandRate += '&rate=' + arrRate.toString();
               window.location.search += brandRate;
               console.log('rand loi')
           }
       }
   }
</script>
@stop
@section('js')
@stop
