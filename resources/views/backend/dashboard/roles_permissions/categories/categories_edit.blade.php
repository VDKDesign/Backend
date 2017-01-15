@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Categorieën | {{$category->name}}</title>
@stop

@section('header_title')
    {{$category->name}}
@stop

@section('header_sub_title')
    Categorieën
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/categories">Categorieën</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/categories/{{$category->id}}/edit">{{$category->name}}</a></li>
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
        {!! Form::open(array('url' => '/backend/categories/'.$category->id.'/edit')) !!}
            <div class="form-group">
                <label>Functie</label>
                <input type="text" name="name" class="form-control" value="{{$category->name}}" placeholder="Naam" @permission(('category-edit')) required @else disabled @endpermission>
            </div>
            <div class="form-group">
                <label>Omschrijving</label>
                <input type="text" name="description" class="form-control" value="{{$category->description}}" placeholder="Omschrijving" @permission(('category-edit')) required @else disabled @endpermission>
            </div>

            <div class="form-group buttons">
                <a href="{!! URL::to('/') !!}/backend/categories"><button type="button" class="btn btn-default">Annuleren</button></a>
                <button type="submit" class="btn btn-primary pull-right" @permission(('category-edit')) @else disabled @endpermission>Wijzigen</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection