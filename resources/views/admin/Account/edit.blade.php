@extends('layouts.admin_2')
@section('title', 'Thêm tài khoản mới')
@section('main')
    <form action="" method="POST" class="card col">
        @foreach ($dataAdmin as $data)
            @csrf
            <h3>Cấp quyền và sửa quyền</h3>
            <div class="form-group">
                <label for="my-input">Tên Nhân Viên</label>
                <input class="form-control" type="text" name="name" value="{{ $data->username }}" readonly
                    placeholder="Tên Nhân Viên">
                @error('name')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="my-input">Email</label>
                <input class="form-control" type="text" name="email" placeholder="Nhập Email" value="{{ $data->email }}" readonly>
                @error('email')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="my-input">Số điện thoại</label>
                <input class="form-control" type="text" value="{{ $data->phone }}" name="password" placeholder="" readonly>
                @error('postion')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="my-input">Quyền quản lý</label><br>
                <div class="container-fuild ">
                    @foreach ($roles as $dataRole)
                        @foreach ($dataRole -> Roles as $nameRole )
                            {{ $nameRole -> name }}
                            <table>
                                <tr>
                                    @php
                                        $list = json_decode($nameRole->permissions);
                                    @endphp
                                    @foreach ($list as $dataName )
                                        @foreach ($permission as $per )
                                            @if ($dataName == $per->route)
                                                <td class="col-md-3">
                                                    <input class="" type="checkbox" name="role[]"
                                                        placeholder="Nhập..." value="{{ $per->route }}">
                                                    {{ $per->name }}
                                                </td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tr>
                            </table>
                        @endforeach
                    @endforeach
                      {{-- @foreach ($roles as $data)
                        <label class="col"> {{ $data->name }}</label>

                        <table>
                            <tr>
                                @php
                                    $list = json_decode($data->permissions);
                                @endphp
                                @foreach ($list as $data_name)
                                    @foreach ($permission as $per)
                                        @if ($data_name == $per->route)
                                            <td class="col-md-3">
                                                <input class="" type="checkbox" name="role[]"
                                                    placeholder="Nhập..." value="{{ $per->route }}">
                                                {{ $per->name }}
                                            </td>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                        </table>
                    @endforeach --}}

                </div>
                @error('role')
                    <small class="help-block">{{ $message }}</small>
                @enderror
            </div>
        @endforeach
        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="margin-left: 95%">Thêm</button>
        </div>
    </form>

    {{-- <form action="{{ route('admin.Account.store') }}" method="POST">
    @csrf
<input type="text" name="idUser">
<input type="text" name="idRoles">
<button type="submit">thêm</button> --}}
    </form>
@stop
