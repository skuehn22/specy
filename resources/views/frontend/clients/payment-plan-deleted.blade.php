@extends('frontend.masters.paymentplan')

@section('seo')
    <title>Trustfy Login</title>
@endsection


@section('css')

    <style>

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid @if(isset($company->color) ) {{ $company->color }} @else #28a745 @endif;
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid @if(isset($company->color) ) {{ $company->color }} @else #28a745 @endif;
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: @if(isset($company->color) ) {{ $company->color }} @else #28a745 @endif;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: @if(isset($company->color) ) {{ $company->color }} @else #28a745 @endif;
            width: 25px;
        }

        .invoice table .total {
            background:@if(isset($company->color) ) {{ $company->color }} @else #28a745 @endif;
            color: #fff
        }

        .invoice table tfoot tr:last-child td {
            color: #19A3B8;
            font-size: 1.4em;
            border-top: 1px solid @if(isset($company->color) ) {{ $company->color }} @else #28a745 @endif;
        }

        .blur {
            -webkit-filter: blur(2px);
            filter: blur(8px);
        }

        .modal-dialog {
            max-width: 400px;
            margin: 1.75rem auto;
        }

        .footer-txt {
            color: #aaa;
            font-size: 11px;
            text-align: center;
        }

        .footer-txt a{
            color: #aaa;
            font-size: 11px;
            text-align: center;
        }

    </style>


@endsection

@section('content')

    <div class="row blur" id="invoice">
        <!--
            <div class="toolbar hidden-print">
                <div class="text-right">
                    <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                    <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                </div>
                <hr>
            </div>-->
        @if(isset($preview))
            <div class="col col-lg-12 invoice overflow-auto">
                @else
                    <div class="col col-lg-8 col-md-12 col-sm-12 invoice overflow-auto">
                        @endif

                        <header>
                            @if(Session::has('error'))
                                <div class="alert alert-danger error_message">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            @if(isset($protect) && $protect == true)
                                <div class="alert alert-success success_message">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    Thank you. The Payment Plan Protection is now active.
                                </div>
                            @endif
                            <div class="row">
                                <div class="col">
                                    @if(isset($company->logo) && $company->logo!="3.png")
                                        @if( file_exists(public_path('uploads/companies/logo/'.$company->logo)))
                                            <img src="{{ asset('uploads/companies/logo/'.$company->logo)}}" data-holder-rendered="true" style="width: 200px;" />
                                        @endif
                                    @endif
                                </div>
                                <div class="col company-details">
                                    <h3 class="name">
                                        {!! $company->name or '<i>please fill in</i>' !!}
                                    </h3>
                                    <div>
                                        {{$company->address1 or ''}}<br>
                                        @if(strlen($company->address2)>1){{$company->address2 or ''}}<br> @endif
                                        @if(strlen($company->postcode)>1) {{$company->postcode or ''}}, @endif
                                        {{$company->city or ''}}
                                    </div>
                                    <div>  {{$user->email or ''}}</div>
                                    <div> {{$user->phone or ''}}</div>
                                </div>
                            </div>
                        </header>


                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    @if(isset($plan->lastname) && $plan->lastname!=" ")
                                        <h5 class="to">{{$plan->firstname}} {{$plan->lastname}}</h5>
                                        <div class="address">{{$plan->address1}} {{$plan->address2}} {{$plan->city}}</div>
                                        <div class="email">{{$plan->email}}</div>
                                    @else
                                        <i>please fill in</i>
                                    @endif
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">Payment Plan</h1>
                                    <div class="date"></div>

                                </div>
                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id"style="text-align: left; padding-top: 25px; padding-bottom: 10px;">{{$plan->name}}</h1>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">DESCRIPTION</th>
                                    <th class="text-right"></th>
                                    <th class="text-right"></th>
                                    <th class="text-right"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="no">01</td>
                                    <td class="text-left" style="width:35%;">
                                        The Plan was deleted!
                                    </td>

                                    <td class="qty">



                                    </td>
                                    <td class="qty" style="width:16%;"></td>
                                    <td style="text-align: right;">


                                    </td>
                                </tr>


                                </tbody>

                            </table>

                        </main>
                        <footer>

                            <p class="more"><a href="https://www.trustfy.io" target="_blank">Learn more about trustfy.io</a></p>
                        </footer>

                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
            </div></div>


    <!-- Modal -->
    <div class="modal fade" id="plan-deleted-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center"  id="modal-body-msg">
                    <h4 class="modal-title-msg" id="modal-title-msg">Payment plan deleted</h4>
                    <p style="padding-top: 15px; font-size: 13px;">
                        The plan was deleted by   {!! $company->name !!}. <br>Please get in contact.
                    </p>
                </div>
                <div class="text-center">
                    <hr>
                    <span class="footer-txt"><a href="https://www.trustfy.io">Powered by Trustfy</a></span>
                    <br><br>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>

        $( document ).ready(function() {
            $('#plan-deleted-modal').modal('show');
        });


    </script>

@endsection

