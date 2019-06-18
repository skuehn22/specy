@extends('backend.masters.freelancer')
@section('seo')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
@stop
@section('css')

    <style>
        .sw-theme-arrows .sw-container {
            min-height: 40px;
        }

        .sw-theme-default > ul.step-anchor > li {
            position: relative;
            margin-right: 2px;
            padding: 9px;
        }

        .sw-theme-default .sw-container {
            min-height: auto;
        }

        .sw-theme-default .sw-toolbar {
            background: #f9f9f9;
            border-radius: 0 !important;
            padding-left: 10px;
            padding-right: 10px;
            padding: 10px;
            margin-bottom: 0 !important;
        }

        .sw-theme-default ul {
            -webkit-columns: 2;
            -moz-columns: 2;
            columns: 2;
        }

        .menu-icons button{
            width: 115px;
        }

        .menu-icons i {
            font-size: 15px;
            color: #fff;
            padding: 5px;
        }

        .sw-theme-default > ul.step-anchor > li.active > a {
            border: none !important;
            color: #19A3B8 !important;
            background: transparent !important;
            cursor: pointer;
        }

        hr{
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 90px;
            height: 34px;
        }

        .switch input {display:none;}

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ca2222;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #19A3B8;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(55px);
            -ms-transform: translateX(55px);
            transform: translateX(55px);
        }

        /*------ ADDED CSS ---------*/
        .on
        {
            display: none;
        }

        .on, .off
        {
            color: white;
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
        }

        input:checked+ .slider .on
        {display: block;}

        input:checked + .slider .off
        {display: none;}

        /*--------- END --------*/

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;}

        .cancel-plan{
            width: 115px;
        }

        .nav-tabs{
            padding-left: 40px;
        }

        .sw-container{
            padding-left: 40px;
        }

        .next-btn {
            width: 70px;
        }

        .prev-btn {
            width: 70px;
        }

    </style>
@stop

@section('content')
    <div class="plans">
        <div class="row">

        </div>

        <div class="row">
            <div class="col-md-12 p-0">


                <div id="smartwizard" class="sw-main sw-theme-default">
                    <ul id="arrows" class="nav nav-tabs step-anchor">
                        <li class="text-center"><a href="#step-1">Step 1<br /><small>General Information</small></a></li>
                        <li class="text-center"><a href="#step-2">Step 2<br /><small>Set up milestones</small></a></li>
                        <li class="text-center"><a href="#step-3">Step 3<br /><small>Add documents</small></a></li>
                        <li class="text-center"><a href="#step-4">Step 4<br /><small>Payment options</small></a></li>
                        <li class="text-center"><a href="#step-5">Step 5<br /><small>Preview</small></a></li>
                        <li class="right;"></li>
                    </ul>



                    <div class="col-md-12 btn-toolbar sw-toolbar sw-toolbar-top justify-content-end  menu-icons" style="text-align: right;">

                        <div class="btn-group mr-2 sw-btn-group" role="group" >
                            <a class="btn btn-secondary cancel-plan" id="cancel" href="/freelancer/plans/"><i class="fas fa-ban"></i> Close</a>
                            <button class="btn btn-success save-plan button-menu" id="save"><i class="fas fa-save"></i> Save</button>
                        </div>

                        <div class="btn-group mr-2 sw-btn-group" role="group" >
                            <button class="btn btn-alternative" id="preview-btn"><i class="fas fa-search"></i>Preview</button>
                        </div>

                    </div>

                    <div class="sw-container tab-content" style=" padding-left: 40px;">

                        <form method="post" id="upload_form" enctype="multipart/form-data">
                            <div id="step-1" class="tab-pane step-content">
                                @include('backend.freelancer.plans.general-infos')
                            </div>

                            <div id="step-2" class="tab-pane step-content">
                                @include('backend.freelancer.plans.payment-infos')
                            </div>

                            <div id="step-3" class="tab-pane step-content">
                                @include('ajax_file_upload')
                            </div>
                            <div id="step-4" class="tab-pane step-content">
                                @include('backend.freelancer.plans.finishing')
                            </div>
                            <div id="step-5" class="tab-pane step-content">
                                @include('backend.freelancer.plans.preview')
                            </div>
                            <input type="hidden" id="plan" name="plan" value="{{$plan->id}}">
                            <input type="hidden" id="due_typ_response" name="due_typ_response" value="{{$milestones->due_typ or ""}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <!-- Modal -->
    <div class="modal fade" id="saved-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog preview-modal" role="document"  style="width: 200px;">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="exampleModalLabel">Saved!</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                </div>
                <div class="modal-body" id="modal-body preview-body">
                    <div class="col-md-12">
                         <button type="submit" class="btn btn-success close-saved">Okay</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="send-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog preview-modal" role="document"  style="width: 200px;">
            <div class="modal-content">

                <div class="modal-header">

                    <span class="modal-title" id="exampleModalLabel">Your Payment Plan was send to your client!</span>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body preview-body">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-success close-saved" data-dismiss="modal" aria-label="Close">Okay</button>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog preview-modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body preview-body">
                    <div id="page1">
                        <div class="col-md-12 plan-preview align-middle">
                            <div class="col-md-12 p-0 pt-5 text-md-center">
                                <br><br><br><br><h3 class="font-italic text-secondary">-Preview-</h3>
                                <br><br><br><br><br> <br>
                                @if(isset($blade["user"]->logo))
                                    <img src="/uploads/companies/logo/{{$blade["user"]->logo}}" style="width:300px;">
                                @endif
                                <br><br><br><br><br><br>
                                <h4>Payment Plan</h4>
                                <br><br>
                                <div id="marker-creation-date"><span class="font-italic">--please select date--</span></div>
                                <br><br>
                                <p>between</p>
                                <p><strong>{{$blade["user"]->firstname}} {{$blade["user"]->lastname}} - Principal</strong></p>
                                <p>and</p>
                                <div><strong id="marker-client"><span class="font-italic">--please select client--</span></strong></div>
                                <div class="preview-project">
                                    <br><br><br><br>
                                    <h3>Project</h3>
                                    <div id="marker-project"><span class="font-italic">--please select project--</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="page2" class="plan-preview ">
                        <div class="col-md-12 float-right text-right">
                            @if(isset($blade["user"]->logo))
                                <img src="/uploads/companies/logo/{{$blade["user"]->logo}}" style="width: 220px; padding-top: 55px; padding-right: 55px;">
                            @endif
                        </div>
                        <div class="col-md-12">
                            <h4>Payment Plan</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('backend.freelancer.modals.create-client')



@stop
@section("javascript")
    @include('backend.freelancer.plans.js-edit-and-save')
@stop