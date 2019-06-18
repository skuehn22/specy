@extends('frontend.masters.master-trustfy')

@section('seo')
    <title>Trustfy</title>
    <meta name="description" content="Here you will find the most frequently asked questions">
@endsection
@section('css')
    <style>
    </style>
@endsection

@section('content')
    <div class="container content-container">
        <br><br>
        <div class="row">
            <div class="col-md-12 content">
                <h3> {!! $msg !!}</h3>
            </div>
        </div>
        <br><br>
    </div>
@endsection
