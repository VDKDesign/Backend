@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Users | {{$user->name}}</title>
@stop

@section('header_title')
    {{$user->name}}
@stop

@section('header_sub_title')
    Gebruiker
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/users">Gebruikers</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/user/{{$user->id}}/edit">{{$user->name}}</a></li>
    </ol>
@stop

@section('content')
    <div class="form_page_editor">
        @if(Session::has('succes_box_message'))
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Succesvol!</h4>
                {{ Session::get('succes_box_message') }}
            </div>
        @endif

        @if(Session::has('error_box_message'))
            <div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                {{ Session::get('error_box_message') }}
            </div>
        @endif
        @if(count($errors) != 0)
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Opgelet!</h4>
                @foreach ($errors->all() as $error)
                    <p class="control-label" for="inputError"><i class="fa fa-arrow-right"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif
        {!! Form::open(array('url' => '/backend/user/'.$user->id.'/edit')) !!}
            <div class="form-group">
                <label>Naam</label>
                <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="Naam" @permission(('user-edit')) required @else disabled @endpermission>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="email" @permission(('user-edit')) required @else disabled @endpermission>
            </div>
            <div class="form-group buttons">
                <a href="{!! URL::to('/') !!}/backend/users"><button type="button" class="btn btn-default">Annuleren</button></a>
                <button type="submit" class="btn btn-primary pull-right" @permission(('user-edit')) @else disabled @endpermission>Wijzigen</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection