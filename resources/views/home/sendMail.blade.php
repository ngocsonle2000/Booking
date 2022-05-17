<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận đặt phòng khách sạn</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="{{ url('public/site') }}/css/animate.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body style="background-color: #f6f7f9">
    <br>
    <div class="container" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); width: 50%; margin-left: 23%">

        <h1 style="text-align: center; color: #32a923;"> <i class="fa fa-check-circle" aria-hidden="true" ></i></h1>
        <h2 style="color: #32a923; text-align: center"> Xác nhận đơn đặt phòng thành công</h2>
        <p style="text-align: center">Thân gửi {{ request()->get('name') }}</p>
        <p style="text-align: center">
            Để tham khảo, mã đặt phòng của quý khách là 634440672.
            Để xem, hủy, hoặc sửa đổi đơn đặt phòng của quý khách,
            hãy sử dụng dịch vụ tự phục vụ dễ dàng của chúng tôi.
        </p>
    </div>
    <div class="container" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); width: 50%; margin-left: 23%">
        @foreach ($infoRoom as $data )
            <h2>{{ $data -> name }}</h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ url('public/upload')}}/{{ $data -> image }}" class="" alt="" width="100%">
                </div>
                <div class="col-md-6">
                    <table class="row">
                        <th class="col-md-6">Ngày Nhận Phòng</th>
                        <th class="col-md-6">Ngày Trả Phòng</th>
                        <tr>
                            <td  class="col-md-3">{{ request()->get('checkin') }}</td>
                            <td  class="col-md-3">{{ request()->get('checkout') }}</td>
                        </tr>
                    </table>

                </div>
            </div><br>
            <div>
                <h4>Thông tin phòng</h4>
                <table class="table table-borderless">
                    <th></th>
                    <th></th>
                    <tr>
                        <td>Đặt Phòng</td>
                        <td>{{ request()->get('ceill') }} phòng, {{ request()->get('numDay') }} đêm</td>
                    </tr>
                    <tr>
                        <td>Loại Phòng</td>
                        <td>Phòng {{ $data -> name }}</td>
                    </tr>
                    <tr>
                        <td>Số Người Ở</td>
                        <td> {{ request()->get('guests') }}</td>
                    </tr>
                    <tr>
                        <td>Yêu cầu đặc biệt</td>
                        <td> {{ request()->get('guests') }}</td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
    <div class="container" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); width: 50%; margin-left: 23%">
        <h4>Đơn đặt phòng của bạn đã được xác nhận</h4>
        <table class="table table-borderless">
            <th></th>
            <th></th>
            <tr>
                <td>{{ request()->get('ceill') }} phòng, {{ request()->get('numDay') }} đêm</td>
                <td>{{ request()->get('count') }}$</td>
            </tr>
            <tr>
                <td>Mã giảm giá đã áp dụng</td>
                <td><b>{{ request()->get('count') }}$</b></td>
            </tr>
            <tr>
                <td>Tổng Tiền</td>
                <td><b>{{ request()->get('count') }}$</b></td>
            </tr>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
