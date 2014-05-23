<?php
require 'conexion.php';
include 'funciones.php';

$general_error = "";
//administrar usuarios

$operacion = $_POST['operacion'];
//administrar servidores
if ($operacion==1 or $operacion==2){// edito el servidor

	if ($operacion==1) {
		$idservidores=$_POST['idserv'];
		$nombserv=$_POST['nombreserv'];
	}
	$nombre=$_POST['nombre'];

	if (!$_FILES["uplogo"]["error"]){

		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 300;

		if (in_array($_FILES['uplogo']['type'], $permitidos) && $_FILES['uplogo']['size'] <= $limite_kb * 1024){
			//esta es la ruta donde copiaremos la uplogo
			switch ($_FILES['uplogo']['type']) {
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

			$ruta = "img/servidores/" .$idservidores.".".$type;
			$resultado = @move_uploaded_file($_FILES["uplogo"]["tmp_name"], $ruta);	

			if ($resultado){
				if ($operacion==1){
					$sql="UPDATE servidores SET logo='servidores/".$idservidores.".".$type."' WHERE idservidores='".$idservidores."'";
					$rs = $conn->query($sql);
					$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El logo ha sido actualizado exitosamente.</div>";				
				}
			} else {
				$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Ha ocurrido un error.</div>";
			}

		} else {
			$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Imágen no permitida, el tipo de imámen no esta permitido o excede el tamano de $limite_kb Kilobytes.</div>";
		}

	}

	if ($operacion==2 && !$general_error){
		
		if ($resultado){
			$sql="INSERT INTO servidores (nombre,logo) VALUES ('$nombre','servidores/".$idservidores.".".$type."')";
		}else{
			$sql="INSERT INTO servidores (nombre) VALUES ('$nombre')";			
		}
		$rs = $conn->query($sql);

		if($conn->affected_rows > 0){
			$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El servidor $nombre ha sido creado exitosamente.</div>";				
		}else{
			$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al ingresar el servidor $nombre.</div>";	
		}
	}

	if ($operacion==1 && $nombre!=$nombserv){
		$sql="UPDATE servidores SET nombre='$nombre' WHERE idservidores='".$idservidores."'";
		$rs = $conn->query($sql);

		if($conn->affected_rows > 0){
			$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> El servidor $nombre ha sido actulizado exitosamente.</div>";
		}else{
			$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al actualizar el servidor $nombre.</div>";	
		}
	}

}else if ($operacion==0) {//elimino el servidor

	$eli_id = trim($_POST['id']);
	$eli_nombre = trim($_POST['nombre']);

	$sql = "DELETE FROM servidores WHERE idservidores = $eli_id ";
	$rs = $conn->query($sql);

	if($conn->affected_rows > 0){
		$general_error = "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Registro Eliminado!</strong> El servidor $eli_nombre fue eliminado exitosamente.</div>";

	}else{
		$general_error = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Problemas al eliminar el servidor $edi_nombre.</div>";
	}
}
echo $general_error;
?>