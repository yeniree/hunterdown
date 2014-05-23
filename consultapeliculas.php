<?php
session_start();
require 'conexion.php';

$usuario=$_POST['usuario'];
$titulo=$_POST['titulo'];
$fecha=$_POST['fecha'];
$formato=$_POST['formato'];
$categoria=$_POST['categoria'];


if (!empty($usuario)){
	$sql="SELECT * FROM usuarios WHERE usuario LIKE '%$usuario%'";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();

	$condicion = " WHERE idusuarios = '".$row['idusuarios']."'";
}else{
	$usuario = $_SESSION['user'];
}

if (!empty($titulo)){
	if ($condicion){
		$condicion .= " AND titulo LIKE '%$titulo%'";
	}else{
		$condicion = " WHERE titulo LIKE '%$titulo%'";
	}
}

if (!empty($fecha)){
	$fecha=new Datetime($fecha);
	if ($condicion){
		$condicion .= " AND fechahora = '".$fecha->format('Y-m-d H:i:s')."'";
	}else{
		$condicion = " WHERE fechahora = '".$fecha->format('Y-m-d H:i:s')."'";
	}
}

if (!empty($formato)){
	if ($condicion){
		$condicion .= " AND formato = '$formato'";
	}else{
		$condicion = " WHERE formato = '$formato'";
	}
}

if (!empty($categoria)){
	if ($condicion){
		$condicion .= " AND idcategorias = '$categoria'";
	}else{
		$condicion = " WHERE idcategorias = '$categoria'";
	}
}

if (!$condicion) {$condicion = " WHERE idusuarios = '".$_SESSION['idusuarios']."'";}

$sql = "SELECT temas.*, categorias.nombre FROM temas INNER JOIN categorias ON temas.idcategorias = categorias.idcategorias ".$condicion;
//echo $sql."<br/>";
$rs = $conn->query($sql);
?>
<table id="ltemas" class="table table-striped table-hover table-responsive" style="font-size: 12px" >
	<thead>
		<tr>
			<th>#</th>
			<th>Categoría</th>
			<th>Usuario</th>
			<th>Título</th>
			<th>Fecha de Publicación</th>
			<th>Formato</th>
			<th>Descargas</th>
			<th class='text-center'>Opciones</th>
		</tr>
	</thead>
	<tbody>

		<?php

		if ($rs->num_rows == 0) {
			echo "<tr><td colspan='8'>No existe Información</td></tr>";
		}
		$i=0;
		while ($fila = $rs->fetch_assoc()) {
			$i++;
			echo "<tr>
			<td>$i</td>
			<td>".$fila['nombre']."</td>
			<td>".$_SESSION['user']."</td>
			<td>".$fila['titulo']."</td>
			<td>".$fila['fechahora']."</td>
			<td>".$fila['formato']."</td>
			<td>".$fila['descargas']."</td>
			<td class='text-center'>";
				?>
				<a href="<?php echo $fila['idtemas']; ?>" class="glyphicon glyphicon-pencil text-success toolti" alt="editar" data-toggle="tooltip" data-placement="bottom" title="Editar tema"></a>

				<a href="<?php echo $fila['idtemas']; ?>" class="glyphicon glyphicon-remove text-danger toolti" alt="eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar tema"></a>
				<?php
				echo "  </td>
			</tr>
		</tr>";
	}
	echo "<tr><td colspan='8'>Total de Registros: ".$rs->num_rows."</td></tr>"; 
	?>
</tbody>
</table>

<!-- editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="Editar Tema" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Editar Tema</h4>
			</div>
			<div id="editarContenido" class="modal-body">

			</div>
		</div>
	</div>
</div>
<!-- eliminar-->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="Eliminar Tema" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Eliminar Tema</h4>
			</div>
			<div id="eliminarContenido" class="modal-body">

			</div>
		</div>
	</div>
</div>


<?php
$rs->close(); 
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#ltemas > tbody > tr > td > a[alt='editar']").click(function(e){
			e.preventDefault();
			var id = $(this).attr('href');
			pagina_a_cargar = "nuevapelicula.php?id=" + id;

			$.ajax({  
				url: pagina_a_cargar,  
				success: function(data) {
					$('#contenido').html(data);
				}  
			});
		});

		$("#ltemas > tbody > tr > td > a[alt='eliminar']").click(function(e){
			e.preventDefault();
			var id = $(this).attr('href');
			pagina_a_cargar = "eliminartema.php?id=" + id;

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