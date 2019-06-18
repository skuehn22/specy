@extends('frontend.masters.sign')

@section('seo')
    <title>trustfy.io - Error</title>
@stop


@section('content')
    <div class="col-md-offset-2 col-md-10" style="padding-top:25px; padding-bottom:25px;">

        @if(isset($content))
            <p style="padding-top:15px;"> {!! $content !!} </p>
        @endif

    </div>
@stop


@section("js")

    <script>

    </script>

@stop