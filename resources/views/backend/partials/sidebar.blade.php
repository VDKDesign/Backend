<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/img/backend/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Sidebar -->
        <ul class="sidebar-menu">
            <li class="header">Overzicht</li>
            <li class="active"><a href="{!! URL::to('/') !!}/backend">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-flag"></i>
                    <span>Pagina's</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if($menu_categorie != null)
                        @if(count($menu_categorie->menu_items) == null)
                            <li>
                                <a>Geen subpagina's</a>
                            </li>
                        @endif
                        @foreach($menu_categorie->menu_items as $value)
                            <li>
                                <a href="{!! URL::to('/') !!}/backend/page/{{$value->slug}}"><i class="fa fa-caret-right"></i>{{$value->title}}
                                    @if(count($value->menu_sub_items) != 0)
                                        <i class="fa fa-angle-left pull-right"></i>
                                    @endif
                                </a>
                                @if($menu_categorie->subpages == true)
                                    @if(count($value->menu_sub_items) != 0)
                                        <ul class="treeview-menu">
                                            <li>
                                                <a href="{!! URL::to('/') !!}/backend/page/{{$value->slug}}" class="treeview-header">Hoofdpagina</a>
                                            </li>
                                            @foreach($value->menu_sub_items as $subValue)
                                                <li>
                                                    <a href="{!! URL::to('/') !!}/backend/subpage_2/{{$value->slug}}/{{$subValue->slug}}">
                                                        <i class="fa fa-caret-right"></i>{{$subValue->title}}
                                                        @if(count($subValue->menu_sub_sub_items) != 0)
                                                            <i class="fa fa-angle-left pull-right"></i>
                                                        @endif
                                                    </a>
                                                    @if($menu_categorie->sub_subpages == true)
                                                        @if(count($subValue->menu_sub_sub_items) != 0)
                                                            <ul class="treeview-menu">
                                                                <li>
                                                                    <a href="{!! URL::to('/') !!}/backend/subpage_2/{{$value->slug}}/{{$subValue->slug}}" class="treeview-header">Hoofdpagina</a>
                                                                </li>
                                                                @foreach($subValue->menu_sub_sub_items as $subSubValue)
                                                                    <li>
                                                                        <a href="{!! URL::to('/') !!}/backend/subpage_3/{{$value->slug}}/{{$subValue->slug}}/{{$subSubValue->slug}}">
                                                                            <i class="fa fa-caret-right"></i>{{$subSubValue->title}}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li><a href="{!! URL::to('/') !!}/backend">Geen pagina's</a></li>
                    @endif
                </ul>
            </li>
            <li>
                <a>
                    <i class="fa fa-th"></i>
                    <span>Widgets</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        @if($menu_categorie != null)
                            @if(count($menu_categorie->menu_items) == null)
                                <li>
                                    <a>Geen subpagina's</a>
                                </li>
                            @endif
                            @foreach($menu_categorie->menu_items as $value)
                                <li>
                                    <a href="{!! URL::to('/') !!}/backend/widget/{{$value->slug}}"><i class="fa fa-caret-right"></i>{{$value->title}}
                                        @if(count($value->menu_sub_items) != 0)
                                            <i class="fa fa-angle-left pull-right"></i>
                                        @endif
                                    </a>
                                    @if($menu_categorie->sub_widgets == true)
                                        @if(count($value->menu_sub_items) != 0)
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="{!! URL::to('/') !!}/backend/widget/{{$value->slug}}" class="treeview-header">Hoofdpagina</a>
                                                </li>
                                                @foreach($value->menu_sub_items as $subValue)
                                                    <li>
                                                        <a href="{!! URL::to('/') !!}/backend/subwidget_2/{{$value->slug}}/{{$subValue->slug}}">
                                                            <i class="fa fa-caret-right"></i>{{$subValue->title}}
                                                            @if(count($subValue->menu_sub_sub_items) != 0)
                                                                <i class="fa fa-angle-left pull-right"></i>
                                                            @endif
                                                        </a>
                                                        @if($menu_categorie->sub_subwidgets == true)
                                                            @if(count($subValue->menu_sub_sub_items) != 0)
                                                                <ul class="treeview-menu">
                                                                    <li>
                                                                        <a href="{!! URL::to('/') !!}/backend/subwidget_2/{{$value->slug}}/{{$subValue->slug}}" class="treeview-header">Hoofdpagina</a>
                                                                    </li>
                                                                    @foreach($subValue->menu_sub_sub_items as $subSubValue)
                                                                        <li>
                                                                            <a href="{!! URL::to('/') !!}/backend/subwidget_3/{{$value->slug}}/{{$subValue->slug}}/{{$subSubValue->slug}}"><i class="fa fa-caret-right"></i>{{$subSubValue->title}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                </li>
                            @endforeach
                        @else
                            <li><a href="{!! URL::to('/') !!}/backend">Geen pagina's</a></li>
                        @endif
                    </ul>
                </a>
            </li>
            <li>
                <a href="{!! URL::to('/') !!}/backend/gallerij">
                    <i class="fa fa-image"></i> <span>Gallerij</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-yellow">4</small>
                    </span>
                </a>
            </li>
            @permission(('page-permissions'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>Rollen & rechten</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{!! URL::to('/') !!}/backend/roles"><i class="fa fa-caret-right"></i> Rollen</a></li>
                        <li><a href="{!! URL::to('/') !!}/backend/users-roles"><i class="fa fa-caret-right"></i> Gebruikersrollen</a></li>
                        <li><a href="{!! URL::to('/') !!}/backend/categories"><i class="fa fa-caret-right"></i> Categorieën</a></li>
                        <li><a href="{!! URL::to('/') !!}/backend/permissions"><i class="fa fa-caret-right"></i> Rechten</a></li>
                        <li><a href="{!! URL::to('/') !!}/backend/users-permissions"><i class="fa fa-caret-right"></i> Gebruikersrechten</a></li>
                    </ul>
                </li>
            @endpermission
        </ul>
    </section>
</aside>