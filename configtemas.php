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
	//echo $sql;
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
	$puntaje=$_POST['puntaje'];

	$sql="UPDATE temas SET idcategorias='$categoria', titulo='$titulo', temporada='$temporada', sipnosis='$sipnosis', ano='$ano', pagoficial='$pag', trailer='$trailer', formato='$formato', fechahora='".date("Y-m-d H:m:s")."'
	WHERE idtemas='$idtemas'";
	$rs = $conn->query($sql);

	if (!$_FILES["imagen"]["error"]){
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		if (in_array($_FILES['imagen']['type'], $permitidos)){
			//esta es la ruta donde copiaremos la imagen
			switch ($_FILES['imagen']['type']) {
				case 'image/jpg':
				$type="jpg";
				break;

				case 'image/jpeg':
				$type="jpeg";
				break;

				case 'image/gif':
				$type="gif";
				break;
				
				case 'image/png':
				$type="png";
				break;
			}

			$ruta = "img/posters/" .$idtemas.".".$type;
			$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);	

			if ($resultado){
				if ($operacion==1){
					$sql="UPDATE temas SET imagen='posters/".$idtemas.".".$type."' WHERE idtemas='".$idtemas."'";
					$rs = $conn->query($sql);
					$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El logo ha sido actualizado exitosamente.</div>";				
				}
			} else {
				$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Ha ocurrido un error.</div>";
			}

		} else {
			$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Imágen no permitida.</div>";
		}
	}


	$sql="DELETE FROM generostemas WHERE idtemas='$idtemas'";
	$rs = $conn->query($sql);

	foreach ($generos as $idgeneros) {
		$sql="INSERT INTO generostemas (idgeneros, idtemas) VALUES ('$idgeneros','$idtemas')";
		$rs = $conn->query($sql);
	}

	if ($categoria==1){//es pelicula
		$sql="UPDATE articulos SET titulo='$titulo',fechahora='".date("Y-m-d H:m:s")."' WHERE idtemas='$idtemas'";
		$rs = $conn->query($sql);
	}

	$sql="UPDATE puntajes SET puntaje='$puntaje' WHERE idtemas='$idtemas' and idusuarios='".$_SESSION['idusuarios']."'";
	$rs = $conn->query($sql);

	if($conn->affected_rows >= 0){
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
	$puntaje=$_POST['puntaje'];


	$sql="INSERT INTO temas (idcategorias, idusuarios, titulo, temporada, sipnosis, ano, fechahora, pagoficial, trailer, formato) VALUES ('$categoria','".$_SESSION['idusuarios']."','$titulo','$temporada','$sipnosis','$ano','".date("Y-m-d H:m:s")."','$pag','$trailer','$formato')";
	$rs = $conn->query($sql);

	$sql="SELECT MAX(idtemas) idtemas FROM temas";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$idtemas=$row['idtemas'];	

	if (!$_FILES["imagen"]["error"]){
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		if (in_array($_FILES['imagen']['type'], $permitidos)){
			//esta es la ruta donde copiaremos la imagen
			switch ($_FILES['imagen']['type']) {
				case 'image/jpg':
				$type="jpg";
				break;

				case 'image/jpeg':
				$type="jpeg";
				break;

				case 'image/gif':
				$type="gif";
				break;
				
				case 'image/png':
				$type="png";
				break;
			}

			$ruta = "img/posters/" .$idtemas.".".$type;
			$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);	

			if ($resultado){
				//if ($operacion==1){
					$sql="UPDATE temas SET imagen='posters/".$idtemas.".".$type."' WHERE idtemas='".$idtemas."'";
					//echo $sql;
					$rs = $conn->query($sql);
					$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El logo ha sido actualizado exitosamente.</div>";				
				//}
			} else {
				//$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Ha ocurrido un error.</div>";
			}

		} else {
			$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Imágen no permitida.</div>";
		}
	}


	foreach ($generos as $idgeneros) {
		$sql="INSERT INTO generostemas (idgeneros, idtemas) VALUES ('$idgeneros','".$row['idtemas']."')";
		$rs = $conn->query($sql);
	}

	if ($categoria==1){//es pelicula
		$sql="INSERT INTO articulos (idtemas, nombre, episodio, fechahora) VALUES ('$idtemas','$titulo',0,'".date("Y-m-d H:m:s")."')";
		$rs = $conn->query($sql);
	}

	$sql="INSERT INTO puntajes (idtemas, idusuarios, puntaje) VALUES ('$idtemas','$idusuarios','$puntaje')";
	$rs = $conn->query($sql);

	/*if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El tema $titulo ha sido creado exitosamente.</div>";				
	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al ingresar el tema $titulo.</div>";	
	}*/

	$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El tema $titulo ha sido creado exitosamente.</div>";				

}else if ($operacion==3) {//articulo
	$idtemas=$_POST['idtemas'];
	$titulo=$_POST['nombre'];
	$serv=$_POST['servidores'];
	$url=$_POST['url'];
	$episodio=$_POST['episodio'];

	$sql="INSERT INTO articulos (idtemas, nombre, episodio, fechahora) VALUES ('$idtemas','$titulo','$episodio','".date("Y-m-d H:m:s")."')";
	$rs = $conn->query($sql);

	$sql="SELECT MAX(idarticulos) idarticulos FROM articulos";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$i=0;
	foreach ($serv as $servidorurl) {
		if (!empty($url[$i])){
			$sql="INSERT INTO urls (idarticulos, idservidores, url) VALUES ('".$row['idarticulos']."','".$servidorurl."',
				'".$url[$i]."')";
$rs = $conn->query($sql);
}
$i++;
}

if($conn->affected_rows > 0){
	$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El artículo $titulo ha sido creado exitosamente.</div>";				
}else{
	$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al ingresar el artículo $titulo.</div>";	
}
}else if ($operacion==4) {//edito articulo
	$id=$_POST['idtemas'];
	$titulo=$_POST['nombre'];
	$serv=$_POST['servidores'];
	$url=$_POST['url'];
	$episodio=$_POST['episodio'];

	$sql="UPDATE articulos SET titulo='$titulo',episodio='$episodio' WHERE idarticulos='$id'";
	$rs=$conn->query($sql);

	$sql="DELETE FROM urls WHERE idarticulos='$id'";
	$rs=$conn->query($sql);

	$i=0;
	foreach ($serv as $servidorurl) {
		if (!empty($url[$i])){
			$sql="INSERT INTO urls (idarticulos, idservidores, url) VALUES ('".$id."','".$servidorurl."',
				'".$url[$i]."')";
$rs = $conn->query($sql);
}
$i++;
}

if($conn->affected_rows > 0){
	$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El artículo $titulo ha sido actualizado exitosamente.</div>";				
}else{
	$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al actualizar el artículo $titulo.</div>";	
}

}else if ($operacion==5) {//eliminar articulo
	$eli_id = trim($_POST['id']);
	$eli_nombre = trim($_POST['nombre']);

	$sql = "DELETE FROM urls WHERE idarticulos = '$eli_id' ";
	$rs = $conn->query($sql);

	$sql = "DELETE FROM articulos WHERE idarticulos = '$eli_id' ";
	$rs = $conn->query($sql);


	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El artículo $titulo ha sido eliminado exitosamente.</div>";				
	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al eliminar el artículo $titulo.</div>";	
	}

}
echo $general_error;
?>