
@extends('backend.pilot_applaud.master')

@section('seo')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
@stop
@section('css')

    <style>
        /* CSS used here will be applied after bootstrap.css */

        body{ margin-top:50px;}
        .nav-tabs .glyphicon:not(.no-margin) { margin-right:10px; }
        .tab-pane .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
        .tab-pane .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
        .tab-pane .list-group .checkbox { display: inline-block;margin: 0px; }
        .tab-pane .list-group input[type="checkbox"]{ margin-top: 2px; }
        .tab-pane .list-group .glyphicon { margin-right:5px; }
        .tab-pane .list-group .glyphicon:hover { color:#FFBC00; }
        a.list-group-item.read { color: #222;background-color: #F3F3F3; }
        hr { margin-top: 5px;margin-bottom: 10px; }
        .nav-pills>li>a {padding: 5px 10px;}

        .ad { padding: 5px;background: #F5F5F5;color: #222;font-size: 80%;border: 1px solid #E5E5E5; }
        .ad a.title {color: #15C;text-decoration: none;font-weight: bold;font-size: 110%;}
        .ad a.url {color: #093;text-decoration: none;}
    </style>
@stop
@section('breadcrumb')
    Dashboard
@stop

@section('content')

    <div class="container dashboard">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="far fa-envelope"></i> Inbox </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-12">
                                @include('backend.inbox.index')
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="far fa-chart-bar"></i> Bookmarked</h3>
                    </div>
                    <div class="panel-body">
                        @include('backend.bookmarks')
                    </div>
                </div>
                -->
            </div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fas fa-magic"></i> Quick Shortcuts</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-4 shortcuts-boxes">
                                <a href="#" class="btn btn-outline-grey btn-lg panel-btn modal-btn" id="create-offer" role="button" data-toggle="modal" data-target="#exampleModalCenter">
                                    <i class="fas fa-file-alt"></i> <br/><p style="padding-top: 11px;">Create Offer</p>
                                </a>
                            </div>
                            <div class="col-xs-12 col-md-4 shortcuts-boxes">
                                <a href="#" class="btn btn-outline-grey btn-lg panel-btn disabled" role="button">
                                    <i class="fas fa-file-alt"></i> <br/><p style="padding-top: 11px;">View Project</p>
                                </a>
                            </div>
                            <div class="col-xs-12 col-md-4 shortcuts-boxes">
                                <a href="#" class="btn btn-outline-grey btn-lg panel-btn disabled" role="button">
                                    <i class="fas fa-file-alt"></i> <br/><p style="padding-top: 11px;">View Project</p>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-4 shortcuts-boxes">
                                <a href="/en/mangopay/sandbox" class="btn btn-outline-grey btn-lg panel-btn" role="button">
                                    <i class="fas fa-file-alt"></i> <br/><p style="padding-top: 11px;">Sandbox</p>
                                </a>
                            </div>
                            <div class="col-xs-12 col-md-4 shortcuts-boxes">
                                <a href="#" class="btn btn-outline-grey btn-lg panel-btn modal-btn disabled" id="clients" role="button" data-toggle="modal" data-target="#exampleModalCenter">
                                    <i class="fas fa-address-book"></i> <br/><p style="padding-top: 11px;">View Clients</p>
                                </a>
                            </div>
                            <div class="col-xs-12 col-md-4 shortcuts-boxes">
                                <a href="/en/provider/settings" class="btn btn-outline-grey btn-lg panel-btn" role="button">
                                    <i class="fas fa-cog"></i> <br/><p style="padding-top: 11px;">Settings</p>
                                </a>
                            </div>
                        </div>
                        <!--<a href="http://www.jquery2dotnet.com/" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-globe"></span> Website</a>-->
                    </div>

                </div>
                <!--
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fas fa-chart-line"></i> KPIs</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <a href="/en/documents" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Apps</a>
                                <a href="#" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Bookmarks</a>
                                <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Reports</a>
                                <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                            </div>
                        </div>

                    </div>
                </div>
        -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Offer Calculation
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>
                    <!--
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    -->
                </div>
            </div>
        </div>

    </div>



@stop
@section("js")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <script>

        $( document ).ready(function() {
            loadScripts();
        });

        function loadScripts(){

            $( "#create-button" ).click(function() {
                setEscrow( "performer@applaud.com",  "client@applaud.com", $('#offer_amount').val());
            });

            $( "#offer_amount" ).keyup(function() {
                calculate(this.value);
            });

            //loads content for shortcuts
            $(".modal-btn").click(function() {
                getModalContent($(this).attr('id'));
            });

            //loads content for shortcuts
            $(".load-modul").click(function() {

                url=$(this).attr('id');

                data = {};

                obj = {
                    "client": $( "select#clients option:checked" ).val(),
                    "expiresdate": $("#expires-date").val(),
                    "dateproposal": $("#date-proposal").val()
                };

                data["proposal"] = JSON.stringify(obj);
                action(url, data);

            });

            $( ".date_proposal" ).datepicker({
                required: true,
                minDate: +7,
                numberOfMonths: 1,
                clearText: 'delete', clearStatus: 'delete current date',
                closeText: 'close', closeStatus: 'close without changes',
                prevText: 'back', prevStatus: 'show last month',
                nextText: 'forward', nextStatus: 'show next month',
                currentText: 'today', currentStatus: '',
                monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'],
                monthNamesShort: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                monthStatus: 'show other month', yearStatus: 'show other year',
                weekHeader: 'We', weekStatus: 'Week of the month',
                dayNames: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                dayNamesShort: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],
                dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'],
                dayStatus: 'Set DD as first Weekday', dateStatus: 'Choose D, M d',
                dateFormat: 'dd.mm.yy', firstDay: 1,
                initStatus: 'Select a date', isRTL: false,
                onClose: function( selectedDate ) {
                    if(selectedDate!=null && selectedDate!=""){
                        var current_date = $.datepicker.parseDate('dd.mm.yy', selectedDate);
                        current_date.setDate(current_date.getDate()+1);
                        $( ".expires_date" ).datepicker( "show", "option", "minDate", current_date );
                    }
                }
            });

            $( ".expires_date" ).datepicker({
                required: true,
                numberOfMonths: 1,
                clearText: 'delete', clearStatus: 'delete current date',
                closeText: 'close', closeStatus: 'close without changes',
                prevText: 'back', prevStatus: 'show last month',
                nextText: 'forward', nextStatus: 'show next month',
                currentText: 'today', currentStatus: '',
                monthNames: ['January','February','March','April','May','June',
                    'July','August','September','October','November','December'],
                monthNamesShort: ['Jan','Feb','Mar','Apr','May','Jun',
                    'Jul','Aug','Sep','Oct','Nov','Dec'],
                monthStatus: 'show other month', yearStatus: 'show other year',
                weekHeader: 'We', weekStatus: 'Week of the month',
                dayNames: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                dayNamesShort: ['Su','Mo','Tu','Wed','Thu','Fri','Sat'],
                dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'],
                dayStatus: 'Set DD as first Weekday', dateStatus: 'Wähle D, M d',
                dateFormat: 'dd.mm.yy', firstDay: 1,
                minDate: 0+1,
                initStatus: 'Select a date', isRTL: false,
                onClose: function( selectedDate ) {
                    if(selectedDate!=null && selectedDate!=""){
                        var current_date = $.datepicker.parseDate('dd.mm.yy', selectedDate);
                        current_date.setDate(current_date.getDate()-1);
                        $( ".expires_date" ).datepicker( "option", "minDate", current_date);
                        $( ".expires_date" ).datepicker( "show");
                    }
                }
            });


        }

        function action(url, data){

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("modal-body").innerHTML = xmlhttp.responseText;
                    loadScripts();
                }
            };


            urlAddress = "{{env("MYHTTP")}}/{{$blade['locale']}}/provider/" + url;


            if(data != null && Object.keys(data).length > 0) {

                urlAddress += "?";

                for (var k in data) {
                    urlAddress += k + "=" + data[k] + "&";
                }

                urlAddress = urlAddress.slice(0, -1);

            }

            xmlhttp.open("GET", urlAddress, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();

        }


        function getModalContent($url){

            //alert($url);

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("modal-body").innerHTML = xmlhttp.responseText;
                    loadScripts();
                }
            }
            xmlhttp.open("GET","{{env("MYHTTP")}}/{{$blade['locale']}}/applaud/performer/"+ $url, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();

        }


        function calculate(sum_offer){

            fee_performer = $( "#service_fee_performer" ).val();
            fee_client = $( "#service_fee_client" ).val();
            clientOffer = parseFloat(sum_offer) + parseFloat((sum_offer*(fee_client/100)));
            performerOffer = parseFloat(sum_offer) - parseFloat((sum_offer*(fee_performer/100)));
            applaudOffer = parseFloat(sum_offer*(fee_performer/100)) + parseFloat(sum_offer*(fee_client/100));

            $( ".calculation-client-offer" ).text(clientOffer.toFixed(2)+ " €");
            $( ".calculation-performer-offer" ).text(performerOffer.toFixed(2)+ " €");
            $( ".calculation-applaud-offer" ).text(applaudOffer.toFixed(2)+ " €");
            $( ".calculation-amount" ).text(parseFloat(sum_offer).toFixed(2)+ " €");
            $( ".calculation-performer-fee" ).text(parseFloat(sum_offer*(fee_performer/100)).toFixed(2)+ " €");
            $( ".calculation-client-fee" ).text(parseFloat(sum_offer*(fee_client/100)).toFixed(2)+ " €");

        }

        function setEscrow(performer_mail, client_mail, amount){

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    hash = xmlhttp.responseText;
                    document.getElementById("_hash").value = hash;
                    loadBtn();
                }
            };

            xmlhttp.open("GET","{{env("MYHTTP")}}/{{$blade['locale']}}/applaud/admin/set-escrow?performer="+performer_mail+"&client="+client_mail+"&amount="+amount, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();

        }

        function loadBtn(){

            btn = "<a class='btn btn-success' href='"+ $( "#_hash" ).val() +"' role='button'>Link</a>"
            $( "#pay-button-area" ).val(btn);
            $( ".button-area" ).show();
            $( ".payin-btn" ).prop("href", "/applaud/secure/escrow/"+ $( "#_hash" ).val())

        }



    </script>

@stop