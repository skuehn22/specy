<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Trustfy - Trust between freelancers and clients</title>
    <link href="{{ asset('css/backend/freelancer/bootstrap_4_0.css')}}" rel="stylesheet">
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/backend/style_backend.css')}}" rel="stylesheet">
    <link href="{{ asset('css/backend/freelancer/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/backend/freelancer/smart_wizard_theme_arrows.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/backend/freelancer/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/backend/freelancer/tour.css')}}" rel="stylesheet">

    @if (env('APP_ENV')=='live')
        @include('frontend.masters.elements.tracking')
    @endif


    @yield('css')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



</head>


<body>

<header class="cd-main-header">
    <a href="{{ URL::to($blade["ll"].'/freelancer/dashboard') }}" class="cd-logo">
        <img src="/img/trustfy-green.png" class="img-responsive logo" style="width: 150px;">
    </a>
    <a href="#0" class="cd-nav-trigger">Menu<span></span></a>
    <nav class="cd-nav">

        <ul class="cd-top-nav">
                       <li class="has-children account menu-top">
                <a href="#0">
                    <i class="fas fa-user-circle"></i>
                    @if(isset($company->name) && $company->name != null)
                        {{$company->name}}
                    @else
                        Account
                    @endif
                </a>
                <ul style="list-style-type: none;">
                    <li><a href="{{ URL::to($blade["ll"].'/freelancer/settings') }}">Settings</a></li>
                    <li><a href="{{ URL::to($blade["ll"].'/logout') }}">Logout</a></li>
                </ul>
            </li>

        </ul>
    </nav>
</header>
<main class="cd-main-content">
    <nav class="cd-side-nav">
        <ul class="navbar-nav">
            <li class="cd-label">Main</li>
            <li class="dashboard-sidebar">
                <a href="{{ URL::to($blade["ll"].'/freelancer/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i> <span class="pl-2">Dashboard</span>
                </a>
            </li>
            <li class="has-children client-sidebar">
                <a href="{{ URL::to($blade["ll"].'/freelancer/clients') }}"><i class="fas fa-users"></i> <span class="pl-2">Clients</span></a>
                <ul>
                    <li class="menu-left-sub">
                        <a href="{{ URL::to($blade["ll"].'/freelancer/clients') }}">
                            Overview
                        </a>
                    </li>
                    <li class="menu-left-sub">
                        <a href="{{ URL::to($blade["ll"].'/freelancer/clients/new') }}">
                            Add Client
                        </a>
                    </li>

                </ul>
            </li>
            <!--
            <li class="has-children">
                <a href="{{ URL::to($blade["ll"].'/freelancer/projects') }}"><i class="fas fa-project-diagram"></i> Projects</a>
                <ul>
                    <li>
                        <a href="{{ URL::to($blade["ll"].'/freelancer/projects') }}">
                            Overview
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to($blade["ll"].'/freelancer/projects/new') }}">
                            Add Project
                        </a>
                    </li>

                </ul>
            </li>

            -->
            <li class="has-children plan-sidebar">
                <a href="{{ URL::to($blade["ll"].'/freelancer/plans') }}">  <i class="far fa-money-bill-alt"></i> <span class="pl-2">Payment Plans</span></a>
                <ul>
                    <li class="menu-left-sub">
                        <a href="{{ URL::to($blade["ll"].'/freelancer/plans') }}">
                            Overview
                        </a>
                    </li>
                    <li class="menu-left-sub">
                        <a href="{{ URL::to($blade["ll"].'/freelancer/plans/new') }}">
                            New Plan
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
        <ul>
            <li class="cd-label">Information</li>
            <li class="settings-sidebar">
                <a href="{{ URL::to($blade["ll"].'/freelancer/settings') }}">
                    <i class="fas fa-cog"></i><span class="pl-2"> Settings</span>
                </a>
            </li>
            <li class="has-children tour-sidebar d-none d-sm-block d-md-block d-lg-block d-xl-block">
                <a href="{{ URL::to($blade["ll"].'/freelancer/dashboard?tour=activate') }}">
                    <i class="fas fa-eye"></i> <span class="pl-2">Start Tour</span>
                </a>
            </li>
        </ul>
        <ul>

            <li class="action-btn"><a href="{{ URL::to($blade["ll"].'/freelancer/plans/new') }}">Create Plan</a></li>
        </ul>
    </nav>

    <div class="content-wrapper">
        @yield('content')

        @if(!isset($user))
            <input type="hidden" name="tour" id="tour" value="{{$blade['user']->tour or ''}}">
        @else
            <input type="hidden" name="tour" id="tour" value="{{$user->tour or ''}}">
        @endif


    </div>

</main>

<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright © trustfy.io 2019</span> | <span class="terms"><a href="https://www.trustfy.io/en/terms" target="_blank" style="color: #19A3B8;">Terms and Conditions</a></span>
        </div>
    </div>
</footer>



@if((isset($user->tour) && $user->tour == "true") || (isset($blade['user']->tour) && $blade['user']->tour == "true"))
    @include('backend.freelancer.tour.index')
@endif


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="/js/freelancer/main.js"></script>
<script src="/js/freelancer/menu-aim.js"></script>


<!-- Include jQuery -->
<script src="https://unpkg.com/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
<script src="/js/freelancer/jquery.smartWizard.min.js"></script>

<!--order of script is important-->
<script>
    var url = "{{env("APP_SSL")}}://" + window.location.hostname + window.location.pathname;
    //alert(url);

    $('ul.navbar-nav li a').each(function () {

        if (this.href == url) {

            $("ul.navbar-nav li").each(function () {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                }
            });
            $(this).parents().addClass('active');
        }
    });


    $('ul.navbar-nav li ul').removeClass("active");
    $('ul.navbar-nav li ul li').removeClass("active");
</script>


@yield('javascript')
@yield('javascript-expanded')

<script type="text/javascript">


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


    $().alert('close');



</script>
<script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'efdb2cb1-6f9b-48a2-ba23-add187956429', f: true }); done = true; } }; })();</script>

</body>
</html>