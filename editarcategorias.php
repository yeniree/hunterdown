<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

$idcategorias = $_GET['id'];

require 'conexion.php';
$sql = "SELECT * FROM categorias WHERE idcategorias = ".$idcategorias;

$rs = $conn->query($sql);

$row = $rs->fetch_assoc();
$nombre = trim($row['nombre']);

?>

<form id="form-editar" class="form-horizontal" method="post" enctype="multipart/form-data" >
	<!-- Select Basic -->
	<div class="form-group">
		<label class="col-md-4 control-label" for="tipo_usu">Categoría</label>
		<div class="col-md-5">
			<input id="nombre" name="nombre" type="text" placeholder="Nombre de la Categoría" 
			class="form-control input-md" required="" value="<?php echo $nombre; ?>">
		</div>
	</div>

	<input type="hidden" name="idcat" id="idcat" value="<?php echo $idcategorias; ?>"/>
	<input type="hidden" name="nombrecat" id="nombrecat" value="<?php echo $nombre; ?>"/>

	<div class="form-group" style="margin-top: 35px;">
		<div class="col-md-12 text-center">
			<div class="btn-group">
				<button type="button" class="btn btn-default" style="width: 150px;" data-dismiss="modal">Cancelar</button>
				<input type="submit" id="btneditar" name="btneditar"
				class="btn btn-primary col-md-3" style="width: 150px;" value="Guardar Cambios"/>
			</div>
		</div>
	</div>

	<input type="hidden" name="operacion" id="operacion" value="1"/>

</form>

<script type="text/javascript">

	$("#form-editar").submit( function( e ) {
		e.preventDefault();

		$.ajax( {
			url: 'configCategorias.php',
			type: 'POST',
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(data) {
				$('.modal').modal('hide'); 
				
				$.ajax({  
					url: "categorias.php",
					success: function(contenido) {
						$('#contenido').html(contenido);
						$('#generalc').html(data);

					}  
				});
				
			}  
		});
	});

	$('.modal').on('loaded.bs.modal', function (e) {
		alert("paso");
	})
</script>