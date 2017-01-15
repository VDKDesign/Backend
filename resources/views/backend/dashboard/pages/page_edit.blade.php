@extends('backend.layout.main')

@section('title')
    <title>VDK Design | {{$menu_item->title}}</title>
@stop

@section('header_title')
    {{$menu_item->title}}
@stop

@section('header_sub_title')
    Niveau 1
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/page/{{$menu_item->slug}}">{{$menu_item->title}}</a></li>
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
        {!! Form::open(array('url' => '/backend/page/'.$menu_item->slug.'/edit/'.$menu_item->id)) !!}
            <div class="form-group">
                <label>Titel</label>
                <input type="text" name="title" class="form-control" value="{{$menu_item->title}}" placeholder="Titel" maxlength="20" @permission(('page-edit')) required @else disabled @endpermission >
            </div>
            <div class="form-group">
                <label>Volgorde</label>
                <select class="form-control select2" name="rank" style="width: 100%;" >
                    @foreach($menu_items as $value)
                         <option value="{{$value->rank}}" {{ $value->slug == $menu_item->slug ? 'selected="selected"' : '' }}>{{$value->rank.' - '.$value->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Pagina zichtbaar</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsVisibility" id="optionsRadios1" value="1" @if($menu_item->status == 1) checked @endif @permission(('page-edit')) @else disabled @endpermission>Ja
                    </label>
                    <label style="margin-left: 10px;">
                        <input type="radio" name="optionsVisibility" id="optionsRadios2" value="0" @if($menu_item->status == 0) checked @endif @permission(('page-edit')) @else disabled @endpermission>Nee
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Paginainhoud</label>
                <div class="box">
                    <div class="box-body pad">
                        <textarea class="textarea" name="body" placeholder="Inhoud van de pagina" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" @permission(('page-edit')) required @else disabled @endpermission>
                            @foreach($menu_item->page_items as $value)
                                {!! $value->body !!}
                            @endforeach
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group buttons">
                <a href="{!! URL::to('/') !!}/backend"><button type="button" class="btn btn-default">Annuleren</button></a>
                <button type="submit" class="btn btn-primary pull-right" @permission(('page-edit')) @else disabled @endpermission>Wijzigen</button>
            </div>
        {!! Form::close() !!}
    </div>

@endsection