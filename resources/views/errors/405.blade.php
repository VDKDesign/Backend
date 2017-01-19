<html>
	<head>
		<title>VDK Design - 404 Error</title>
		<link rel="shortcut icon" type="image/x-icon" href="{!! URL::to('/') !!}/favicon.ico"/>
		<style>
			.content {
				width: 100%;
			}
			.error-content{
				margin-left: 0 !important;
				text-align: center;
			}
			.headline{
				font-size: 100px;
				text-align: center;
			}
			h3{
				text-align: center;
			}
            img{
                max-width: 75px;
                margin-bottom: 20px;
            }
		</style>
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
	</head>
	<body>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper" style="margin-left: 0;">
			<section class="content-header">
				<h1>
					<a href="{!! URL::to('/') !!}"><img src="{!! URL::to('/') !!}/img/backend/logo.png" alt="VDK Design"></a>
				</h1>
				<ol class="breadcrumb">
					<li><a href="{!! URL::to('/') !!}/backend"><i class="fa fa-home"></i> Home</a></li>
					<li class="active">404 error</li>
				</ol>
			</section>
			<section class="content">
				<div class="error-page">
					<div>
						<h2 class="headline text-yellow"> 404</h2>
					</div>
					<div>
						<h3><i class="fa fa-warning text-yellow"></i> Opgelet! Pagina niet gevonden.</h3>
					</div>
					<div class="error-content">
						<p>
							De pagina waar u naar zoekt kunnen we niet terugvinden. <br/>
							Keer terug naar het <a href="{!! URL::to('/') !!}/backend">dashboard</a>.
						</p>
					</div>
				</div>
			</section>
		</div>
	</body>
</html>