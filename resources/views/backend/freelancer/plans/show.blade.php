@extends('backend.masters.freelancer')
@section('css')
    <link href="{{ asset('css/backend/freelancer/bootstrap_4_0.css')}}" rel="stylesheet">
    <link href="{{ asset('css/backend/freelancer/paymentPlan.css')}}" rel="stylesheet">

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


        a:hover {
            color: #fff;
            text-decoration: underline;
        }

        /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip-main {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            font-weight: 700;
            background: #f3f3f3;
            border: 1px solid #737373;
            color: #737373;
            margin: 4px 121px 0 5px;
            float: right;
            text-align: left !important;
        }

        .tooltip-qm {
            float: left;
            margin: -2px 0px 3px 4px;
            font-size: 12px;
        }

        .tooltip-inner {
            max-width: 236px !important;
            height: 76px;
            font-size: 12px;
            padding: 10px 15px 10px 20px;
            background: #FFFFFF;
            color: rgb(0, 0, 0, .7);
            border: 1px solid #737373;
            text-align: left;
        }

        .tooltip.show {
            opacity: 1;
        }


    </style>


@stop

@section('content')


    <div class="row" id="invoice">
        <!--
            <div class="toolbar hidden-print">
                <div class="text-right">
                    <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                    <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                </div>
                <hr>
            </div>-->

        <div class="col col-lg-9 col-md-12 col-sm-12 invoice overflow-auto">
            <header>
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
                        <h3 class="name" style="padding-right:0px;">
                            {!! $company->name or '<i>please fill in</i>' !!}
                        </h3>
                        <div>
                            {{$company->address1 or ''}}<br>
                            @if(strlen($company->address2)>1){{$company->address2 or ''}}<br> @endif
                            @if(strlen($company->postcode)>1) {{$company->postcode or ''}}, <br>@endif
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
                            <div class="address">{{$plan->address1}} <br>
                                @if(strlen($plan->address2)>1){{$plan->address2 or ''}}<br> @endif
                                {{$plan->city}}</div>
                            <div class="email">{{$plan->email}}</div>
                        @else
                            <i>please fill in</i>
                        @endif
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id" style="text-align: right;">Payment Plan</h1>
                        <div class="date">Date of Invoice: {{ \Carbon\Carbon::parse($plan->date)->format('d/m/Y')}} </div>

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
                        <th class="text-right">DUE ON</th>
                        <th class="text-right">TOTAL</th>
                        <th class="text-right">PAYMENT STATUS</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($milestones as $milestone)

                    <tr>
                        <td class="no">0{{ $milestone->order }}</td>
                        <td class="text-left" style="width:30%;">
                            <strong>{!!  $milestone->name or '<i>please fill in</i>'!!}</strong><br>
                            <input type="hidden" value="{{$milestone->name}}" id="name_{{$milestone->id}}">
                            @if(isset($milestone->desc) && $milestone->desc!="") -  {{$milestone->desc}} @endif
                        </td>

                        <td class="qty"> @if(isset($milestone->due_at)) {{ \Carbon\Carbon::parse($milestone->due_at)->format('d/m/Y')}} @else  <i>please fill in</i> @endif</td>
                        <td class="qty"  style="width:16%;"> @if(isset($milestone->amount)){{$milestone->currency}} {{ number_format($milestone->amount, 2, '.', ',') }} @else  <i>please fill in</i> @endif</td>
                        <td class="text-right">

                                <p style="color:{{ $milestone->status['color'] }}; padding-top: 12px;" id="plan-status-{{$milestone->id}}">

                                    <i><strong>{{ $milestone->status['state'] }}</strong></i>
                                    <i class="fas fa-info-circle green  pl-2" data-toggle="tooltip" data-placement="top" title="{{ $milestone->status['info'] }}"></i>


                                    @if($milestone->paystatus==2)
                                        <span class="input-group-btn" style="padding-left: 5px;">
                                         <button class="btn btn-success work-done" id="{{$milestone->id}}">Request Release</button>
                                        </span>
                                    @endif

                                </p>

                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                    <!--
                    <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">SUBTOTAL</td>
                        <td>$5,200.00</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">TAX 25%</td>
                        <td>$1,300.00</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">GRAND TOTAL</td>
                        <td>$6,500.00</td>
                    </tr>
                    </tfoot>
                    -->
                </table>

                @if(isset($docs) && count($docs)>0)

                    <div class="docs">

                        Relevant Documents:

                        @if(isset($docs))
                            @foreach($docs as $doc)

                                <p class="{{$doc->id}}">
                                    <a target="_blank" href="/uploads/companies/contracts/{{$plan->id}}/{{$doc->filename}}" style="color: #19A3B8;">{{$doc->name}}</a>
                                    <a href="#"  style="color: #19A3B8;" data-id="{{$doc->id}}" data-toggle="tooltip" data-placement="top" title="" class="delete-doc" data-original-title="Delete">
                                        <i  style="color: #19A3B8;" class="fas fa-trash green"></i>
                                    </a>
                                </p>

                            @endforeach
                        @endif

                    </div>

                @endif

                <div class="thanks">Thank you!</div>
                @if($plan->comment!=null)
                    <div class="notices">
                        <div>NOTICE:</div>
                        <div class="notice">{{$plan->comment}}</div>
                    </div>
                @endif
            </main>
            <footer>
                Payment Plan was created on a computer and is valid without the signature and seal.
                <p class="more"><a href="https://www.trustfy.io" target="_blank">Learn more about trustfy.io</a></p>
            </footer>

            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 350px;">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Work completed</h5>
                    <p style="font-size: 12px;">
                        Great! Your client has been notified <br> and can release your payment.
                    </p>
                    <p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="release-money" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 314px;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="alert alert-error login-error d-none">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <div class="login-error-msg"></div>
                    </div>
                    <h4 class="modal-title-msg" id="modal-title-msg">Mark this milestone as complete?</h4>

                </div>
                <div class="modal-body"  id="modal-body-msg">
                    <p>Your client will be notified that work is complete and can release payment.</p>
                    <div class="form-check form-check-inline">
                        <div id="milestone-done" name="milestone-done" class="pr-5"></div>
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                        <button id="do-release" type="button" class="btn btn-success work-done-confirm">
                            <span class="ui-button-text">My Text</span>
                        </button>
                        <input type="hidden" value="" id="completed-milestone">
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


@stop
@section("javascript")

    <script>

        // External Button Events
        $(".work-done").on("click", function() {

            var id = $(this).attr("id");
            var name =   $('#name_'+$(this).attr("id")).val();

            $("#completed-milestone").val(id);
            $('#milestone-done').html("Milestone completed: " +name);
            $("#do-release span").text("Confirm");

            $('#release-money').modal('show');

            return true;
        });

        // External Button Events
        $(".work-done-confirm").on("click", function() {

            var id =  $("#completed-milestone").val();
            /*var name =   $('#name_'+$(this).attr("id")).val();*/

            $.ajax({
                type: 'GET',
                url: '{{env("MYHTTP")}}/{{$blade["ll"]}}/freelancer/plans/work-done/'+id,
                data: { variable: id },
                dataType: 'json',

                success: function(data) {


                    $('#plan-status-'+id).html(' <i><strong>work completed</strong></i><i class="fas fa-info-circle green  pl-2" style="color: #7f7f7f;" data-toggle="tooltip" data-placement="top" title="Waiting for the customer to release the money."></i>');
                    $('#release-money').modal('hide');
                    $('#doneModal').modal('show');

                }
            });
        });


    </script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })




    </script>
@stop