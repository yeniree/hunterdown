<?php 
error_reporting(0);

$servidor = "localhost";
$usuariodb = "root";
$contradb = "";
$database = "hunterdowndb";

$conn = new mysqli();
$conn->connect($servidor, $usuariodb, $contradb, $database);

if ($conn->connect_error || mysqli_connect_errno()) {
	die("<div class='alert alert-danger'> <strong>Error de Conexión:</strong><p>".$conn->connect_error."</p></div>");
	exit();
}
?>