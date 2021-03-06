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
		$("#lcategorias > tbody > tr > td > a[alt='editar']").click(function(e){
			e.preventDefault();
			var idcategoria = $(this).attr('href');
			pagina_a_cargar = "editarcategorias.php?id=" + idcategoria;

			$.ajax({  
				url: pagina_a_cargar,  
				success: function(data) {
					$('#editarContenido').html(data);
					$("#modalEditar").modal("show");
				}  
			});
		});

		$("#lcategorias > tbody > tr > td > a[alt='eliminar']").click(function(e){
			e.preventDefault();
			var idcategoria = $(this).attr('href');
			pagina_a_cargar = "eliminarcategoria.php?id=" + idcategoria;

			$.ajax({  
				url: pagina_a_cargar,  
				success: function(data) {
					$('#eliminarContenido').html(data);
					$("#modalEliminar").modal("show");
				}  
			});
		});

		$("a[alt='nuevo']").click(function(e){
			e.preventDefault();
			pagina_a_cargar = "nuevacategoria.php";

			$.ajax({  
				url: pagina_a_cargar,  
				success: function(data) {
					$('#nuevoContenido').html(data);
					$("#modalNuevo").modal("show");
				}  
			});
		});
	});
</script>

<div class="row">
	<div class="col-md-6">
		<h1 style="margin-top: 0;">Lista de Categorías</h1>
	</div>
	<div class="col-md-6 text-right">
		<a alt="nuevo" id="nuevo" class="btn btn-info">Nuevo</a>
	</div>

	<div class="col-md-12">
		<p id="generalc"></p>
		<?php 
		$sql = "SELECT * FROM categorias WHERE 1=1";
		$rs = $conn->query($sql);

		if ($rs->num_rows > 0) {
			?>

			<table id="lcategorias" class="table table-striped table-hover table-responsive">
				<thead>
					<tr>
						<th class="hidden-xs">#</th>
						<th>Nombre</th>
						<th class='text-center'>Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1; 
					while ($row = $rs->fetch_assoc()) {
						echo "<tr>
						<td class='hidden-xs'>".$i++."</td>
						<td>".$row['nombre']."</td>
						<td class='text-center'>";
							?>
							<a href="<?php echo $row['idcategorias']; ?>" class="glyphicon glyphicon-pencil text-success toolti" alt="editar" data-toggle="tooltip" data-placement="bottom" title="Editar categoria"></a>

							<a href="<?php echo $row['idcategorias']; ?>" class="glyphicon glyphicon-remove text-danger toolti" alt="eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar categoria"></a>
							<?php
							echo "  </td>
						</tr>"	;
					}
					?>
				</tbody>
			</table>
			<?php } $rs->close(); $conn->close();?>

			<!-- Modal -->
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="Editar Categoría" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Editar Categoría</h4>
						</div>
						<div id="editarContenido" class="modal-body">

						</div>
					</div>
				</div>
			</div>
			<!-- Modal 2-->
			<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="Eliminar Categoría" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Eliminar Categoría</h4>
						</div>
						<div id="eliminarContenido" class="modal-body">

						</div>
					</div>
				</div>
			</div>
			<!-- nuevo-->
			<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="Nuevo " aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Nuevo </h4>
						</div>
						<div id="nuevoContenido" class="modal-body">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
