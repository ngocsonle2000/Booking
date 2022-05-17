@extends('layouts.admin_2')
@section('title', ' Thêm Loại Chỗ Ở')
@section('main')
<form action="{{ route('admin.accommodation.store') }}" method="post"  enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="my-input"> Tên loại chỗ ở </label>
                <input  id="name" class="form-control" type="text" name="name"  >
                @error('name')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="my-input"> Hình đại diện </label>
        <input type="file" name="file_upload"   class="form-control" >
        @error('file_upload')
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
    <button  class="btn btn-primary" type="submit">Thêm</button>

</form>
@stop
@section('js')
<script src="{{url('public/ad')}}/dist/js/slug.js"></script>
@stop
