@extends('frontend.masters.sign')

@section('seo')
    <title>{!! trans('seo.title_login') !!}</title>
    <meta name="description" content="{!! trans('seo.desc_login') !!}">
    <meta name="keywords" content="{!! trans('seo.keywords_login') !!}">
@endsection

@section('content')
    @if(Session::has('error'))
        <div class="alert alert-danger error_message">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ Session::get('error') }}
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success error_message">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {!!  Session::get('success') !!}
        </div>
    @endif
<form class="form-horizontal" role="form" method="POST" action="{{ url('/login-review') }}">
    {{ csrf_field() }}

    <div class="col-md-12 pb-3">
        <h1 class="text-left">{!! trans('index.login-form2') !!}</h1>
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-12 control-label text-left font-weight-bold">E-Mail</label>
        <div class="col-md-12">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-12 control-label text-left font-weight-bold">{!! trans('index.login-form3') !!}</label>

        <div class="col-md-12">
            <input id="password" type="password" class="form-control" name="password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group sign-up">
        <div class="col-md-12 pb-3">
            <button type="submit" class="btn btn-secondary btn-sign">
                Log in
            </button>

            <a class="forget" href="{{ url('en/password/reset') }}">{!! trans('index.login-form5') !!}</a>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12 register pt-5">
            <p style="font-size: 18px; padding-bottom: 0px;">{!! trans('index.login-form1') !!}</p>
            <a class="btn btn-secondary btn-register" href="/{{$blade["locale"]}}/free-register" role="button">{!! trans('index.login-form4') !!}</a>
            <br><br>
        </div>

    </div>

</form>



 <!--
<form class="form-horizontal" role="form" method="POST" action="{{ url('/sign-up') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail</label>

        <div class="col-md-8">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Password</label>

        <div class="col-md-8">
            <input id="password" type="password" class="form-control" name="password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-secondary">
                Sign Up
            </button>
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <a id="login">Already have an account? Log in</a>
        </div>
    </div>
</form>
-->

@endsection
