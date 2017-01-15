@extends('frontend.layout.main')

@section('meta_data')
    <meta property="og:title" content="">
    <meta property="og:image" content="{!! URL::to('/') !!}/img/frontend/">
    <meta property="og:description" content="">
    <meta name="description" content="">
@stop

@section('title')
    <title> - </title>
@stop

@section('content')
    <div class="message">
        @if(Session::has('message'))
            <div class="alert alert-succes container">
                <p class="col-lg-11 col-md-11 col-xs-10">{{ Session::get('message') }}</p>
                <button type="button" class="close col-lg-1 col-md-1 col-xs-2" data-dismiss="alert"><i class="fa fa-close"></i> </button>
            </div>
        @endif
    </div>
    <header>

    </header>

    @include('frontend.page_parts.contact')

@stop
