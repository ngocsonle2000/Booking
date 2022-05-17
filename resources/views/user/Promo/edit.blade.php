@extends('layouts.admin_2')
@section('title', 'Sửa mã giảm giá')
@section('main')
    <br>
    <form action="{{ route('Promo.update', $Promo->id) }}" class="card " method="POST"
        enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="container" style="margin: 2%">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tên mã giảm giá </label>
                    <input type="text" class="form-control" name="name" id="" value="{{ $Promo->name }}">
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="">Mã giảm giá</label>
                    <input type="text" class="form-control" name="code" value="{{ $Promo->code }}">
                    @error('code')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for=""> Điều kiện giảm giá</label>
                    <select name="condition" id="" class="form-control">
                        @if ($Promo->condition_promo == 1)
                            <option value="1">Giảm theo tiền</option>
                            <option value="0">Giảm theo phần trăm</option>
                        @else
                            <option value="0">Giảm theo phần trăm</option>
                            <option value="1">Giảm theo tiền</option>
                        @endif

                    </select>
                    @error('condition')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Nhập số % hoặc số tiền giảm</label>
                    <input type="text" name="price" class="form-control"
                        @if ($Promo->condition_promo == 1) value="{{ $Promo->price }}$"
                        @else
                            value="{{ $Promo->price }}%" @endif>
                    @error('price')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="">Ngày bắt đầu</label>
                    <input type="date" class="form-control" name="start_day" id="start_day" value="{{ $Promo->start_day }}">
                    @error('start_day')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="">Ngày kết thúc</label>
                    <input type="date" class="form-control" name="end_day" id="end_day" value="{{ $Promo->end_day }}">
                    @error('end_day')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Số lượng mã</label>
                    <input type="text" name="number" class="form-control" value="{{ $Promo->number }}">
                    @error('number')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="">Chọn chi nhánh</label>
                    <select name="HotelBrand" class="form-control HotelBrand" id="HotelBrand">
                        @foreach ($Promo->Hotel as $dataHotelDB)
                            <option value="{{ $dataHotelDB->id }}">{{ $dataHotelDB->name }}</option>
                        @endforeach
                        <option value="0">Tất cả chi nhánh</option>
                        @foreach ($dataHotelID as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach

                    </select>
                    @error('number')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4" id="dataRoom">
                    <label for="">Chọn phòng</label>
                    <select name="HotelRoom" class="form-control " id="HotelRoom">
                        @foreach ($Promo->KindRoom as $dataKindRoom)
                            <option value="{{ $dataKindRoom->id }}">{{ $dataKindRoom->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div><br>
            <button class="btn btn-primary" type="submit" style="margin-left: 91%">Cập nhập</button>
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
    </script>
    <script>
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
