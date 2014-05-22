<?php
include("funciones.php"); 

$usermail = "";
$usermail_error = "";
$passwd = "";
$passwd_error = "";
$general_error = "";

if (isset($_POST['btn-ok'])) {
	$usermail = trim($_POST['usermail']);
	$passwd = trim($_POST['passwd']);
	$errores = 0;

	if(strpos($usermail, "@") !== false){
		/* email */
		if (isset($usermail) && $usermail!='') {
			if (!validarDirCorreoElec($usermail)) {
				$usermail_error = mensajeError("Debe ingresar un correo valido"); $errores = 1;
			}
		}else{
			$usermail_error = mensajeError("Debe ingresar un correo electronico"); $errores = 1;
		}
	}else{
		/* usuario */
		if (isset($usermail) && $usermail!='') {
			if(!validaUser($usermail)){
				$usermail_error = mensajeError("Debe ingresar un nombre de usuario valido"); $errores = 1;
			}
		}else{
			$usermail_error = mensajeError("Debe ingresar un nombre de usuario"); $errores = 1;
		}
	}

	if (!$errores) {
		require 'conexion.php';

		$sql = "SELECT * FROM usuarios WHERE usuario = '".strtolower($usermail)."' OR email = '".strtolower($usermail)."'";
		$rs = $conn->query($sql);

		if($rs->num_rows == 0){
			$usermail_error = mensajeError("Usuario o correo no registrado");
		}else{
			$row = $rs->fetch_assoc();

			if ($row['passwd'] != md5($passwd)) {
				$passwd_error = mensajeError("Contraseña incorrecta");
			}else{
				session_start();
				$_SESSION['user'] = $row['usuario'];
				$_SESSION['nombre'] = $row['nombre'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['tipo_usu'] = $row['idtipousuarios'];
				$_SESSION['idusuarios'] = $row['idusuarios'];
				header("location: index.php");
			}
		}
		$conn->close();
	}

	//header("location: index.php");
}
?>
<?php $caru=true; include("header.php"); ?>

<div class="container" style="margin: 70px auto;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="well well-lg">
				<form id="form-login" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'].'#form-login'; ?>" >
					<fieldset>

						<legend>Inicio de Sesión</legend>

						<div class="form-group required-control">
							<label class="col-md-3 control-label" for="usermail">Usuario</label>
							<div class="col-md-8">
								<input id="usermail" name="usermail" type="text" placeholder="Usuario ó Correo Electronico" 
								class="form-control input-md" required="" value="<?php echo $usermail; ?>">
								<?php if (strlen($usermail_error)>0) {echo $usermail_error;} ?>
							</div>
						</div>

						<div class="form-group required-control">
							<label class="col-md-3 control-label" for="passwd">Password</label>
							<div class="col-md-8">
								<input id="passwd" name="passwd" type="password" placeholder="Contraseña" 
								class="form-control input-md" required="" value="<?php echo $passwd; ?>">
								<?php if (strlen($passwd_error)>0) {echo $passwd_error;} ?>
							</div>
						</div>

						<div class="form-group" style="margin-top: 35px;">
							<div class="col-md-12 text-center">
								<div class="btn-group">
									<input type="submit" id="btn-ok" name="btn-ok" class="btn btn-default col-md-3" style="width: 120px;" value="Aceptar"/>
									<button id="btn-cancel" name="btn-cancel" class="btn btn-primary col-md-3" style="width: 120px;" onClick="location.href = 'index.php';">Cancelar</button>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>	
</div>
<?php include("footer.php"); ?>