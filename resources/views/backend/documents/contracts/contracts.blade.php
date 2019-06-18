@extends('backend.master')
@section('seo')
@stop
@section('css')

    body { padding-top:20px; }
    .panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px; }

@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-bookmark"></span> Inbox</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                Contracts
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

        </div>
    </div>
    </div>
@stop
@section("js")
@stop