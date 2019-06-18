@extends('frontend.masters.sign')
@section('seo')
    <title>{!! trans('seo.title_register') !!}</title>
    <meta name="description" content="{!! trans('seo.desc_register') !!}">
    <meta name="keywords" content="{!! trans('seo.keywords_register') !!}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" style="padding:20px;">
                    <div class="panel-heading"><h3>{{ trans('index.register') }}</h3></div>
                    <p><hr></p>
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
                    <div class="panel-body text-left" >
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/header-register-save') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label">{{ trans('index.login-mail') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    <input id="status" type="hidden" class="form-control" name="status" value=" {{ $status or  '' }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-12 control-label">{{ trans('index.login-password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 register">
                                    <button type="submit" class="btn btn-secondary btn-sign">
                                        <i class="fa fa-btn fa-user"></i> {{ trans('index.login-btn') }}
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                @if($ll == "de")
                                    <span style="color: #19a3b8">Bitte beachte, dass unser Service bisher nur in Englisch angeboten wird. Eine deutsche Version folgt demnächst.</span>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <p class="terms-login">
                                    {{ trans('index.login-terms1') }} <a href="https://www.trustfy.io/en/terms" >{{ trans('index.login-terms4') }}</a> {!! trans('index.login-terms2') !!} <a href="https://www.trustfy.io/en/privacy" >{{ trans('index.login-terms3') }}</a> {{ trans('index.login-terms5') }}
                                </p>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 register pt-5 text-center">
                                    <p style="font-size: 16px; padding-bottom: 0px;">
                                        {{ trans('index.login-footer3') }}
                                        <a href="/{{$ll}}/login" style="background: none; color: #19A3B8">{{ trans('index.login-footer2') }}</a> {{ trans('index.login-footer1') }}</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
