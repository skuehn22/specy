@extends('frontend.masters.intern')

@section('seo')
    <title>trustfy.io - intern</title>
@stop


@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success error_message">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="/{{$blade["ll"]}}/admin/users/delete" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-row py-2">
                    <input type="email" class="form-control col-md-6" id="delete-mail" name="delete-mail" placeholder="E-Mail" required>
                    <button style="margin-left: 10px;" type="submit" class="btn btn-success">Delete User</button>
                </div>
            </div>
        </div>
    </form>

@stop


@section("js")

    <script>

    </script>

@stop