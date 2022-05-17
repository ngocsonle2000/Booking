@extends('layouts.admin_2')
@section('title', ' Thêm Bài Viết')
@section('main')
<form action="{{ route('admin.banner.store') }}" method="post"  enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="my-input"> Hình banner </label>
                <input  class="form-control" type="file" name="file_upload"  >
                @error('image')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="my-input"> Nội dung </label>
        <textarea id="summernote" name="content"></textarea>
        @error('content')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>
    <button  class="btn btn-primary" type="submit">Thêm Banner</button>

</form>
@stop
@section('js')
<script src="{{url('public/ad')}}/dist/js/slug.js"></script>
@stop
