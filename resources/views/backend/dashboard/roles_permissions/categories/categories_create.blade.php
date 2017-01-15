@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Categorie aanmaken</title>
@stop

@section('header_title')
    Categorie
@stop

@section('header_sub_title')
    Aanmaken
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/categories">Categorieën</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/categories/new">Categorie aanmaken</a></li>
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
        {!! Form::open(array('url' => '/backend/categories/new')) !!}
            <div class="form-group">
                <label>Functie</label>
                <input type="text" name="name" class="form-control" placeholder="Naam" @permission(('category-create')) required @else disabled @endpermission>
            </div>
            <div class="form-group">
                <label>Omschrijving</label>
                <input type="text" name="description" class="form-control" placeholder="Omschrijving" @permission(('category-create')) required @else disabled @endpermission>
            </div>

            <div class="form-group buttons">
                <a href="{!! URL::to('/') !!}/backend/categories"><button type="button" class="btn btn-default">Annuleren</button></a>
                <button type="submit" class="btn btn-primary pull-right" @permission(('category-create')) @else disabled @endpermission>Aanmaken</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection