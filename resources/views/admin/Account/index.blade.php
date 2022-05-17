@extends('layouts.admin_2')
@section('title', 'Tất cả tài khoản')
@section('main')
    <div class="card">
        <div class="card-body">
            <form action="" class="form-inline">
                <div class="form-group">
                    <input name="key" id="" class="form-control" placeholder="Search" aria-describedby="helpId">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-left: 2%">
                    <i class="fas fa-search"></i>
                    submit
                </button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body ">
            <h3>Tài khoản khách hàng</h3>
            <table class="col-md-12">
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th></th>
                @foreach ($custom as $data )
                    <tr>
                        <td>{{ $data -> username }}</td>
                        <td>{{ $data -> email }}</td>
                        <td>{{ $data -> phone }}</td>
                        <td>{{ $data -> adrress }}</td>
                        <td>
                            @if ($data -> Status == 1)
                                <a href="{{ route('admin.Account.lock', [$data -> id, $data -> Status]) }}" onclick="return confirm('Bạn có chắc sẽ mở khóa tài khoản này không ')" class="btn btn-sm btn-danger">
                                    <i class="fa fa-lock" aria-hidden="true"></i>

                                </a>
                            @else
                                <a href="{{ route('admin.Account.lock', [$data -> id, $data -> Status]) }}" onclick="return confirm('Bạn có chắc sẽ khóa tài khoản này không')" class="btn btn-sm btn-success">
                                    <i class="fa fa-unlock" aria-hidden="true"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="card-body ">
            <h3>Tài khoản admin</h3>
            <table class="col-md-12">
                <th>Tên nhân viên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th></th>
                @foreach ($admin as $data_admin )
                    <tr>
                        <td>{{ $data_admin -> username }}</td>
                        <td>{{ $data_admin -> email }}</td>
                        <td>{{ $data_admin -> phone }}</td>
                        <td>{{ $data_admin -> adrress }}</td>
                        <td>
                            @if ($data_admin -> Status == 1)
                                <a href="{{ route('admin.Account.lock', [$data_admin -> id, $data_admin -> Status]) }}" onclick="return confirm('Bạn có chắc sẽ mở khóa tài khoản này không ')" class="btn btn-sm btn-danger">
                                    <i class="fa fa-lock" aria-hidden="true"></i>

                                </a>
                            @else
                                <a href="{{ route('admin.Account.lock', [$data_admin -> id, $data_admin -> Status]) }}" onclick="return confirm('Bạn có chắc sẽ khóa tài khoản này không')" class="btn btn-sm btn-success">
                                    <i class="fa fa-unlock" aria-hidden="true"></i>
                                </a>
                            @endif
                            <a href="{{ route('admin.Account.edit', $data_admin -> id) }}"  class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>


    </div>
@stop
