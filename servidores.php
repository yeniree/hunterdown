<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

$caru=false; 
require 'conexion.php';
include 'funciones.php';
?>

<div class="row">
	<div class="col-md-12">
		<h1 style="margin-top: 0;">Lista de Servidores</h1>
		
		<?php 
		$sql = "SELECT * FROM servidores WHERE 1=1";
		$rs = $conn->query($sql);

		if ($rs->num_rows > 0) {
			?>

			<table class="table table-striped table-hover table-responsive" id="lservers">
				<thead>
					<tr>
						<th class="hidden-xs">#</th>
						<th>Nombre</th>
						<th>Lógo</th>
						<th>Opcionces</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 0;
					while ($fila = $rs->fetch_assoc()) {						
						echo "<tr>
								<td class='hidden-xs'>".$i++."</td>
								<td>".$fila['nombre']."</td>
								<td><img src='img/".$fila['logo']."' height='40' width='40' alt='".$fila['nombre']."'></td>
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
		</div>
	</div>