@extends('layouts.admin_2')
@section('title', 'Tất cả chỗ ở')
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
        <table style="text-align: center;">
            <th>Tên Chỗ Ở</th>
            <th>Hình Ảnh</th>
            <th>Số Lượng Chổ Ở</th>
            <th></th>

            @foreach ($accommodations as $data)
                <tr>
                    <td>
                        <p>{!! $data->name !!}</p>
                    </td>
                    <td>
                        <img src="{{ url('public/upload') }}/{{ $data->image }}" class=""
                            style="width: 20%; border-radius: 10px" alt="">
                    </td>
                    <td>
                        @php
                            $countAccom = DB::table('hotels')
                                ->where('accommodation', $data->slug)
                                ->count();
                        @endphp
                        <p>{{ $countAccom }}</p>
                    </td>
                    <td>
                        <a href="{{ route('admin.accommodation.edit', $data->id) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.accommodation.destroy', $data->id) }}"
                            class="btn btn-sm btn-danger btndelete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@stop
