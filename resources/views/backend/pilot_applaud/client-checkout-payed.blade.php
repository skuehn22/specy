<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Applaud Events</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('css/applaud-style.css') }}" rel="stylesheet" type="text/css" >
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    @yield('seo')
    <style>
        @yield('css')
    </style>

</head>
<body id="app-layout">

<div class="container">
    <div class="col-md-offset-2 col-md-8">
        <div class="row">
            <div class="col-md-12 client-checkout-logo">
                <img src="/images/applaud_free.png" style="width:200px;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 wrapper">
                <div class="col-md-6">
                    <h1>Booked Items</h1>
                    <div class="row">
                        <div class="col-md-6">Performer:</div> <div class="col-md-4" style="text-align:right;">Natalie Turner</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Date:</div> <div class="col-md-4" style="text-align:right;">31.10.2018</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Price:</div> <div class="col-md-4" style="text-align:right;">645.00 €</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color:#1e8033; text-align: justify;">
                                <br><br>
                                The amount is held in a secure account. The performer has no access to it. You simply release the money from this account at the push of a button when the performer has done his job.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Pay with debit or credit card</h3>
                            <p>We don’t share your financial details with the merchant.</p>
                            <p>
                                <select class="form-control">
                                    <option value="">select</option>
                                    <option value="CB_VISA_MASTERCARD">Visa Mastercard</option>
                                </select>
                                <br>
                                <a class="btn btn-success escrowbutton" href="{{ $payIn->RedirectURL }}" role="button"> <i class="fas fa-lock"></i> Make Secure Payment</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="overflow: hidden;">
                    <img src="https://static1.squarespace.com/static/5a3c0f4f29f1877828aabc1b/5aafe185f950b79ea5110c51/5adbb2c5562fa78e4b199b3f/1524347590799/Photo%2B1.jpg">
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
