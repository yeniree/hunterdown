<?php
require 'conexion.php';
include 'funciones.php';

$general_error = "";
//administrar usuarios

$operacion = $_POST['operacion'];

if ($operacion==1){
	$idcategorias=$_POST['idcat'];
	$nombre=$_POST['nombre'];

	$sql="UPDATE categorias SET nombre='$nombre' WHERE idcategorias='$idcategorias'";
	$rs = $conn->query($sql);

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> La categoría $nombre ha sido modificada exitosamente.</div>";				
	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al modificar la categoría $nombre.</div>";	
	}

}else if ($operacion==2){
	$nombre=$_POST['nombre'];

	$sql="INSERT INTO categorias (nombre) VALUES ('$nombre')";
	$rs = $conn->query($sql);

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> La categoría $nombre ha sido ingresada exitosamente.</div>";				
	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al ingresar la categoría $nombre.</div>";	
	}

}else if($operacion==0){

	$eli_id = trim($_POST['id']);
	$eli_nombre = trim($_POST['nombre']);

	$sql = "DELETE FROM categorias WHERE idcategorias = $eli_id ";
	$rs = $conn->query($sql);

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Registro Eliminado!</strong> La categoría $eli_nombre fue eliminado exitosamente.</div>";

	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al eliminar la categoría $edi_nombre.</div>";
	}

}
echo $general_error;
?>