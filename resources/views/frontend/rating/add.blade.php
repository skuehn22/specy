@extends('frontend.masters.master-trustfy')
@section('seo')
@stop
@section('css')

@stop

@section('content')

    <div class="container" style="padding-top:25px; padding-bottom:25px;">
        <div class="row">
            @if(session()->has('message'))
                <div class="col-sm-12">
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                </div>
            @endif
            @if(isset($msg))
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        {{ $msg }}
                    </div>
                </div>
            @endif<div class="col-md-6">

                    <form id="ratingForm" method="POST" action="/save-rating-template">
                        <p>

                        <div class="col-md-12 rating-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <h3>Create another review</h3>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="client-mail">E-Mail of your Client*</label>
                                    <input type="email" class="form-control" name="client-mail"  id="client-mail" placeholder="marc@client.com" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="freelancer-mail">Name of your Client</label>
                                    <input type="text" class="form-control" id="name-client" name="name-client" placeholder="Marc">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="name">Your Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </p>
                        <p>
                        <div class="col-md-12 rating-form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <h3>Tell us something about the project</h3>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="name">Project Name</label>
                                        <input type="text" class="form-control" id="project-name" name="project-name" placeholder="Website created" required>
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
                        </div>
                        </p>
                        <div class="col-md-12 rating-form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <h3>Secure your account</h3>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="freelancer-mail">Your E-Mail</label>
                                    <input type="email" class="form-control" id="freelancer-mail" name="freelancer-mail" placeholder="john@doe.com" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="client-mail">Password</label>
                                    <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    *With this data you can access your collected reviews
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
                        </div>

                    </form>
            </div>
            <div class="col-md-6">
                <div class="col-sm-12">
                    <div class="alert alert-warning" role="alert" style="margin-top: 15px;">
                        <form class="form-inline" method="POST" action="/newsletter-sign-up">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p>If you would like to be informed in the future how our product will continue, register here for the newsletter:</p>
                            <label for="freelancer-mail">E-Mail&nbsp;&nbsp; </label>
                            <input type="email" class="form-control" id="email-newsletter" name="email-newsletter" placeholder="john@doe.com">&nbsp;&nbsp;
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section("js")

@stop