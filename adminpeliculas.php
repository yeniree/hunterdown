<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}
require 'conexion.php';
include_once "funciones.php";
?>

<div class="row">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-10"><h1 style="margin-top: 0;">Lista de Temas</h1></div>
			<div class="col-md-2 text-right"><a alt="nuevo" id="nuevo" class="btn btn-info">Nueva</a></div>
		</div>

		
		<div class="row" >
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body" style="font-size: 11px">
						<form id="form-peli" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-4">
									<label>Categoría</label>
									<select class="form-control" name="categoria">
										<option></option>
										<?php
										$sql="select * from categorias order by 2";
										$rs = $conn->query($sql);
										while ($row = $rs->fetch_assoc()) {
											echo "<option value='".$row['idcategorias']."'>".$row['nombre']."</option>";
										}
										?>
									</select>
								</div>
								<div class="col-md-4">
									<label>Usuario</label>
									<input id="usuario" name="usuario" type="text" placeholder="Usuario" value="<?php echo $_SESSION['user'];?>" class="form-control"/>
								</div>
								<div class="col-md-4">
									<label>Título</label>
									<input name="titulo" type="text" placeholder="Título" value="" class="form-control"/>
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="col-md-4">
									<label>Fecha de Publicación</label>
									<input  type="text" placeholder="dd/mm/yyyy"  id="fecha" name="fecha" class="form-control">
									<span id="errorfecha"></span>
								</div>

								<div class="col-md-4">
									<label>Formato</label>
									<input name="formato" type="text" placeholder="Formato" value="" class="form-control"/>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<p id="generalt"></p>

			<div id="dataPelicula">
				
			</div>
			
		</div>
	</div>

</div>			
</div>

<!-- nuevo-->
<!--<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="Nuevo Tema" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Nuevo tema</h4>
			</div>
			<div id="nuevoContenido" class="modal-body">

			</div>
		</div>
	</div>
</div>-->

<script type="text/javascript">

	$(document).ready(function(){
		$.post("consultapeliculas.php",$(this).serialize(),function(data){
			$('#dataPelicula').html(data);
		});

		$("input").keyup(function(){
			$("form").submit();
		});

		$("select").change(function(){
			$("form").submit();
		});

		$("form").submit(function(e){
			e.preventDefault();

			$.post("consultapeliculas.php",$(this).serialize(),function(data){
				$('#dataPelicula').html(data);
			});
		});

		$("a[alt='nuevo']").click(function(e){
			e.preventDefault();
			pagina_a_cargar = "nuevapelicula.php";

			$.ajax({  
				url: pagina_a_cargar,  
				success: function(data) {
					$('#contenido').html(data);
					//$("#modalNuevo").modal("show");
				}  
			});
		});

	});

</script>