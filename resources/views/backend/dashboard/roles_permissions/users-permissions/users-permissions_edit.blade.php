@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Gebruikersrecht wijzigen</title>
@stop

@section('header_title')
    Gebruikersrecht
@stop

@section('header_sub_title')
    Wijzigen
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/users-permissions">Gebruikersrechten</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/users-permissions/{{$permission_id}}/{{$role_id}}/edit">Gebruikersrecht wijzigen</a></li>
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
        {!! Form::open(array('url' => '/backend/users-permissions/'.$permission_id.'/'.$role_id.'/edit')) !!}
            <div class="form-group">
                <label>Gebruikersrollen</label>
                {{Form::select('role', $roles, $role_id, ['class' => 'form-control select2'])}}
            </div>
            <div class="form-group">
                <label>Toegangsrechten</label>
                <select class="form-control select2" name="permission" style="width: 100%;" >
                    <option value="0" selected="selected">-- Kies een toegangsrecht --</option>
                    @foreach($permission_categories as $value)
                        <option value="{{$value->id}}" disabled="disabled">{{$value->name}}</option>
                        @foreach($value->permissions as $subValue)
                            <option value="{{$subValue->id}}" @if(isset($permission_id)){{ $permission_id == $subValue->id ? 'selected="selected"' : '' }}@endif>{{$subValue->display_name}}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="form-group buttons">
                <a href="{!! URL::to('/') !!}/backend/users-permissions"><button type="button" class="btn btn-default">Annuleren</button></a>
                <button type="submit" class="btn btn-primary pull-right" @permission(('user-permissions-edit')) @else disabled @endpermission>Wijzigen</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection