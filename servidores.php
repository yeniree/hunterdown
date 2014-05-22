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
		$("#lservidores > tbody > tr > td > a[alt='editar']").click(function(e){
			e.preventDefault();
			var idservidor = $(this).attr('href');
			pagina_a_cargar = "editarservidor.php?id=" + idservidor;

			$.ajax({  
				url: pagina_a_cargar,  
				success: function(data) {
					$('#editarContenidoServidor').html(data);
					$("#modalEditarServidor").modal("show");
				}  
			});
		});

		$("#lservidores > tbody > tr > td > a[alt='eliminar']").click(function(e){
			e.preventDefault();
			var idservidor = $(this).attr('href');
			pagina_a_cargar = "eliminarservidor.php?id=" + idservidor;

			$.ajax({  
				url: pagina_a_cargar,  
				success: function(data) {
					$('#eliminarContenidoServidor').html(data);
					$("#modalEliminarServidor").modal("show");
				}  
			});
		});

		$("a[alt='nuevo']").click(function(e){
			e.preventDefault();
			pagina_a_cargar = "nuevoServidor.php";

			$.ajax({  
				url: pagina_a_cargar,  
				success: function(data) {
					$('#nuevoContenidoServidor').html(data);
					$("#modalNuevoServidor").modal("show");
				}  
			});
		});
	});
</script>
<div class="row">
	<div class="col-md-6">
		<h1 style="margin-top: 0;">Lista de Servidores</h1>
	</div>
	<div class="col-md-6 text-right">
		<a alt="nuevo" id="nuevo" class="btn btn-info">Nuevo</a>
	</div>
	<div class="col-md-12">	
		
		<?php 
		$sql = "SELECT * FROM servidores WHERE 1=1";
		$rs = $conn->query($sql);

		if ($rs->num_rows > 0) {
			?>
			<p id="generals"></p>

			<table id="lservidores" class="table table-striped table-hover table-responsive" id="lservers">
				<thead>
					<tr>
						<th class="hidden-xs" width="10%">#</th>
						<th>Nombre</th>
						<th width="10%">Logo</th>
						<th width="10%">Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					while ($fila = $rs->fetch_assoc()) {	
						$logo = trim($fila['logo']);

						if (strlen($logo)==0 or !file_exists("img/".$logo)) {
							$logo = "servidores/sinlogo.png";
						}

						echo "<tr>
						<td class='hidden-xs'>".$i++."</td>
						<td>".$fila['nombre']."</td>
						<td><img src='img/".$logo."' height='40' width='40' alt='".$fila['nombre']."'></td>
						<td>";
							?>
							<a href="<?php echo $fila['idservidores']; ?>" class="glyphicon glyphicon-pencil text-success toolti" alt="editar" data-toggle="tooltip" data-placement="bottom" title="Editar Servidor"></a>

							<a href="<?php echo $fila['idservidores']; ?>" class="glyphicon glyphicon-remove text-danger toolti" alt="eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar Servidor"></a>
							<?php
							"</td>
						</tr>";
					}
					?>
				</tbody>
			</table> <?php }$rs->close();?>

			<!-- editar -->
			<div class="modal fade" id="modalEditarServidor" tabindex="-1" role="dialog" aria-labelledby="Editar Servidor" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Editar Servidor</h4>
						</div>
						<div id="editarContenidoServidor" class="modal-body">

						</div>
					</div>
				</div>
			</div>
			<!-- eliminar-->
			<div class="modal fade" id="modalEliminarServidor" tabindex="-1" role="dialog" aria-labelledby="Eliminar Servidor" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Eliminar Servidor</h4>
						</div>
						<div id="eliminarContenidoServidor" class="modal-body">

						</div>
					</div>
				</div>
			</div>
			<!-- nuevo-->
			<div class="modal fade" id="modalNuevoServidor" tabindex="-1" role="dialog" aria-labelledby="Nuevo Servidor" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Nuevo Servidor</h4>
						</div>
						<div id="nuevoContenidoServidor" class="modal-body">

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>