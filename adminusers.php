<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

$caru=false; 
require 'conexion.php';
include 'funciones.php';
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
							<h4 class="modal-title">Eliminar Usuario</h4>
						</div>
						<div id="eliminarContenido" class="modal-body">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.modal').on('hidden.bs.modal', function () {
				$.ajax({  
					url: "adminusers.php",
					success: function(data) {
						$('#contenido').html(data);
					}  
				});
			});
		});
	</script>
