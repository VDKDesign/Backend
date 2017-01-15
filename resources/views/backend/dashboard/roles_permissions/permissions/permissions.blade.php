@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Toegangsrechten</title>
@stop

@section('header_title')
    Toegangsrechten
@stop

@section('header_sub_title')
    Overzicht
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/permissions">Toegangsrechten</a></li>
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
            <a href="{{ URL::to('/backend/permissions/new')}}" class="btn btn-app">
                <i class="fa fa-plus-square-o"></i> Toegang
            </a>
        </div>
        <section class="content">
            <div class="row page">
                @foreach($permission_categories as $value)
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
                                            <th>ID</th>
                                            <th>Toegang - Functie</th>
                                            <th>Toegang - Code</th>
                                            <th>Toegang - Omschrijving</th>
                                            <th>Actie</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($value->permissions) != null)
                                                @foreach($value->permissions as $subValue)
                                                    <tr>
                                                        <td>{{$subValue->id}}</td>
                                                        <td>{{$subValue->display_name}}</td>
                                                        <td>{{$subValue->name}}</td>
                                                        <td>{{$subValue->description}}</td>
                                                        <td>
                                                            <div class="col-lg-4 col-md-4 col-xs-4" style="text-align: center;">
                                                                <a href="{{ URL::to('/backend/permissions/'.$subValue->id.'/edit') }}" title="Wijzig de toegang"><i class="glyphicon glyphicon-pencil"></i></a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-xs-4" style="text-align: center;">
                                                                @if($subValue->deleted_at != null)
                                                                    {!! Form::open(array('url' => '/backend/permissions/' . $subValue->id.'/unlock')) !!}
                                                                    <a title="De toegang ontgrendelen"><i class="fa fa-lock" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Toegang ontgrendelen?"  data-message="Wilt u de toegang '{{$subValue->display_name}}' van  de categorie '{{$value->name}}' ontgrendelen?" ></i></a>
                                                                    {!! Form::close() !!}
                                                                @else
                                                                    {!! Form::open(array('url' => '/backend/permissions/' . $subValue->id.'/lock')) !!}
                                                                    <a title="De toegang vergrendelen"><i class="fa fa-unlock" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Toegang vergrendelen?"  data-message="Wilt u de toegang '{{$subValue->display_name}}' van  de categorie '{{$value->name}}' vergrendelen?" ></i></a>
                                                                    {!! Form::close() !!}
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-xs-4" style="text-align: center;">
                                                                @if($subValue->deleted_at != null)
                                                                    <a title="Unlock de toegang om te verwijderen"><i class="glyphicon glyphicon-ban-circle"></i></a>
                                                                @else
                                                                    {!! Form::open(array('url' => '/backend/permissions/' . $subValue->id.'/delete')) !!}
                                                                    <a title="De toegang verwijderen"><i class="glyphicon glyphicon-trash" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Toegang verwijderen?"  data-message="Wilt u de toegang '{{$subValue->display_name}}' van  de '{{$subValue->name}}' verwijderen?" ></i></a>
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
                                            <th>ID</th>
                                            <th>Toegang - Functie</th>
                                            <th>Toegang - Code</th>
                                            <th>Toegang - Omschrijving</th>
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