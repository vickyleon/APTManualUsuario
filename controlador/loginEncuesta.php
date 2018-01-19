<?php
    session_start();
    $user=$_POST["user"];
    $pass=$_POST["pass"];
	//echo $user;
	//echo $pass;
    $conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
	$pass=md5($pass);
    $sql="select * from usuario  where email='$user' and passw='$pass';";
	if($res=mysqli_query($conexion,$sql))//Si me regresa tuplas significa que ya esta registrado
				{
					//echo 1;
				}
				else{
					 echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
	}
				
    $numrows=mysqli_num_rows($res);
    while($columna=mysqli_fetch_array($res)){
        $nombre=$columna['Nombre'];
        $apellido=$columna['ApPaterno']." ".$columna['ApMaterno'];
		$contesto=$columna['ContestoEncuesta'];
		$tipoUsuario=$columna['TipoUsuario'];
		$Area=$columna['idArea'];
		$idUsr=$columna['ID'];
        $edad=$columna['Edad'];
    }
    if($numrows==1){
        $_SESSION["acceso"][1]=$nombre;
        $_SESSION["acceso"][2]=$apellido;
        $_SESSION["acceso"][3]=$contesto;
        $_SESSION["acceso"][4]=$tipoUsuario;
        $_SESSION["acceso"][5]=$Area;
		$_SESSION["acceso"][6]=$idUsr;
		$_SESSION["acceso"][7]=1;
		$_SESSION["acceso"][10]=" ";
		$_SESSION["acceso"][11]=" ";
		$_SESSION["acceso"][12]=" ";
		$_SESSION["acceso"][13]=" ";
		$_SESSION["acceso"][14]=" ";
		$_SESSION["acceso"][15]=" ";
        $_SESSION["acceso"][16]=$edad;
        $_SESSION["acceso"][17]=$user;
        
        //nuevo
    $sql="SELECT p.nombre as pais, n.nivel as nivel, i.nombre as institucion, a.nombre as area from usuario u, pais p, nivel n ,institucion i, area a where u.IDPais=p.IDPais and u.IDInst=i.IDInst and u.idArea=a.IDArea and u.idNivel=n.idNivel and u.ID='$idUsr';";
    
if($res=mysqli_query($conexion,$sql))//Si me regresa tuplas significa que ya esta registrado
				{
					//echo 1;
				}
				else{
					 echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
	}
    
    while($columna=mysqli_fetch_array($res)){
        $_SESSION["acceso"][18]=$columna['pais'];
        $_SESSION["acceso"][19]=$columna['institucion'];
        $_SESSION["acceso"][20]=$columna['area'];
        $_SESSION["acceso"][21]=$columna['nivel'];
    }

    }
	if($numrows==0){
		echo $numrows;
	}
	else{
		echo "1";
	}
    
   
?>
