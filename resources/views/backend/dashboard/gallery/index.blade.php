@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Gallerij</title>
@stop

@section('header_title')
    Gallerij
@stop

@section('header_sub_title')
    Overzicht
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/gallerij">Gallerij</a></li>
    </ol>
@stop

@section('content')
    <div class="gallery">
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
    </div>

@endsection