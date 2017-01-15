@extends('backend.layout.main')

@section('title')
    <title>VDK Design | {{$widget_sub_sub_item->title}}</title>
@stop

@section('header_title')
    {{$widget_sub_sub_item->title}}
@stop

@section('header_sub_title')
    Widget | Niveau 3
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/widget/{{$menu_item->slug}}">{{$menu_item->title}}</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/subwidget_2/{{$menu_item->slug}}/{{$menu_sub_item->slug}}">{{$menu_sub_item->title}}</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/subwidget_3/{{$menu_item->slug}}/{{$menu_sub_item->slug}}/{{$menu_sub_sub_item->slug}}">{{$menu_sub_sub_item->title}}</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/subwidget_3/{{$menu_item->slug}}/{{$menu_sub_item->slug}}/{{$menu_sub_sub_item->slug}}/details/{{$widget_sub_sub_item->id}}">Edit</a></li>
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
        {!! Form::open(array('url' => '/backend/subwidget_3/'.$menu_item->slug.'/'.$menu_sub_item->slug.'/'.$menu_sub_sub_item->slug.'/details/'.$widget_sub_sub_item->id.'/edit')) !!}
        <div class="box-header-sub">
            <h3 class="box-title">Algemene eigenschappen</h3>
        </div>
        <div class="form-group">
            <label>Titel</label>
            <input type="text" name="title" class="form-control" value="{{$widget_sub_sub_item->title}}" placeholder="Titel" maxlength="20"  @permission(('sub-sub-widget-edit')) required @else disabled @endpermission>
        </div>
        <div class="form-group">
            <label>Omschrijving</label>
            <input type="text" name="description" class="form-control" value="{{$widget_sub_sub_item->description}}" placeholder="Omschrijving" maxlength="35"  @permission(('sub-sub-widget-edit')) required @else disabled @endpermission>
        </div>
        <div class="form-group">
            <label>Widget icoon</label>
            <div class="input-group">
                <span class="input-group-addon" @permission(('edit-sub-sub-widget')) @else style="pointer-events: none;" @endpermission></span>
                <input data-placement="topLeft" name="icon" class="form-control icp icp-auto" value="{{$widget_sub_sub_item->icon}}" type="text"  @permission(('sub-sub-widget-edit')) required @else disabled @endpermission/>
            </div>
        </div>
        <div class="box-header-sub">
            <h3 class="box-title">Specifieke eigenschappen</h3>
        </div>
        <div class="form-group">
            <label>Keuzelijst</label>
            <select class="form-control select2" name="extra" style="width: 100%;"  @permission(('sub-sub-widget-edit')) required @else disabled @endpermission>
                <option value="1" selected="selected">Test1</option>
                <option value="2">Test2</option>
                <option value="3">Test3</option>
                <option value="4">Test4</option>
            </select>
        </div>
        <div class="form-group buttons">
            <a href="{!! URL::to('/') !!}/backend"><button type="button" class="btn btn-default">Annuleren</button></a>
            <button type="submit" class="btn btn-primary pull-right" @permission(('sub-sub-widget-edit')) @else disabled @endpermission>Wijzigen</button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection