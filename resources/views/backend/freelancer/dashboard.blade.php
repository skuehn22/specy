@extends('backend.masters.freelancer')
@section('seo')

@stop
@section('css')
    <link href="https://fonts.googleapis.com/css?family=Anton|Fjalla+One" rel="stylesheet">

    <style>

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

        @keyframes funded-plans-left{
            0%{
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100%{
                -webkit-transform: rotate({{$openLeft['funded']}}deg);
                transform: rotate({{$openLeft['funded']}}deg);
            }
        }

        @keyframes funded-plans-right{
            0%{
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100%{
                -webkit-transform: rotate({{$openRight['funded']}}deg);
                transform: rotate({{$openRight['funded']}}deg);
            }
        }

        @keyframes pending-plans-left{
            0%{
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100%{
                -webkit-transform: rotate({{$openLeft['pending']}}deg);
                transform: rotate({{$openLeft['pending']}}deg);
            }
        }

        @keyframes pending-plans-right{
            0%{
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100%{
                -webkit-transform: rotate({{$openRight['pending']}}deg);
                -webkit-transform: rotate({{$openRight['pending']}}deg);
                transform: rotate({{$openRight['pending']}}deg);
            }
        }



        @keyframes released-plans-left{
            0%{
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100%{
                -webkit-transform: rotate({{$openLeft['released']}}deg);
                transform: rotate({{$openLeft['released']}}deg);
            }
        }

        @keyframes released-plans-right{
            0%{
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100%{
                -webkit-transform: rotate({{$openRight['released']}}deg);
                transform: rotate({{$openRight['released']}}deg);
            }
        }


        .progress.blue .progress-bar{
            border-color: #19A3B8;
        }
        .progress.blue .progress-left .progress-bar{
            animation: released-plans-left 1.2s linear forwards 1.8s;
        }

        .progress.blue .progress-right .progress-bar{
            animation: released-plans-right 0.5s linear forwards 0.8s;
        }


        .progress.green .progress-bar{
            border-color: #28a745;
        }
        .progress.green .progress-left .progress-bar{
            animation: funded-plans-left 1.2s linear forwards 1.8s;
        }

        .progress.green .progress-right .progress-bar{
            animation: funded-plans-right 0.5s linear forwards 0.8s;
        }


        .progress.yellow .progress-bar{
            border-color: #fdcc52;
        }
        .progress.yellow .progress-left .progress-bar{
            animation: pending-plans-left 1.2s linear forwards 1.8s;
        }

        .progress.yellow .progress-right .progress-bar{
            animation: pending-plans-right 0.5s linear forwards 0.8s;
        }



        .modal-content {
            min-height: 200px;
        }
        body{
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }


        .btn-group-lg>.btn, .btn-lg {
            padding: .5rem 1rem;
            font-size: 1.50rem;
            line-height: 1.5;
            border-radius: .3rem;
        }

        .plans-dropdown{
            color: #fff;
            background-color: #9e9e9e;
            border:0px;
        }

        .plans-dropdown:hover {
            color: #fff;
            background-color: #9e9e9e;
            border-color: #9e9e9e;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: .25rem 1.5rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
            font-size: 1.5em;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 10rem;
            padding: .5rem 0;
            margin: .125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #eeeeee;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: .25rem;
        }


        .btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active, .show>.btn-secondary.dropdown-toggle {
            color: #fff;
            background-color: #d8d8d8;
            border-color: #fff;
        }



    </style>

    <script>



    </script>
@stop

@section('content')

    @if(Session::has('error'))
        <div class="row" style="padding-top: 20px;">
            <div class="col-md-12">
                <div class="alert alert-danger error_message">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('error') }}
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('success'))
        <div class="row" style="padding-top: 20px;">
            <div class="col-md-12">
                <div class="alert alert-success success_message">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row blur-dashboard" style="padding-top: 20px;">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4 mb-4">
                    @include('backend.freelancer.dashboard.inbox')
                </div>
                <div class="col-md-8 mb-4">
                    @include('backend.freelancer.dashboard.projects')
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-md-12">
                    <p style="font-size: 20px; font-family: 'Fjalla One', sans-serif; color: #19A3B8;">Payment status</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-4">
                    @include('backend.freelancer.dashboard.funds')
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12 mb-4">
                    @include('backend.freelancer.dashboard.upcoming')
                </div>
            </div>
        </div>
    </div>



    <!-- Setup Modal
    <div class="modal fade" id="setup-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" id="modal-body">

                </div>
            </div>
        </div>
    </div>
-->

    <!-- DEMO Installation Modal
    <div class="modal fade" id="demo-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" id="modal-body">

                </div>
            </div>
        </div>
    </div>
    -->

    </div>
    <input id="setup" type="hidden" value="{{$setup or ''}}">

@stop
@section("javascript")
    <script type="text/javascript">

        //checks if a new setup is required for the freelancer

        /*
        var setup = $('#setup').val();

        if( setup == 0 ) {

            $('#setup-modal').modal('show');

        }else{
            //loads project on dashboard

            var last = {{$last_project->id or 'false'}};

            if(last){
                getProject(last);
            }else{
                getProject( $('#projects-modul').val());
            }

        }
        */

        $(document).ready(function (e) {




            $('.active-inbox').click();
            $('#inbox-start').click();

            var id = $(".dropdown-item").data("id");
            getProject(id);

        });



        function loadScripts(){
            // External Button Events
            $(".force-next").on("click", function() {
                // Reset wizard
                $('#smartwizard').smartWizard("next");
                return true;
            });

            $(".save-project").on("click", function() {


                if ($("#project-data").valid()) {

                    //if valid save company in DB
                    data = {};
                    obj = {
                        "name" : $("#project-name").val(),
                        "desc" : $("#project-description").val(),
                        "notes" : $("#project-notes").val(),
                        "client" : $("#project-clients").val(),

                        "address1" : $("#project-address1").val(),
                        "address2" : $("#project-address2").val(),
                        "city"     : $("#project-city").val(),
                        "country"  : $("#project-data #country").val(),
                    };

                    data["project"] = JSON.stringify(obj);
                    var msg = save("save-project", data);

                }else{

                }

            });

            $("#plan-details").on('change', function() {
                getPlan($(this).val());
            });


        }

        function save(url, data) {

            urlAddress = "{{env('MYHTTP')}}/{{$blade["ll"]}}/freelancer/setup/save/" + url;

            if(data != null && Object.keys(data).length > 0) {

                urlAddress += "?";
                for (var k in data) {
                    urlAddress += k + "=" + data[k] + "&";
                }
                urlAddress = urlAddress.slice(0, -1);
            }

            $.ajax({
                type: 'GET',
                url: urlAddress,
                data: { variable: 'value' },
                dataType: 'json',
                success: function(data) {
                    var items = data["success"];

                    if(items == "Client successfully created"){
                        $("#msg").text(items);
                        clearClientForm();
                        $(".client-next").text("Next Step").addClass( "btn-success force-next" ).removeClass( "btn-secondary" );
                        loadScripts();
                    }

                    if(items == "Project successfully created"){
                        $("#msg-project").text(items);
                        clearProjectForm();
                        $(".project-next").text("Next Step").addClass( "btn-success force-next" ).removeClass( "btn-secondary" );
                        loadScripts();
                    }
                }
            });
        }

        function getClients() {

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    document.getElementById("client-list").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "{{env('MYHTTP')}}/{{$blade["ll"]}}/freelancer/clients/get-by-id", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();

        }


        // Smart Wizard

        /*
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'default',
            transitionEffect:'slide',
            autoAdjustHeight: false,
            toolbarSettings: {toolbarPosition: 'none',
                toolbarExtraButtons: [
                    {label: 'Finish', css: 'btn-success', onClick: function(){ alert('Finish Clicked'); }},
                    {label: 'Cancel', css: 'btn-warning', onClick: function(){ $('#smartwizard').smartWizard("reset"); }}
                ]
            }
        });

        // External Button Events
        $("#reset-btn").on("click", function() {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");
            return true;
        });

        $(".prev-btn").on("click", function() {
            // Navigate previous
            $('#smartwizard').smartWizard("prev");
            return true;
        });


        $(".save-company").on("click", function() {

            if ($("#company-data").valid()) {

                //if valid save company in DB
                data = {};
                obj = {
                    "firstname" : $("#firstname").val(),
                    "lastname" : $("#lastname").val(),
                    "company" : $("#company").val(),
                    "address" : $("#address").val(),
                    "country" :  $("#company-data #country").val(),
                    "city" : $("#city").val(),
                };

                data["company"] = JSON.stringify(obj);
                save("save-company", data);

                //opens next tab
                $('.alert-welcome').hide();
                $('#smartwizard').smartWizard("next");
                return true;

            }else{

            }

        });

        $(".save-client").on("click", function() {

            if ($("#client-data").valid()) {

                //if valid save company in DB
                data = {};
                obj = {
                    "firstname" : $("#client-firstname").val(),
                    "lastname" : $("#client-lastname").val(),
                    "phone" : $("#client-phone").val(),
                    "mobile" : $("#client-mobile").val(),
                    "mail" : $("#client-mail").val(),

                    "currency" : $("#currency").val(),
                    "address1" : $("#client-address1").val(),
                    "address2" : $("#client-address2").val(),
                    "city" : $("#client-city").val(),
                    "country" :  $("#client-data #country").val(),
                };

                data["clients"] = JSON.stringify(obj);
                var msg = save("save-client", data);
                getClients();

            }else{

            }

        });


        //initalize the arrow bar on the top of the modal
        $('#smartwizard').smartWizard("theme", "arrows");



        function clearClientForm() {

            $("#client-firstname").val('');
            $("#client-lastname").val('');
            $("#client-phone").val('');
            $("#client-mobile").val('');
            $("#client-mail").val('');
            $("#currency").val('');
            $("#client-address1").val('');
            $("#client-address2").val('');
            $("#client-city").val('');
            $("#client-data #country").val('');
        }


        function clearProjectForm() {

            $("#project-name").val('');
            $("#project-description").val('');
            $("#project-notes").val('');
            $("#project-address1").val('');
            $("#project-address2").val('');
            $("#project-city").val('');
            $("#project-data #country").val('');

        }

        // Expand the modal width for setup creation through freelancer
        $("#start-setup").on("click", function() {
            $(".modal-dialog").addClass('modal-expand');
            $('#arrows').removeClass("d-none");
            $('#smartwizard').smartWizard("next");
        });

        $("#install-demo").on("click", function() {

            installDemo();

            $('#setup-modal').modal('hide');
            $('#demo-modal').modal('show');

            $(".demo-company-loading").addClass("").delay(1500).queue(function(next){
                $(".demo-company-loading").addClass("d-none")
                $(".demo-company-done").removeClass("d-none")
                next();
            });

            $(".demo-clients-loading").addClass("").delay(2500).queue(function(next){
                $(".demo-clients-loading").addClass("d-none")
                $(".demo-clients-done").removeClass("d-none")
                next();
            });

            $(".demo-projects-loading").addClass("").delay(3500).queue(function(next){
                $(".demo-projects-loading").addClass("d-none")
                $(".demo-projects-done").removeClass("d-none")
                next();
            });

            $(".demo-plans-loading").addClass("").delay(4500).queue(function(next){
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


        // Expand the modal width for setup creation through freelancer
        $("#prev-btn-step1").on("click", function() {
            $('#arrows').addClass("d-none");
            $(".modal-dialog").removeClass('modal-expand');
        });

        // Expand the modal width for setup creation through freelancer
        $(".project-next").on("click", function() {
            $('#arrows').addClass("d-none");
        });
  */
        // Expand the modal width for setup creation through freelancer
        $(".dropdown-item").on("click", function() {
            var planID = $(this).data("id");
            getProject(planID);
        });


        function getProject(id) {


            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    document.getElementById("dashboard-projects").innerHTML = xmlhttp.responseText;
                    $("#projects-modul").val(id);
                    loadScripts();
                    //getPlan($("#plan-details").val());
                }
            }

            xmlhttp.open("GET", "{{env('MYHTTP')}}/{{$blade["ll"]}}/freelancer/dashboard/load-project?id="+id, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();

        }



        $('#load-dashboard').click(function() {
            $('#setup-modal').modal('hide');
            setSetupState();
            location.reload();
        });


        function setSetupState() {

            $.ajax({
                type: 'GET',
                url: '{{env("MYHTTP")}}/{{$blade["ll"]}}/freelancer/setup/save/done',
                data: { variable: 'value' },
                dataType: 'json',

                success: function(data) {
                    var items = data["data"];
                    //$("#marker-client").text(items["firstname"] + " " + items["lastname"] + " - Contractor");
                }
            });
        }



        $(".get-details").on("click", function() {

            var msg = $(this).attr('id');
            getMsgDetails(msg);

        });

        function getMsgDetails(msg) {



            $.ajax({
                type: 'GET',
                url: '{{env("MYHTTP")}}/{{$blade["ll"]}}/freelancer/msg/get/details',
                data: { msg: msg },
                dataType: 'json',

                success: function(data) {

                    items = data["data"];


                    if( items["typ"] == 1){
                        subject = '{{ trans("messages.subject_typ_1") }}';
                    }

                    if( items["typ"] == 2){
                        subject = '{{ trans("messages.subject_typ_2") }}';
                    }


                    if( items["typ"] == 3){
                        subject = '{{ trans("messages.subject_typ_3") }}';
                    }

                    if( items["typ"] == 4){
                        subject = '{{ trans("messages.subject_typ_4") }}';
                    }


                    txt = items["meassage"];

                    $("#modal-title-msg").text(subject);

                    $("#modal-body-msg").html(txt);

                    $('#msgDetail').modal('show');
                }
            });
        }



    </script>
@stop