<?php 
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}

if (!isset($_POST['btneditar'])) {
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
		<?php echo $nombre; ?><span class="text-muted"> (<?php echo $user; ?>)</span><br/>
		<span class="text-info"><?php echo $email; ?> </span>
	</p>

	<!-- Select Basic -->
	<div class="form-group">
		<label class="col-md-4 control-label" for="tipo_usu">Tipo Usuario</label>
		<div class="col-md-5">
			<select id="tipo_usu" name="tipo_usu" class="form-control">
				<option value="1" <?php echo ($tipo_usu==1?'selected':''); ?>>Administrador</option>
				<option value="2" <?php echo ($tipo_usu==2?'selected':''); ?>>Pulicador</option>
				<option value="3" <?php echo ($tipo_usu==3?'selected':''); ?>>Basico</option>
			</select>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
		<label class="col-md-4 control-label" for="status">Status</label>
		<div class="col-md-5">
			<select id="status" name="status" class="form-control">
				<option value="1" <?php echo ($status==1?'selected':''); ?>>Activo</option>
				<option value="0" <?php echo ($status==0?'selected':''); ?>>Inactivo</option>
			</select>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<label class="col-md-4 control-label" for="passwd">Password</label>  
		<div class="col-md-5">
			<input id="passwd" name="passwd" type="password" placeholder="Contraseña" 
			class="form-control input-md" required="" value="<?php echo $passwd; ?>">
		</div>
	</div>

	<input type="hidden" name="oldpass" id="oldpass" value="<?php echo $passwd; ?>"/>
	<input type="hidden" name="id" id="id" value="<?php echo $idusuario; ?>"/>
	<input type="hidden" name="nombre" id="nombre" value="<?php echo $nombre; ?>"/>

	<div class="form-group" style="margin-top: 35px;">
		<div class="col-md-12 text-center">
			<div class="btn-group">
				<button type="button" class="btn btn-default" style="width: 150px;" data-dismiss="modal">Cancelar</button>
				<input type="submit" id="btneditar" name="btneditar" 
				class="btn btn-primary col-md-3" style="width: 150px;" value="Guardar Cambios"/>
			</div>
		</div>
	</div>
	
</form>
<?php } ?>