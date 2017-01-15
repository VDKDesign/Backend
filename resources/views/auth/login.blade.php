@extends('auth.layout.main')

@section('title')
    <title>VDK Design | Login</title>
@stop

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{!! URL::to('/') !!}/backend"><b>VDK</b>Design</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Backend Login</p>
            <form role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    <input id="email" type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <input id="password" type="password" class="form-control" name="password" placeholder="Wachtwoord" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row form-group">
                    <div class="col-md-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Wachtwoord onthouden
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
