@extends('frontend.masters.masters-trustfy-plan-tool')
@section('seo')
    <title>{!! trans('seo.title_about') !!}</title>
    <meta name="description" content="{!! trans('seo.desc_about') !!}">
    <meta name="keywords" content="{!! trans('seo.keywords_about') !!}">

@endsection


@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        h5{
            font-size: 14px;
        }

        .heading{
            font-family: Catamaran,Helvetica,Arial,sans-serif;
            font-weight: 200;
            letter-spacing: 1px;
            font-size: 14px;
        }

        .add-row{
            color: #19A3B8;
            background-color: #fff;
            border-color: #19A3B8;
            width: 148px;
            font-size: 14px;
            border-radius: 0px;
            padding: 0px;
        }

        input.btn.btn-lg, input.btn.btn-lg:focus {
            outline: 0;
            width: 100%;
            height: 36px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border: 1px solid #9d959a;
            padding: 0px;
        }



        /* This is the checked state */
        .custom-radio .custom-control-input:checked~.custom-control-label::before,
        .custom-radio .custom-control-input:checked~.custom-control-label::after {
            background-color: #19A3B8;  /* green */
            /* this bg image SVG is just a white circle, you can replace it with any valid SVG code */
            background-image: url(data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3E%3Ccircle r='3' fill='%23fff'/%3E%3C/svg%3E);
            border-radius: 50%;
        }

        /* active state i.e. displayed while the mouse is being pressed down */
        .custom-radio .custom-control-input:active ~ .custom-control-label::before {
            color: #fff;
            background-color: #ff0000; /* red */
        }

        /* the shadow; displayed while the element is in focus */
        .custom-radio .custom-control-input:focus ~ .custom-control-label::before {
            box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(255, 123, 255, 0.25); /* pink, 25% opacity */
        }

    </style>

@endsection

@section('content')

    <div class="container content-container" style="background-color: #f7f7f7; padding-bottom: 120px; margin-top: 80px; max-width: 800px;">
        <form class="form-horizontal" role="form" method="POST" action="{{ url($blade["locale"].'/plan-preview') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-12 col-md-12 pt-5 pl-5 pr-5">
                @if(Session::has('error'))
                    <div class="alert alert-danger error_message">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {{ Session::get('error') }}
                    </div>
                @endif
                    @if(isset($msg_success))
                        <div class="alert alert-success error_message">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            {!!  $msg_success !!}
                        </div>
                    @endif
                @if(Session::has('success'))
                    <div class="alert alert-success error_message">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {!!  Session::get('success') !!}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">

                        <h2>Set up Your Payment Plan!</h2>

                    </div>
                </div>



                    <div class="row">
                        <div class="col-md-12 pb-4 pt-4">

                            <div class="form-inline">
                                <div class="custom-control custom-radio pr-5">
                                    <input type="radio" class="custom-control-input" id="radio-type-new" name="radio-new" value="0" checked>
                                    <label class="custom-control-label" for="radio-type-new">I'm new here!</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="radio-type-returning" name="radio-new" value="1">
                                    <label class="custom-control-label" for="radio-type-returning">I have an account!</label>
                                </div>

                            </div>

                        </div>
                    </div>



                <div class="row pt-1">
                    <div class="col-md-6">
                        <h5>Your Email Address</h5> <div id="mailCheck" style="color: red;"></div>

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-envelope"></i></div>
                            </div>


                                @if(isset($user) && $user->tmp_mail==0 && $user->active==1)
                                    <input id="email" type="email" class="form-control col-md-12" name="email" value="{{ $user->email or ''}}">
                                @else
                                    <input id="email" type="email" class="form-control col-md-12" name="email" value="{{ $user->tmp_mail or ''}}">
                                @endif


                        </div>



                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h5 id="password">Please enter a password <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="You can bla bla..."></i></h5>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-key"></i></div>
                            </div>
                            <input id="password" type="password" class="form-control col-md-12" name="password">
                        </div>


                        @if ($errors->has('password'))
                            <span class="help-block">
                                 <strong>{{ $errors->first('password') }}</strong>
                             </span>
                        @endif
                    </div>

                </div>


                    <input type="hidden" name="hash" value="{{$plan->hash or ''}}">
                    <input type="hidden" name="tmp" id="tmp" value="0">

                    <div class="row pt-1 naming">

                        <div class="col-md-6">
                            <h5>Your Name</h5>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                </div>
                                <input id="name_freelancer" type="text" class="form-control col-md-12" name="name_freelancer" value="{{$company->firstname or ''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Your Business Name (optional)</h5>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-building"></i></div>
                                </div>
                                <input id="business" type="text" class="form-control col-md-12" name="business" value="{{$company->name or ''}}">
                            </div>
                        </div>

                    </div>

                <div class="row pt-5">
                    <div class="col-md-12">

                        <!--
                        <h5 class="pt-4">Are you a Freelancer or a Client?</h5>

                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="radio-type-freelancer" name="radio-type" value="0"  @if(isset($type) && $type==0) checked @endif>
                            <label class="custom-control-label" for="radio-type-freelancer">Freelancer</label>
                        </div>


                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="radio-type-client" name="radio-type" value="1"  @if(isset($type) && $type==1) checked @endif>
                            <label class="custom-control-label" for="radio-type-client">Client</label>
                        </div>
                        -->


                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="pt-1">The Client's Email</h5>

                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-envelope"></i></div>
                                    </div>


                                    <input type="email" id="email" name="client-email" class="form-control col-md-5" value="{{$client->email or ''}}" required>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h5 class="pt-4">What is the Project About?</h5>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">   <i class="fas fa-pen"></i></div>
                            </div>
                            <input class="form-control col-md-5" id="title" name="title" type="text" placeholder="e.g. Create a Website" value="{{$plan->name or ''}}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h5 class="pt-4">Payment Type</h5>
                        <select id="typ" name="typ" class="form-control col-md-12">
                            <option value="1" @if(isset($plantype) && $plantype==0) selected @endif>
                                Deposit / Single Payment
                            </option>
                            <option value="2" @if(isset($plantype) && $plantype==1) selected @endif>
                                Milestone Payment
                            </option>
                        </select>


                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="plan-typ-response"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="pt-4">Personal Message</h5>
