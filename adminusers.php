<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

$caru=false; 
require 'conexion.php';
include 'funciones.php';

$general_error = "";
if (isset($_POST['btneditar'])) {
	$edi_id = trim($_POST['id']);
	$edi_tipo_usu = trim($_POST['tipo_usu']);
	$edi_status = trim($_POST['status']);
	$edi_passwd = trim($_POST['passwd']);
	$edi_oldpass = trim($_POST['oldpass']);
	$edi_nombre = trim($_POST['nombre']);
	$errores = 0;

	if ($edi_oldpass != $edi_passwd) {
		if (isset($edi_passwd) && $edi_passwd!='') {
			if (!validarPass($edi_passwd)) {
				$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al actualizar el usuario, debe ingresar una contraseña valida.</div>";
				$errores = 1;
			}
		}else{
			$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al actualizar el usuario, debe ingresar una contraseña.</div>";
			$errores = 1;
		}
	}

	if (!$errores) {
		$sql = "UPDATE usuarios SET idtipousuarios = $edi_tipo_usu, status = $edi_status ";
		if ($edi_oldpass != $edi_passwd) {
			$sql = $sql.", passwd = '".md5($edi_passwd)."' ";
		}
		$sql = $sql." WHERE idusuarios = $edi_id ";
		$rs = $conn->query($sql);

		if($conn->affected_rows > 0){
			$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Registro Actualizado!</strong> El usuario $edi_nombre fue actualizado exitosamente.</div>";

		}else{
			$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al actualizar al usuario $edi_nombre.</div>";
		}

	}
}

if(isset($_POST['btneliminar'])) {
	$eli_id = trim($_POST['id']);
	$eli_nombre = trim($_POST['nombre']);

	$sql = "DELETE FROM usuarios WHERE idusuarios = $eli_id ";
	$rs = $conn->query($sql);

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Registro Eliminado!</strong> El usuario $eli_nombre fue eliminado exitosamente.</div>";

	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al eliminar al usuario $edi_nombre.</div>";
	}
}
?>

<script type="text/javascript">
$(document).ready(function(){
	$("#lusuarios > tbody > tr > td > a[alt='editar']").click(function(e){
		e.preventDefault();
		var idusuario = $(this).attr('href');
		pagina_a_cargar = "cargaformeditar.php?id=" + idusuario;

		$.ajax({  
			url: pagina_a_cargar,  
			success: function(data) {
				$('#editarContenido').html(data);
				$("#modalEditar").modal("show");
			}  
		});
	});

	$("#lusuarios > tbody > tr > td > a[alt='eliminar']").click(function(e){
		e.preventDefault();
		var idusuario = $(this).attr('href');
		pagina_a_cargar = "eliminarusuario.php?id=" + idusuario;

		$.ajax({  
			url: pagina_a_cargar,  
			success: function(data) {
				$('#eliminarContenido').html(data);
				$("#modalEliminar").modal("show");
			}  
		});
	});
});
</script>

<div class="row">
	<div class="col-md-12">
		<h1 style="margin-top: 0;">Lista de usuarios</h1>
		<?php if (strlen($general_error)>0) {echo $general_error;} ?>

		<?php 
		$sql = "SELECT * FROM usuarios WHERE 1=1";
		$rs = $conn->query($sql);

		if ($rs->num_rows > 0) {
			?>

			<table id="lusuarios" class="table table-striped table-hover table-responsive">
				<thead>
					<tr>
						<th class="hidden-xs">#</th>
						<th>Nombre</th>
						<th>Usuario</th>
						<th>Correo</th>
						<th>Sexo</th>
						<th class='hidden-xs'>Fec/Nac</th>
						<th>Tipo</th>
						<th class='text-center'>Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1; 
					while ($row = $rs->fetch_assoc()) {
						echo "<tr ".($row['status']==0?" class='danger' ":"").">
						<td class='hidden-xs'>".$i++."</td>
						<td>".$row['nombre']."</td>
						<td>".$row['usuario']."</td>
						<td>".$row['email']."</td>
						<td>".$row['sexo']."</td>
						<td class='hidden-xs'>".cambiarfecha($row['fecnac'])."</td>
						<td>".($row['idtipousuarios']==1?'Administrador':($row['idtipousuarios']==2?'Publicador':'Basico'))."</td>
						<td class='text-center'>";
						?>
						<a href="<?php echo $row['idusuarios']; ?>" class="glyphicon glyphicon-pencil text-success toolti" alt="editar" data-toggle="tooltip" data-placement="bottom" title="Editar Usuario"></a>

						<a href="<?php echo $row['idusuarios']; ?>" class="glyphicon glyphicon-remove text-danger toolti" alt="eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar Usuario"></a>
						<?php
						echo "  </td>
						</tr>"	;
					}
					?>
				</tbody>
			</table>
			<span class="text-info">Usuarios en color <strong class="text-danger">rojo</strong> se encuentran inactivos.</span>
			<?php } $rs->close(); $conn->close();?>

			<!-- Modal -->
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="Editar Usuario" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Editar Usuario</h4>
						</div>
						<div id="editarContenido" class="modal-body">

						</div>
					</div>
				</div>
			</div>
			<!-- Modal 2-->
			<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="Eliminar Usuario" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Editar Usuario</h4>
						</div>
						<div id="eliminarContenido" class="modal-body">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
