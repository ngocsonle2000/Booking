@extends('layouts.admin_2')
@section('title', 'Tất cả thành phố')
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
        <table class="col-md-12">
            <th class="col-md-3" style="text-align: center">Tên thành phố</th>
            <th class="col-md-2" style="text-align: center">Số lượng chỗ ở</th>
            <th class="col-md-5" style="text-align: center">Hình ảnh</th>
            <th class="col-md-2" style="text-align: center"></th>

            @foreach ($nameCity as $data)
                <tr>
                    <td style="text-align: center;  ">{{ $data->name }}</td>
                    @php
                        $quantity = DB::table('hotels')->where('city', $data -> slug)->count();
                    @endphp
                    <td style="text-align: center;">{{ $quantity }}</td>
                    <td style="text-align: center">
                        <img src="{{ url('public/upload') }}/{{ $data->image }}" alt="" style="width: 50%; border-radius: 10px">
                    </td>
                    <td style="text-align: center">
                        <a href="{{ route('admin.city.edit', $data -> id) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@stop
