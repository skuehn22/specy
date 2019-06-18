@extends('backend.masters.freelancer')
@section('seo')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
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
            border: 1px solid #999;
            border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn:hover, .table-title .btn:focus {
            color: #566787;
            background: #f2f2f2;
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
            padding: 12px 15px;
            vertical-align: middle;
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
        .status {
            font-size: 30px;
            margin: 2px 2px 0 0;
            display: inline-block;
            vertical-align: middle;
            line-height: 10px;
        }
        .text-success {
            color: #10c469;
        }
        .text-info {
            color: #62c9e8;
        }
        .text-warning {
            color: #FFC107;
        }
        .text-danger {
            color: #ff5b5b;
        }
        .pagination {
            float: right;
            margin: 0 0 5px;
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

    </style>

@stop

@section('content')
<div class="clients">

@if(Session::has('success'))
        <div class="alert alert-success error_message">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-5">
                    <h2>Projects</h2>
                </div>
                <div class="col-sm-7 float-right text-right">
                    <a href="/{{$blade["ll"]}}/freelancer/projects/new" class="btn btn-default btn-lg active" role="button" aria-pressed="true">Add Project</a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th style="width: 15%;">Date Created</th>
                <th style="width: 15%;">Client</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @if(isset($projects))
                @foreach($projects as $project)
                    <tr>
                        <td style="width:20%;">{{$project->name}}</td>
                        <td>{{ \Carbon\Carbon::parse($project->created_at)->format('d/m/Y')}} </td>
                        <td>{{$project->firstname}} {{$project->lastname}}</td>
                        <td>{{$project->desc}}</td>
                        <td>
                            <a href="/{{$blade["ll"]}}/freelancer/projects/edit/{{$project->id}}" data-toggle="tooltip" data-placement="right" title="Edit"><i class="far fa-edit green"></i></a>
                            <span data-toggle="modal" data-target="#exampleModal">
                                <a href="#" data-id="{{$project->id}}"  data-toggle="tooltip"  data-placement="right" title="Delete" class="delete-project">
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
                <form action="/{{$blade["ll"]}}/freelancer/projects/delete/" id="deleteform" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
@section("javascript")

    <script>

        $(document).on("click", ".delete-project", function () {
            var myBookId = $(this).data('id');
            var url = "/en/freelancer/projects/delete/"+myBookId;
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