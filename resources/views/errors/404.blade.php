<html>
	<head>
		<title>VDK Design - 404 Error</title>
		<link rel="shortcut icon" type="image/x-icon" href="{!! URL::to('/') !!}/favicon.ico"/>
		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #61BDD5;
                background-color: #E6E6E1;
				display: table;
				font-weight: 100;
                font-family: 'Montserrat', sans-serif;
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 40px;
				margin: 20px 0 20px 0;
				color: #ed2b35;
			}
            img{
                max-width: 350px;
                margin-bottom: 20px;
            }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<a href="{!! URL::to('/') !!}"><img src="{!! URL::to('/') !!}/img/backend/logo.png" alt="VDK Design"></a>
                <div class="title">Deze pagina werd niet gevonden</div>
            </div>
		</div>
	</body>
</html>