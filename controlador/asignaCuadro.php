<?php
	session_start();
	$valor=$_POST["seleccion2"];
	$_SESSION["acceso"][8]=$valor;
	echo "si";
?>