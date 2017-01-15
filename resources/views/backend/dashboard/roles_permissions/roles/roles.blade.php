@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Rollen</title>
@stop

@section('header_title')
    Rollen
@stop

@section('header_sub_title')
    Overzicht
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/roles">Rollen</a></li>
    </ol>
@stop

@section('content')
    @if(Session::has('succes_box_message'))
        <div class="box alert-success">
            <div class="has-success">
                <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> {{ Session::get('succes_box_message') }}</label>
            </div>
        </div>
    @endif
    @if(Session::has('error_box_message'))
        <div class="box alert-danger">
            <div class="has-error">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ Session::get('error_box_message') }}</label>
            </div>
        </div>
    @endif
    @if(count($errors) != 0)
        <div class="box alert-warning">
            <div class="has-warning">
                @foreach ($errors->all() as $error)
                    <p class="control-label" for="inputError"><i class="fa fa-arrow-right"></i> {{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif
    <div class="overview_all_permissions">
        <div class="row">
            <a href="{{ URL::to('/backend/roles/new')}}" class="btn btn-app">
                <i class="fa fa-plus-square-o"></i> Rol
            </a>
        </div>
        <section class="content">
            <div class="row page">
                <section class="content">
                    <div class="row">
                        <div class="box">
                            <div class="box-body">
                                <table id="data_table" class="display table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Rol - Functie</th>
                                        <th>Rol - Code</th>
                                        <th>Rol - Omschrijving</th>
                                        <th>Actie</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($roles) != null)
                                        @foreach($roles as $value)
                                            <tr>
                                                <td>{{$value->id}}</td>
                                                <td>{{$value->display_name}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->description}}</td>
                                                <td>
                                                    <div class="col-lg-4 col-md-4 col-xs-4" style="text-align: center;">
                                                        <a href="{{ URL::to('/backend/roles/'.$value->id.'/edit') }}" title="Wijzig de rol"><i class="glyphicon glyphicon-pencil"></i></a>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-xs-4" style="text-align: center;">
                                                        @if($value->deleted_at != null)
                                                            {!! Form::open(array('url' => '/backend/roles/' . $value->id.'/unlock')) !!}
                                                            <a title="De rol ontgrendelen"><i class="fa fa-lock" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Rol ontgrendelen?"  data-message="Wilt u de rol '{{$value->display_name}}' ontgrendelen?" ></i></a>
                                                            {!! Form::close() !!}
                                                        @else
                                                            {!! Form::open(array('url' => '/backend/roles/' . $value->id.'/lock')) !!}
                                                            <a title="De rol vergrendelen"><i class="fa fa-unlock" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Rol vergrendelen?"  data-message="Wilt u de rol '{{$value->display_name}}' vergrendelen?" ></i></a>
                                                            {!! Form::close() !!}
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-xs-4" style="text-align: center;">
                                                        @if($value->deleted_at != null)
                                                            <a title="Unlock de toegang om te verwijderen"><i class="glyphicon glyphicon-ban-circle"></i></a>
                                                        @else
                                                            {!! Form::open(array('url' => '/backend/roles/' . $value->id.'/delete')) !!}
                                                            <a title="De toegang verwijderen"><i class="glyphicon glyphicon-trash" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Rol verwijderen?"  data-message="Wilt u de rol '{{$value->display_name}}' verwijderen?" ></i></a>
                                                            {!! Form::close() !!}
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Rol - Functie</th>
                                        <th>Rol - Code</th>
                                        <th>Rol - Omschrijving</th>
                                        <th>Actie</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
    <!-- Modal Dialog -->
    <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Verwijder volledig uit het systeem</h4>
                </div>
                <div class="modal-body">
                    <p>Bent u het zeker?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirm">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>
@endsection