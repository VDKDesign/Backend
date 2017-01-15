<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="UTF-8">

    @yield('title')

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap 3.3.6 -->
    <link href="{{ asset("/bower_components/backend/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap editable 1.5.0 -->
    <link href="{{ asset("/css/backend/plugins/bootstrap_editable/bootstrap-editable.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome 4.7.0 -->
    <link href="{{ asset("/css/backend/general/font_awesome/font-awesome.css") }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.1 -->
    <link href="{{ asset("/css/backend/plugins/ionic_icons/ionicons.css") }}" rel="stylesheet" type="text/css" />
    <!-- Backend style -->
    <link href="{{ asset("/css/backend/backend.css")}}" rel="stylesheet" type="text/css" />
    <!-- Backend Skin style -->
    <link href="{{ asset("/css/backend/backend_skin.css")}}" rel="stylesheet" type="text/css" />
    <!-- IconPicker -->
    <link rel="stylesheet" href="{{ asset("/css/backend/plugins/iconpicker/fontawesome-iconpicker.css")}}">

    <!-------- BACKEND - BOWER COMPONENTS -------->
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset("/bower_components/backend/plugins/iCheck/flat/blue.css")}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset("/bower_components/backend/plugins/morris/morris.css")}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset("/bower_components/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css")}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset("/bower_components/backend/plugins/datepicker/datepicker3.css")}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset("/bower_components/backend/plugins/daterangepicker/daterangepicker.css")}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset("/bower_components/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset("/bower_components/backend/plugins/select2/select2.css")}}">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset("/bower_components/backend/plugins/datatables/dataTables.bootstrap.css")}}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" type="image/x-icon" href="{!! URL::to('/') !!}/favicon.ico"/>

</head>
<body class="skin-red">
<div class="wrapper">
    <!-- Header -->
    @include('backend.partials.header')

    <!-- Sidebar -->
    @include('backend.partials.sidebar')

    <!-- Content -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                @yield('header_title')
                <small>@yield('header_sub_title')</small>
            </h1>
            @yield('breadcrumb')
        </section>
        <!-- Page Content -->
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Footer -->
    @include('backend.partials.footer')

</div>

<!-- JQUERY JS 3.1.1 -->
<script src="{{ asset("/js/backend/general/jquery/jquery.js")}}"></script>

<!-- jQuery UI 1.12.1 -->
<script src="{{ asset("/js/backend/general/jquery_UI/jquery-ui.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset("/bower_components/backend/bootstrap/js/bootstrap.min.js")}}"></script>
<!-- Bootstrap Editable 1.5.0 -->
<script src="{{ asset("/js/backend/plugins/bootstrap_editable/bootstrap-editable.js")}}"></script>
<!-- Morris.js charts - Raphael 2.2.1 -->
<script src="{{ asset("/js/backend/plugins/raphael_js/raphael.js")}}"></script>
<script src="{{ asset("/bower_components/backend/plugins/morris/morris.min.js")}}"></script>
<!-- IconPicker -->
<script src="{{ asset("/js/backend/plugins/iconpicker/fontawesome-iconpicker.js")}}"></script>
<script src="{{ asset("/js/backend/plugins/js-migrate/js-migrate.js")}}"></script>
<!-- Sparkline -->
<script src="{{ asset("/bower_components/backend/plugins/sparkline/jquery.sparkline.min.js")}}"></script>
<!-- jvectormap -->
<script src="{{ asset("/bower_components/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}"></script>
<script src="{{ asset("/bower_components/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("/bower_components/backend/plugins/knob/jquery.knob.js")}}"></script>
<!-- daterangepicker - Moment 2.17.0-->
<script src="{{ asset("/js/backend/plugins/moment_js/moment.js")}}"></script>
<script src="{{ asset("/bower_components/backend/plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- datepicker -->
<script src="{{ asset("/bower_components/backend/plugins/datepicker/bootstrap-datepicker.js")}}"></script>
<!-- Select2 -->
<script src="{{ asset("/bower_components/backend/plugins/select2/select2.full.js")}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset("/bower_components/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>
<!-- Slimscroll -->
<script src="{{ asset("/bower_components/backend/plugins/slimScroll/jquery.slimscroll.min.js")}}"></script>
<!-- FastClick -->
<script src="{{ asset("/bower_components/backend/plugins/fastclick/fastclick.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("/bower_components/backend/dist/js/app.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("/bower_components/backend/dist/js/demo.js")}}"></script>
<!-- DataTables -->
<script src="{{ asset("/bower_components/backend/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("/bower_components/backend/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("/js/backend/plugins/sortable_js/Sortable.js")}}"></script>

<!-- OWN SCRIPTS -->
<script src="{{ asset ("/js/backend/main.js") }}" type="text/javascript"></script>

</body>
</html>