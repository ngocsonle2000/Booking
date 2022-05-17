@extends('layouts.admin_2')
@section('title', 'Sửa Thông Tin Phòng')
@section('main')

<form action="{{ route('KindRoom.update', $KindRoom->id) }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="form-group">
        <label for="my-input">Loại Phòng</label>
        <input id="name" class="form-control" type="text" name="name"  placeholder="Nhập tên..." value="{{ $KindRoom -> name }}">
        @error('name')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <table class="col-md-12">
            <th><label for="my-input">Số Lượng Phòng</label></th>
            <th><label for="my-input">Diện Tích Phòng</label></th>
            <th> <label for="my-input">Sức Chứa</label></th>
            <tr>
                <td class="col-md-6">
                    <input id="my-input" class="form-control" type="text" name="quantity" placeholder="Nhập..." value=" {{$KindRoom -> quantity }}">
                    @error('quantity')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </td>
                <td class="col-md-3">
                    <input id="my-input" class="form-control" type="text" name="area" placeholder="Nhập..." value=" {{$KindRoom -> area }}">
                    @error('quantity')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </td>
                <td class="col-md-3" >
                    <input id="my-input" class="form-control" type="text" name="capacity" placeholder="Nhập..." value=" {{$KindRoom -> capacity }}">
                </td>
            </tr>
        </table>
    </div>
    <div class="form-group">
       <table class="col-md-12">
           <th> <label for="my-input">Tiên Nghi</label></th>
           <th> <label for="my-input">Số Lượng Giường</label></th>
           <th> <label for="my-input">Gía Gốc</label></th>
           <th> <label for="my-input">Gía Giảm</label></th>
           <tr>
               <td class="col-md-3">
                    @foreach ($data_TienNghi as $dataTN)
                        <input type="checkbox" name="TienNghi[]"  value="{{ $dataTN -> name }}"
                            @php
                                $id = explode('|', $KindRoom -> TienNghi)
                            @endphp
                            @foreach ($id as $data_id )
                                @if ($data_id == $dataTN -> name)
                                    checked
                                @endif
                            @endforeach>
                        {{ $dataTN -> name }}
                    @endforeach
                    {{-- @error('quantity')
                        <small class="help-block">{{ $message }}</small>
                    @enderror --}}
               </td>
               <td class="col-md-3" >
                    <input id="my-input" class="form-control" type="text" name="bed" placeholder="Nhập..." value=" {{$KindRoom -> bed }}">
               </td>
               <td class="col-md-3">
                    <input id="my-input" class="form-control" type="text" name="price" placeholder="Nhập..." value=" {{$KindRoom -> price }}">
               </td>
               <td class="col-md-3">
                   <input id="my-input" class="form-control" type="text" name="sale_price" placeholder="Nhập..." value=" {{$KindRoom -> sale_price }}">
               </td>
           </tr>
       </table>

    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label for="my-input"> Hình đại diện </label>
            <input  class="form-control" type="file" name="file_upload" value="{{ $KindRoom -> image }}" >
            <img src="{{ url('public/upload')}}/{{ $KindRoom -> image}}" width="20%">
            @error('image')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="my-input"> Album hình </label>
            <input  class="form-control" type="file" name="image_list[]" multiple  value="{{ $KindRoom -> image_list }}">
            @php
                $list = explode('|', $KindRoom -> image_list)
            @endphp
            @foreach ($list as $image)
                <img src="{{ url('public/upload')}}/{{ $image}}" width="20%">
                @error('image')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            @endforeach

        </div>
    </div>
    <div class="form-group">
        <label for="my-input">Chi nhánh</label>
        <select name="idHotel" class="form-control" id="selectid">
            @foreach ($KindRoom -> Hotel  as $dataKR)
                <option value="{{ $dataKR -> id }}">{{ $dataKR -> name }}</option>
            @endforeach
            @foreach ($hotel as $data)
                <option value="{{ $data -> id }}">{{ $data -> name }}</option>
            @endforeach
        </select>
        @error('idHotel')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="my-input"> Chi tiết phòng</label>
        <textarea id="summernote" name="content">{{ $KindRoom -> content }}</textarea>
        @error('content')
            <small class="help-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="my-input">Trạng Thái</label>
        <div class="radio">
            @if ($KindRoom -> status ==1)
                <label>
                    <input type="radio" name="status" value="1" checked>
                    Publish
                </label>
                <label>
                    <input type="radio" name="status" value="0" >
                    Private
                </label>
            @else
                <label>
                    <input type="radio" name="status" value="1">
                    Publish
                </label>
                <label>
                    <input type="radio" name="status" value="0" checked>
                    Private
                </label>
            @endif
        </div>
        <div class="form-group">
            <label for="my-input">Slug</label>
            <input id="slug" class="form-control" type="text" name="slug"  placeholder="Nhập..." value="{{ $KindRoom->slug }}">
            @error('slug')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="my-input">Slug Hotel</label>
            <input id="slug_hotel" class="form-control" type="text" name="slug_hotel" placeholder="Nhập..." value="{{ $KindRoom -> slug_hotel }}">

        </div>
    </div>
    <button type="submit" class="btn btn-primary">Cập Nhập</button>
</form>
@stop
@section('js')
<script src="{{url('public/ad')}}/dist/js/slug.js"></script>
<script>
    $(document).ready(function() {
    $("select#selectid").change(function() {
        var title, slug;
        // lấy text từ thẻ input title
        title = $(this).children("option:selected").text();

        // đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();


        // đổi kí tự có dấu thành không dấu
        slug = slug.replace(/á|à|ạ|ả|à|ã|ă|ắ|ằ|ẳ|ã|ạ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ế|ề|ể|ẽ|ê|ẹ/gi, 'e');
        slug = slug.replace(/í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ố|ồ|ổ|ỗ|ộ|ớ|ờ|ở|ỡ|ơ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');

        // xóa các ký tự đặc biệt
        slug = slug.replace(
            /\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\<|\.|\>|\?|\/|\:|\;|\'|\"|\_/gi, '');

        slug = slug.replace(/ /gi, "-");

        slug = slug.replace(/\-\-\-\-\-/gi, "-");
        slug = slug.replace(/\-\-\-\-/gi, "-");
        slug = slug.replace(/\-\-\-/gi, "-");
        slug = slug.replace(/\-\-/gi, "-");

        slug = '@' + slug + '@';

        slug = slug.replace(/\@\-|\-\@|\@/gi, '');

        $('input#slug_hotel').val(slug);
    });
});
</script>
@stop
