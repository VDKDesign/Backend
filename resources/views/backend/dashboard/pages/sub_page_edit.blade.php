@extends('backend.layout.main')

@section('title')
    <title>VDK Design | {{$menu_sub_item->title}}</title>
@stop

@section('header_title')
    {{$menu_sub_item->title}}
@stop

@section('header_sub_title')
    Niveau 2
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/page/{{$menu_item->slug}}">{{$menu_item->title}}</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/subpage_2/{{$menu_item->slug}}/{{$menu_sub_item->slug}}">{{$menu_sub_item->title}}</a></li>
    </ol>
@stop

@section('content')
    <div class="form_page_editor">
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
        {!! Form::open(array('url' => '/backend/subpage_2/'.$menu_item->slug.'/'.$menu_sub_item->slug.'/edit/'.$menu_sub_item->id)) !!}
            <div class="form-group">
                <label>Titel</label>
                <input type="text" name="title" class="form-control" value="{{$menu_sub_item->title}}" placeholder="Titel" maxlength="20" @permission(('sub-page-edit')) required @else disabled @endpermission>
            </div>
            <div class="form-group">
                <label>Volgorde</label>
                <select class="form-control select2" name="rank" style="width: 100%;" >
                    @foreach($menu_sub_items as $value)
                         <option value="{{$value->rank}}" {{ $value->slug == $menu_sub_item->id ? 'selected="selected"' : '' }}>{{$value->rank.' - '.$value->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Pagina zichtbaar</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsVisibility" id="optionsRadios1" value="1" @if($menu_sub_item->status == 1) checked @endif @permission(('sub-page-edit')) @else disabled @endpermission>Ja
                    </label>
                    <label style="margin-left: 10px;">
                        <input type="radio" name="optionsVisibility" id="optionsRadios2" value="0" @if($menu_sub_item->status == 0) checked @endif @permission(('sub-page-edit')) @else disabled @endpermission>Nee
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Paginainhoud</label>
                <div class="box">
                    <div class="box-body pad">
                        <textarea class="textarea" name="body" placeholder="Inhoud van de pagina" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                            @foreach($menu_sub_item->page_sub_items as $value)
                                {!! $value->body !!}
                            @endforeach
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group buttons">
                <a href="{!! URL::to('/') !!}/backend"><button type="button" class="btn btn-default">Annuleren</button></a>
                <button type="submit" class="btn btn-primary pull-right" @permission(('sub-page-edit')) @else disabled @endpermission>Wijzigen</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection