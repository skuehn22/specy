@extends('frontend.masters.master-trustfy')
@section('seo')
@stop
@section('css')

@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <div class="alert alert-info" role="alert">
                    <h3>Hello!</h3>

                    <p>
                        You got this message because you work freelance.
                        We at trustfy.io are working on an independent rating system where your ratings are no longer just on marketplaces.
                    </p>
                    <p>
                        It would help us a lot if you took 3 minutes to create a short review that we can send to your customer.
                    </p>
                </div>

                <form id="ratingForm" method="POST" action="/save-rating-template">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h3>Create a rating</h3>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="description">Short Description</label>
                                <textarea class="form-control" rows="4" id="description" name="description" placeholder="Example: Hello, Marc, here's John, your roofer. I repaired your roof last week and I would be happy if you could leave me a short evaluation here." required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="client-mail">E-Mail Client</label>
                            <input type="email" class="form-control" name="client-mail"  id="client-mail" placeholder="marc@client.com">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="freelancer-mail">Your E-Mail</label>
                            <input type="email" class="form-control" id="freelancer-mail" name="freelancer-mail" placeholder="john@doe.com">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info"id="saveReview">Send Review</button>
                                <div id="msg" class="form-group"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">

                        </div>
                    </div>

                </form>
            </div>
            <div class="col-md-6">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h4>Please note!</h4>
                        <p><strong>Your rating will not be published anywhere.</strong></p>
                        <p>
                            With the sending of the form, the person whose e-mail address has to be deposited receives a message with the information you have given. The customer can then award 1 to 5 stars and make a comment.
                        </p>
                        <p>
                            This data is only used for internal analysis by trustfy.io and will not be published under any circumstances.
                        </p>
                        <p>
                            You will get your customer's feedback directly as soon as he fills it out.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section("js")

@stop