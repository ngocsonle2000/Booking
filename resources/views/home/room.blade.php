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
                            <span>About</span></p>
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
                    <div class="sidebar-wrap bg-light ftco-animate card_booking " style="border-radius: 10px">
                       <h3 class="heading mb-4">Tìm</h3>
                       <form action="{{ route('home.search') }}">
                          <div class="fields">
                             <div class="form-group">
                                <input type="text" id="checkin_date" name="checkin"
                                   class="form-control checkin_date" style="border-radius: 10px" placeholder="Ngày đến">
                             </div>
                             <div class="form-group">
                                <input type="text" id="checkin_date" name="checkout"
                                   class="form-control checkout_date" placeholder="Ngày đi" style="border-radius: 10px">
                             </div>
                             <div class="form-group">
                                <div class="select-wrap one-third">
                                   {{--
                                   <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                   --}}
                                   <input type="text" id="checkin_date" class="form-control"
                                      placeholder="Thành phố" name="city" style="border-radius: 10px">
                                </div>
                             </div>
                             <div class="form-group">
                                <div class="select-wrap one-third">
                                   <input type="text" class="form-control" style="border-radius: 10px" placeholder="Số người" name="guests">
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
                                <button type="submit" class="btn btn-primary py-3 px-5" style="border-radius: 10px">Search</button>
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
                    <div class="sidebar-wrap bg-light ftco-animate card_booking" style="border-radius: 10px">
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
                             <button type="submit" class="btn btn-primary py-3 px-5" style="border-radius: 10px">Lọc</button>
                          </div>
                       </form>
                    </div>
                 </div>
                 <div class="col-lg-9" >
                    @if (request()->get('checkout'))
                        @foreach ($searchRoom as $room_data)
                            <div class="card card_booking" style="margin-bottom: 2%">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="{{ url('public/upload') }}/{{ $room_data->img }}" alt=""
                                            class="img " style="width: 100%; margin: 2%">
                                        </div>
                                        <div class="col-md-9">
                                            <h4>{{ $room_data -> name }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($data_Hotel as $room_data)
                            <div class="card card_booking" style="margin-bottom: 2%">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div style="width: auto;">
                                                <img src="{{ url('public/upload') }}/{{ $room_data->img }}" alt=""
                                                class="img " style="width: 200px; height: 200px; margin: 3%; border-radius: 3%">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <h4>{{ $room_data -> name }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                 </div>
            </div>
        </div>
    </section>

@stop
@section('js')
@stop
