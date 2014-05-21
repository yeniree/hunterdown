<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

$idservidores = $_GET['id'];

require 'conexion.php';
$sql = "SELECT * FROM servidores WHERE idservidores = ".$idservidores;

$rs = $conn->query($sql);

$row = $rs->fetch_assoc();
$nombre = trim($row['nombre']);
$idservidores=$row['idservidores'];
?>

<form id="form-eliminar" class="form-horizontal" method="post" enctype="multipart/form-data" >
	<p class="lead">
		Esta seguro de Eliminar el servidor:<br/>
		<?php echo $nombre; ?><br/>
	</p>

	<p id="general"></p>
	
	<input type="hidden" name="id" id="id" value="<?php echo $idservidores; ?>"/>
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

	<input type="hidden" name="operacion" id="operacion" value="0"/>
	
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$("#form-eliminar").submit(function(e){
			e.preventDefault();

			$.ajax( {
				url: 'configServidor.php',
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function(data) {
					$('#general').html(data);
					$(".lead").hide();
					$("#btneliminar").hide();
				}  
			});
		});
	});
</script>