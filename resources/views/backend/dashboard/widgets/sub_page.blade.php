@extends('backend.layout.main')

@section('title')
    <title>VDK Design | {{$menu_sub_item->title}} | Niveau 2</title>
@stop

@section('header_title')
    {{$menu_sub_item->title}}
@stop

@section('header_sub_title')
    Widgets | Niveau 2
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/widget/{{$menu_item->slug}}">{{$menu_item->title}}</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/subwidget_2/{{$menu_item->slug}}/{{$menu_sub_item->slug}}">{{$menu_sub_item->title}}</a></li>
    </ol>
@stop

@section('content')
    <div class="row">
        @if($menu_sub_item->need_sub_widget == false)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="callout callout-danger">
                    <h4>Opgelet!</h4>
                    <p>Deze pagina kan geen widgets bevatten.</p>
                </div>
            </div>
        @else
            @if(count($menu_sub_item->widget_sub_items) != 0)
                @foreach($menu_sub_item->widget_sub_items as $value)
                    <a href="{!! URL::to('/') !!}/backend/subwidget_2/{{$menu_item->slug}}/{{$menu_sub_item->slug}}/details/{{$value->id}}">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa {{$value->icon}}"></i></span>
                                <div class="info-box-content">
                            <span class="info-box-number">
                                <span class="text widgetTitle">{{$value->title}}</span>
                            </span>
                            <span class="info-box-description">
                                <span class="text widgetTitle">{{$value->description}}</span>
                            </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </a>
                @endforeach
            @else
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="callout callout-info">
                        <h4>
                            <i class="icon fa fa-exclamation-circle"></i>
                            Opgelet!
                        </h4>
                        <p>Deze pagina bevat geen widgets.</p>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection