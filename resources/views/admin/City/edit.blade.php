@extends('layouts.admin_2')
@section('title', ' Sửa thành phố')
@section('main')
<form action="{{ route('admin.city.update', $city -> id) }}" method="post"  enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="my-input"> Tên loại thành phố </label>
                <input  class="form-control" type="text" name="name" value="{{ $city -> name }}" >
                @error('name')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="my-input"> Hình đại diện </label>
        <input type="file" name="file_upload"   class="form-control"><br>
        <img src="{{ url('public/upload') }}/{{ $city -> image }}" alt="" style="width: 20%; border-radius: 10px">
        @error('file_upload')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for=""> Slug </label>
        <input type="text" name="slug" value="{{ $city -> slug }}" class="form-control">
    </div>
    <button  class="btn btn-primary" type="submit">Cập Nhập</button>

</form>
@stop
@section('js')
<script src="{{url('public/ad')}}/dist/js/slug.js"></script>
@stop
