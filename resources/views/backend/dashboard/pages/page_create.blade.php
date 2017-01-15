@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Aanmaken pagina | Niveau 1</title>
@stop

@section('header_title')
    Aanmaken pagina
@stop

@section('header_sub_title')
    Niveau 1
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/new_page">Aanmaken pagina | Niveau 1</a></li>
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
        {!! Form::open(array('url' => '/backend/new_page/create')) !!}
            <div class="form-group">
                <label>Titel</label>
                <input type="text" name="titel" class="form-control" placeholder="Titel" maxlength="20" required>
            </div>
            <div class="form-group">
                <label>Pagina zichtbaar?</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsVisibility" id="optionsRadios1" value="1">Ja
                    </label>
                    <label style="margin-left: 10px;">
                        <input type="radio" name="optionsVisibility" id="optionsRadios2" value="0" checked>Nee
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Subpagina's (niveau 2)?</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsSubpage" id="optionsSubpage1" value="1" checked>Ja
                    </label>
                    <label style="margin-left: 10px;">
                        <input type="radio" name="optionsSubpage" id="optionsSubpage2" value="0">Nee
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Widgets?</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsWidget" id="optionsWidget1" value="1" checked>Ja
                    </label>
                    <label style="margin-left: 10px;">
                        <input type="radio" name="optionsWidget" id="optionsWidget2" value="0">Nee
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Paginainhoud</label>
                <div class="box">
                    <div class="box-body pad">
                        <textarea class="textarea" name="body" placeholder="Inhoud van de pagina" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" > </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group buttons">
                <a href="{!! URL::to('/') !!}/backend"><button type="button" class="btn btn-default">Annuleren</button></a>
                <button type="submit" name="aanmaken" value="aanmaken_volgende" class="btn btn-primary pull-right" @permission(('page-create')) @else disabled @endpermission>Aanmaken en Volgende</button>
                <button type="submit" name="aanmaken" value="aanmaken" class="btn btn-primary pull-right" style="margin-right: 10px;" @permission(('page-create')) @else disabled @endpermission>Aanmaken</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection