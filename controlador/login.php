<?php 
	require_once("connection.php");
	require_once("BeanUsuario.php");
	/***************************************************/
	login();
	// Algoritmo principal
	/*
	
	*/
	
	//Algoritmo de login
	/*
	1.- Obtener datos: nombre de usuario y contraseña
	2.- usuario = usuario de la bd & password = password de la bd
	
	2.1.- SI
	2.1.1.- Obtener datos del usuario para llenar el bean
	2.1.2.- Crear Sesion
	2.1.3.- Ir paso 3
	
	2.2.- NO
	2.2.1.- Mostrat "Verificar datos"
	2.2.2.- Regresar al paso 1
	
	3.- Tipo de usuario = 'ellos'
	
	3.1.- SI
	3.1.1.- Mostrar el menu de ellos
	3.1.2.- Ir a paso 4 
	
	3.2.- NO
	3.2.1.- Mostrar menu de administrador
	
	4.- Fin
	*/
	
	function login(){
		$email = $_POST['email'];
		$password = md5($_POST['pass']);
		
		$conexion = new connection();
		$conexion->conectar();
		$query = "SELECT idUsuario, tipo, nombre,fechaNac, sex, ocupacion,institucion, email FROM usuario WHERE email = '$email' AND password='$password'";
		$conexion->myQuery($query);
		$conexion->desconectar();
		if($conexion->getFilas() <= 0){
			//echo "¡Error! verifica tu usuario y/o contraseña";
			echo "<!doctype html><html lang='es'><head>
		<meta charset='utf-8'><script language='JavaScript' type='text/javascript'> 
                	alert('¡Error! verifica tu usuario y/o contraseña'); location.href='javascript:history.back()';
                </script></head></html>";
			//redireccionar al login
		}
		else{
			$resultado = $conexion->getArrayFila();
			$usuario = new BeanUsuario($resultado['idUsuario'],$resultado['nombre'],$resultado['fechaNac'],$resultado['sex'],$resultado['ocupacion'],$resultado['institucion'],$email,$resultado['tipo']);
			echo "Bienvenido homie ".$usuario->getNombre();
			session_start();
			$usuario = serialize($usuario);
			$_SESSION["login"] = $usuario;
			header('Location: ../4mat.php');
		}
	}
?>