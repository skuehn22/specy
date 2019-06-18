<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
<title>{{ trans('seo.title_home') }}</title>
<meta name="description" content="{{ trans('seo.desc_home') }}">
<meta name="keywords" content="{{ trans('seo.keywords_home') }}">
<link rel="canonical" href="{{ URL::current() }}" />
@include('frontend.masters.elements.meta')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
<link href="{{ asset('css/frontend/homepage.min.css') }}" rel="stylesheet">


@if (env('APP_ENV')=='live')
    @include('frontend.masters.elements.tracking')
@endif

</head>

<body id="page-top" class="landing-page landing-page1">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container pl-0">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <img src="{{ asset('img/trustfy-new-mixed.png') }}" style="max-width: 200px;" class="img-fluid logo-desktop" alt="Trustfy Freelancer Payment">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <!--<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#download">Create a review</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="#home">{{ trans('index.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">{{ trans('index.contact') }}</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<header class="masthead" id="home">
    <div class="container h-100">
        <div class="row h-150">

            <div class="col-lg-12 my-auto text-center" style="padding-top: 70px;">

                <h3>Understand exactly what your customer wants!</h3>
                <h4>Save time, money and effort.</h4>

                <video width="560" height="400" autoplay>
                    <source src="img/vid1.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>

            </div>





        </div>
    </div>
</header>

<div class="section section-demo" style="padding-top:45px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-muted">Our unique software <br>understands your customers exactly and will inquire <br>the requirements for them down to the last detail.</h2>
                <p class="homepage-txt text-center text-muted" style="margin-top:0px; padding-top: 14px; font-size: 19px;">
                    <i class="fas fa-check"></i> Our system has learned from countless projects.
                </p>
                <p class="homepage-txt text-center text-muted" style="margin-top:0px; padding-top: 14px; font-size: 19px;">
                    <i class="fas fa-check"></i> Our system is self-learning.
                </p>
                <p class="homepage-txt text-center text-muted" style="margin-top:0px; padding-top: 14px; font-size: 19px;">
                    <i class="fas fa-check"></i> Learn from past mistakes.
                </p>
                <p class="homepage-txt text-center text-muted" style="margin-top:0px; padding-top: 14px; font-size: 19px;">
                    <i class="fas fa-check"></i> The system adapts individually to customer requirements.
                </p>




                <hr>
            </div>
        </div>
    </div>
</div>










<section class="section section-demo freelancer" id="features" style="padding-bottom:10px;">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text-muted">{!! trans('index.advantages') !!}</h2>

            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 text-center" style="padding-bottom: 50px;">
                                    <i class="fas fa-file-invoice-dollar advantages-icon"></i> <br>
                                    <span class="advantages-txt">You will get a clear scope of work for the project</span>
                                </div>
                                <div class="col-md-3 text-center" style="padding-bottom: 50px;">
                                    <i class="fas fa-meteor advantages-icon"></i> <br>
                                    <span class="advantages-txt"> Save time and let out software do the initial work for you</span>
                                </div>
                                <div class="col-md-3 text-center" style="padding-bottom: 50px;">
                                    <i class="fas fa-money-bill-alt advantages-icon"></i><br>
                                    <span class="advantages-txt">Less dispute or changes during the project</span>

                                </div>
                                <div class="col-md-3 text-center" style="padding-bottom: 50px;">
                                    <i class="far fa-smile-wink advantages-icon"></i><br>
                                    <span class="advantages-txt">Your customer satisfaction will be much higer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="contact bg-primary" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto" style="text-align: center; ">
                <h3 class="text-muted">We run our free beta version soon with only 50 customers. <br> So sign up for it now!</h3>
                <div class="badges">

                    <form class="form-inline" method="POST" action="/newsletter-sign-up">
                        <div class="input-group" style="width: 100%;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="btn btn-lg" name="email-newsletter" id="email-newsletter" type="email" placeholder="{!! trans('index.your_mail') !!}" required>
                            <button class="btn btn-info btn-lg" type="submit">{!! trans('index.sign_up2') !!}</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>

<footer id="contact">
    <div class="container pt-3">
        <form id="ratingForm" method="POST" action="/send-message">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row" style="padding-bottom:25px;">
            <div class="offset-md-3 col-md-5">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h3>{!! trans('index.contact_form') !!}</h3>
                        <h5>{!! trans('index.contact1') !!}</h5>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="{!! trans('index.contactname') !!}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="email" name="email" placeholder="{!! trans('index.contactmail') !!}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" rows="4" id="message" name="message" placeholder="{!! trans('index.contactmsg') !!}" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <input class="btn btn-info" type="submit" value="{!! trans('index.send') !!}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

    </div>
</footer>

<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/homepage.min.js') }}"></script>
<script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'efdb2cb1-6f9b-48a2-ba23-add187956429', f: true }); done = true; } }; })();</script>
</body>

</html>
