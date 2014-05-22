<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

$caru=false; 
include("header.php");
?>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({  
			url: "adminusers.php",
			success: function(data) {
				$('#contenido').html(data);
			}  
		});

		$("#menulateral > li > a").click(function(e){
			e.preventDefault();
			var pagina = $(this).attr('href');
			var padre = $(this).parent();
			$.ajax({  
				url: pagina,
				success: function(data) {
					$("#menulateral > li").removeClass("active");
					padre.addClass('active');
					$('#contenido').html(data);
				}  
			});
		});
	});
</script>

<div class="container" style="margin-top: 30px;">
	<div class="row">
		<div class="col-md-3">
			<ul id="menulateral" class="nav nav-pills nav-stacked">
				<li><a href="adminusers.php">Usuarios</a></li>
				<li><a href="servidores.php">Servidores</a></li>
				<li><a href="#">Peliculas</a></li>
				<li><a href="#">Series</a></li>
				<li><a href="categorias.php">Cetegorías</a></li>
				<li><a href="#">Algo mas</a></li>
			</ul>
		</div>

		<div id="contenido" class="col-md-9">
			
		</div>
	</div>
</div>

<?php include("footer.php"); ?>