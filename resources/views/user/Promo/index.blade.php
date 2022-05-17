@extends('layouts.admin_2')
@section('title', 'Tất cả mã giảm giá')
@section('main')
    <form action="" class="form">
        <div class="form-group" style="float: left">
            <input name="key" id="" class="form-control" placeholder="Search" aria-describedby="helpId">
        </div>
        <button type="submit" class="btn btn-primary me-1 mb-1" style="margin-left: 2%">
            <i class="fas fa-search"></i>
            submit
        </button>
    </form>
    <div class="table-responsive card">
        <table class="table table-hover mb-0">
            <thead>
                <th>Tên mã giảm giá</th>
                <th>Mã giảm giá</th>
                <th>Số lượng mã</th>
                <th>Điều kiện giảm giá</th>
                <th>Số giảm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th></th>
            </thead>
            @foreach ($dataPromo as $data)
                <tbody>
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->code }}</td>
                        <td>{{ $data->number }}</td>
                        @if ($data->condition_promo == 1)
                            <td>Giảm theo tiền</td>
                            <td>{{ $data->price }}$</td>
                        @else
                            <td>Giảm theo phần trăm</td>
                            <td>{{ $data->price }}%</td>
                        @endif
                        <td>{{ $data->start_day }}</td>
                        <td>{{ $data->end_day }}</td>
                        <td>
                            @if ($data->end_day >= $now)
                                <span class="badge bg-success">Đang kích hoạt</span>
                            @else
                                @php
                                    $id = $data->id;
                                    DB::update("update promo set Status = 1 where id = '$id'");
                                @endphp
                                <span class="badge bg-danger">Hết hạn</span>
                            @endif

                        </td>
                        <td>
                            <a href="{{ route('Promo.edit', $data->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="{{ route('Promo.destroy', $data->id) }}" class="btn btn-sm btn-danger btndelete">
                                <i class="fas fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                </tbody>
            @endforeach
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
