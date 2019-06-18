<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @yield('seo')
    <link rel="canonical" href="{{ URL::current() }}" />
    @include('frontend.masters.elements.meta')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
    <link href="{{ asset('css/frontend/homepage.min.css') }}" rel="stylesheet">




    @if (env('APP_ENV')=='live')
        @include('frontend.masters.elements.tracking')
    @endif


    <style>

        h2{
            font-size: 20px;
        }

        h3{
            font-size: 18px;
            font-weight: 600;
        }

        p{
            font-size: 16px;
        }

        body{
            padding-bottom: 0px;
            color: #16150f;
        }

        header.masthead {
            position: relative;
            width: 100%;
            padding-top: 90px;
            padding-bottom: 100px;
            color: #16150f;
            height: initial;
        }

        footer {
            text-align: center;
            color: rgba(255, 255, 255, 0.3);
            background-color: #222222;
            position: absolute;
            right: 0;
            bottom: -80px;
            left: 0;
        }




        .content{
            padding-left: 65px;
            padding-right: 110px;
            padding-top: 85px;

        }


        @media only screen and (max-width: 600px) {

            .content{
                padding-left: 0px;
                padding-right: 0px;
                padding-top: 0px;

            }

            footer {
                text-align: center;
                color: rgba(255, 255, 255, 0.3);
                background-color: #222222;
                position: absolute;
                right: 0;
                bottom: -190px;
                left: 0;
            }

        }

        #mainNav {
            border-color: #19A3B8!important;
            background-color: #19A3B8!important;

        }

        #mainNav.navbar-shrink {
            border-color: rgba(34, 34, 34, 0.1);
            background-color: #19A3B8!important;
            opacity: 0.8;
        }

        #mainNav.navbar-shrink .navbar-brand {
            color: #222222;
        }


    </style>

    @yield('css')


</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/">
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
                    <a class="nav-link" href="/{{$blade["locale"]}}/{{ trans('index.about_url') }}">{{ trans('index.about_us') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">{{ trans('index.contact') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/{{$blade["locale"]}}/faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/{{$blade["locale"]}}/login">{{ trans('index.sign_in') }}</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="/beta-register">Sign up for free</a>
                </li>
                -->
            </ul>
        </div>
    </div>
</nav>

<header class="" id="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>
</header>




<footer id="contact">
    <div class="container pt-3">
        <form id="ratingForm" method="POST" action="/send-message">
            <!--
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row" style="padding-bottom:25px;">
                <div class="offset-md-3 col-md-5">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h3>Get in Contact</h3>
                            <h5>Give us a shout! We'd love to hear from you.</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="E-Mail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" rows="4" id="message" name="message" placeholder="Message" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <input class="btn btn-info" type="submit" value="Send">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>-->
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('img/trustfy-new-mixed.png') }}" style="max-width: 200px;" class="img-fluid logo-desktop" alt="Trustfy Freelancer Payment">
                        <p>
                            {!! trans('index.claim') !!}
                        </p>
                    </div>
                    <div class="col-md-2">
                        <p style="padding-bottom: 10px;"><a href="/{{$blade["locale"]}}/terms" style="color:#fff;"> {!! trans('index.terms') !!}</a></p>
                        <p style="padding-bottom: 10px;"><a href="/{{$blade["locale"]}}/privacy" style="color:#fff;"> {!! trans('index.privacy') !!}</a></p>
                        <p><a href="/{{$blade["locale"]}}/faq" style="color:#fff;">FAQ</a></p>
                    </div>
                    <div class="col-md-5">
                        <img src="{{ asset('img/powered-by-mangopay.png') }}" alt="mangopay" class="img-responsive img-fluid">
                    </div>
                    <div class="col-md-2">
                        <a href="https://ie.linkedin.com/company/work-smarter-payment?trk=public_profile_topcard_current_company" target="_blank"><img src="{{ asset('img/linkedin.png') }}" alt="mangopay" class="img-responsive img-fluid"></a>
                        <a href="https://www.facebook.com/trustfy/" target="_blank"><img src="{{ asset('img/facebook.png') }}" alt="mangopay" class="img-responsive img-fluid"></a>
                    </div>
                </div>
        <div class="row" style="padding-top:25px;">
            <div class="col-md-12">

            </div>
        </div>
    </div>
</footer>
<!--
<script src="{{ asset('/js/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('/js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/js/homepage.min.js') }}"></script>
-->
<script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'efdb2cb1-6f9b-48a2-ba23-add187956429', f: true }); done = true; } }; })();</script>
@yield('javascript')
</body>

</html>
