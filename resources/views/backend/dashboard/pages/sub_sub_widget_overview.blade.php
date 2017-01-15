@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Subwidgets niveau 3</title>
@stop

@section('header_title')
    Subwidgets
@stop

@section('header_sub_title')
    Niveau 3
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/subwidgets_2/overview">Subwidgets | Niveau 2</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/subwidgets_3/overview">Subwidgets | Niveau 3</a></li>
    </ol>
@stop

@section('content')
    <div class="row overview_sub_sub_widgets">
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
                                @if($value != null)
                                    <div class="overview_pages">
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
                                        @foreach($value->menu_sub_items as $subValue)
                                            <div class="small-box bg-green">
                                                <div class="inner">
                                                    <h3>{{$subValue->title}}</h3>
                                                    <p>Niveau 2</p>
                                                </div>
                                            </div>
                                            @if(count($subValue->menu_sub_sub_items) == null)
                                                <div class="page_box margin_bottom">
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">OPGELET</span>
                                                            <span class="info-box-number">Pagina bevat geen subpagina (niveau 3)</span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                    </div>
                                                    <!-- /.info-box -->
                                                </div>
                                            @endif
                                            @foreach($subValue->menu_sub_sub_items as $subSubItems)
                                                <div class="small-box bg-aqua">
                                                    <div class="inner">
                                                        <h3>{{$subSubItems->title}}</h3>
                                                        <p>Niveau 3</p>
                                                    </div>
                                                </div>
                                                @foreach($subSubItems->widget_sub_sub_items as $subSubWidgets)
                                                    <a href="{!! URL::to('/') !!}/backend/subwidget_3/{{getItemSlug(getSubItem($subSubWidgets->menu_sub_sub_item_id)->menu_item_id)}}/{{getSubItemSlug($subSubWidgets->menu_sub_sub_item_id)}}/{{getSubSubItemSlug(getSubItemMenuId($subSubWidgets->menu_sub_sub_item_id))}}/details/{{$subSubWidgets->id}}" >
                                                        <div class="page_box">
                                                            <div class="info-box">
                                                                <span class="info-box-icon bg-aqua"><i class="fa {{$subSubWidgets->icon}}"></i></span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text">Widget</span>
                                                                    <span class="info-box-number">{{$subSubWidgets->title}}</span>
                                                                </div>
                                                                <!-- /.info-box-content -->
                                                            </div>
                                                            <!-- /.info-box -->
                                                        </div>
                                                    </a>
                                                @endforeach
                                                    @permission(('create-sub-sub-widget'))
                                                        @if($subValue->need_sub_sub_widget == true)
                                                        <a href="{!! URL::to('/') !!}/backend/new_sub_widget_3/{{$subSubItems->id}}" >
                                                            <div class="page_box margin_bottom">
                                                                <div class="info-box">
                                                                    <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                                                    <div class="info-box-content">
                                                                        <span class="info-box-text">Niveau 3 </span>
                                                                        <span class="info-box-number">Subwidget toevoegen</span>
                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                                <!-- /.info-box -->
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


                                                @if($subSubItems->need_sub_sub_widget == true)
                                                    <a href="{!! URL::to('/') !!}/backend/new_sub_widget_3/{{$subSubItems->id}}" >
                                                        <div class="page_box margin_bottom">
                                                            <div class="info-box">
                                                                <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text">Niveau 3 </span>
                                                                    <span class="info-box-number">Subwidget toevoegen</span>
                                                                </div>
                                                                <!-- /.info-box-content -->
                                                            </div>
                                                            <!-- /.info-box -->
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
                                            @endforeach
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                    @endforeach
                </div>
        </section>
    </div>
@endsection