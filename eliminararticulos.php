<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

$idarticulos = $_GET['id'];

require 'conexion.php';
$sql = "SELECT * FROM articulos WHERE idarticulos = ".$idarticulos;

$rs = $conn->query($sql);

$row = $rs->fetch_assoc();
$nombre = trim($row['nombre']);
$idarticulos=$row['idarticulos'];
$idtemas=$row['idtemas'];
?>

<form id="form-eliminar" class="form-horizontal" method="post" enctype="multipart/form-data" >
	<p class="lead">
		Esta seguro de Eliminar el artículo:<br/>
		<?php echo $nombre; ?><br/>
	</p>

	<input type="hidden" name="id" id="id" value="<?php echo $idarticulos; ?>"/>
	<input type="hidden" name="nombre" id="nombre" value="<?php echo $nombre; ?>"/>

	<div class="form-group" style="margin-top: 35px;">
		<div class="col-md-12 text-center">
			<div class="btn-group">
				<button type="button" class="btn btn-default" style="width: 120px;" data-dismiss="modal">Cancelar</button>
				<input type="submit" id="btneliminar" name="btneliminar" 
				class="btn btn-danger col-md-3" style="width: 120px;" value="Eliminar"/>
			</div>
		</div>
	</div>

	<input type="hidden" name="operacion" id="operacion" value="5"/>
	
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$("#form-eliminar").submit(function(e){
			e.preventDefault();

			$.ajax( {
				url: 'configtemas.php',
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function(data) {
					$('.modal').modal('hide');

					$.ajax({  
						url: "nuevapelicula.php?id=<?php echo $idtemas; ?>",
						success: function(contenido) {
							$('#contenido').html(contenido);
							$('#generalt').html(data);

						}  
					});

				}  
			});
		});
	});
</script>