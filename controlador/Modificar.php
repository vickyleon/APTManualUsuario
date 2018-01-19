<?php
	require_once("./connection.php");
	require_once("./BeanUsuario.php");
	//Conexion a la BD//
	$conexion = new connection();

	//Obtencion de datos del formulario
	session_start();
	$usuario = $_SESSION["login"];
    $usuario = unserialize($usuario);
	$idUsuario=$usuario->getId();
	$nombre = $_POST['txtNombre'];
	$nombre.=" ".$_POST['txtApPat'];
	$nombre.=" ".$_POST['txtApMat'];
	$fechaN = $_POST['txtFechaNac'];
	$ocup = $_POST['txtOcupacion'];
	$inst = $_POST['txtInstitucion'];
	$genero = $_POST['genero'];
	$email = $_POST['txtEmail'];
	$email2 = $_POST['txtEmail2'];
	
	
	$mes=implode( array ($fechaN));
	$separado=explode(" ",$mes);
	
	$fechaN=$separado[2]."-";
	switch($separado[1]){
			case "January,":
				$m="01";
				break;
			case "February,":
				$m="02";
				break;
			case "March,":
				$m="03";
				break;
			case "April,":
				$m="04";
				break;
			case "May,":
				$m="05";
				break;
			case "June,":
				$m="06";
				break;
			case "July,":
				$m="07";
				break;
			case "August,":
				$m="08";
				break;
			case "September,":
				$m="09";
				break;
			case "October,":
				$m="10";
				break;
			case "November,":
				$m="11";
				break;
			case "December,":
				$m="12";
				break;
	}
	$fechaN.=$m."-".$separado[0];
	//echo $fechaN;

	//$p=md5($password);
	$query = "update usuario set nombre=\"".$nombre."\", fechaNac=\"".$fechaN."\", sex=\"".$genero."\", ocupacion=\"".$ocup."\", institucion= \"".$inst."\", email=\"".$email."\" where idUsuario = ".$idUsuario;
	
	
		$conexion->conectar();
		$conexion->myQuery($query);
		$conexion->desconectar();
		echo 1;	
	
	
?>
