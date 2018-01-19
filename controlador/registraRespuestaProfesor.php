<?php
	session_start();
	//printArray($_POST);

	$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
	$opinion=normaliza($_POST["opinion"]);
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
	
	$sqlp="update usuario set ultimapregunta=".$_SESSION["acceso"][7]." where id=".$_SESSION["acceso"][6].";";
	$paises=mysqli_query($conexion,$sqlp);
	$_SESSION["acceso"][7]=$_SESSION["acceso"][7]+1;

	function printArray($array){
     foreach ($array as $key => $value){
        echo "$key => $value";
        if(is_array($value)){ //If $value is an array, print it as well!
            printArray($value);
        }  
    } 
}
function normaliza($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}
?>