@extends('backend.masters.freelancer')
@section('seo')

@stop
@section('css')

    <style type="text/css">
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

        .table-title .btn {
            color: #566787;
            padding: 10px;
            font-size: 14px;
        }


        .table-title .btn:hover, .table-title .btn:focus {
            color: #566787;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }


        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            padding: 5px;
            vertical-align: middle;
        }

        /*Large devices (desktops, 992px and up)*/
        @media (min-width: 992px) {
            table.table tr th, table.table tr td {
                border-color: #e9e9e9;
                padding: 12px 15px;
                vertical-align: middle;
            }
        }

        /*Extra large devices (large desktops, 1200px and up)*/
        @media (min-width: 1200px) {
            table.table tr th, table.table tr td {
                border-color: #e9e9e9;
                padding: 12px 15px;
                vertical-align: middle;
            }
        }



        table.table tr th:first-child {
            width: 60px;
        }
        table.table tr th:last-child {
            width: 100px;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table td:last-child i {
            opacity: 0.9;
            font-size: 17px;
            margin: 0 5px;
        }
        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
        }
        table.table td a:hover {
            color: #2196F3;
        }
        table.table td a.settings {
            color: #2196F3;
        }
        table.table td a.delete {
            color: #F44336;
        }
        table.table td i {
            font-size: 19px;
        }
        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }


        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }
        .pagination li a:hover {
            color: #666;
        }
        .pagination li.active a, .pagination li.active a.page-link {
            background: #03A9F4;
        }
        .pagination li.active a:hover {
            background: #0397d6;
        }
        .pagination li.disabled i {
            color: #ccc;
        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }
        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        .modal-content {
            min-height: 200px;
        }



        /*Large devices (desktops, 992px and up)*/
        @media (min-width: 992px) {
            .new-button{
                text-align: right;
                float: right;
            }
        }

        /*Extra large devices (large desktops, 1200px and up)*/
        @media (min-width: 1200px) {
            .new-button{
                text-align: right;
                float: right;
            }
        }


    </style>

@stop

@section('content')
        @if(Session::has('success'))
            <div class="pt-5">
                <div class="alert alert-success error_message">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif

        @if(Session::has('error'))
            <div class="pt-5">
                <div class="alert alert-danger error_message pt-3">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('error') }}
                </div>
            </div>
        @endif

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-xs-12 col-sm-5">
                        <h2>Payment Plans</h2>
                    </div>
                    <div class="col-xs-12 col-sm-7 new-button pt-3">
                        <a href="/{{$blade["ll"]}}/freelancer/plans/new" class="btn btn-default btn-lg active" style="color: #fff;" role="button" aria-pressed="true">Create Plan</a>
                    </div>

                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th style="width:25%;">Name</th>

                    <th style="width:25%;">Client</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @if(isset($plans))
                    @foreach($plans as $plan)
                        <tr>
                            <td>
                                @if($plan->state > 0)
                                    <a href="/{{$blade["ll"]}}/freelancer/plans/payment-plan/{{$plan->hash}}" data-toggle="tooltip" data-placement="top" title="Show">
                                        {{ $plan->name or 'not set' }}
                                    </a>
                                @else
                                    <a href="/{{$blade["ll"]}}/freelancer/plans/edit/{{$plan->id}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                        {{ $plan->name or 'not set' }}
                                    </a>
                                @endif
                            </td>

                            <td>{{$plan->firstname}} {{$plan->lastname}}</td>
                            <td><span class="status {{$plan->color}}">&bull;</span> {{$plan->state_txt}}</td>

                            <td>

                                @if($plan->state > 0)
                                    <a href="/{{$blade["ll"]}}/freelancer/plans/payment-plan/{{$plan->hash}}" data-toggle="tooltip" data-placement="top" title="Show">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @else
                                    <a href="/{{$blade["ll"]}}/freelancer/plans/edit/{{$plan->id}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="far fa-edit green"></i>
                                    </a>
                                @endif

                                <span data-toggle="modal" data-target="#exampleModal">
                                    <a href="#" data-id="{{$plan->id}}"  data-toggle="tooltip" data-placement="top"  title="Delete" class="delete-client">
                                        <i class="fas fa-trash green"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                    You have no payment plans yet...
                @endif
                </tbody>
            </table>
        </div>




    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form action="/{{$blade["ll"]}}/freelancer/plans/delete/" id="deleteform" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p>
                            Are you sure you want to delete this plan? Your client will not be able to access it or make payments any more.
                        </p>
                        <button type="button" class="btn btn-secondary" style="width:80px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" style="width:80px;">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@section("javascript")

    <script>

        $(document).on("click", ".delete-client", function () {
            var myBookId = $(this).data('id');
            var url = "/en/freelancer/plans/delete/"+myBookId;
            $('#deleteform').attr('action', url);
        });


        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $('#modal-from-dom').on('show', function() {
            var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');

            removeBtn.attr('href', removeBtn.attr('href').replace(/(&|\?)ref=\d*/, '$1ref=' + id));

            $('#debug-url').html('Delete URL: <strong>' + removeBtn.attr('href') + '</strong>');
        });

        $('.confirm-delete').on('click', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            $('#modal-from-dom').data('id', id).modal('show');
        });
    </script>
@stop