@extends('frontend.masters.master-trustfy')
@section('seo')
    <title>{!! trans('seo.title_about') !!}</title>
    <meta name="description" content="{!! trans('seo.desc_about') !!}">
    <meta name="keywords" content="{!! trans('seo.keywords_about') !!}">

@endsection
@section('seo')
    <title>Trustfy About Us</title>
    <meta name="description" content="Why we founded Trustfy and what drives us. Our inspiration to found Trustfy and why we get up in the morning.">
@endsection

@section('css')

@endsection

@section('content')
    <div class="container content-container" style="background-color: #fff; padding-bottom: 40px;">
        <br><br>
        <div class="row">
            <div class="col-xs-12 col-md-12 content">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <h1 style="padding-top: 40px;">{!! trans('index.about_us2') !!}</h1>
                        <p>&nbsp;</p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-8">

                        <p><i><strong>{!! trans('index.about1') !!}</strong></i></p>

                        <p><i><strong>{!! trans('index.about2') !!}</strong></i></p>
                        <p><i><strong>{!! trans('index.about3') !!}</strong></i></p>
                        <p><strong>Sebastian<br>{!! trans('index.about4') !!}</strong></p>
                    </div>
                  <div class="col-xs-12 col-md-4">
                      <img src="/img/sebastian.jpg" class="img-responsive rounded-circle" style="width:250px;" alt="Sebastian - Trustfy">
                  </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 content">
                <br><br>

                <p style="text-align: justify">{!! trans('index.about5') !!}</p>
                <p style="text-align: justify">
                    {!! trans('index.about6') !!}</p>
                <p style="text-align: justify">{!! trans('index.about7') !!}</p>
                <p style="text-align: justify">{!! trans('index.about8') !!}</p>
                <p style="text-align: justify">{!! trans('index.about9') !!}</p>

                <p style="text-align: justify">{!! trans('index.about10') !!}</p>

<p style="text-align: justify">{!! trans('index.about11') !!}</p>
<br><br><br><br>
            </div>
        </div>
    </div>
@endsection
