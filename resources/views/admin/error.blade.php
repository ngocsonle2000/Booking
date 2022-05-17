@extends('layouts.admin_2')
@section('main')
    <?php
        $code = isset($code) ? $code : 404;
        $title = isset($title) ? $title : 'Not Found';
        $message = isset($message) ? $message : 'Page Not Found';
    ?>
    <div class="jumbotron">
        <h1 class="display-3">{{ $code }}, {{ $title }} </h1>
        <hr class="my-2">
        <p>{{ $message }}</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Learn more</a>
        </p>
    </div>
@stop
