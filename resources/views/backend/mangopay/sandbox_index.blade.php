@extends('backend.master')



@section('seo')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
@stop
@section('css')

    <style>
        .tab-pane {
            padding:50px;
        }
    </style>
@stop
@section('breadcrumb')
    Dashboard
@stop

@section('content')


    <div class="container mangopay">
        <div class="row">
            <div class="col-md-12">

                @if(Session::has('success'))
                    <div class="alert alert-success error_message">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger error_message">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {{ Session::get('error') }}
                    </div>
                @endif

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#offer" aria-controls="offer" role="tab" data-toggle="tab">Create Offer</a></li>
                    <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Create Natural User</a></li>
                    <li role="presentation"><a href="#legaluser" aria-controls="home" role="tab" data-toggle="tab">Create Legal User</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Create Wallet</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Make a PayIn</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Create Bank Account</a></li>
                    <li role="presentation"><a href="#payout" aria-controls="settings" role="tab" data-toggle="tab">Make Payout</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="offer">
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="/mangopay/sandbox/create-offer" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Firstname</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp" placeholder="Enter Firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Lastname</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp" placeholder="Enter Lastname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Amount</label>
                                        <input type="text" class="form-control" id="offer_amount" name="offer_amount" aria-describedby="emailHelp" placeholder="Enter Amount" required>
                                    </div>
                                    <div class="form-group">
                                        <!--<label for="exampleInputPassword1">Service Fee (%)</label>-->
                                        <input type="hidden" class="form-control" id="service_fee_performer" name="service_fee_performer" value="5" required>
                                        <input type="hidden" class="form-control" id="service_fee_client" name="service_fee_client" value="8" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Offer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="home">
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="/mangopay/sandbox/create-user" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Firstname</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp" placeholder="Enter Firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Lastname</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-Mail</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter E-Mail" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="legaluser">
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="/mangopay/sandbox/create-legal-user" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Firstname</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp" placeholder="Enter Firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Lastname</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-Mail</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter E-Mail" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="/mangopay/sandbox/create-wallet" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">For User:</label>
                                        <select name="users" class="form-control">
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->Id}}">{{$user->Email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Wallet Description</label>
                                        <textarea class="form-control" id="desc_wallet" name="desc_wallet" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Wallet</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        <div class="row">
                            <div class="col-md-4">
                                <br><br>
                                <form action="/mangopay/sandbox/create-payin" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">From User (Author):</label>
                                        <select name="users_payin_out" id="users_payin_out" class="form-control">
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->Id}}">{{$user->Email}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">To User:</label>
                                        <select name="users_payin_to" id="users_payin_to" class="form-control">
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->Id}}">{{$user->Email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                   <div class="action" id="action"></div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">

                    </div>
                    <div role="tabpanel" class="tab-pane" id="payout">
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="/mangopay/sandbox/create-payout" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">To User:</label>
                                        <select name="users_payout" id="users_payout" class="form-control">
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->Id}}">{{$user->Email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="action2" id="action2"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <h2 style="color:black;">
                    MangoPay Test API
                </h2>
                <p>
                    <a href="/mangopay/test" >Mangotest API get user data</a>
                </p>
                -->
            </div>
        </div>
    </div>



@stop
@section("js")
    <script>

        $( "#users_payin_to" ).change(function() {

            user = $( "#users_payin_to" ).val();
            url = "get-wallets-in";
            action(user, url);

        });


        $( "#users_payout" ).change(function() {

            user = $( "#users_payout" ).val();
            url = "get-wallets-out";
            action(user, url);

        });

        function action(id, url) {

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    if(url == "get-wallets-in"){
                        document.getElementById("action").innerHTML = xmlhttp.responseText;
                    }else{
                        document.getElementById("action2").innerHTML = xmlhttp.responseText;
                    }

                }
            }
            xmlhttp.open("GET","{{env("MYHTTP")}}/en/mangopay/sandbox/"+url+"?id="+id, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();

        }


    </script>
@stop