<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- If you delete this meta tag, Half Life 3 will never be released. -->
    <meta name="viewport" content="width=device-width" />

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>VDK Design - Contact verzoek</title>

    <!-- PLUGIN CSS -->
    <link href="{{ asset("css/general/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />

    <style>
        /* -------------------------------------
		GLOBAL
------------------------------------- */
        * {
            margin:0;
            padding:0;
        }
        body { font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif !important; }

        img {
            max-width: 100%;
        }
        .collapse {
            margin:0;
            padding:0;
        }
        body {
            -webkit-font-smoothing:antialiased;
            -webkit-text-size-adjust:none;
            width: 100%!important;
            height: 100%;
        }


        /* -------------------------------------
                ELEMENTS
        ------------------------------------- */
        a { color: #ed2b35; text-decoration: none;}
        a.tel{
            color: black;
        }
        a:hover{
            cursor: pointer;
        }
        .btn {
            text-decoration:none;
            color: #FFF;
            background-color: #666;
            padding:10px 16px;
            font-weight:bold;
            margin-right:10px;
            text-align:center;
            cursor:pointer;
            display: inline-block;
        }

        p.callout {
            padding:15px;
            background-color:#ECF8FF;
            margin-bottom: 15px;
        }
        .callout a {
            font-weight:bold;
            color: #2BA6CB;
        }

        table.social {
            /* 	padding:15px; */
            background-color: #ebebeb;

        }
        .social .soc-btn {
            padding: 3px 7px;
            font-size:12px;
            margin-bottom:10px;
            text-decoration:none;
            color: #FFF;font-weight:bold;
            display:block;
            text-align:center;
        }
        .footer_social{
        }
        .footer_social li{
            display: inline-block;

        }
        .footer_social li:first-child{
            margin-left: 0;
        }
        .footer_social i{
            text-align: left;
            color: black;
        }
        .footer_social i:hover{
            color: #ed2b35;
        }
        .footer_info i{
            width: 8%;
        }
        .sidebar .soc-btn {
            display:block;
            width:100%;
        }

        /* -------------------------------------
                HEADER
        ------------------------------------- */
        table.head-wrap { width: 100%;}

        .header.container table td.logo { padding: 15px; }
        .header.container table td.label { padding: 15px; padding-left:0px;}
        img{max-width: 150px;}


        /* -------------------------------------
                BODY
        ------------------------------------- */
        table.body-wrap { width: 100%;}


        /* -------------------------------------
                FOOTER
        ------------------------------------- */
        table.footer-wrap { width: 100%;	clear:both!important;
        }
        .footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
        .footer-wrap .container td.content p {
            font-size:10px;
            font-weight: bold;

        }


        /* -------------------------------------
                TYPOGRAPHY
        ------------------------------------- */
        h1,h2,h3,h4,h5,h6 {
            font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
        }
        h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

        h1 { font-weight:200; font-size: 44px;}
        h2 { font-weight:200; font-size: 37px;}
        h3 { font-weight:500; font-size: 27px; margin-bottom: 30px;}
        h4 { font-weight:500; font-size: 23px;}
        h5 { font-weight: bold; font-size: 17px;margin-bottom: 20px; text-decoration: underline}
        h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

        .collapse { margin:10px 0 0 0;  color: #61BDD5;text-align: left;}

        p, ul {
            margin-bottom: 10px;
            font-weight: normal;
            font-size:14px;
            line-height:1.6;
        }
        p.lead { font-size:16px; margin-bottom: 30px;}
        p.header_title{
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
        }
        .content_gegevens{
            margin-bottom: 20px;
        }
        .content_gegevens td{
            padding-bottom: 15px;
        }
        .content_gegevens tr td:nth-child(odd){
            width: 25%;
        }
        .content_gegevens td a{
            padding-bottom: 15px;
        }
        p.last { margin-bottom:0px;}

        ul li {
            margin-left:5px;
            list-style-position: inside;
        }

        /* -------------------------------------
                SIDEBAR
        ------------------------------------- */
        ul.sidebar {
            background:#ebebeb;
            display:block;
            list-style-type: none;
        }
        ul.sidebar li { display: block; margin:0;}
        ul.sidebar li a {
            text-decoration:none;
            color: #666;
            padding:10px 16px;
            /* 	font-weight:bold; */
            margin-right:10px;
            /* 	text-align:center; */
            cursor:pointer;
            border-bottom: 1px solid #777777;
            border-top: 1px solid #FFFFFF;
            display:block;
            margin:0;
        }
        ul.sidebar li a.last { border-bottom-width:0px;}
        ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}



        /* ---------------------------------------------------
                RESPONSIVENESS
                Nuke it from orbit. It's the only way to be sure.
        ------------------------------------------------------ */

        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        .container {
            display:block!important;
            max-width:600px!important;
            margin:0 auto!important; /* makes it centered */
            clear:both!important;
        }

        /* This should also be a block element, so that it will fill 100% of the .container */
        .content {
            padding:15px;
            max-width:600px;
            margin:0 auto;
            display:block;
        }

        /* Let's make sure tables in the content area are 100% wide */
        .content table { width: 100%; }


        /* Odds and ends */
        .column {
            width: 300px;
            float:left;
        }
        .column tr td { padding: 15px; }
        .column-wrap {
            padding:0!important;
            margin:0 auto;
            max-width:600px!important;
        }
        .column table { width:100%;}
        .social .column {
            width: 280px;
            min-width: 279px;
            float:left;
        }

        /* Be sure to place a .clear element after each set of columns, just to be safe */
        .clear { display: block; clear: both; }


        /* -------------------------------------------
                PHONE
                For clients that support media queries.
                Nothing fancy.
        -------------------------------------------- */
        @media only screen and (max-width: 600px) {

            a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

            div[class="column"] { width: auto!important; float:none!important;}

            table.social div[class="column"] {
                width:auto!important;
            }

        }
    </style>

</head>

<body bgcolor="#FFFFFF">

<!-- HEADER -->
<table class="head-wrap" bgcolor="#222">
    <tr>
        <td></td>
        <td class="header container" >

            <div class="content">
                <table bgcolor="#222">
                    <tr>
                        <td> <img src="{!! URL::to('/') !!}/img/frontend/logo_red.png"  class="" alt="Logo"/></td>
                    </tr>
                </table>
            </div>

        </td>
        <td></td>
    </tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">

            <div class="content">
                <table>
                    <tr>
                        <td>
                            <h3>Beste VDK Design,</h3>
                            <p>
                                Er is een nieuw probleem request binnen gekomen.
                            </p>
                            <p class="header_title">
                                Gegevens:
                            </p>
                            <table class="content_gegevens">
                                <tr>
                                    <td>Onderwerp:</td>
                                    <td>{{$data['subject']}}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{$email}}</td>
                                </tr>
                                <tr>
                                    <td>Bericht:</td>
                                    <td>{{$data['bericht']}}</td>
                                </tr>
                            </table>

                            <!-- social & contact -->
                            <table class="social" width="100%">
                                <tr>
                                    <td>
                                        <!-- column 1 -->
                                        <table align="left" class="column">
                                            <tr>
                                                <td>
                                                    <h5 class="">Volg VDK Design</h5>
                                                    <div class="footer_social">
                                                        <ul class="list-inline">
                                                            <li><a href="https://www.facebook.com/designVDK/?fref=ts" target="_blank"><i class="fa fa-facebook fa-fw fa-2x"></i></a>
                                                            </li>
                                                            <li><a href="https://be.linkedin.com/in/stijn-vanderkimpen-72764a60" target="_blank"><i class="fa fa-linkedin fa-fw fa-2x"></i></a>
                                                            </li>
                                                            <li><a href="https://twitter.com/VDKDesign" target="_blank"><i class="fa fa-twitter fa-fw fa-2x"></i></a>
                                                            </li>
                                                            <li><a href="https://plus.google.com/u/0/106276271728242048633" target="_blank"><i class="fa fa-google-plus fa-fw fa-2x"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </td>
                                            </tr>
                                        </table><!-- /column 1 -->

                                        <!-- column 2 -->
                                        <table align="left" class="column">
                                            <tr>
                                                <td>

                                                    <h5 class="">Contact Info</h5>
                                                    <p class="footer_info">
                                                        <i class="fa fa-phone"></i> <a href="tel:+0032472 76 50 39" class="tel">0472/76.50.39</a><br/>
                                                        <i class="fa fa-envelope"></i> <strong><a href="emailto:info@vdk-design.be" style="font-size:14px;">info@vdk-design.be</a></strong><br/>
                                                        <i class="fa fa-road"></i> Elzeelsesteenweg 327<br/>
                                                        <i class="fa fa-map-marker"></i> 9600 Ronse
                                                    </p>

                                                </td>
                                            </tr>
                                        </table><!-- /column 2 -->

                                        <span class="clear"></span>

                                    </td>
                                </tr>
                            </table><!-- /social & contact -->

                        </td>
                    </tr>
                </table>
            </div><!-- /content -->

        </td>
        <td></td>
    </tr>
</table><!-- /BODY -->

</body>
</html>