@extends('layouts.index')
@section('title', 'Bài viết')
@section('main')
@foreach ($details as $data)
<div class="hero-wrap" style="background-image: url('{{ url('public/site') }}/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span>
                        <span>Blog</span>
                    </p>
                    <h1 class="mb-4 bread">Blog</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        <div class="row ">
            <div class="col-md-8 container">
                <h1>{{ $data->title }}</h1>
                <p>
                    @foreach ($data->Custom as $cus)
                    by <b>{{ $cus->username }}</b> -
                    @endforeach
                    @php
                    echo date_format($data->created_at, 'd-m-Y ');
                    @endphp
                </p>
                <div>
                    {!! $data->content !!}
                </div>
                <div>
                    <h2>Blog tương tư</h2>
                </div>
                <hr>
                <div class="">
                    @if (Auth::guard('custom')->check())
                    <div class="card">
                        <div class="mt-3 d-flex flex-row align-items-center p-3 form-color">
                            <img src="https://i.imgur.com/zQZSWrt.jpg" width="50" class="rounded-circle mr-2">
                            <form
                                action="{{ route('CommentBlog.post', ['idBlog' => $data->id, 'idUser' => Auth::guard('custom')->user()->id]) }}"
                                method="POST" style="width: 100%">
                                @csrf
                                <input type="text" class="form-control" placeholder="Enter your comment..."
                                    name="comment" style="display: block">
                            </form>
                        </div>
                        @foreach ($comment as $dataComment)
                        <div class="mt-2">
                            <div class="d-flex flex-row p-3">
                                <img src="https://i.imgur.com/zQZSWrt.jpg" width="40" height="40"
                                    class="rounded-circle mr-3">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-row align-items-center">
                                            <span class="mr-2">
                                            @foreach ($dataComment->customer as $nameCustomer)
                                            {{ $nameCustomer->username }}
                                            @endforeach
                                            </span>
                                        </div>
                                        <small>12h ago</small>
                                    </div>
                                    <p class="text-justify comment-text mb-0">{{ $dataComment->comment }}
                                    </p>
                                    <div class="d-flex flex-row user-feed">
                                        <span class="wish"><i
                                            class="fa fa-heartbeat mr-2"></i>24</span>
                                        <span class="ml-3"
                                            onclick="replyComment({{ $dataComment->id }})"><i
                                            class="fa fa-comments-o mr-2"></i>Reply</span>
                                    </div>
                                    @foreach ($commentBlog as $commentParent)
                                       @if ($commentParent->parent_id == $dataComment->id)
                                            <div class="d-flex flex-row p-3">
                                                <img src="https://i.imgur.com/zQZSWrt.jpg" width="40" height="40"
                                                    class="rounded-circle mr-3">
                                                <div class="w-100">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex flex-row align-items-center">
                                                            <span class="mr-2">
                                                            @foreach ($commentParent->customer as $nameCustomer)
                                                            {{ $nameCustomer->username }}
                                                            @endforeach
                                                            </span>
                                                        </div>
                                                        <small>12h ago</small>
                                                    </div>
                                                    <p class="text-justify comment-text mb-0">
                                                        {{ $commentParent->comment }}
                                                    </p>
                                                    <div class="d-flex flex-row user-feed">
                                                        <span class="wish"><i
                                                            class="fa fa-heartbeat mr-2"></i>24</span>
                                                        <span class="ml-3"
                                                            onclick="replyComment({{ $commentParent->id }})"><i
                                                            class="fa fa-comments-o mr-2"></i>Reply</span>
                                                    </div>
                                                </div>
                                                <div style="display: none" id="{{ $commentParent->id }}">
                                                    <div class=" d-flex   ">
                                                        <img src="https://i.imgur.com/zQZSWrt.jpg" width="50"
                                                            class="rounded-circle mr-2">
                                                        <form
                                                            action="{{ route('CommentBlog.post', [
                                                            'idBlog' => $data->id,
                                                            'idUser' => Auth::guard('custom')->user()->id,
                                                            'parent_id' => $commentParent->id,
                                                            ]) }}"
                                                            style="width: 100%" method="post">
                                                            @csrf
                                                            <input type="text" class="form-control" name="comment"
                                                                placeholde r="Enter your comment..."
                                                                style="display: block">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                       @endif
                                    @endforeach
                                    <div style="display: none" id="{{ $dataComment->id }}">
                                        <div class=" d-flex   ">
                                            <img src="https://i.imgur.com/zQZSWrt.jpg" width="50"
                                                class="rounded-circle mr-2">
                                            <form
                                                action="{{ route('CommentBlog.post', [
                                                'idBlog' => $data->id,
                                                'idUser' => Auth::guard('custom')->user()->id,
                                                'parent_id' => $dataComment->id,
                                                ]) }}"
                                                style="width: 100%" method="post">
                                                @csrf
                                                <input type="text" class="form-control" name="comment"
                                                    placeholde r="Enter your comment..."
                                                    style="display: block">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="card row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                            <p>Hãy đăng nhập để bình luận</p>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        {{--
                        <div class="mt-3 d-flex flex-row align-items-center p-3 form-color">
                            <img src="https://i.imgur.com/zQZSWrt.jpg" width="50" class="rounded-circle mr-2">
                            <input type="text" class="form-control" placeholder="Enter your comment...">
                        </div>
                        --}}
                        <div class="mt-2">
                            <div class="d-flex flex-row p-3">
                                <img src="https://i.imgur.com/zQZSWrt.jpg" width="40" height="40"
                                    class="rounded-circle mr-3">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-row align-items-center">
                                            <span class="mr-2">Brian selter</span>
                                            <small class="c-badge">Top Comment</small>
                                        </div>
                                        <small>12h ago</small>
                                    </div>
                                    <p class="text-justify comment-text mb-0">Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                        magna aliqua.
                                        Ut enim ad minim veniam
                                    </p>
                                    <div class="d-flex flex-row user-feed">
                                        <span class="wish"><i
                                            class="fa fa-heartbeat mr-2"></i>24</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                ok
            </div>
        </div>
    </div>
</section>
@endforeach
@stop
@section('js')
<script>
    function replyComment(id) {

        console.log(id);
        document.getElementById(id).style.display = "block";
    }
</script>
@stop
