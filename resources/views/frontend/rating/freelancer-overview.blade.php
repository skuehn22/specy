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
                    <h4>Hi There!</h4>

                    <p>
                        You’ve received this message because we heard you do freelance work.
                    </p>
                    <p>
                        At trustfy.io, we believe freelancers should own their own reputation- your reviews shouldn’t be tied to third-party websites or marketplaces. That’s why we’re developing an independent rating and review system that lets you showcase all that customer praise you’ve worked so hard for.
                    </p>
                    <p>
                        We’re building this for you, so tell us what you think!<br>
                        Send a short survey to a customer and help us test this out, you would make our day. Really.

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
                        <h4>Heads Up!</h4>
                        <p><strong>Your rating will not be published.</strong></p>
                        <p>
                            By clicking “Send,” the person you’re inviting will receive a message asking them to leave a review. They can award 1 to 5 stars and leave a comment.
                        </p>
                        <p>
                            We are beta testing this service and won’t be publishing any information provided- but please let us know what you think!
                        </p>
                        <p>
                            You will receive your customer's feedback as soon as they fill out the form.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section("js")
@stop