@extends('auth.layout.main')

@section('title')
    <title>VDK Design | Register</title>
@stop

@section('content')
    <body class="hold-transition register-page">
    <div class="register-box">
        <div class="login-logo">
            <a href="{!! URL::to('/') !!}/backend"><b>VDK</b>Design</a>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">Register user</p>
            <form role="form" method="POST" action="{{ url('/register_admin') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <input id="name" type="text" class="form-control" placeholder="Volledige naam" name="name" value="{{ old('name') }}" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <input id="email" type="email" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <input id="password" type="password" class="form-control" placeholder="Wachtwoord" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Bevestig wachtwoord" name="password_confirmation" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="form-group">
                   {{Form::select('role', $roles, null, ['class' => 'form-control select2'])}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                        <a href="{{action('backend\IndexController@index')}}" style="color: white;"><button type="button" class="btn btn-primary btn-block btn-flat" style="margin-top: 10px;">Dashboard</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
