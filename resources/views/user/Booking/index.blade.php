@extends('layouts.admin_2')
@section('title', 'Tất cả đơn hàng')
@section('main')
    <br>
    <div class="card ">
        <table style="margin: 1%">
            <tr>
                <th class="col-md-3">Tìm kiếm theo mã</th>
                <th class="col-md-2">Theo chi nhánh</th>
                <th class="col-md-2">Ngày nhận phòng</th>
                <th class="col-md-2">Ngày trả phòng</th>
                <th class="col-md-1"></th>
            </tr>
            <tr>
                <td class="col-md-3">
                    <form action="" class="form-inline ">
                        <div class="form-group" style="float: left">
                            <input name="key" id="" class="form-control" placeholder="Search" aria-describedby="helpId">
                        </div>
                        <button type="submit" class="btn btn-primary" style="max-resolution: 5%;">
                            <i class="fas fa-search"></i>
                            submit
                        </button>
                    </form>
                </td>
                <td class="col-md-2">
                    <select  id="brand-filter" onchange="brandScript()"   class="form-control ">
                        <option value="">---Chọn chi nhánh---</option>
                        @foreach ($hotel as $dataHotel)
                            <option value="{{ $dataHotel->id }}" >{{ $dataHotel->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="col-md-2">
                    <input type="date" class="form-control" onchange="DateFrom()" id="DateFrom">
                </td>
                <td class="col-md-2">
                    <input type="date" class="form-control" onchange="DateTo()" id="dateTo" >
                </td>
                <td class="col-md-1 ">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".evaluate-pdf">Xuất PDF</button>
                </td>
            </tr>
            <div class="modal fade evaluate-pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-admin" style="color: black">
                    <div class="modal-content ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Từ ngày:</p>
                                    <input type="date" name="date-form" id="" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <p>Đến ngày:</p>
                                    <input type="date" name="date-to" id="" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <p>Chi nhánh:</p>
                                    <select name="" class="form-control " id="">
                                        @foreach ($hotel as $dataPDF)
                                            <option value="{{ $dataPDF->id }}">{{ $dataPDF->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </table>
    </div><br>

    <div class="card">
        <table class="table table-hover ">
            <thead>
                <th>Mã đơn hàng</th>
                <th>Tên Khách Sạn</th>
                {{-- <th>Loại Phòng</th> --}}
                <th>Ngày Nhận Phòng</th>
                <th>Ngày Trả Phòng</th>
                <th>Số Lượng Phòng</th>
                <th>Số Tiền</th>
                <th>Trạng Thái Thanh Toán</th>
                <th></th>
            </thead>

            <tbody id="tab-none">
                @foreach ($dataOrder as $dataBooking)
                    <tr>
                        <td>{{ $dataBooking->CodeOrders }}</td>

                        @foreach ($dataBooking->Hotel as $data_hotel)
                            <td> {{ $data_hotel->name }}</td>
                        @endforeach

                        <td>{{ $dataBooking->NextDay }}</td>
                        <td>{{ $dataBooking->OutDay }}</td>
                        <td>{{ $dataBooking->RoomQuantity }}</td>
                        <td>{{ $dataBooking->CountPrice }}$</td>
                        <td>
                            @if ($dataBooking->PaymentStatus == 1)
                                <span class="badge bg-danger">Chưa Thanh Toán</span>
                            @else
                                <span class="badge bg-success">Đã Thanh Toán</span>
                            @endif

                        </td>
                        <td>
                            <a data-toggle="modal" data-target="#exampleModalCenter_{{ $dataBooking->id }}"
                                class="btn btn-sm btn-success">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </a>
                            <a href="" class="btn btn-sm btn-danger btndelete">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModalCenter_{{ $dataBooking->id }}" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"> Thông tin đơn hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <p>Tên khách hàng: {{ $dataBooking->NameCustom }}</p>
                                    <p>Số điện thoại: {{ $dataBooking->Phone }}</p>
                                    <p>Mã đơn hàng: {{ $dataBooking->CodeOrders }}</p>
                                    @foreach ($dataBooking->KindRoom as $data)
                                        @foreach ($data->Hotel as $dataHotel)
                                            <p>Tên khách sạn: {{ $dataHotel->name }}</p>
                                        @endforeach
                                        <p> Loại phòng: {{ $data->name }}</p>
                                    @endforeach
                                    <p>Ngày nhận phòng: {{ $dataBooking->NextDay }}</p>
                                    <p>Ngày trả phòng: {{ $dataBooking->OutDay }}</p>
                                    <p>Số khách: {{ $dataBooking->Guests }}</p>
                                    <p>Số phòng: {{ $dataBooking->RoomQuantity }}</p>
                                    <p>Yêu cầu đặc biệt: {{ $dataBooking->Note }}</p>
                                    <p>Gía 1 phòng lúc đặt: {{ $dataBooking->PriceRoom }}$</p>
                                    <p>Gía đặt phòng: <span style="color: red">{{ $dataBooking->CountPrice }}$</span></p>
                                    @if ($dataBooking -> CodePromo)
                                        <p>Mã giảm giá đã áp dụng: {{ $dataBooking ->CodePromo }}</p>
                                        <p>Số tiền sau khi áp mã: <span style="color: red">{{ $dataBooking ->CountPromo }}$</span></p>
                                    @endif

                                </div>
                                {{-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>



    <form action="" method="POST" id="form-delete">
        @csrf @method('DELETE')
    </form>



@stop

@section('js')
    <script>
        function brandScript() {
            var brand = [];
            if(location.search == null){
                brand += '?brand_value=' + document.getElementById('brand-filter').value;
                window.location.href += brand;
            }else{
                brand += '?brand_value=' + document.getElementById('brand-filter').value;
                window.location.href = brand;
            }

        }
        function DateFrom() {

            var dateFrom = [];
            if(location.search == null){
                dateFrom += '?DateFrom=' + document.getElementById('DateFrom').value;
                window.location.href += dateFrom;
            }else{
                dateFrom += '?DateFrom=' + document.getElementById('DateFrom').value;
                window.location.href = dateFrom;
            }

        }

        function DateTo() {
            var dateTo = [];
            if(location.search == null){
                dateTo += '?DateTo=' + document.getElementById('dateTo').value;
                window.location.href += dateTo;
            }else{
                dateTo += '?DateTo=' + document.getElementById('dateTo').value;
                window.location.href = dateTo;
            }

        }

        $('.btndelete').click(function(ev) {
            ev.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-delete').attr('action', _href);
            if (confirm('Bạn có muốn xóa nó không')) {
                $('form#form-delete').submit();
            }
        })
        DateFrom
    </script>
@stop
