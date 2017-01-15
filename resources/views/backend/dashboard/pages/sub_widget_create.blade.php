@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Aanmaken widget | Niveau 2</title>
@stop

@section('header_title')
    Aanmaken widget
@stop

@section('header_sub_title')
    Niveau 2
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/new_sub_widget_2">Aanmaken widget | Niveau 2</a></li>
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
        {!! Form::open(array('url' => '/backend/new_sub_widget_2/create')) !!}
            <div class="box-header-sub">
                <h3 class="box-title">Algemene eigenschappen</h3>
            </div>
            <div class="form-group">
                <label>Subpagina</label>
                <select class="form-control select2" name="subpagina" style="width: 100%;" >
                    <option value="" selected="selected">-- Kies een pagina (niveau 2) --</option>
                    @foreach($menu_items as $value)
                        <option value="{{$value->id}}" disabled="disabled">{{$value->title}}</option>
                        @foreach($value->menu_sub_items as $subValue)
                            <option value="{{$subValue->id}}" @if(isset($id)){{ $id == $subValue->id ? 'selected="selected"' : '' }}@endif >{{$subValue->title}}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Titel</label>
                <input type="text" name="titel" class="form-control" placeholder="Titel" maxlength="20" required>
            </div>
            <div class="form-group">
                <label>Omschrijving</label>
                <input type="text" name="description" class="form-control" placeholder="Omschrijving" maxlength="35" required>
            </div>
            <div class="form-group">
                <label>Widget icoon</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input data-placement="topLeft" name="icon" class="form-control icp icp-auto" value="fa-star-o" type="text" required />
                </div>
            </div>
            <div class="box-header-sub">
                <h3 class="box-title">Specifieke eigenschappen</h3>
            </div>
            <div class="form-group">
                <label>Keuzelijst</label>
                <select class="form-control select2" name="extra" style="width: 100%;" required>
                    <option value="1" selected="selected">Test1</option>
                    <option value="2">Test2</option>
                    <option value="3">Test3</option>
                    <option value="4">Test4</option>
                </select>
            </div>
            <div class="form-group buttons">
                <a href="{!! URL::to('/') !!}/backend"><button type="button" class="btn btn-default">Annuleren</button></a>
                <button type="submit" name="aanmaken" value="aanmaken_volgende" class="btn btn-primary pull-right">Aanmaken en Volgende</button>
                <button type="submit" name="aanmaken" value="aanmaken" class="btn btn-primary pull-right" style="margin-right: 10px;">Aanmaken</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection