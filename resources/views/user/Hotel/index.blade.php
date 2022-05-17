@extends('layouts.admin_2')
@section('title', 'Tất Cả Chi Nhánh')
@section('main')
    <form action="" class="form">
        <div class="form-group" style="float: left">
            <input name="key" id="" class="form-control" placeholder="Search" aria-describedby="helpId">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-left: 2%">
            <i class="fas fa-search"></i>
            submit
        </button>
    </form>
    <div class="card">
        <table class="table table-hover mb-0">
            <thead>
                <th>ID</th>
                <th>Tên Khách Sạn</th>
                <th>Thành Phố</th>
                <th>Số Phòng</th>
                <th>Hình Đại Diện</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($hotel as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>
                            @foreach ($data->City as $dataCity)
                                {{ $dataCity->name }}
                            @endforeach
                        </td>
                        <td>{{ $data->RoomQuanity }}</td>
                        <td>
                            <img src="{{ url('public/upload') }}/{{ $data->img }}" alt="" width="100px">
                        </td>
                        <td>
                            <a href="{{ route('Hotel.edit', $data->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('Hotel.destroy', $data->id) }}" class="btn btn-sm btn-danger btndelete">
                                <i class="fas fa-trash"></i>
                            </a>
                            @if ($data->Status == 1)
                                <a href="" onclick="return confirm('Khách sạn đã hoạt động trở lại')"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa fa-lock" aria-hidden="true"></i>

                                </a>
                            @else
                                <a href="" onclick="return confirm('Bạn có chắc khách sạn này tạm đóng cửa')"
                                    class="btn btn-sm btn-success">
                                    <i class="fa fa-unlock" aria-hidden="true"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <form action="" method="POST" id="form-delete">
        @csrf @method('DELETE')
    </form>
    {{-- <div>
        {{ $data-> appends(request()->all()) -> links() }}

    </div> --}}

@stop

@section('js')
    <script>
        $('.btndelete').click(function(ev) {
            ev.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-delete').attr('action', _href);
            if (confirm('Bạn có muốn xóa nó không')) {
                $('form#form-delete').submit();
            }
        })
    </script>
@stop
