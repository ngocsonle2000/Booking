@extends('layouts.admin_2')
@section('title', 'Sửa Chi Nhánh')
@section('main')

<form action="{{ route('Hotel.update', $Hotel->id) }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row">
        <div class="form-group col-md-4">
            <label for="my-input">Tên Khách Sạn</label>
            <input id="name" class="form-control" type="text" name="name"  placeholder="Nhập tên..." value="{{ $Hotel -> name }}">
            @error('name')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="my-input"> Thành Phố </label>
            <select name="city" id="" class="form-control">
                @foreach ($Hotel -> City as $data )
                    <option value="{{ $data -> slug }}">
                        {{ $data -> name }}
                    </option>
                @endforeach

                @foreach ($city as $dataCity )
                    <option value="{{ $dataCity -> slug }}">{{ $dataCity ->name }}</option>
                @endforeach
            </select>
            @error('image')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="my-input"> Image </label>
            <input  class="form-control" type="file" name="file_upload" >
            <img src="{{ url('public/upload')}}/{{ $Hotel -> img}}" width="30%">
            @error('image')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="my-input">Số Phòng</label>
            <input id="my-input" class="form-control" type="text" name="RoomQuanity" placeholder="Nhập..." value=" {{$Hotel -> RoomQuanity }}">
            @error('roomquanity')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="my-input">Loại hình chỗ ở</label>

                <select name="accommodation" class="form-control" id="selectid">
                    @foreach ($Hotel -> accommodations as $data )
                        <option value="{{ $data -> slug }}">{{ $data -> name }}</option>
                    @endforeach
                    @foreach ($accommodations as $dataAcc )
                        <option value="{{ $dataAcc -> slug }}">{{ $dataAcc -> name }}</option>
                    @endforeach
                </select>
                @error('roomquanity')
                    <small class="help-block">{{ $message }}</small>
                @enderror


        </div>
        <div class="form-group  col-md-4">
            <label for="my-input">Địa Chỉ</label>
            <input id="my-input" class="form-control" type="text" name="address" placeholder="Nhập..." value=" {{$Hotel -> adrress }}">
            @error('quantity')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="my-input"> Chi Tiết Khách Sạn</label>
        <textarea id="summernote" name="content">{!! $Hotel -> content !!}</textarea>
        @error('content')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="my-input">Slug</label>
        <input id="slug" class="form-control" value="{{ $Hotel -> slug }}" type="text" name="slug"  placeholder="Nhập...">
        @error('slug')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>


    <button type="submit" class="btn btn-primary">Cập nhập</button>
</form>
@stop
@section('js')
<script src="{{url('public/ad')}}/dist/js/slug.js"></script>
@stop
