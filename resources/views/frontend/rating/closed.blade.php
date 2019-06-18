@extends('frontend.masters.master-trustfy')
@section('seo')
@stop
@section('css')
    <style>
        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

        fieldset, label { margin: 0; padding: 0; }
        h1 { font-size: 1.5em; margin: 10px; }

        /****** Style Star Rating Widget *****/

        .rating {
            border: none;
            float: left;
        }

        .rating > input { display: none; }
        .rating > label:before {
            margin: 5px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating > .half:before {
            content: "\f089";
            position: absolute;
        }

        .rating > label {
            color: #ddd;
            float: right;
        }

        /***** CSS Magic to Highlight Stars on Hover *****/

        .rating > input:checked ~ label, /* show gold star when clicked */
        .rating:not(:checked) > label:hover, /* hover current star */
        .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

        .rating > input:checked + label:hover, /* hover current star when changing rating */
        .rating > input:checked ~ label:hover,
        .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
        .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }
    </style>
@stop

@section('content')

    <div class="container">
        <div class="row" style="padding-bottom: 25px; padding-top: 35px;">
            @if(isset($msg))
                <div class="col-sm-12">
                <div class="alert alert-success">
                    {{ $msg }}
                </div>
                </div>
            @endif
            <div class="col-sm-12">
                <form id="ratingForm" method="POST" action="/store-rating">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">

                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </div>

@stop
@section("js")

@stop