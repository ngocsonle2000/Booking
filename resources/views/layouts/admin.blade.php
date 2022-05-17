<?php
$menus = config('menu');
$menuAdmin = config('menuAdmin');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{ url('public/ad') }}/plugins/fontawesome-free/css/all.min.css" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href=" {{ url('public/ad') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{ url('public/ad') }}/dist/css/adminlte.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
                            console.log(dt);
                        }
                    }
                })
            });

            // $('#btn-promo').click(function() {

            //     var promoDetails = $('#promoDetails').val();
            //     var idKindRoom   = $('#idKindRoom').val();
            //     var idHotel      = $('#idHotel').val();
            //     var _token       = $('input[name= "_token"]').val();
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
<style>
    .wrappertd {
        padding: 20px;
        background: #eaeaea;
        max-width: 400px;
        margin: 50px auto;
    }

    .demo-1 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .TienNghi {
        -moz-column-count: 3;
        -moz-column-gap: 20px;
        -webkit-column-count: 3;
        -webkit-column-gap: 20px;
        column-count: ;
        column-gap: 20px;
    }

</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">@yield('title')</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ route('logout') }}">
                        <i class="far fa-user-circle"></i>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src=" {{ url('public/ad') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image" />
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::guard('custom')->user()->username }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search" />
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::guard('custom')->user()->level == 1)
                            @foreach ($menus as $m)
                                <li class="nav-item">
                                    <a href="{{ route($m['route']) }}" class="nav-link">
                                        <i class="nav-icon fas {{ $m['icon'] }}"></i>
                                        <p>
                                            {{ $m['lable'] }} @if (isset($m['items']))
                                                <i class="right fas fa-angle-left"></i>
                                            @endif
                                        </p>
                                    </a>
                                    @if (isset($m['items']))
                                        <ul class="nav nav-treeview">
                                            @foreach ($m['items'] as $mi)
                                                <li class="nav-item">
                                                    <a href=" {{ route($mi['route']) }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>{{ $mi['label'] }}</p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @elseif(Auth::guard('custom')->user()->level == 0)
                            @foreach ($menuAdmin as $menuAD)
                                <li class="nav-item">
                                    <a href="{{ route($menuAD['route']) }}" class="nav-link">
                                        <i class="nav-icon {{ $menuAD['icon'] }}" aria-hidden="true"></i>
                                        <p>
                                            {{ $menuAD['lable'] }} @if (isset($menuAD['items']))
                                                <i class="right fas fa-angle-left"></i>
                                            @endif
                                        </p>
                                    </a>
                                    @if (isset($menuAD['items']))
                                        <ul class="nav nav-treeview">
                                            @foreach ($menuAD['items'] as $miAD)
                                                <li class="nav-item">
                                                    <a href=" {{ route($miAD['route']) }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>{{ $miAD['label'] }}</p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>
        <br />
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->

                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ Session::get('error') }}
                                </div>
                                @endif @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ Session::get('success') }}
                                    </div>
                            @endif
                                <script>
                                    $(".alert").alert();
                                </script>
                                {{-- Số phòng --}}

                                @yield('main')

                                <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,

        });
    </script>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src=" {{ url('public/ad') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ url('public/ad') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src=" {{ url('public/ad') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src=" {{ url('public/ad') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src=" {{ url('public/ad') }}/dist/js/demo.js"></script>
    <script src="https://kit.fontawesome.com/224cad339f.js" crossorigin="anonymous"></script>
    @yield('js')
</body>

</html>
