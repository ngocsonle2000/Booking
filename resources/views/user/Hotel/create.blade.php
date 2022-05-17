@extends('layouts.admin_2')
@section('title', 'Thêm Chi Nhánh')
@section('main')

<form action="{{ route('Hotel.store') }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-4">
            <label for="my-input">Tên Khách Sạn</label>
            <input id="name" class="form-control" type="text" name="name"  placeholder="Nhập tên..." >
            @error('name')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="my-input"> Thành Phố </label>
                <select name="city" id="" class="form-control">
                    <option value="">---Chọn thành phố---</option>
                    @foreach ($citys as $dataCity )
                        <option value="{{ $dataCity -> slug }}">{{ $dataCity ->name }}</option>
                    @endforeach
                </select>
                @error('city')
                    <small class="help-block">{{ $message }}</small>
                @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="my-input"> Image </label>
            <input  class="form-control" type="file" name="file_upload" >
            @error('file_upload')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="my-input">Số Phòng</label>
            <input id="my-input" class="form-control" type="text" name="RoomQuanity" placeholder="Nhập...">
            @error('RoomQuanity')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="my-input">Loại Hình Chổ Ở</label>
            <select name="accommodation" id="" class="form-control">
                <option value="">---Chọn loại hình---</option>
                @foreach ($accommodations as $dataAcc )
                    <option value="{{ $dataAcc -> slug }}">{{ $dataAcc -> name }}</option>
                @endforeach
            </select>
            @error('accommodation')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="my-input">Địa Chỉ</label>
            <input id="my-input" class="form-control" type="text" name="adrress" placeholder="Nhập..." >
            @error('adrress')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="my-input"> Chi Tiết Khách Sạn</label>
        <textarea id="summernote" name="content"></textarea>
        @error('content')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="my-input">Slug</label>
        <input id="slug" class="form-control"  type="text" name="slug"  placeholder="Nhập..." >
        @error('slug')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>
    <input type="text" hidden name="idUser" id="" value="{{  Auth::guard('custom')->user()->id }}">
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>
@stop
@section('js')
<script src="{{url('public/ad')}}/dist/js/slug.js"></script>
@stop
