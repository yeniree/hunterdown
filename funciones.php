<?php

function validaUser ($Cad) {
	return preg_match("/^[a-zA-Z0-9._-]{3,30}$/i", $Cad );
}

// funcion para validad una cadena alfabetica
function validaAlfa ($Cad) {
	// prueba si la entrada es una cadena alfabetica
	return preg_match("/^[a-zA-Z\s]{3,100}$/i", $Cad );
}

function validarPass($Cad) {
	return preg_match("/^[A-Za-z0-9!@#$%^&*()_]{3,20}$/i", $Cad);
}

// funcion para validad una cadena alfanumerica
function validaAlfaNum ($Cad) {
	// prueba si la entrada es una cadena alfanumerica
	return preg_match("/^[a-z0-9]*$/i", $Cad );
}

// funcion para validad un entero 
function validaEntero ($texto) { 
 // prueba si la entrada es un entero, sin signo 
	return preg_match("/^[0-9]+$/", $texto ); 
} 

// funcion para validad un entero con signo opcional 
function validaEnteroConSigno ($Cad) { 
 // prueba si la entrada es un entero, con un signo opcional 
	return preg_match("/^-?([0-9])+$/", $Cad ); 
} 

// funcion para validad un numero de punto flotante 
function validarFlotante ($Cad) { 
 // prueba si la entrada es un numero de punto flotante, con un signo opcional 
	return preg_match("/^-?([0-9])+([\.|,]([0-9])*)?$/", $Cad ); 
}

function validarDirCorreoElec($Cad){
	return eregi("([^.@]+)(\.[^.@]+)*@([^.@]+\.)+([^.@]+)", $Cad);
} 

// funcion para validar una fecha ingresada
function datecheck($input,$format="")
{
	$separator_type= array(
           //con  "/",
           //con  "-",
           //o con  "."
		"-"
		);
	foreach ($separator_type as $separator) {
		$find= stripos($input,$separator);
		if($find<>false){
			$separator_used= $separator;
		}
	}
	
	$input_array= explode($separator_used,$input);
	if ($format=="mdY") {
		return checkdate($input_array[0],$input_array[1],$input_array[2]);
	} elseif ($format=="Ymd") {
		return checkdate($input_array[1],$input_array[2],$input_array[0]);
	} else {
		return checkdate($input_array[1],$input_array[0],$input_array[2]);
	}
	$input_array=array();
}

//Funcion para Verificar el Rango de Años de una Fecha
function verificaryears($fecha) {
	list($d,$m,$a) = explode("-",$fecha);

	if ( $a >= 1910 and $a <= 2014 ){
		$year = true; // Rango correcto
	}else{
		$year = false; // Rango incorreto
	}
	return $year;
}

//En caso de que la fecha tenga el formato día-mes-año
function cambiarfecha($fecha){
	list($year,$mes,$dia)=explode("-",$fecha);
	$fecha="$dia-$mes-$year";
	return $fecha;
}

//En caso de que la fecha tenga el formato año-mes-dia
function cambiarfechadeBD($fecha){
	//formato fecha americana
	$fecha=date("Y-m-d",strtotime($fecha));
	//El nuevo valor de la variable: $fecha2="dd-mm-aaaa"
	return $fecha;
}

function mensajeError($mensa='') {
	$htmlerror = "<label for='nombre' class='error'><span class='merror'>:MENSAJE</span></label>";
	$html = str_replace(":MENSAJE", $mensa, $htmlerror);
	return $html;
}

?>