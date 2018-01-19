<?php
	session_start();
	$_SESSION["acceso"][10]=normaliza($_POST["text1"]);
	$_SESSION["acceso"][11]=normaliza($_POST["text2"]);
	$_SESSION["acceso"][12]=normaliza($_POST["text3"]);
	$_SESSION["acceso"][13]=normaliza($_POST["text4"]);
	$_SESSION["acceso"][14]=normaliza($_POST["text5"]);
	$_SESSION["acceso"][15]=normaliza($_POST["text6"]);
    
    

	$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
	$sql=" ";
	for($x=0; $x<6; $x++){
		
		$sqlp="select * from opinionGeneral where id=".$_SESSION["acceso"][6]." and orden=".$x.";";
		echo $sqlp;
		$paises=mysqli_query($conexion,$sqlp);
		$y=0;
		 while($pais=mysqli_fetch_array($paises,MYSQLI_BOTH)){
			 $y++;
		 }
		if($y==0){
			$sql="insert into opinionGeneral values(".$_SESSION["acceso"][6].", ".$x.",'".$_SESSION["acceso"][10+$x]."');";
			$paises=mysqli_query($conexion,$sql);
		}
		else{
			$sql="update opinionGeneral set texto='".$_SESSION["acceso"][10+$x]."' where id=".$_SESSION["acceso"][6]." and orden=".$x.";";
			$paises=mysqli_query($conexion,$sql);
		}
		
		
	}
    


    function normaliza($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}
?>