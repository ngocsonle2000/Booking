@extends('layouts.admin_2')
@section('title', 'Tất cả phòng')
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
        <table class="table table-hover">
            <thead>
                <th>Tên Loại Phòng </th>
                <th>Số Lượng Phòng</th>
                <th>Tiện Nghi</th>
                <th>Sức chứa</th>
                <th>Diện Tích</th>
                <th>Chi Nhánh</th>
                <th>Trạng thái</th>
            </thead>
            <tbody>
                @foreach ($data_KindRoom as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>
                            @php
                                $TienNghi = explode('|', $data->TienNghi);
                            @endphp
                            @foreach ($TienNghi as $dataTienNghi)
                                @foreach ($data_TienNghi as $nameTienNghi )
                                    @if ($dataTienNghi == $nameTienNghi->id)
                                        {{ $nameTienNghi -> name }} <br>
                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td>{{ $data->capacity }}</td>
                        <td>{{ $data->area }}m<sup>2</sup></td>
                        <td>
                            @foreach ($data->Hotel as $data_hotel)
                                <option value="{{ $data_hotel->id }}">{{ $data_hotel->name }}</option>
                            @endforeach
                        </td>

                        <td>
                            @if ($data->status == 0)
                                <span class="badge bg-danger">Hết Phòng</span>
                            @else
                                <span class="badge bg-success">Còn Phòng</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('KindRoom.edit', $data->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="{{ route('KindRoom.destroy', $data->id) }}" class="btn btn-sm btn-danger btndelete">
                                <i class="fas fa-trash"></i>
                            </a>


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
        {{ $data_KindRoom-> appends(request()->all()) -> links() }}
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
