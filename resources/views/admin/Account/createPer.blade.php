@extends('layouts.admin_2')
@section('title', 'Thêm tài khoản mới')
@section('main')
<br>
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('admin.Permission.store') }}" method="post" class="card">
                @csrf
                <h3>Đặt tên quyền</h3>
                <div class="form-group">
                    <label for="my-input">Tên Quyền</label>
                    <input class="form-control" type="text" name="name"  placeholder="Nhập..." >
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="my-input">Quyền quản lý</label><br>
                    @foreach ($arrRoute as $data )
                        <input class="" type="checkbox" name="route"  placeholder="Nhập..." value="{{ $data }}">
                        {{ $data }} <br>
                    @endforeach
                    @error('slug')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Đặt tên</button>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{ route('admin.Permission.store') }}" method="post" class="card">
                @csrf
                <h3>Đặt Tên Nhóm Quyền</h3>
                <div class="form-group">
                    <label for="my-input">Tên Nhóm Quyền</label>
                    <input class="form-control" type="text" name="name"  placeholder="Nhập..." >
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="my-input">Các Quyền</label><br>
                    @foreach ($permission as $data_role )
                        <input class="" type="checkbox" name="role[]"  placeholder="Nhập..." value="{{ $data_role -> route }}">
                        {{ $data_role -> name }} <br>
                    @endforeach
                    @error('slug')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Đặt tên</button>
            </form>
        </div>
    </div>
@stop
