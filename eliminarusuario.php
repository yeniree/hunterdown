<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}


$idusuario = $_GET['id'];

require 'conexion.php';
$sql = "SELECT * FROM usuarios WHERE idusuarios = ".$idusuario;

$rs = $conn->query($sql);

$row = $rs->fetch_assoc();
$nombre = $row['nombre'];
$user = $row['usuario'];
$email = $row['email'];
$passwd = $row['passwd'];
$tipo_usu = $row['idtipousuarios'];
$status = $row['status'];
?>

<form id="form-editar" class="form-horizontal" method="post" action="adminusers.php">
	<p class="lead">
		Esta seguro de Eliminar al usuario:<br/>
		<?php echo $nombre; ?><span class="text-muted"> (<?php echo $user; ?>)</span><br/>
		<span class="text-info"><?php echo $email; ?> </span>
	</p>

	<p id="general"></p>
	
	<input type="hidden" name="id" id="id" value="<?php echo $idusuario; ?>"/>
	<input type="hidden" name="nombre" id="nombre" value="<?php echo $nombre; ?>"/>

	<div class="form-group" style="margin-top: 35px;">
		<div class="col-md-12 text-center">
			<div class="btn-group">
				<button type="button" class="btn btn-default" style="width: 120px;" data-dismiss="modal">Cancelar</button>
				<input type="button" id="btneliminar" name="btneliminar" 
				class="btn btn-danger col-md-3" style="width: 120px;" value="Eliminar"/>
			</div>
		</div>
	</div>
	
</form>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#btneliminar").click(function(e){
				e.preventDefault();
				$.ajax({  
					type: "POST",
					url: "configUser.php",
					data: {id: ""+$('#id').val()+"", nombre: ""+$('#nombre').val()+"", operacion: 0},
					success: function(data) {
						$("#general").html(data);
						$("#btneliminar").hide();
						$(".lead").hide();
					}  
				});
			});
		});
	</script>