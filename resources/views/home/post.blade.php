@extends('layouts.index')
@section('title', 'Khách Sạn')
@section('main')
<div class="hero-wrap" style="background-image: url('{{ url('public/site') }}/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Blog</span></p>
                    <h1 class="mb-4 bread">Blog</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        <div class="row d-flex">
            @foreach ($data_post as $data)
                <div class="col-md-3 d-flex ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        <a href="blog-single.html" class="block-20" style="background-image: url('{{ url('public/upload') }}/{{ $data -> image }}');">
                        </a>
                        <a href="{{ route('home.post_details',$data->slug) }}">
                            <div class="text mt-3 d-block">
                                <h3 class="heading mt-3">{{ $data->title }}</a></h3>
                                <div class="meta mb-3">
                                    <div>
                                        @php
                                            echo date_format($data ->created_at,"d-m-Y  ");
                                        @endphp
                                    </div>
                                    <div>
                                        @foreach ($data -> Custom as $cus )
                                            {{ $cus -> username }}
                                        @endforeach
                                    </div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>


                        <li> {{ $data_post->links() }}</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
