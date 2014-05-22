<?php
session_start();
require 'conexion.php';
include 'funciones.php';

$general_error = "";

$operacion = $_POST['operacion'];

if ($operacion==0){//borra
	$eli_id = trim($_POST['id']);
	$eli_nombre = trim($_POST['nombre']);

	$sql = "DELETE FROM temas WHERE idtemas = '$eli_id' ";
	$rs = $conn->query($sql);

	$sql = "DELETE FROM generostemas WHERE idtemas = '$eli_id'";
	$rs = $conn->query($sql);

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Registro Eliminado!</strong> El tema $eli_nombre fue eliminado exitosamente.</div>";

	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al eliminar el tema $edi_nombre.</div>";
	}
} else if ($operacion==1) {//edita
	$idtemas=$_POST['idtemas'];
	$categoria=$_POST['categoria'];
	$titulo=$_POST['titulo'];
	$temporada=$_POST['temporada'];
	$sipnosis=$_POST['sipnosis'];
	$ano=$_POST['ano'];
	$pag=$_POST['pag'];
	$trailer=$_POST['trailer'];
	$formato=$_POST['formato'];
	$generos=$_POST['generos'];

	$sql="UPDATE temas SET idcategorias='$categoria', titulo='$titulo', temporada='$temporada', sipnosis='$sipnosis', ano='$ano', pagoficial='$pag', trailer='$trailer', formato='$formato' 
	WHERE idtemas='$idtemas'";
	$rs = $conn->query($sql);

	$sql="DELETE FROM generostemas WHERE idtemas='$idtemas'";
	$rs = $conn->query($sql);

	foreach ($generos as $idgeneros) {
		$sql="INSERT INTO generostemas (idgeneros, idtemas) VALUES ('$idgeneros','$idtemas')";
		$rs = $conn->query($sql);
	}

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El tema $titulo ha sido actualizado exitosamente.</div>";				
	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al editar el tema $titulo.</div>";	
	}

} else if ($operacion==2) {//nuevo
	$categoria=$_POST['categoria'];
	$titulo=$_POST['titulo'];
	$temporada=$_POST['temporada'];
	$sipnosis=$_POST['sipnosis'];
	$ano=$_POST['ano'];
	$pag=$_POST['pag'];
	$trailer=$_POST['trailer'];
	$formato=$_POST['formato'];
	$generos=$_POST['generos'];

	$sql="INSERT INTO temas (idcategorias, idusuarios, titulo, temporada, sipnosis, ano, fechahora, pagoficial, trailer, formato) VALUES ('$categoria','".$_SESSION['idusuarios']."','$titulo','$temporada','$sipnosis','$ano','".date("Y-m-d H:m:s")."','$pag','$trailer','$formato')";
	$rs = $conn->query($sql);

	$sql="SELECT MAX(idtemas) idtemas FROM temas";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();

	foreach ($generos as $idgeneros) {
		$sql="INSERT INTO generostemas (idgeneros, idtemas) VALUES ('$idgeneros','".$row['idtemas']."')";
		$rs = $conn->query($sql);
	}

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El tema $titulo ha sido creado exitosamente.</div>";				
	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al ingresar el tema $titulo.</div>";	
	}
}
echo $general_error;
?>