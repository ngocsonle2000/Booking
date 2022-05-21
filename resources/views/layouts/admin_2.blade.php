<?php
$menus = config('menu');
$menuAdmin = config('menuAdmin');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('public') }}/assets/css/bootstrap.css">

    <link rel="stylesheet" href="{{ url('public') }}/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="{{ url('public') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ url('public') }}/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ url('public') }}/assets/css/app.css">
    <link rel="shortcut icon" href="{{ url('public') }}/assets/images/favicon.svg" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        $(document).ready(function() {


            function chartDay() {
                var token = 1;
                console.log(token);
                // $.ajax({
                //     url: "{{ url('/API/day-order') }}",
                //     method: "POST",
                //     dataType: "JSON",
                //     data: {
                //         token: _token
                //     },
                //     success: function(data) {
                //         // if (chartDT) {
                //         //     chartDT.series[0].update({
                //         //         data: data
                //         //     });
                //         //     console.log(dt);
                //         // }
                //         console.log(data);
                //     }
                // });
            }

            $('.HotelBrand').change(function() {
                var HotelBrand = $(this).val();
                var _token = $('input[name= "_token"]').val();
                $.ajax({
                    url: "{{ url('/API/HotelBrand') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        HotelBrand: HotelBrand,
                        _token: _token
                    },
                    success: function(data) {
                        var divRoom = document.getElementById('HotelRoom');
                        divRoom.innerHTML = ' <option value="0"> Chọn tất cả </option>';
                        $.each(data, function(key, index) {
                            divRoom.innerHTML +=
                                ` <option value="${index.id}">${index.name}</option>`;
                        })
                    }
                })
            });
            $('.filter-dasboard').change(function() {
                var dasboard_value = $(this).val();
                var _token = $('input[name= "_token"]').val();
                $.ajax({
                    url: "{{ url('/API/dauthang') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        dasboard_value: dasboard_value,
                        _token: _token
                    },
                    success: function(data) {
                        if (chartDT) {
                            chartDT.series[0].update({
                                data: data
                            });
                        }
                    }
                })
            });

            $('#btn-filter').click(function() {

                var date_form = $('#dateForm').val();
                var date_to = $('#dateTo').val();
                var _token = $('input[name= "_token"]').val();
                $.ajax({
                    url: "{{ url('/API/date-filter') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        date_form: date_form,
                        date_to: date_to,
                        _token: _token
                    },
                    success: function(data) {
                        if (chartDT) {
                            chartDT.series[0].update({
                                data: data
                            });
                        }
                    }
                })
            });

            $('.branchHotel_Confort').change(function() {
                var branchHotel_Confort = $(this).val();
                var _token = $('input[name= "_token"]').val();
                $.ajax({
                    url: "{{ url('/API/branchHotel_Confort') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        branchHotel_Confort: branchHotel_Confort,
                        _token: _token
                    },
                    success: function(data) {
                        var HotelComfort = document.getElementById('HotelComfort');
                        $.each(data, function(key, index) {
                            HotelComfort.innerHTML +=
                                `<li style="list-style-type: none;">
                                    <input type="checkbox" name="TienNghi[]" value="${index.id}">
                                    <span>${index.name}</span>
                                </li>`;
                        })
                    }
                })
            });

            // $('#btn-promo').click(function() {

            //     var promoDetails = $('#promoDetails').val();
            //     var idKindRoom = $('#idKindRoom').val();
            //     var idHotel = $('#idHotel').val();
            //     var _token = $('input[name= "_token"]').val();
            //     $.ajax({
            //         url: "{{ url('/API/ApplyPromo') }}",
            //         method: "POST",
            //         dataType: "JSON",
            //         data: {
            //             promoDetails: promoDetails,
            //             idKindRoom: idKindRoom,
            //             idHotel: idHotel,
            //             _token: _token
            //         },
            //         success: function(data) {

            //             console.log(dt);

            //         }
            //     })
            // });
        });
    </script>
    @yield('css')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">

                            <a href="index.html">
                                {{ Auth::guard('custom')->user()->username }}
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">

                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        @if (Auth::guard('custom')->user()->level == 1)
                            @foreach ($menus as $m)
                                <li
                                    class="sidebar-item
                                @if (isset($m['items'])) has-sub @endif
                                ">
                                    <a href="{{ route($m['route']) }}" class='sidebar-link'>
                                        <i class="nav-icon fas {{ $m['icon'] }}"></i>
                                        <span>{{ $m['lable'] }}</span>
                                    </a>
                                    @if (isset($m['items']))
                                        <ul class="submenu ">
                                            @foreach ($m['items'] as $mi)
                                                <li class="submenu-item ">
                                                    <a href="{{ route($mi['route']) }}">{{ $mi['label'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>

                            @endforeach

                        @elseif(Auth::guard('custom')->user()->level == 0)
                            @foreach ($menuAdmin as $menuAD)
                                <li
                                    class="sidebar-item
                                    @if (isset($menuAD['items'])) has-sub  @endif
                                ">
                                    <a href="{{ route($menuAD['route']) }}" class='sidebar-link'>
                                        <i class="nav-icon fas {{ $menuAD['icon'] }}"></i>
                                        <span>{{ $menuAD['lable'] }}</span>
                                    </a>
                                    @if (isset($menuAD['items']))
                                        <ul class="submenu ">
                                            @foreach ($menuAD['items'] as $miAD)
                                                <li class="submenu-item ">
                                                    <a href="{{ route($miAD['route']) }}">{{ $miAD['label'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                        <li class="sidebar-item">
                            <a href="{{ route('logout') }}" class='sidebar-link'>
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                <span>Logout</span>
                            </a>

                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div id="main" >
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>@yield('title')</h3>
            </div>
            <div class="page-content" >
                <section class="row" >
                    {{-- main --}}
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @yield('main')
                </section>
            </div>


        </div>
    </div>
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,

        });
    </script>
    <script src="{{ url('public') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ url('public') }}/assets/js/bootstrap.bundle.min.js"></script>

    <script src="{{ url('public') }}/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="{{ url('public') }}/assets/js/pages/dashboard.js"></script>

    <script src="{{ url('public') }}/assets/js/mazer.js"></script>
    <script src="https://kit.fontawesome.com/224cad339f.js" crossorigin="anonymous"></script>
    @yield('js')
</body>

</html>
