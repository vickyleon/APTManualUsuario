<?php 
	require_once("./connection.php");
	require_once("./BeanUsuario.php");
	//Conexion a la BD//
	$conexion = new connection();

	//Obtencion de datos del formulario
	$nombre = $_POST['txtNombre']." ".$_POST['txtApPat']." ".$_POST['txtApMat'];
	$fechaN = $_POST['txtFechaNac'];
	$ocup = $_POST['txtOcupacion'];
	$inst = $_POST['txtInstitucion'];
	$genero = $_POST['genero'];
	$email = $_POST['txtEmail'];
	$email2 = $_POST['txtEmail2'];
	$pass = $_POST['txtPwd'];
	$pass2 = $_POST['txtPwd2'];
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
	if(empty($nombre) || empty($email)){
		echo 4;
	}
	else if($email==$email2)
	{
		$query="select * from usuario where email='".$email."'";
		$conexion->conectar();
		$conexion->myQuery($query);
		if($conexion->getFilas())//Si me regresa tuplas significa que ya esta registrado
		{

			echo 3;
			
		}
		else
		{
			if(empty($pass)){
				echo 2;
			}
			else if($pass==$pass2)
			{
				$pass = md5($pass);
				$query="call registro('Ellos','".$nombre."','".$fechaN."','".$genero."','".$ocup."','".$inst."','".$email."','".$pass."');";
				$conexion->myQuery($query);
			
				echo 1;		
				
			}
			
		}
		$conexion->desconectar();
			
	}
	else
		echo 2;
    
?>