@if(isset($plan->comment))
                            <textarea class="form-control col-md-12" rows="4"  name="comment" id="comment" placeholder="Hi John, I am really looking forward to working together! Best, Jane"> {{$plan->comment}}</textarea>
@else
                            <textarea class="form-control col-md-12" rows="4"  name="comment" id="comment" placeholder="Hi John, I am really looking forward to working together! Best, Jane"></textarea>

@endif


                    </div>
                </div>
               <div class="row">
                   <div class="col-md-2 pt-4">
                       <input type="submit" class="btn btn-create" value="Preview ">
                   </div>
               </div>

            </div>
        </div>
        </form>
    </div>
    <br><br><br>

@endsection
@section("javascript")

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="/js/freelancer/main.js"></script>
    <script src="/js/freelancer/menu-aim.js"></script>


    <!-- Include jQuery -->
    <script src="https://unpkg.com/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script src="/js/freelancer/jquery.smartWizard.min.js"></script>


    <script>

        //loads projects for selected client
        $("#typ").on('change', function() {

            if($("#typ").val() == 1 || $("#typ").val() == 2){
                getPlanTyp($(this).val());
            }

        });

        function checkMail() {

            if($('#tmp').val() == 0){
                var email = $("#email").val();
                $.ajax({

                    type: 'GET',
                    url: '{{env("MYHTTP")}}/{{$blade["locale"]}}/check-email/?email='+email,
                    data: { variable: 'value' },
                    dataType: 'json',
                    success:function(data)
                    {
                        $('#mailCheck').html(data.message);
                    }
                })

                $('#mailCheck').show();
            }

        }


        $("#email").focusout(function(){
            checkMail();
        });


        $(document).ready(function () {

            @if(isset($user))
                @if($user->tmp_mail==0 && $user->active==1)
                    $( "#radio-type-returning" ).attr('checked', true);
                    $('#tmp').val("1");
                    $('.naming').hide();
                @else
                    $( "#radio-type-new" ).attr('checked', true);
                    $('#tmp').val("0");
                    $('.naming').show();
                @endif
            @endif



            @if(isset($plan))
                $( "#typ" ).val({{$plan->typ}});
            @endif

            if($("#typ").val() == 1 || $("#typ").val() == 2){
                getPlanTyp($("#typ").val());
            }
        });


        function getPlanTyp(id) {


            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {

                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    document.getElementById("plan-typ-response").innerHTML = xmlhttp.responseText;


                    if(id == 1){
                        $(".button-bar-footer").removeClass("col-md-12").addClass("col-md-5");


                        @if(isset($cur))
                            $('#currency').val('{{$cur}}');
                        @endif
                        @if(isset($milestones))
                        $('#title-milestone').val('{{$milestones[0]->name}}');
                        $('#desc-milestone').val('{{$milestones[0]->desc}}');

                        $('#single-amount').val('{{$milestones[0]->amount}}');
                        $('#due_date').val('{{$milestones[0]->due_at}}');
                        @endif
                    }else{
                        $(".button-bar-footer").removeClass("col-md-5").addClass("col-md-12");




                        @if(isset($milestones))
                        $('#firstline').remove();
                        var counter = 0;
                        @foreach($milestones as $milestone)

                        var newRow = $("<tr>");
                        var cols = "";

                        cols += '<td><input type="text" class="form-control" name="name[]" value="{{$milestone->name}}"/><br>Description <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="Tell your client what this payment is for."></i><br><br><textarea class="form-control" rows="3" name="description[]">{{$milestone->desc}}</textarea></td>';
                        cols += '<td><input type="number" class="form-control" name="amount[]" value="{{$milestone->amount}}"/><br>Due Date <br><br><input type="text" class="form-control" id="due_date\' + counter + \'" name="due_date[]"  value="{{$milestone->due_at}}"/></td>';
                        cols += '<td class="col-sm-1 col-lg-1"  style="width: 15%"><select name="currency[]" id="currency[]" class="form-control"><option value="EUR" @if($milestone->currency == "EUR") selected @endif>EUR</option><option value="GBP" @if($milestone->currency == "GBP") selected @endif>GBP</option><option value="USD" @if($milestone->currency == "USD") selected @endif>USD</option></select></td>';
                        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="-"></td>';

                        newRow.append(cols);
                        $("table.order-list").append(newRow);
                        $( "#due_date" + counter).datepicker();
                        counter++;

                        @endforeach
                        @endif
                    }

                    @if(isset($milestones_edit->due_typ))
                    $("#pay-due").val({{$milestones_edit->due_typ}});
                    $(".amount").removeClass("d-none");
                    getDocs({{$plan->id}});
                    @endif

                    loadScript();

                }
            };

            @if(isset($milestones_edit->due_typ))
            xmlhttp.open("GET","{{env("MYHTTP")}}/{{$blade["locale"]}}/get-plan-typ/?typedit="+id, true);
            @else
            xmlhttp.open("GET","{{env("MYHTTP")}}/{{$blade["locale"]}}/get-plan-typ/?typ="+id, true);
            @endif

            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();
        }


        $('#radio-type-freelancer,#radio-type-client').on('change', function () {

            if($(this).val() == 1){
                $('.email-txt').html("Freelancers");
            }else{
                $('.email-txt').html("Clients");
            }

        });


        $('#radio-type-new,#radio-type-returning').on('change', function () {

            if($(this).val() == 0){
                $('#password').html("Please enter a new password");
                $('#tmp').val("0");
                $('.naming').show();
                checkMail();
            }else{
                $('#password').html("Please enter your password");
                $('#tmp').val("1");
                $('#mailCheck').hide();
                $('.naming').hide();
            }

        });






        function loadScript(){

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })


            @if(isset($amount))
                $( "#single-amount" ).val({{$amount}});
            @endif


            //initalize datepicker
            $( function() {
                $( "#due_date" ).datepicker( );
                $( "#due_date" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
                $('#due_date').datepicker('setDate', new Date());
            } );

            $(document).ready(function () {
                var counter = 1;

                $("#addrow").on("click", function () {



                    var newRow = $("<tr>");
                    var cols = "";

                    cols += '<td><input type="text" class="form-control" name="name[]"/><br>Description <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="Tell your client what this payment is for."></i><br><br><textarea class="form-control" rows="3" name="description[]"></textarea></td>';
                    cols += '<td><input type="number" class="form-control" name="amount[]"/><br>Due Date <br><br><input type="text" class="form-control" id="due_date' + counter + '" name="due_date[]"/></td>';
                    cols += '<td class="col-sm-1 col-lg-1"  style="width: 9%"><select name="currency[]" id="currency[]" class="form-control"><option value="EUR">EUR</option><option value="GBP">GBP</option><option value="USD">USD</option></select></td>';
                    cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="-"></td>';




                    newRow.append(cols);
                    $("table.order-list").append(newRow);
                    $( "#due_date" + counter).datepicker();
                    counter++;

                });


                $("table.order-list").on("click", ".ibtnDel", function (event) {
                    $(this).closest("tr").remove();
                    counter -= 1
                });
            });

        }




    </script>

@endsection
