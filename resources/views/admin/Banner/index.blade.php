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
        <table>
            <th>Hình Banner</th>
            <th>Tiêu Đề</th>
            <th>Trạng Thái</th>
            <tr >
                @foreach ($dataBanner as $data)
                    <td>
                        <img src="{{ url('public/upload') }}/{{ $data -> image }}" class="" style="width: 40%" alt="">
                    </td>
                    <td>
                        <p>{!! $data -> content !!}</p>
                    </td>
                    <td >
                        <a href="{{ route('admin.banner.edit',$data->id) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.banner.destroy',$data->id) }}" class="btn btn-sm btn-danger btndelete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                @endforeach
            </tr>
        </table>
    </div>
@stop
