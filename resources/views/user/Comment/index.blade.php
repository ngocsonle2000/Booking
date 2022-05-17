@extends('layouts.admin_2')
@section('title', 'Tất cả comment')
@section('main')
    <br>
    <div class="card-content ">
        <table class="table table-light mb-0">
            <tr>
                <th class="col-md-4">Tác giả</th>
                <th class="col-md-4">Bình luận</th>
                <th class="col-md-4">Trả lời bình luận</th>
            </tr>

            @foreach ($dataComment as $data)
                <tr>
                    @foreach ($data->User as $dataUser)
                        <td>
                            <div class="col-md-1" style="float: left">
                                <img src="{{ url('public/upload/user.png') }}" alt="" style="padding-top: 10%">&nbsp;
                            </div>
                            <div class="col-md-11" style="margin-left: 10%">
                                {{ $dataUser->username }} <br>
                                {{ $dataUser->email }}
                            </div>
                        </td>

                    @endforeach
                    <td>
                        <p><i>Đã bình luận vào {{ $data->updated_at }}</i></p>
                        <p> {{ $data->Comment }}</p>
                        <a href="#" data-toggle="modal" data-target=".evaluate-{{ $data->id }}">Trả lời</a>
                    </td>
                    <td>
                        @php
                            $reply = DB::table('comments')->where('parent_id', $data -> id)->get();
                        @endphp
                        @foreach ($reply as $dataReply )
                            <p><i>Đã trả lời vào {{ $dataReply-> updated_at }}</i></p>
                            <p>{{ $dataReply -> Comment }}</p>
                            <a href="#" data-toggle="modal" data-target=".reply-{{ $dataReply->id }}">Chỉnh sửa</a>
                            <div class="modal fade reply-{{ $dataReply->id }} " tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-admin" style="color: black">
                                    <div class="modal-content ">
                                        <div class="container">
                                            <br>
                                            <form action="{{ route('Comment.parent_update', $dataReply -> id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <p><b>Trả lời bình luận:</b></p>
                                                <textarea name="comment" class="form-control" id="" cols="10" rows="5" style="border-radius: 10px;">{{ $dataReply -> Comment }}</textarea><br>
                                                <button class="btn btn-primary" type="submit" style="margin-left: 87%">Chỉnh sửa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </td>
                </tr>
                {{-- Reply --}}
                <div class="modal fade evaluate-{{ $data->id }} " tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-admin" style="color: black">
                        <div class="modal-content ">
                            <div class="container">

                                <br>
                                @foreach ($data->Code as $dataBook)
                                    @foreach ($dataBook->Hotel as $dataHotel)
                                        <h4>{{ $dataHotel->name }}</h4>
                                    @endforeach <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Tên khách hàng: {{ $dataBook->NameCustom }}</p>
                                            <p>Mã đơn hàng: {{ $dataBook->CodeOrders }}</p>
                                            <p>Ngày nhận phòng: {{ $dataBook->NextDay }}</p>
                                            <p>Ngày trả phòng: {{ $dataBook->OutDay }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Loại phòng: {{ $dataBook->NameRoom }}</p>
                                            <p>Số khách: {{ $dataBook->Guests }}</p>
                                            <p>Tổng tiền: {{ $dataBook->CountPrice }}</p>
                                            <div>
                                                Số sao đánh giá:
                                                <span style="color: yellow">
                                                    @if ($data->Ratings == 5)
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @elseif ($data->Ratings == 4)
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @elseif ($data->Ratings == 3)
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @elseif ($data->Ratings == 2)
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @elseif ($data->Ratings == 1)
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                @endforeach
                                <form action="{{ route('Comment.parent', [$data->CodeOrders, $data->id]) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <p><b>Trả lời bình luận:</b></p>
                                    <textarea class="form-control" name="comment" cols="5" rows="5" style="border-radius: 10px;"></textarea><br>
                                    <button class="btn btn-primary" type="submit" style="margin-left: 90%">Trả lời</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Edit Reply --}}

            @endforeach

        </table>
    </div>
@stop
