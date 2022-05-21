@extends('layouts.admin_2')
@section('title', 'Sửa Tiện Nghi')
@section('main')

<form action="{{ route('Comfort.store') }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="my-input">Tên Tiện Nghi</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ $TienNghi -> name }}"  placeholder="Nhập tên..." >
            @error('name')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="my-input">Chi Nhánh</label><br>
            <ul class="TienNghi">
                <li style="list-style-type: none;">
                    <input type="checkbox" name="idHotel[]" value="0"> Tất cả chi nhánh
                </li>
                {{-- @foreach ($Hotel as $data)
                    <li style="list-style-type: none;">
                        <input type="checkbox" name="idHotel[]" value="{{ $data->id }}">
                        {{ $data->name }}
                    </li>
                @endforeach --}}
            </ul>
            @error('idHotel')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="my-input">Slug</label>
        <input id="slug" class="form-control"  type="text" name="slug"  placeholder="Nhập..." >
        @error('slug')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Thêm</button>
</form>
@stop
@section('js')
<script src="{{url('public/ad')}}/dist/js/slug.js"></script>
@stop
