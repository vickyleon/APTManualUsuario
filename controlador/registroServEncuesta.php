<?php 
	
	$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");

	//obtener los datos del form
	$nombre = $_POST['txtNombre'];
	$apP=$_POST['txtApPat'];
	$apM=$_POST['txtApMat'];
	$edad = $_POST['txtEdad'];
	$inst = $_POST['txtInstitucion'];
	$nivel=$_POST['txtOcupacion'];
	$genero = $_POST['genero'];
	$email = $_POST['txtEmail'];
	$email2 = $_POST['txtEmail2'];
	$pass = $_POST['txtPwd'];
	$pass2 = $_POST['txtPwd2'];
	$area=$_POST['txtArea'];
	$pais=$_POST['txtPais'];

	if(empty($nombre) || empty($email)){
		echo 4;
	}
	
	else if($email==$email2)
	{
		$query="select * from usuario where email='".$email."'";
		
		$usrs=mysqli_query($conexion,$query);
		if($usrs->num_rows)//Si me regresa tuplas significa que ya esta registrado
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
				
				//CHECO QUE EXISTA LA INSTITUCION:
				$query="SELECT IDInst FROM INSTITUCION WHERE NOMBRE LIKE '".$inst."'; ";
				$usrs=mysqli_query($conexion,$query);
				if($usrs->num_rows)//Si me regresa tuplas significa que ya esta registrado
				{
					
						while($row = mysqli_fetch_assoc($usrs)) {
							$inst= $row["IDInst"];
						}
					
				}
				else{
					$query="INSERT INTO INSTITUCION (NOMBRE) VALUES ('".$inst."');";
					$usrs=mysqli_query($conexion,$query);
					$query="SELECT IDInst FROM INSTITUCION WHERE NOMBRE LIKE '".$inst."'; ";
					$usrs=mysqli_query($conexion,$query);
					while($row = mysqli_fetch_assoc($usrs)) {
							$inst= $row["IDInst"];
					}
					
				}
				
				//AGREGO EL NIVEL
				
				$query="INSERT INTO usuario (ID, Nombre, ApPaterno, ApMaterno, Edad, Email, Passw, ContestoEncuesta, TipoUsuario, IDNivel, IDPais, IDInst,IDArea) VALUES (NULL, '".$nombre."', '".$apP."', '".$apM."', '".$edad."', '".$email."', '".$pass."', 'No', 'Profesor', '".$nivel."', '".$pais."', '".$inst."','".$area."');";
				
			    if(mysqli_query($conexion,$query))//Si me regresa tuplas significa que ya esta registrado
				{
					echo 1;
				}
				else{
					 echo "Error: " . $query . "<br>" . mysqli_error($conexion);
				}
				
					
				
			}
			
		}
			
	}
	else
		echo 2;
    

	

?>
