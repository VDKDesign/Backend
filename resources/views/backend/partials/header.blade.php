<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{!! URL::to('/') !!}/backend" class="logo">
        <span class="logo-mini"><b>VDK</b></span>
        <span class="logo-lg"><b>VDK</b>Design</span>
    </a>
    <!-- Header -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset("/img/backend/user2-160x160.jpg") }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset("/img/backend/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
                            <p>
                                {{ Auth::user()->name }}
                                <small>{{ Auth::user()->email }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            @permission(('create-user'))
                                <div class="pull-left">
                                    <a href="{!! URL::to('/') !!}/register_admin" class="btn btn-default btn-flat">Toevoegen</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{!! URL::to('/') !!}/logout" class="btn btn-default btn-flat">Uitloggen</a>
                                </div>
                            @else
                                <div>
                                    <a href="{!! URL::to('/') !!}/logout" class="btn btn-default btn-flat">Uitloggen</a>
                                </div>
                            @endpermission
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>