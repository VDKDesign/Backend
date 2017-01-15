@extends('backend.layout.main')

@section('title')
    <title>VDK Design |Widgets niveau 2</title>
@stop

@section('header_title')
    Widgets
@stop

@section('header_sub_title')
    Niveau 2
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/subwidgets_2/overview">Widgets | Niveau 2</a></li>
    </ol>
@stop

@section('content')
    <div class='row overview_sub_widgets'>
        <section class="content">
            <div class="row page">
                @foreach($menu_items as $key => $value)
                    <div class="col-lg-3 col-xs-3 page_col">
                        <div class="small-box bg-green-active">
                            <div class="inner">
                                <h3>{{$value->title}}</h3>
                                <p>Niveau 1</p>
                            </div>
                        </div>
                        @if($value->need_widget != null)
                            @if(count($value->menu_sub_items) == null)
                                <div class="page_box margin_bottom">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">OPGELET</span>
                                            <span class="info-box-number">Pagina bevat geen subpagina (niveau 2)</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                            @endif
                        @else
                            <div class="page_box margin_bottom">
                                <div class="info-box">
                                    <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">OPGELET</span>
                                        <span class="info-box-number">Geen widget toevoegen</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        @endif
                        @if($value != null)
                            <div class="overview_pages">
                                @foreach($value->menu_sub_items as $subValue)
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3>{{$subValue->title}}</h3>
                                            <p>Niveau 2</p>
                                        </div>
                                    </div>
                                    @foreach($subValue->widget_sub_items as $subWidgets)
                                        <a href="{!! URL::to('/') !!}/backend/subwidget_2/{{$value->slug}}/{{$subValue->slug}}/details/{{$subWidgets->id}}" >
                                            <div class="page_box">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="fa {{$subWidgets->icon}}"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Widget</span>
                                                        <span class="info-box-number">{{$subWidgets->title}}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                        </a>
                                    @endforeach
                                    @permission(('create-sub-widget'))
                                        @if($subValue->need_sub_widget == true)
                                            <a href="{!! URL::to('/') !!}/backend/new_sub_widget_2/{{$subValue->id}}" >
                                                <div class="page_box">
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Niveau 2</span>
                                                            <span class="info-box-number">Subwidget toevoegen</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @else
                                            <div class="page_box margin_bottom">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">OPGELET</span>
                                                        <span class="info-box-number">Geen subwidget toevoegen</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                        @endif
                                    @else
                                        <div class="page_box margin_bottom">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">OPGELET</span>
                                                    <span class="info-box-number">Geen subwidget toevoegen</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    @endpermission
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection