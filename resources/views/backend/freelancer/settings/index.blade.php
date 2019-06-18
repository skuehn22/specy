@extends('backend.masters.freelancer')
@section('seo')
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/css/bootstrap-colorpicker.css">

    <style>

    body {
        color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        font-size: 13px;
    }

    .modal-content {
        min-height: 200px;
    }

    .input-group-addon {
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1;
        color: #555;
        text-align: center;
        background-color: #eee;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn-upload{

        padding: 10px;
        font-size: 14px;

    }


    input[type=file] {
        font-size: 14px;
        background-color: #eeeeee;
        color: #0f0f0f;
    }

    </style>

@stop
@section('content')
    <div class="settings">

            @if(Session::has('error'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger error_message">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {{ Session::get('error') }}
                    </div>
                </div>
            </div>
            @endif
            @if(Session::has('success'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success success_message">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            {!! Session::get('success') !!}
                        </div>
                    </div>
                </div>
            @endif


        <div class="row">
            <div class="col-md-12">
                <div id="exTab3">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Banking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#kyc" role="tab" aria-controls="kyc" aria-selected="false">Verification</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> @include('backend.freelancer.settings.company')</div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> @include('backend.freelancer.settings.account')</div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> @include('backend.freelancer.settings.payments')</div>
                        <div class="tab-pane fade" id="kyc" role="tabpanel" aria-labelledby="contact-tab"> @include('backend.freelancer.settings.kyc')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DEMO Installation Modal -->
    <div class="modal fade" id="demo-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" id="modal-body">
                    @include('backend.freelancer.setup.demo')
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form class="form-horizontal" role="form" method="POST" action="/freelancer/settings/reset">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="kyc-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 700px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">KYC documents</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <table>
                        <thead>
                        <tr>
                            <th style="padding-bottom: 15px;">Document type</th>
                            <th style="padding-bottom: 15px;">Usage</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="width: 300px;">&quot;IDENTITY_PROOF&quot;</td>
                            <td><p>ID Card, Passport, Residence Permit, or Driving License for SEPA area. Passport or Driving Licence for the UK, USA and Canada. For other nationalities, a passport is required.<br>In the case of a legal user, this document should refer to the individual duly empowered to act on behalf of the legal entity.  ID card: Front AND Back (Valid) OR Passport (Valid)</p></td>
                        </tr>
                        <tr>
                            <td>&quot;ARTICLES_OF_ASSOCIATION&quot;</td>
                            <td><p>Certified articles of association (Statute) - formal memorandum stated by the entrepreneurs, in which the following information is mentioned: business name, activity, registered address, shareholding…</p></td>
                        </tr>
                        <tr>
                            <td>&quot;REGISTRATION_PROOF&quot;</td>
                            <td><p>Extract from the Company Register issued within the last three months<br>In the case of an organization or soletrader, this can be a proof of registration from the official authority</p></td>
                        </tr>
                        <tr>
                            <td>&quot;SHAREHOLDER_DECLARATION&quot;</td>
                            <td><p>Send information referring to the <a href="https://www.mangopay.com/terms/shareholder-declaration/Shareholder_Declaration-EN.pdf" target="_blank">shareholder declaration</a></p></td>
                        </tr>
                        <tr>
                            <td>&quot;ADDRESS_PROOF&quot;</td>
                            <td><p>Proof of address. Confirmation of residence: Less than a year old. Can be: Residential Registration Form, Water/electricity/gas/telephone bill, Tax certificate, Householder insurance, Confirmation of real estate ownership</p></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
@section("javascript")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/js/bootstrap-colorpicker.js"></script>
    <script>

        $( document ).ready(function() {


            if(/android|webos|iphone|ipad|ipod|blackberry|opera mini|Windows Phone|iemobile|WPDesktop|XBLWP7/i.test(navigator.userAgent.toLowerCase())) {
                return false;
            }else{
                if($("#tour").length && $("#tour").val() == "true"){

                    $(".cd-app-screen").addClass('d-none').addClass('cd-app-screen-step1').removeClass('cd-app-screen');
                    $(".cd-nugget-info").addClass('d-none').addClass('cd-nugget-info-step1').removeClass('cd-nugget-info');
                    $("#cd-tour-trigger-step1").removeClass('d-none');
                    $("#cd-tour-trigger").addClass('d-none');

                    $(".tour-step-3").addClass('is-selected');

                }

            }



            @if(Session::has('success'))

            if(/android|webos|iphone|ipad|ipod|blackberry|opera mini|Windows Phone|iemobile|WPDesktop|XBLWP7/i.test(navigator.userAgent.toLowerCase())) {

            }else{
                if($("#tour").length && $("#tour").val() == "true"){
                    $(".cd-app-screen").removeClass('d-none').addClass('cd-app-screen-step1').removeClass('cd-app-screen');
                    $(".cd-nugget-info").removeClass('d-none').addClass('cd-nugget-info-step1').removeClass('cd-nugget-info');
                    $("#cd-tour-trigger-step1").addClass('d-none');
                    $("#cd-tour-trigger-step2").removeClass('d-none');
                    $("#cd-tour-trigger").addClass('d-none');
                    $(".tour-step-3").removeClass('is-selected');
                    $(".tour-step-4").addClass('is-selected');
                    $(".client-sidebar").addClass('active');
                }

            }


            @endif



            loadScripts();
        });

        function loadScripts(){

            $(function () {
                $('#color-picker-component').colorpicker();
            });

            //loads content for shortcuts
            $(".load-content").click(function() {
                getContent($(this).attr('id'));
            })

            $('#upload_form').on('submit', function(event){

                event.preventDefault();
                $.ajax({
                    url:"{{ route('ajaxupload.action') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        $('#uploaded_image').html('');
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('.old_image').remove();
                        $('#uploaded_image').html(data.uploaded_image);
                        loadScripts();
                    }
                })
            });

            $('#delete-image').on('click', function(event){

                var doc = $(this).data('name');

                event.preventDefault();
                $.ajax({
                    url:"{{ route('ajaxupload.delete') }}",
                    method:"GET",
                    data: { variable: doc },
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('#uploaded_image').html(" ");
                    }
                })
            });

        }

        function getContent($url){

            //alert($url);

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
                    document.getElementById("content-container").innerHTML = xmlhttp.responseText;
                    loadScripts();
                }
            };

            xmlhttp.open("GET","{{env("MYHTTP")}}/{{$blade['ll']}}/provider/settings/"+ $url, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();

        }

        $("#install-demo").on("click", function() {

            installDemo();

            $('#setup-modal').modal('hide');
            $('#demo-modal').modal('show');

            $(".demo-company-loading").addClass("").delay(1000).queue(function(next){
                $(".demo-company-loading").addClass("d-none")
                $(".demo-company-done").removeClass("d-none")
                next();
            });

            $(".demo-clients-loading").addClass("").delay(2000).queue(function(next){
                $(".demo-clients-loading").addClass("d-none")
                $(".demo-clients-done").removeClass("d-none")
                next();
            });

            $(".demo-projects-loading").addClass("").delay(3000).queue(function(next){
                $(".demo-projects-loading").addClass("d-none")
                $(".demo-projects-done").removeClass("d-none")
                next();
            });

            $(".demo-plans-loading").addClass("").delay(4000).queue(function(next){
                $(".demo-plans-loading").addClass("d-none")
                $(".demo-plans-done").removeClass("d-none")
                $("#get-started").removeClass("btn-disable").addClass("btn-classic")
                next();
            });

        });


        function installDemo() {

            $.ajax({
                type: 'GET',
                url: '{{env("MYHTTP")}}/{{$blade["ll"]}}/freelancer/demo/install',
                data: { variable: 'value' },
                dataType: 'json',

                success: function(data) {
                    var items = data["data"];
                    $("#marker-client").text(items["firstname"] + " " + items["lastname"] + " - Contractor");
                }
            });
        }


        $("#get-started").on("click", function() {
            $("#demo-modal").modal('hide');
            location.reload();
        });

        $(".reset-account").on("click", function() {
            $("#delete-modal").modal('show');
        });


        $("#country_bank").on('change', function() {

            $("#country_iso").val( $(this).val());

        });


        $("#kyc-details").on("click", function() {
            $("#kyc-modal").modal('show');
        });


        $(document).ready(function() {
            $('#ibanForm').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    iban: {
                        validators: {
                            iban: {
                                message: 'The value is not valid IBAN'
                            }
                        }
                    }
                }
            });
        });

    </script>
@stop