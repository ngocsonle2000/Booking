@extends('layouts.admin_2')
@section('title', 'Thêm mã giảm giá')
@section('main')
<br>
    <form action="{{ route('Promo.store') }}" class="card " method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container" style="margin: 2%">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tên mã giảm giá </label>
                    <input type="text" class="form-control" name="name" id="">
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="">Mã giảm giá</label>
                    <input type="text" class="form-control" name="code">
                    @error('code')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for=""> Điều kiện giảm giá</label>
                    <select name="condition" id="" class="form-control">
                        <option value="">Chọn điều kiện</option>
                        <option value="1">Giảm theo tiền</option>
                        <option value="0">Giảm theo phần trăm</option>
                    </select>
                    @error('condition')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Nhập số %  hoặc số tiền giảm</label>
                    <input type="text" name="price" class="form-control">
                    @error('price')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="">Ngày bắt đầu</label>
                    <input type="date" class="form-control" name="start_day" id="start_day">
                    @error('start_day')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="">Ngày kết thúc</label>
                    <input type="date" class="form-control" name="end_day" id="end_day">
                    @error('end_day')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Số lượng mã</label>
                    <input type="text" name="number" class="form-control">
                    @error('number')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="">Chọn chi nhánh</label>
                    <select name="HotelBrand" class="form-control HotelBrand" id="HotelBrand" >
                        <option value="">---Chọn chi nhánh---</option>
                        <option value="0">Tất cả chi nhánh</option>
                        @foreach ($dataHotel as $data)
                            <option value="{{ $data -> id }}">{{ $data -> name }}</option>
                        @endforeach
                    </select>
                    @error('number')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4" id="dataRoom">
                        <label for="">Chọn phòng</label>
                        <select name="HotelRoom" class="form-control " id="HotelRoom">
                            <option value="">---Chọn phòng---</option>
                        </select>
                </div>
            </div><br>
            <button class="btn btn-primary" type="submit" style="margin-left: 94%">Thêm</button>
        </div>
    </form>

@stop

@section('js')
    <script>
        $('.btndelete').click(function(ev) {
            ev.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-delete').attr('action', _href);
            if (confirm('Bạn có muốn xóa nó không')) {
                $('form#form-delete').submit();
            }
        })
        const start = document.getElementById("start_day");
        const dateOut = document.getElementById("end_day");
        start.addEventListener("input", myScript);
        const date = new Date();
        start.min = date.getFullYear() + '-0' + (date.getMonth() + 1) + '-' + date.getDate();

        function myScript() {
            dateOut.min = (start.value);
        }
    </script>

@stop
