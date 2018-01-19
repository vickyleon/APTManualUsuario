<?php

	//Conexion a la BD//
	$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
	session_start();
	$usuario = $_SESSION["acceso"][6];
	$pass = $_POST['txtPwd'];
	$pass2 = $_POST['txtPwd2'];
	
	if(empty($pass) || empty($pass2)){
		echo 2;
	}
	else if($pass==$pass2){
		$p=md5($pass);
		$query= "UPDATE usuario SET Passw =\"".$p."\" WHERE ID= ".$usuario.";";
		if($res=mysqli_query($conexion,$query)){
			echo 1;
		}
		else{
			echo("Error description: " . mysqli_error($conexion));
		}
		
	}
	else
		echo 3;

?>