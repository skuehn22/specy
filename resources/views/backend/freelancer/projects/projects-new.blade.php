@extends('backend.masters.freelancer')
@section('seo')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
@stop
@section('css')

    <style>

    </style>
@stop
@section('breadcrumb')
    Dashboard
@stop

@section('content')
    <form action="/{{$blade["ll"]}}/freelancer/projects/save/0">
    <div class="clients" style="padding: 35px;">
        <div class="row section-heading">
            <div class="col-md-6 pl-0">
                <h3>Create new Project</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pl-2">

                    <div class="form-row py-2">
                        <h5>General Information</h5>
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-2 col-form-label" for="clients">Client</label>
                        @if(count($clients)>0)
                        <select name="clients" id="clients" class="col-md-8">
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->firstname}} {{$client->lastname}}</option>
                            @endforeach
                        </select>
                        @else
                            <div class="pt-2">
                                No clients created yet. <a href="/{{$blade["ll"]}}/freelancer/clients/new">Create Client</a>
                            </div>

                        @endif
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-2 col-form-label" for="name">Name</label>
                        <input type="text" class="form-control col-md-8" id="name" name="name">
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-2 col-form-label"  for="description">Description</label>
                        <textarea class="form-control col-md-8" rows="5" id="description" name="description"></textarea>
                    </div>


            </div>
            <div class="col-md-6">
                <div class="form-row py-2">
                    <h5>Address optional</h5>
                </div>
                <div class="form-row py-2">
                    <label class="col-md-2 col-form-label"  for="street">Street</label>
                    <input type="text" class="form-control col-md-8" id="street" name="street">
                </div>
                <div class="form-row py-2">
                    <label class="col-md-2 col-form-label"  for="city">City</label>
                    <input type="text" class="form-control col-md-8" id="city" name="city">
                </div>
                <div class="form-row py-2">
                    <label class="col-md-2 col-form-label"  for="country">Country</label>
                    <input type="text" class="form-control col-md-8" id="country" name="country">
                </div>
                <div class="form-row pt-4">
                    <button type="submit" class="btn btn-classic">Save Project</button>
                </div>
            </div>
        </div>
    </div>
    </form>
@stop
@section("js")

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop