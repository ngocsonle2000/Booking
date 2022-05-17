@extends('layouts.index')
@section('title', 'Bài viết')
@section('main')
@foreach ($details as $data )
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
            <div class="row ">
                <div class="col-md-8 container">

                        <h1>{{ $data->title }}</h1>
                        <p>
                            @foreach ($data -> Custom as $cus )
                                by <b>{{ $cus -> username }}</b> -
                            @endforeach
                            @php
                                echo date_format($data ->created_at,"d-m-Y ");
                            @endphp
                        </p>
                        <div>
                            {!! $data -> content !!}
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
