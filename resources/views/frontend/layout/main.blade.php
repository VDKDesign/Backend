<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="author" content="">
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="google-site-verification" content="ZbqP5qTOQNE0028F4TnE4bJeETIPOYguro843g8TLVQ" />

    @yield('meta_data')

        <link rel="shortcut icon" type="image/x-icon" href="{!! URL::to('/') !!}/"/>

    @yield('title')

    <!-- BOOSTRAP CSS -->

    <!-- Modern Style Fonts (IMPORTANT: Delete these unless you are using body.modern!) -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- PLUGIN CSS -->


    <!-- IE8 support for HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top" class="modern">

@include('frontend.partials.navigation')

@yield('content')

@include('frontend.partials.footer')

<!-- GENERAL js -->

<!-- PLUGIN js -->

<!-- Contact Form js -->

<!-- Vitality Theme js -->

@yield('scripts')

@include('frontend.partials.google_analytics')

</body>
</html>
