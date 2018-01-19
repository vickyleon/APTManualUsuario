<?php
	/* Este script sirve para verificar si existe o no una sesion de login para ayudar a seleccionar 
	   que menu de opciones mostrar dependiendo de cada tipo de usuario.
	 */
	 require_once("BeanUsuario.php");
	 
	 session_start();
	 $banderaEllos = false;
	 $banderaSesion = false;
	 $usuario = NULL;
	 
	 //Verificamos si existe la sesion
	 if(isset($_SESSION['login'])){
		 $usuario = unserialize($_SESSION['login']);
		 $banderaSesion = true;
		 
		 //Revisamos que tipo de usuario es
		 if($usuario->getTipo() == "Ellos"){
			 $banderaEllos = true;
		 }
	 }
	 
	 function esAdministrador(){ 
		 if(isset($_SESSION['login'])){
		 	//Revisamos que tipo de usuario es
			$user = unserialize($_SESSION['login']);
		 	if($user->getTipo() == "Ellos"){
				header('Location: 4mat.php'); 
		 	}
		 }
		 else{
			 header('Location: 4mat.php'); 
		 }
	 }
?>