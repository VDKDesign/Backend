@extends('backend.layout.main')

@section('title')
    <title>VDK Design | Backend</title>
@stop

@section('header_title')
    Backend
@stop

@section('header_sub_title')
    Dashboard
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{!! URL::to('/') !!}/backend">Dashboard</a></li>
    </ol>
@stop

@section('content')
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
    <div class="row overview_all">
        <section class="content">
            <div class="row page">
                <!-- ALL PAGES (1) -->
                <div class="col-lg-4 col-xs-4 page_col">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>Niveau 1</h3>
                            <p>{{count($menu_items_all)}} @if(count($menu_items_all) == 1) Pagina @else Pagina's @endif</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-flag"></i>
                        </div>
                    </div>
                    @if($menu_categorie != null)
                        @foreach($menu_categorie->menu_items as $value)
                            <a href="{!! URL::to('/') !!}/backend/page/{{$value->slug}}" >
                                <div class="page_box">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Pagina</span>
                                            <span class="info-box-number">{{$value->title}}</span>
                                            <span class="page-visibility">
                                                @if($value->status == 0)
                                                    <i class="fa fa-eye-slash"></i>
                                                @else
                                                    <i class="fa fa-eye"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                    @permission(('page-create'))
                        <a href="{!! URL::to('/') !!}/backend/new_page" >
                            <div class="page_box">
                                <div class="info-box">
                                    <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Niveau 1 </span>
                                        <span class="info-box-number">Pagina toevoegen</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="info-box">
                            <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">OPGELET</span>
                                <span class="info-box-number">Extra pagina onmogelijk</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    @endpermission
                </div>
                @if($menu_categorie->subpages == true)
                    <!-- ALL SUB PAGES (2) -->
                    <div class="col-lg-4 col-xs-4 page_col">
                        <a href="{!! URL::to('/') !!}/backend/subpages_2/overview">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>Niveau 2</h3>
                                    <p>{{count($menu_sub_items)}} @if(count($menu_sub_items) == 1) Pagina @else Pagina's @endif</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-flag"></i>
                                </div>
                            </div>
                        </a>
                        @if($menu_items != null)
                            @foreach($menu_sub_items->take('5') as $value)
                                <a href="{!! URL::to('/') !!}/backend/subpage_2/{{getItemSlug($value->menu_item_id)}}/{{$value->slug}}" >
                                    <div class="page_box">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">SubPagina</span>
                                                <span class="info-box-number">{{$value->title}}</span>
                                                <span class="page-visibility">
                                                    @if($value->status == 0)
                                                        <i class="fa fa-eye-slash"></i>
                                                    @else
                                                        <i class="fa fa-eye"></i>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @permission(('sub-page-create'))
                                <a href="{!! URL::to('/') !!}/backend/new_sub_page_2" >
                                    <div class="page_box">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Niveau 2 </span>
                                                <span class="info-box-number">Pagina toevoegen</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <div class="info-box">
                                    <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">OPGELET</span>
                                        <span class="info-box-number">Extra pagina onmogelijk</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            @endpermission
                        @else
                            <div class="info-box">
                                <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">OPGELET</span>
                                    <span class="info-box-number">Geen subpagina mogelijk</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        @endif
                    </div>
                @endif
                @if($menu_categorie->sub_subpages == true && $menu_categorie->subpages == true)
                    <!-- ALL SUB PAGES (3) -->
                    <div class="col-lg-4 col-xs-4 page_col">
                        <a href="{!! URL::to('/') !!}/backend/subpages_3/overview">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>Niveau 3</h3>
                                    <p>{{count($menu_sub_sub_items)}} @if(count($menu_sub_sub_items) == 1) Pagina @else Pagina's @endif </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-flag"></i>
                                </div>
                            </div>
                        </a>
                        @if($menu_items != null)
                            @foreach($menu_sub_sub_items->take('5') as $value)
                                <a href="{!! URL::to('/') !!}/backend/subpage_3/{{getItemSlug(getSubItemMenuId($value->menu_sub_item_id))}}/{{getSubItemSlug($value->menu_sub_item_id)}}/{{$value->slug}}" >
                                    <div class="page_box">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">SubPagina</span>
                                                <span class="info-box-number">{{$value->title}}</span>
                                            <span class="page-visibility">
                                                @if($value->status == 0)
                                                    <i class="fa fa-eye-slash"></i>
                                                @else
                                                    <i class="fa fa-eye"></i>
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @permission(('sub-sub-page-create'))
                                @if(count($menu_sub_items) != null)
                                    <a href="{!! URL::to('/') !!}/backend/new_sub_page_3" >
                                        <div class="page_box">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Niveau 3 </span>
                                                    <span class="info-box-number">Pagina toevoegen</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <div class="info-box">
                                        <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">OPGELET</span>
                                            <span class="info-box-number">Extra pagina onmogelijk</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                @endif
                            @else
                                <div class="info-box">
                                    <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">OPGELET</span>
                                        <span class="info-box-number">Extra pagina onmogelijk</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            @endpermission
                        @else
                            <div class="info-box">
                                <span class="info-box-icon bg-gray"><i class="fa fa-exclamation-circle white"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">OPGELET</span>
                                    <span class="info-box-number">Geen subpagina mogelijk</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        @endif
                    </div>
                @endif
                @if($menu_categorie->widgets == true)
                    <!-- ALL WIDGETS (1) -->
                    <div class="col-lg-4 col-xs-4 page_col">
                        <a href="{!! URL::to('/') !!}/backend/widgets/overview">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{count($widget_items)}} @if(count($widget_items) == 1) Widget @else Widgets @endif</h3>
                                    <p>Niveau 1</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-grid"></i>
                                </div>
                            </div>
                        </a>
                        @if($widget_items != null)
                            @foreach($widget_items->take('5') as $value)
                                <a href="{!! URL::to('/') !!}/backend/widget/{{getItemSlug($value->menu_item_id)}}/details/{{$value->id}}" >
                                    <div class="page_box">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-aqua"><i class="fa {{$value->icon}}"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Widget</span>
                                                <span class="info-box-number">{{$value->title}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @permission(('widget-create'))
                                <a href="{!! URL::to('/') !!}/backend/new_widget" >
                                    <div class="page_box">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Niveau 1</span>
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
                                        <span class="info-box-number">Extra widget onmogelijk</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            @endpermission
                        @endif
                    </div>
                @endif
                @if($menu_categorie->sub_widgets == true)
                    <!-- ALL SUB WIDGETS (2) -->
                    <div class="col-lg-4 col-xs-4 page_col">
                        <a href="{!! URL::to('/') !!}/backend/subwidgets_2/overview">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{count($sub_widget_items)}} @if(count($sub_widget_items) == 1) Widget @else Widgets @endif</h3>
                                    <p>Niveau 2</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-grid"></i>
                                </div>
                            </div>
                        </a>
                        @if($sub_widget_items != null)
                            @foreach($sub_widget_items->take('5') as $value)
                                <a href="{!! URL::to('/') !!}/backend/subwidget_2/{{getItemSlug(getSubItem($value->menu_sub_item_id)->menu_item_id)}}/{{getSubItemSlug($value->menu_sub_item_id)}}/details/{{$value->id}}" >
                                    <div class="page_box">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-aqua"><i class="fa {{$value->icon}}"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Widget</span>
                                                <span class="info-box-number">{{$value->title}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @permission(('sub-widget-create'))
                                <a href="{!! URL::to('/') !!}/backend/new_sub_widget_2" >
                                    <div class="page_box">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Niveau 2</span>
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
                                        <span class="info-box-number">Extra widget onmogelijk</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            @endpermission
                        @endif
                    </div>
                @endif
                @if($menu_categorie->sub_subwidgets == true)
                    <!-- ALL SUB WIDGETS (3) -->
                    <div class="col-lg-4 col-xs-4 page_col">
                        <a href="{!! URL::to('/') !!}/backend/subwidgets_3/overview">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{count($sub_sub_widget_items)}} @if(count($sub_sub_widget_items) == 1) Widget @else Widgets @endif</h3>
                                    <p>Niveau 3</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-grid"></i>
                                </div>
                            </div>
                        </a>
                        @if($sub_sub_widget_items != null)
                            @foreach($sub_sub_widget_items->take('5') as $value)
                                <a href="{!! URL::to('/') !!}/backend/subwidget_3/{{getItemSlug(getSubItem($value->menu_sub_sub_item_id)->menu_item_id)}}/{{getSubItemSlug($value->menu_sub_sub_item_id)}}/{{getSubSubItemSlug(getSubItemMenuId($value->menu_sub_sub_item_id))}}/details/{{$value->id}}" >
                                    <div class="page_box">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-aqua"><i class="fa {{$value->icon}}"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Widget</span>
                                                <span class="info-box-number">{{$value->title}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @permission(('sub-sub-widget-create'))
                                <a href="{!! URL::to('/') !!}/backend/new_sub_widget_3" >
                                    <div class="page_box">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-gray"><i class="fa fa-plus-circle white"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Niveau 3</span>
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
                                        <span class="info-box-number">Extra widget onmogelijk</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            @endpermission
                        @endif
                    </div>
                @endif
            </div>
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- quick email widget -->
                    <div class="box box-danger">
                        <div class="box-header">
                            <i class="fa fa-envelope"></i>
                            <h3 class="box-title">Contacteer VDK Design</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="mail_succes succes_hide">
                                @if(Session::has('email_message'))
                                    <div class="has-success">
                                        <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> {{ Session::get('email_message') }}</label>
                                    </div>
                                @endif
                            </div>
                            <div class="mail_error error_hide">
                                @if(Session::has('email_error'))
                                    <div class="has-error">
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ Session::get('email_error') }}</label>
                                    </div>
                                @endif
                            </div>
                            <div class="errors">
                                @if(count($errors) != 0)
                                    <div class="alert alert-validation">
                                        @foreach ($errors->all() as $error)
                                            <p class="error">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        {!! Form::open(array('url' => '/backend/problem_contact/')) !!}
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Onderwerp" required>
                            </div>
                            <div>
                                <textarea class="textarea" placeholder="Bericht" name="bericht" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            <button type="submit" class="pull-right btn btn-default" id="sendEmail">Verzenden
                                <i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.email -->
                </section>
                <!-- Right col -->
                <section class="col-lg-5 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-danger">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">To-Do Lijst</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="to_do_succes succes_hide">
                                @if(Session::has('to_do_message'))
                                    <div class="has-success">
                                        <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> {{ Session::get('to_do_message') }}</label>
                                    </div>
                                @endif
                            </div>
                            <div class="to_do_error error_hide">
                                @if(Session::has('error_message'))
                                    <div class="has-error">
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ Session::get('error_message') }}</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="box-body">
                            <ul class="todo-list">
                                @if($toDoList != null && count($toDoList) != 0)
                                    @foreach($toDoList as $value)
                                        <li>
                                            <!-- Show & Edit text -->
                                            <span class="text toDoText" data-type="text" data-placement="right" data-title="Item aanpassen" class="editable editable-click" data-pk="{{$value->id}}" data-original-title="" title="Item aanpassen">{{$value->item}}</span>
                                            <!-- Time tabel -->
                                            <small class="label label-info" id="dateTime_{{$value->id}}"><i class="fa fa-clock-o"></i>
                                                @if($value->updated_at == null)
                                                    {{ secondsToTime(abs(strtotime($value->created_at)- strtotime(date("Y-m-d H:i:s")))) }}
                                                @else
                                                    {{ secondsToTime(abs(strtotime($value->updated_at)- strtotime(date("Y-m-d H:i:s")))) }}
                                                @endif
                                            </small>
                                            <!-- General tools such as delete-->
                                            <div class="tools">
                                                {!! Form::open(array('url' => '/backend/item_delete/'.$value->id)) !!}
                                                <i class="fa fa-trash-o" id="confirm" data-toggle="modal" data-target="#confirmDelete" data-title="Delete attribuut" ></i>
                                                {!! Form::close() !!}
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <p>Klik op de knop 'item toevoegen' </p>
                                @endif
                            </ul>
                        </div>
                        <div class="box-footer clearfix no-border">
                            <div class="box-tools pull-right">
                                {{ $toDoList->links() }}
                            </div>
                            <div class="box-tools pull-left">
                                <button type="button" id="toDoButton" class="btn btn-default pull-right"><i class="fa fa-plus-circle"></i>  Item toevoegen</button>
                            </div>
                        </div>
                        {!! Form::open(array('url' => '/backend/add_item_to_do/')) !!}
                        <div class="box-footer clearfix no-border" id="newToDO">
                            <div class="input-group input-group-sm">
                                <input type="text" name="item" class="form-control" required>
                                    <span class="input-group-btn">
                                            <button type="submit" class="btn btn-danger btn-flat">Toevoegen</button>
                                    </span>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                    <!-- /.TO DO -->
                </section>
            </div>
        </section>
    </div><!-- /.row -->
    <!-- Modal Dialog -->
    <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Item verwijderen</h4>
                </div>
                <div class="modal-body">
                    <p>Bent u hier zeker van?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirm">Verwijderen</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                </div>
            </div>
        </div>
    </div>
@endsection