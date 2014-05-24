<?php //session_start(); ?>

<?php 
if (isset($_GET['cerrarSesion'])) {
	if ($_GET['cerrarSesion']){
		session_unset();
		session_destroy();
		header("location: index.php");
	}
}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>..::Peliculas y Series::..</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/validation/jquery.validate.min.js"></script>
	<script src="js/validaciones.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
	<script type="text/javascript" src="js/jquery.scrollTo.js"></script>
	<script type="text/javascript">
	jQuery(function($){
		$('#top-link').click(function(){
			$.scrollTo( 0, 400);
			return false;
		});
	});
	</script>

	<script type="text/javascript">
	jQuery.fn.topLink = function(settings) {
		settings = jQuery.extend({
			min: 1,
			fadeSpeed: 200,
			ieOffset: 50
		}, settings);
		return this.each(function() {
			var el = $(this);
			el.css('display','none');
			$(window).scroll(function() {
				if(!jQuery.support.hrefNormalized) {
					el.css({
						'position': 'absolute',
						'top': $(window).scrollTop() + $(window).height() - settings.ieOffset
					});
				}
				if($(window).scrollTop() >= settings.min)
				{
					el.fadeIn(settings.fadeSpeed);
				}
				else
				{
					el.fadeOut(settings.fadeSpeed);
				}
			});
		});
	};
	
	$(document).ready(function() {
		$('#top-link').topLink({
			min: 600,
			fadeSpeed: 500
		});
	});
	</script>

	<style type="text/css">
	/*html{position: relative; top: 0px; bottom: 0px;}
	body{color: #e5e5e5;}
	.grand{
		background: #7d7e7d;
		background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzdkN2U3ZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwZTBlMGUiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
		background: -moz-linear-gradient(top,  #4a4e4a 0%, #0e0e0e 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#4a4e4a), color-stop(100%,#0e0e0e));
		background: -webkit-linear-gradient(top,  #4a4e4a 0%,#0e0e0e 100%);
		background: -o-linear-gradient(top,  #4a4e4a 0%,#0e0e0e 100%);
		background: -ms-linear-gradient(top,  #4a4e4a 0%,#0e0e0e 100%);
		background: linear-gradient(to bottom,  #4a4e4a 0%,#0e0e0e 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4a4e4a', endColorstr='#0e0e0e',GradientType=0 );
		}*/
		.banners{width: auto;max-height: 500px;overflow: hidden;}
		.navbar-wrapper {position: absolute;top: 20px;right: 0;left: 0;z-index: 20;}
		.navbar-wrapper .container {padding-right: 0;padding-left: 0;}
		.navbar-wrapper .navbar {padding-right: 15px;padding-left: 15px;}

		.bs-callout{margin:20px 0;padding:20px;border-left:3px solid #eee; height: auto;}
		.bs-callout h4{margin-top:0;margin-bottom:5px}
		.bs-callout p:last-child{margin-bottom:0}
		.bs-callout code{background-color:#fff;border-radius:3px}
		.bs-callout-danger{background-color:#fdf7f7;border-color:#d9534f}
		.bs-callout-danger h4{color:#d9534f}
		.bs-callout-warning{background-color:#fcf8f2;border-color:#f0ad4e}
		.bs-callout-warning h4{color:#f0ad4e}
		.bs-callout-info{background-color:#f4f8fa;border-color:#5bc0de}
		.bs-callout-info h4{color:#5bc0de}

		#top-link {
			display: inline;
			text-decoration: none;
			position: fixed;
			bottom: 50px;
			right: 20px;
			overflow: hidden;
			width: 51px;
			height: 51px;
			border: medium none;
			text-indent: 100%;
			background: url('img/top.png') no-repeat scroll left top transparent;
		}
		.well{color: #3a3e3d;}
		label[class~="checkbox-inline"]{margin-left: 10px;}
		</style>
	</head>
	<body class="grand" style="padding-top: 50px;">

		<?php
		$home="";
		$peli="";
		$series="";
		$login="";
		$reg="";
		$admu="";

		if(strpos($_SERVER['REQUEST_URI'], "login"))
			$login = " class='active' ";
		elseif(strpos($_SERVER['REQUEST_URI'], "registra"))
			$reg=  " class='active' ";
		elseif(strpos($_SERVER['REQUEST_URI'], "admin"))
			$admu = " class='active' ";
		else
			$home = " class='active' ";
		?>
		<div class="navbar-wrapper">

			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">HunterDown</a>
						<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div class="collapse navbar-collapse" id="navbar-main">
						<ul class="nav navbar-nav">
							<li <?php print($home); ?>><a href="index.php">Inicio</a></li>
							<?php 
							if(isset($_SESSION['user'])) {
								if ($_SESSION['tipo_usu'] == 1) {
									?>
									<li <?php print($admu); ?>><a href="admin.php">Administrar</a></li>
									<?php }} ?>
								</ul>


								<ul class="nav navbar-nav navbar-right">
									<?php if (!isset($_SESSION['user'])) {?>
									<li <?php print($login); ?>><a href="login.php">Login</a></li>
									<li <?php print($reg); ?>><a href="registrar.php#form-registro">Registrarse</a></li>
									<?php }else{ ?>
									<li>
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"> </i> <?php print($_SESSION['nombre']); ?> <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a id="cerrarSesion" href="index.php?cerrarSesion=true">Cerrar</a></li>
										</ul>
									</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</nav>
				</div>


<!-- Carousel
	================================================== -->
	<?php if ($caru) { ?>
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
			<li data-target="#myCarousel" data-slide-to="4"></li>
		</ol>
		<div class="carousel-inner">
			<div class="item active">
				<div class="banners">
					<img src="img/banners/thewalkingdead.jpg" alt="The Walking Dead" class="img-responsive">
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1>The Walking Dead Temporada 4</h1>
					</div>
				</div>
			</div>

			<div class="item">
				<div class="banners">
					<img src="img/banners/arrow.jpg" alt="Arrow" class="img-responsive">
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1>Arrow Temporada 2</h1>
					</div>
				</div>
			</div>

			<div class="item">
				<div class="banners">
					<img src="img/banners/gameofthrones.jpg" alt="Game Of Thrones" class="img-responsive">
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1>Game Of Thrones Temporada 4</h1>
						<p>Estreno el proximo 6 de Abril.</p>
					</div>
				</div>
			</div>

			<div class="item">
				<div class="banners">
					<img src="img/banners/thefollowing.jpg" alt="The Following" class="img-responsive">
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1>The Following Temporada 2</h1>
					</div>
				</div>
			</div>

			<div class="item">
				<div class="banners">
					<img src="img/banners/agentsofshield.jpg" alt="Agenst Of S.H.I.E.L.D." class="img-responsive">
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1>Agenst Of S.H.I.E.L.D. Temporada 1</h1>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
	<?php } ?>
<!-- carousel -->