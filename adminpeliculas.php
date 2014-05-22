<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

$caru=false; 
require 'conexion.php';
include("header.php");

// $sql = "SELECT * FROM temas WHERE idusuarios = ".$_SESSION['idusuarios'];
$sql = "SELECT * FROM temas WHERE idusuarios = 25";
$rs = $conn->query($sql);

?>


<div class="row">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-10"><h1 style="margin-top: 0;">Películas</h1></div>
			<div class="col-md-2 text-right"><a alt="nuevo" id="nuevo" class="btn btn-info">Nueva</a></div>
		</div>

		
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-hover table-responsive">
					<thead>
						<?php if ($rs->num_rows > 0) { ?>					
						<tr>
							<th>Usuario</th>
							<th>Título</th>
							<th>Cargada</th>
							<th>Formato</th>
							<th>Descargas</th>
						</tr>
						<?php } else { echo "<tr><td class='text-center'>Agrega una Película!</td></tr>";} ?>
					</thead>
					<tbody>
						<?php 
						while ($fila = $rs->fetch_assoc()) {
							echo "<tr>
							<td width='30%'>".$_SESSION['user']."</td>
							<td width='40%'>".$fila['titulo']."</td>
							<td width='20%'>".$fila['fechahora']."</td>
							<td width='5%'>".$fila['formato']."</td>
							<td width='10%'>".$fila['descargas']."</td>
							</tr>";
						} $rs->close(); ?>					
					</tbody>
				</table>
			</div>
		</div>

		<div class="row" style="margin-top: 5%;">
			<div class="col-md-10"><h1 style="margin-top: 0;">Buscar en Otros Usuarios</h1></div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="input-group">
					<input type="text" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Buscar</button>
					</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-hover table-responsive">
					
				</table>
			</div>
		</div>

	</div>			
</div>


<?php include("footer.php"); ?>