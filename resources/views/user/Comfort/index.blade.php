@extends('layouts.admin_2')
@section('title', 'Tất Cả Tiện Nghi')
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
                <th>Tên Tiện Nghi</th>
                <th>Chi nhánh</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($Comfort as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>
                            @if ($data->idHotel == 0)
                                Tất cả chi nhánh
                            @else
                                @php
                                    $Comfort = explode('|', $data->idHotel);
                                @endphp
                                @foreach ($data_Hotel as $nameHotel)
                                    @foreach ($Comfort as $nameComfort)
                                        @if ($nameHotel->id == $nameComfort)
                                            {{ $nameHotel->name }} <br>
                                        @else
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif

                        </td>
                        <td>
                            <a href="{{ route('Comfort.edit', $data->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('Comfort.destroy', $data->id) }}" class="btn btn-sm btn-danger btndelete">
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
