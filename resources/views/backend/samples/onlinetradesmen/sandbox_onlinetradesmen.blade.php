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

    <link href="{{ asset('css/samples.css') }}" rel="stylesheet" type="text/css" >
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
                <img src="/images/OnlineTradesmenLogo.jpg" style="width:200px;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 wrapper">
                <div class="col-md-6">
                    <h1>Booked Items</h1>
                    <div class="row">
                        <div class="col-md-6">Project:</div>
                        <div class="col-md-4" style="text-align:right;">930918</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Date:</div>
                        <div class="col-md-4" style="text-align:right;">31.10.2018</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Price:</div>
                        <div class="col-md-4" style="text-align:right;">645.00 €</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Payment Plan:</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br><strong>Milestone Plan</strong>
                            <p>Milestone 1: Project Start 50% <br>Milestone 2: Project End 50%</p>
                        </div>
                    </div>
                    @if(!isset($id))
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
                                    <option value="CB_VISA_MASTERCARD">Visa Mastercard</option>
                                </select>
                                <br>
                                <a class="btn btn-success escrowbutton" href="#" role="button"> <i class="fas fa-lock"></i> Make Secure Payment</a>
                            </p>
                        </div>
                    </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <h2 style="color: green;">Thank you for paying!</h2>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <h1>Contractor Details</h1>
                    <div class="row">
                        <div class="col-md-6">Name:</div>
                        <div class="col-md-4" style="text-align:right;">John Doe</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <br><br>
                            Address
                        </div>
                        <div class="col-md-4" style="text-align:right;">
                            <br><br>
                            Pearse Stret 42
                            Dublin 2<br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">Phone:</div>
                        <div class="col-md-5" style="text-align:right;">+353 082 32321</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">E-Mail:</div>
                        <div class="col-md-4" style="text-align:right;">john@doe.de</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="_hash" value="{{ csrf_token() }}">

</div>

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
@yield('js')

<script>

    $( document ).ready(function() {
        setEscrow( "performer@applaud.com",  "client@applaud.com", "500");
    });

    $( "#create-button" ).click(function() {

    });

    function setEscrow(performer_mail, client_mail, amount){

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                hash = xmlhttp.responseText;

                hash = xmlhttp.responseText;

                $(".escrowbutton").prop("href", hash)
                //loadBtn();
            }
        };

        xmlhttp.open("GET","{{env("MYHTTP")}}/{{$blade['locale']}}/applaud/admin/set-escrow?performer="+performer_mail+"&client="+client_mail+"&amount="+amount, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();

    }

</script>

</body>
</html>
