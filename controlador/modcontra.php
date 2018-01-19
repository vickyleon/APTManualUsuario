<?php
	require_once("./connection.php");
	require_once("./BeanUsuario.php");
	//Conexion a la BD//
	$conexion = new connection();
	session_start();
	$usuario = $_SESSION["login"];
    $usuario = unserialize($usuario);
	$idUsuario=$usuario->getId();
	$pass = $_POST['txtPwd'];
	$pass2 = $_POST['txtPwd2'];
	
	if(empty($pass) || empty($pass2)){
		echo 2;
	}
	else if($pass==$pass2){
		$p=md5($pass);
		$query = "update usuario set password=\"".$p."\" where idUsuario = ".$idUsuario;
		$conexion->conectar();
		$conexion->myQuery($query);
		$conexion->desconectar();
		echo 1;
	}
	else
		echo 3;

?>