<?php
require 'conexion.php';
include 'funciones.php';

$general_error = "";
//administrar usuarios

$operacion = $_POST['operacion'];
$errores = 0;

//si es editar
if ($operacion){
	$edi_id = trim($_POST['id']);
	$edi_tipo_usu = trim($_POST['tipo_usu']);
	$edi_status = trim($_POST['status']);
	$edi_passwd = trim($_POST['passwd']);
	$edi_oldpass = trim($_POST['oldpass']);
	$edi_nombre = trim($_POST['nombre']);

	if ($edi_oldpass != $edi_passwd) {
		if (isset($edi_passwd) && $edi_passwd!='') {
			if (!validarPass($edi_passwd)) {
				$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al actualizar el usuario, debe ingresar una contraseña valida.</div>";
				;	$errores = 1;
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
}else{ //si es eliminar

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
echo $general_error;
?>