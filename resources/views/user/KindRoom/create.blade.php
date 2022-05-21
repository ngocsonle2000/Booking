@extends('layouts.admin_2')
@section('title', 'Thêm Loại Phòng')
@section('main')

    <form action="{{ route('KindRoom.store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="my-input">Loại Phòng</label>
            <input id="name" class="form-control" type="text" name="name" placeholder="Nhập tên...">
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
                        <input id="my-input" class="form-control" type="text" name="quantity" placeholder="Nhập...">
                        @error('quantity')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </td>
                    <td class="col-md-3">
                        <input id="my-input" class="form-control" type="text" name="area" placeholder="Nhập...">
                        @error('quantity')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </td>
                    <td class="col-md-3">
                        <input id="my-input" class="form-control" type="text" name="capacity" placeholder="Nhập...">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-group">
            <table class="col-md-12">

                <th> <label for="my-input">Số Lượng Giường</label></th>
                <th> <label for="my-input">Gía Gốc</label></th>
                <th> <label for="my-input">Gía Giảm</label></th>
                <tr>
                    <td class="col-md-3">
                        <input id="my-input" class="form-control" type="text" name="bed" placeholder="Nhập...">
                    </td>
                    <td class="col-md-3">
                        <input id="my-input" class="form-control" type="text" name="price" placeholder="Nhập...">
                    </td>
                    <td class="col-md-3">
                        <input id="my-input" class="form-control" type="text" name="sale_price" placeholder="Nhập...">
                    </td>
                </tr>
            </table>

        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="my-input"> Hình đại diện </label>
                <input class="form-control" type="file" name="file_upload">
                @error('image')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="my-input"> Album hình </label>
                <input class="form-control" type="file" name="image_list[]" multiple>

            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="my-input">Chi nhánh</label>
                <select name="idHotel" class="form-control branchHotel_Confort" id="selectid">
                    <option type="text">----chọn một mục----</option>
                    @foreach ($hotel as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                @error('idHotel')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="my-input">Tiện Nghi</label>
                <ul class="TienNghi" id="HotelComfort">
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label for="my-input">Trạng Thái</label>
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="1" checked>
                    Publish
                </label>
                <label>
                    <input type="radio" name="status" value="0">
                    Private
                </label>
            </div>
            <div class="form-group">
                <label for="my-input">Slug</label>
                <input id="slug" class="form-control" type="text" name="slug" placeholder="Nhập...">
                @error('slug')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="my-input">Slug Hotel</label>
                <input id="slug_hotel" class="form-control" type="text" name="slug_hotel" placeholder="Nhập...">

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@stop
@section('js')
    <script src="{{ url('public/ad') }}/dist/js/slug.js"></script>
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
