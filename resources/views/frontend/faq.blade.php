@extends('frontend.masters.master-trustfy')

@section('seo')
    <title>{!! trans('seo.title_faq') !!}</title>
    <meta name="description" content="{!! trans('seo.desc_faq') !!}">
    <meta name="keywords" content="{!! trans('seo.keywords_faq') !!}">

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
                <h1>{!! trans('index.faq') !!}</h1>
                {!! trans('index.faq1') !!}
            </div>
        </div>
    </div>
@endsection
