<?php
	session_start();
	$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
	$opcion=$_POST["group1"];
	$opinion=$_POST["opinion"];
	$sqlp="insert into opinion (opinion) values ('".$opinion."');";
	$paises=mysqli_query($conexion,$sqlp);
	$sql="select IDOpinion from opinion  where opinion like '$opinion';";
	$usrs=mysqli_query($conexion,$sql);
				if($usrs->num_rows)//Si me regresa tuplas significa que ya esta registrado
				{
					
						while($row = mysqli_fetch_assoc($usrs)) {
							$idop= $row["IDOpinion"];
						}
					
				}

	$sqlp="insert into respuesta (idpregunta,idopcion,id,idopinion) values (".$_SESSION["acceso"][7].",".$_POST["group1"].",".$_SESSION["acceso"][6].",".$idop.");";
	$paises=mysqli_query($conexion,$sqlp);

	$sqlp="update usuario set ultimapregunta=".$_SESSION["acceso"][7]." where id=".$_SESSION["acceso"][6].";";
	$paises=mysqli_query($conexion,$sqlp);
	
	$_SESSION["acceso"][7]=$_SESSION["acceso"][7]+1;
	
?>