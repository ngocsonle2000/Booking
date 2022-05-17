@extends('layouts.admin_2')
@section('title', ' Thêm Bài Viết')
@section('main')
<form action="{{ route('Post.store') }}" method="post"  enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="my-input"> Tiêu đề </label>
                <input id="name" class="form-control" type="text" name="title"  placeholder="Tiêu đề bài viết">
                @error('title')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="my-input"> Hình đại diện </label>
                <input  class="form-control" type="file" name="image"  >
                @error('image')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <textarea id="summernote" name="content"></textarea>
        @error('content')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="my-input">Slug</label>
        <input id="slug" class="form-control" type="text" name="slug"  placeholder="Nhập..." >
        @error('slug')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>
    <button  class="btn btn-primary" type="submit">Đăng bài viết</button>

</form>
@stop
@section('js')
<script src="{{url('public/ad')}}/dist/js/slug.js"></script>
@stop
