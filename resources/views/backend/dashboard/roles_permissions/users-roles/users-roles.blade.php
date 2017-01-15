@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Gebruikersrollen</title>
@stop

@section('header_title')
    Gebruikersrollen
@stop

@section('header_sub_title')
    Overzicht
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/users-roles">Gebruikersrollen</a></li>
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
    <div class="overview_all_user_permissions">
        <div class="row">
            <a href="{{ URL::to('/backend/users-roles/link')}}" class="btn btn-app">
                <i class="fa fa-link"></i> Koppelen
            </a>
        </div>
        <section class="content">
            <div class="row page">
                @foreach($users as $value)
                    <section class="content">
                        <div class="row">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">{{$value->name}}
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <table id="data_table" class="display table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Rol - Code</th>
                                            <th>Rol - Functie</th>
                                            <th>Rol - Omschrijving</th>
                                            <th>Actie</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($value->roles) != null)
                                                @foreach($value->roles as $subValue)
                                                    <tr>
                                                        <td>{{$subValue->id}}</td>
                                                        <td>{{$subValue->name}}</td>
                                                        <td>{{$subValue->display_name}}</td>
                                                        <td>{{$subValue->description}}</td>
                                                        <td>
                                                            <div class="col-lg-4 col-md-4 col-xs-4" style="text-align: center;">
                                                                <a href="{{ URL::to('/backend/users-roles/'.$subValue->id.'/'.$value->id.'/edit') }}" title="Wijzig de gebruikersrollen"><i class="glyphicon glyphicon-pencil"></i></a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-xs-4" style="text-align: center;">
                                                                @if($subValue->deleted_at != null)
                                                                    {!! Form::open(array('url' => '/backend/users-roles/' . $subValue->id.'/unlock')) !!}
                                                                    <a title="De gebruikersrol ontgrendelen"><i class="fa fa-lock" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Gebruikersrol ontgrendelen?"  data-message="Wilt u de rol '{{$subValue->display_name}}' van '{{$value->name}}' ontgrendelen?" ></i></a>
                                                                    {!! Form::close() !!}
                                                                @else
                                                                    {!! Form::open(array('url' => '/backend/users-roles/' . $subValue->id.'/lock')) !!}
                                                                        <a title="De gebruikersrol vergrendelen"><i class="fa fa-unlock" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Gebruikersrol vergrendelen?"  data-message="Wilt u de rol '{{$subValue->display_name}}' van '{{$value->name}}' vergrendelen?" ></i></a>
                                                                    {!! Form::close() !!}
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-xs-4" style="text-align: center;">
                                                                @if($subValue->deleted_at != null)
                                                                    <a title="Unlock de toegang om te verwijderen"><i class="glyphicon glyphicon-ban-circle"></i></a>
                                                                @else
                                                                    {!! Form::open(array('url' => '/backend/users-roles/'.$subValue->id.'/'.$value->id.'/delete')) !!}
                                                                        <a title="De gebruikersrol verwijderen"><i class="glyphicon glyphicon-trash" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Gebruikersrol verwijderen?"  data-message="Wilt u de rol '{{$subValue->display_name}}' van '{{$value->name}}' verwijderen?" ></i></a>
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
                                                    <td>-</td>
                                                </tr>
                                            @endif
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th>Category</th>
                                            <th>Rol - Code</th>
                                            <th>Rol - Functie</th>
                                            <th>Rol - Omschrijving</th>
                                            <th>Actie</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                @endforeach
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