<?php
	session_start();
	//printArray($_POST);

	$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
	$opinion=$_POST["opinion"];
	$rango=$_POST["fader_"];
	//contamos el numero de respuestas que ya existen para esa pregeunta
	$sqlp="select * from respuestaProfesor where IDPregunta=".$_SESSION["acceso"][7]." and ID=".$_SESSION["acceso"][6].";";
	$paises=mysqli_query($conexion,$sqlp);
	$x=0;
	 while($pais=mysqli_fetch_array($paises,MYSQLI_BOTH)){
		 $x++;
	 }
	if($x==0){
		$sqlp="insert into respuestaProfesor (ID,IDPregunta,Opinion,Rango) values(".$_SESSION["acceso"][6].",".$_SESSION["acceso"][7].",'".$opinion."',".$rango.");";
		$paises=mysqli_query($conexion,$sqlp);
        
	}
	else{
		$sqlp="update respuestaProfesor set ID=".$_SESSION["acceso"][6].", IDPregunta=".$_SESSION["acceso"][7].", Opinion='".$opinion."', Rango=".$rango." where IDPregunta=".$_SESSION["acceso"][7]." and ID=".$_SESSION["acceso"][6].";";
		$paises=mysqli_query($conexion,$sqlp);
        
	}
	
	$x=$_SESSION["acceso"][7]-2;
	$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
	$_SESSION["acceso"][7]=$x;
	$sqlp="update usuario set ultimapregunta=".$_SESSION["acceso"][7]." where id=".$_SESSION["acceso"][6].";";
	$paises=mysqli_query($conexion,$sqlp);
	//echo $_SESSION["acceso"][7];

?>