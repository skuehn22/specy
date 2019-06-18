@extends('backend.masters.freelancer')
@section('seo')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
@stop
@section('css')

    <style>

        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }


        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            margin: 30px 0;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #fff;
            color: #19A3B8;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

    </style>

@stop
@section('breadcrumb')
    Dashboard
@stop

@section('content')
    <div class="clients" style="padding:35px;">
        <form action="/{{$blade["ll"]}}/freelancer/clients/save/{{$client->id}}">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2>Edit Client</h2>
                        </div>
                        <div class="col-sm-7 float-right text-right pt-3">
                            <button type="submit" class="btn btn-classic">Save Client</button>
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-6">
                    <h5 class="pb-3">General Information</h5>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label" for="client-firstname">First name</label>
                        <input type="text" class="form-control col-md-7" id="client-firstname" name="client-firstname" value="{{$client->firstname or ''}}" required>
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label"  for="client-lastname">Last name</label>
                        <input type="text" class="form-control col-md-7" id="client-lastname" name="client-lastname"  value="{{$client->lastname or ''}}" required>
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label"  for="client-mail">Email address</label>
                        <input type="email" class="form-control col-md-7" id="client-mail" name="client-mail"  value="{{$client->email or ''}}" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label"  for="client-phone">Phone</label>
                        <input type="text" class="form-control col-md-7" id="client-phone" name="client-phone" value="{{$client->phone or ''}}">
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label"  for="client-mobile">Mobile</label>
                        <input type="text" class="form-control col-md-7" id="client-mobile" name="client-mobile" value="{{$client->mobile or ''}}">
                    </div>


                </div>
                <div class="col-md-6">
                    <h5 class="pb-3">Billing</h5>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label" for="currency">Currency</label>
                        <select id="currency" name="currency" class="col-md-7 col-form-label">
                            <option value="eur">EUR</option>
                            <option value="gbp">GBP</option>
                        </select>
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label"  for="client-address1">Address 1</label>
                        <input type="text" class="form-control col-md-7" id="client-address1" name="client-address1"  value="{{$client->address1 or ''}}" required>
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label"  for="client-address2">Address 2</label>
                        <input type="text" class="form-control col-md-7" id="client-address2" name="client-address2"  value="{{$client->address2 or ''}}">
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label"  for="city">City</label>
                        <input type="text" class="form-control col-md-7" id="client-city" name="client-city"   value="{{$client->city or ''}}" required>
                    </div>
                    <div class="form-row py-2">
                        <label class="col-md-4 col-form-label" for="country">Country</label>
                        @include('backend.settings.countries', [ 'id' => 'country', 'class' => 'form-control col-md-7', 'default' => $blade['user']->country])
                    </div>

                </div>
            </div>
            </div>
        </form>
    </div>
@stop
@section("js")

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop