<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

if (!isset($_POST['btneditar'])) {
	$idservidores = $_GET['id'];

	require 'conexion.php';
	$sql = "SELECT * FROM servidores WHERE idservidores = ".$idservidores;

	$rs = $conn->query($sql);

	$row = $rs->fetch_assoc();
	$nombre = trim($row['nombre']);
	$logo = trim($row['logo']);
	
	if (strlen($logo)==0  or !file_exists("img/".$logo)) {
		$logo = "servidores/sinlogo.png";
	}

	?>

	<form id="form-editar" class="form-horizontal" method="post" enctype="multipart/form-data" >
	<p id="general"></p>
		<!-- Select Basic -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="tipo_usu">Nombre del Servidor</label>
			<div class="col-md-5">
				<input id="nombre" name="nombre" type="text" placeholder="Nombre del Servidor" 
				class="form-control input-md" required="" value="<?php echo $nombre; ?>">
			</div>
			<img id="imglogo" src="<?php echo "img/$logo";?>" height="40" width="40" alt=" <?php echo $nombre?>"/>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="status">Logo</label>

			<div class="col-md-5 control-label">
				<input type="file" name="uplogo"  />
			</div>
		</div>

		<input type="hidden" name="logo" id="logo" value="<?php echo $logo; ?>"/>
		<input type="hidden" name="idserv" id="idserv" value="<?php echo $idservidores; ?>"/>
		<input type="hidden" name="nombreserv" id="nombreserv" value="<?php echo $nombre; ?>"/>

		<div class="form-group" style="margin-top: 35px;">
			<div class="col-md-12 text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-default" style="width: 150px;" data-dismiss="modal">Cancelar</button>
					<input type="submit" id="btneditarServidor" name="btneditarServidor" 
					class="btn btn-primary col-md-3" style="width: 150px;" value="Guardar Cambios"/>
				</div>
			</div>
		</div>

		<input type="hidden" name="operacion" id="operacion" value="1"/>

	</form>
	<?php } ?>

	<script type="text/javascript">

		$("#form-editar").submit( function( e ) {
			e.preventDefault();

			$.ajax( {
				url: 'configServidor.php',
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function(data) {
					$('#general').html(data);
				}  
			});
		});
	</script>