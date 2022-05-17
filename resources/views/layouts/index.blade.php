<!DOCTYPE html>
<html lang="en">

<head>
    <title>Deluxe - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <link rel="stylesheet" href="{{ url('public/home') }}/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('public/home') }}/css/animate.css">

    <link rel="stylesheet" href="{{ url('public/home') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ url('public/home') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ url('public/home') }}/css/magnific-popup.css">

    <link rel="stylesheet" href="{{ url('public/home') }}/css/aos.css">

    <link rel="stylesheet" href="{{ url('public/home') }}/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ url('public/home') }}/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ url('public/home') }}/css/jquery.timepicker.css">
    <link rel="stylesheet" href=" {{ url('public/ad') }}/plugins/fontawesome-free/css/all.min.css" />

    <link rel="stylesheet" href="{{ url('public/home') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ url('public/home') }}/css/icomoon.css">
    <link rel="stylesheet" href="{{ url('public/home') }}/css/style.css">
    <style>
        body{
            background-color: white
        }
        .card_deatils {
            width: 100%;
            height: 100%;
            background-color: white !important;
            border: none !important;
            border-radius: 0px !important;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px !important
        }

        .card_deatils:hover {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important
        }

        @keyframes fadeInBottom {
            from {
                opacity: 0;
                transform: translateY(100%)
            }

            to {
                opacity: 1
            }
        }

        .cssanimation2 {
            animation-duration: 2s;
            animation-fill-mode: both
        }

        .fadeInBottom2 {
            animation-name: fadeInBottom
        }

        .box {
            width: 70%;
            height: auto;
            background-color: #f5f5f5;
            padding: 20px;
            position: relative;
            border-radius: 10px;
            float: left;
        }

        .box.arrow-top {
            margin-top: 40px;
        }

        .box.arrow-top:after {
            content: " ";
            position: absolute;
            right: 30px;
            top: -15px;
            border-top: none;
            border-right: 15px solid transparent;
            border-left: 15px solid transparent;
            border-bottom: 15px solid #f5f5f5;
        }

        .TienNghi {
            -moz-column-count: 3;
            -moz-column-gap: 30px;
            -webkit-column-count: 3;
            -webkit-column-gap: 30px;
            column-count: ;
            column-gap: 30px;
        }

        .grayscale:hover {
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
        }

        .section-card {
            position: relative;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .card-acc img {
            width: 100%;
            height: 250px;
            border-radius: 18px;
        }

        .swiper-pagination {
            position: absolute;
        }

        .swiper-pagination-bullet {
            height: 7px;
            width: 26px;
            border-radius: 25px;
            background: #7d2ae8;
        }

        .swiper-button-next {
            opacity: 0.7;
            color: #7d2ae8;
            transition: all 0.3s ease;
            margin-right: 18%;
        }

        .swiper-button-prev {
            opacity: 0.7;
            color: #7d2ae8;
            transition: all 0.3s ease;
            margin-left: 18%;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            opacity: 1;
            color: #7d2ae8;
        }


        .similar:hover {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important
        }

        .similar {
            -webkit-transition: all 100ms ease-in-out;
            transition: all 100ms ease-in-out;
            border: none;
            -webkit-box-shadow: 0 1px 7px rgba(0, 0, 0, 0.05);
            box-shadow: 0 1px 7px rgba(0, 0, 0, 0.05);
        }

        .card_booking:hover {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important
        }






    </style>
    <script>
        $(document).ready(function() {
            $('#btn-promo').click(function() {

                var promoDetails = $('#promoDetails').val();
                var idKindRoom = $('#idKindRoom').val();
                var idHotel = $('#idHotel').val();
                var count = $('#count').val();
                var _token = $('input[name= "_token"]').val();
                $.ajax({
                    url: "{{ url('/API/ApplyPromo') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        promoDetails: promoDetails,
                        idKindRoom: idKindRoom,
                        idHotel: idHotel,
                        count: count,
                        _token: _token
                    },
                    success: function(data) {
                        var promoDiv = document.getElementById('promoDiv');

                        $.each(data, function(key, dt) {
                            if (dt.alert) {
                                promoDiv.innerHTML =
                                    ` <p style="color: #e03a3a"> <i class="fa fa-times-circle-o" aria-hidden="true"></i> ${dt.alert} </p>`;

                            } else {
                                if (dt.condition_promo == 0) {
                                    var price = document.getElementById('priceCount')
                                        .style.display = 'none';
                                    var priceCount = dt.count * ((100 - dt.price) /
                                        100);
                                    promoDiv.innerHTML =
                                        '<p style="color: #32a923"> <i class="fa fa-check-circle-o" aria-hidden="true"></i> Sử dụng mã khuyến mãi thành công</p>' +
                                        ` <p style="color: #32a923"> <i class="fa fa-check-circle-o" aria-hidden="true"></i> Bạn được giảm: ${dt.price}%</p>` +
                                        ` <p style="margin-left: 55%; margin-top: 20%; color: red; font-size: 20px">
                                            <input style= "display: none" value="${priceCount}" name="CountPromo"></input>
                                            <b>
                                                ${priceCount} $/{{ request()->get('numDay') }} đêm
                                            </b>
                                        </p>`;
                                } else {
                                    var price = document.getElementById('priceCount')
                                        .style.display = 'none';
                                    var priceCount = dt.count - dt.price;
                                    promoDiv.innerHTML =
                                        '<p style="color: #32a923"> <i class="fa fa-check-circle-o" aria-hidden="true"></i> Sử dụng mã khuyến mãi thành công</p>' +
                                        ` <p style="color: #32a923"> <i class="fa fa-check-circle-o" aria-hidden="true"></i> Bạn được giảm: ${dt.price}$</p>` +
                                        ` <p style="margin-left: 55%; margin-top: 20%; color: red; font-size: 20px">
                                            <input style= "display: none" value="${priceCount}" name="CountPromo"></input>
                                            <b>
                                                ${priceCount} $/{{ request()->get('numDay') }} đêm
                                            </b>
                                        </p>`;
                                }
                            }
                        })

                    }
                })
            });
        });
    </script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Deluxe</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="{{ route('home.index') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('home.search') }}" class="nav-link">Rooms</a>
                    </li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="{{ route('home.post') }}" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                    @if (Auth::guard('custom')->check())
                        <li class="nav-item">
                            <a href="{{ route('Dasboard.index') }}" class="nav-link">Quản lý</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home.order') }}" class="nav-link">Đơn đặt chỗ</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                {{ Auth::guard('custom')->user()->username }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Đăng
                                Nhập</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- END nav -->
    @yield('main')

    <section class="instagram">
        <div class="container-fluid">
            <div class="row no-gutters justify-content-center pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2><span>Instagram</span></h2>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ url('public/home') }}/images/insta-1.jpg" class="insta-img image-popup"
                        style="background-image: url({{ url('public/home') }}/images/insta-1.jpg);">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ url('public/home') }}/images/insta-2.jpg" class="insta-img image-popup"
                        style="background-image: url({{ url('public/home') }}/images/insta-2.jpg);">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ url('public/home') }}/images/insta-3.jpg" class="insta-img image-popup"
                        style="background-image: url({{ url('public/home') }}/images/insta-3.jpg);">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ url('public/home') }}/images/insta-4.jpg" class="insta-img image-popup"
                        style="background-image: url({{ url('public/home') }}/images/insta-4.jpg);">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ url('public/home') }}/images/insta-5.jpg" class="insta-img image-popup"
                        style="background-image: url({{ url('public/home') }}/images/insta-5.jpg);">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Deluxe Hotel</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Useful Links</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Blog</a></li>
                            <li><a href="#" class="py-2 d-block">Rooms</a></li>
                            <li><a href="#" class="py-2 d-block">Amenities</a></li>
                            <li><a href="#" class="py-2 d-block">Gift Card</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Privacy</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Career</a></li>
                            <li><a href="#" class="py-2 d-block">About Us</a></li>
                            <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                            <li><a href="#" class="py-2 d-block">Services</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St.
                                        Mountain View, San Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392
                                            3929 210</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text">info@yourdomain.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i
                            class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="{{ url('public/home') }}/js/jquery.min.js"></script>
    <script src="{{ url('public/home') }}/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="{{ url('public/home') }}/js/popper.min.js"></script>
    <script src="{{ url('public/home') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('public/home') }}/js/jquery.easing.1.3.js"></script>
    <script src="{{ url('public/home') }}/js/jquery.waypoints.min.js"></script>
    <script src="{{ url('public/home') }}/js/jquery.stellar.min.js"></script>
    <script src="{{ url('public/home') }}/js/owl.carousel.min.js"></script>
    <script src="{{ url('public/home') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ url('public/home') }}/js/aos.js"></script>
    <script src="{{ url('public/home') }}/js/jquery.animateNumber.min.js"></script>
    <script src="{{ url('public/home') }}/js/bootstrap-datepicker.js"></script>
    <script src="{{ url('public/home') }}/js/jquery.timepicker.min.js"></script>
    <script src="{{ url('public/home') }}/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ url('public/home') }}/js/google-map.js"></script>
    <script src="{{ url('public/home') }}/js/main.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/224cad339f.js" crossorigin="anonymous"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            slidesPerGroup: 3,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

</body>

</html>
