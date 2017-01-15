@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Widgets niveau 1</title>
@stop

@section('header_title')
    Widgets
@stop

@section('header_sub_title')
    Niveau 1
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/widgets/overview">Widgets | niveau 1</a></li>
    </ol>
@stop

@section('content')
    <div class='row overview_widgets'>
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
                                @foreach($value->widget_items as $subValue)
                                    <a href="{!! URL::to('/') !!}/backend/widget/{{$value->slug}}/details/{{$subValue->id}}" >
                                        <div class="page_box">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-aqua"><i class="fa {{$subValue->icon}}"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Widget</span>
                                                    <span class="info-box-number">{{$subValue->title}}</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </a>
                                @endforeach
                                @permission(('create-widget'))
                                    @if($value->need_widget == true)
                                        <a href="{!! URL::to('/') !!}/backend/new_widget" >
                                            <div class="page_box">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Nieuwe</span>
                                                        <span class="info-box-number">Widget toevoegen</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        <div class="info-box">
                                            <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">OPGELET</span>
                                                <span class="info-box-number">Geen widget toevoegen</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    @endif
                                @else
                                    <div class="info-box">
                                        <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">OPGELET</span>
                                            <span class="info-box-number">Geen widget toevoegen</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                @endpermission
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection