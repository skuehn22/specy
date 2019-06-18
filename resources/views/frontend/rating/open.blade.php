@extends('frontend.masters.master-trustfy')
@section('seo')
@stop
@section('css')
    <style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    fieldset, label { margin: 0; padding: 0; }

    h1 { font-size: 1.5em; }

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
        <div class="row" style="padding-top:40px; padding-bottom:30px;">
            <div class="col-sm-6">
                <form id="ratingForm" method="POST" action="/store-rating" class="rating-form">
                    <div class="row">
                    <div class="col-md-12">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <h2>Create a review </h2>
                        <h4>How satisfied are you with the service provided? </h4>
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="rating" value="5" required /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                            <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                            <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                            <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                            <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                            <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                        </fieldset>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="usr">Title*</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="comment">Review*</label>
                                <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" id="saveReview">Save Review</button>
                                <div id="msg" class="form-group"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="session" name="session" value="{{$rating->session}}">

                </form>
            </div>
            <div class="col-sm-6">
                <div class="alert alert-info" role="alert">
                    <h3>Please Note!</h3>

                    <p>
                        Your message will not be published.
                    </p>
                    <p>
                        Only your contractor receives the evaluation.
                    </p>
                </div>
            </div>
        </div>
    </div>

@stop
@section("js")
@stop