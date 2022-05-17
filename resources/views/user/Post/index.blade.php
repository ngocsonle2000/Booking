@extends('layouts.admin_2')
@section('title', ' Thêm Bài Viết')
@section('main')
    <form action="" class="form-inline">
        <div class="form-group">
            <input name="key" id="" class="form-control" placeholder="Search" aria-describedby="helpId">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-left: 2%">
            <i class="fas fa-search"></i>
            submit
        </button>
    </form>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <th>Tên Bài Viết </th>
                <th>Hình Ảnh</th>
                <th>Thời Gian</th>
                <th>Nội Dung</th>
                <th>Trạng thái</th>
            </thead>
            <tbody>
                @foreach ($post as $data)
                    <tr>
                        <td class="col-md-3">{{ $data->title }}</td>
                        <td class="col-md-3">
                            <img src="{{ url('public/upload') }}/{{ $data->image }}" alt="" style="width: 50%">
                        </td>
                        <td>
                            @php
                                echo date_format($data->created_at, 'd-m-Y  ');
                            @endphp
                        </td>
                        <td class="col-md-3">
                            <p> {!! Str::limit($data->content, 500, '....') !!}</p>

                        </td>
                        <td>
                            <a href="{{ route('Post.edit', $data->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('Post.destroy', $data->id) }}" class="btn btn-sm btn-danger btndelete">
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
    <hr>
@stop
