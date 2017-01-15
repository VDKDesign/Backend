@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Subpagina's niveau 3</title>
@stop

@section('header_title')
    Pagina's
@stop

@section('header_sub_title')
    Niveau 3
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{!! URL::to('/') !!}/backend/subpages_2/overview">Pagina's | Niveau 2</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend/subpages_3/overview">Pagina's | Niveau 3</a></li>
    </ol>
@stop

@section('content')
    <div class="row overview_sub_sub_pages">
        <section class="content">
                <div class="row page">
                    @foreach($menu_items as $key => $value)
                        <div class="col-lg-3 col-xs-3 page_col">
                                <a href="{!! URL::to('/') !!}/backend/page/{{$value->slug}}" >
                                    <div class="small-box bg-green-active">
                                        <div class="inner">
                                            <h3>{{$value->title}}</h3>
                                            <p>Niveau 1</p>
                                        </div>
                                    </div>
                                </a>
                                @if($value != null)
                                    <div class="overview_pages">
                                        @if(count($value->menu_sub_items) == null)
                                            @if($value->need_subpage != null)
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
                                            @else
                                                <div class="page_box margin_bottom">
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">OPGELET</span>
                                                            <span class="info-box-number">Geen pagina mogelijk</span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                        @foreach($value->menu_sub_items as $subValue)
                                            <a href="{!! URL::to('/') !!}/backend/subpage_2/{{$value->slug}}/{{$subValue->slug}}" >
                                                <div class="small-box bg-green">
                                                    <div class="inner">
                                                        <h3>{{$subValue->title}}</h3>
                                                        <p>Niveau 2</p>
                                                    </div>
                                                </div>
                                            </a>
                                            @foreach($subValue->menu_sub_sub_items as $subSubItems)
                                                <a href="{!! URL::to('/') !!}/backend/subpage_3/{{$value->slug}}/{{$subValue->slug}}/{{$subSubItems->slug}}" >
                                                    <div class="page_box">
                                                        <div class="info-box">
                                                            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text">Niveau 3</span>
                                                                <span class="info-box-number">{{$subSubItems->title}}</span>
                                                                <span class="page-visibility">
                                                                    @if($subSubItems->status == 0)
                                                                        <i class="fa fa-eye-slash"></i>
                                                                    @else
                                                                        <i class="fa fa-eye"></i>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <!-- /.info-box-content -->
                                                        </div>
                                                        <!-- /.info-box -->
                                                    </div>
                                                </a>
                                            @endforeach
                                            @permission(('create-sub-sub-page'))
                                                @if($subValue->need_sub_subpage == true)
                                                    <a href="{!! URL::to('/') !!}/backend/new_sub_page_3/{{$subValue->id}}" >
                                                        <div class="page_box margin_bottom">
                                                            <div class="info-box">
                                                                <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text">Niveau 3 </span>
                                                                    <span class="info-box-number">Pagina toevoegen</span>
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
                                                                <span class="info-box-number">Geen pagina toevoegen</span>
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
                                                            <span class="info-box-number">Geen pagina toevoegen</span>
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