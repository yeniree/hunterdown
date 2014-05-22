<?php
require 'conexion.php';
include 'funciones.php';

$general_error = "";
//administrar usuarios

$operacion = $_POST['operacion'];

if ($operacion==1){
	$idgeneros=$_POST['idcat'];
	$nombre=$_POST['nombre'];

	$sql="UPDATE generos SET nombre='$nombre' WHERE idgeneros='$idgeneros'";
	$rs = $conn->query($sql);

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El género $nombre ha sido modificado exitosamente.</div>";				
	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al modificar el género $nombre.</div>";	
	}

}else if ($operacion==2){
	$nombre=$_POST['nombre'];

	$sql="INSERT INTO generos (nombre) VALUES ('$nombre')";
	$rs = $conn->query($sql);

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El género $nombre ha sido ingresada exitosamente.</div>";				
	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al ingresar el género $nombre.</div>";	
	}

}else if($operacion==0){

	$eli_id = trim($_POST['id']);
	$eli_nombre = trim($_POST['nombre']);

	$sql = "DELETE FROM generos WHERE idgeneros = $eli_id ";
	$rs = $conn->query($sql);

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Registro Eliminado!</strong> El género $eli_nombre fue eliminado exitosamente.</div>";

	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al eliminar el género $edi_nombre.</div>";
	}

}
echo $general_error;
?>