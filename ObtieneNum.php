<?php
//recibo datos

$seleccion=$_POST['seleccion'];
$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
$query="SELECT IDPregunta from pregunta;";
$sth = mysqli_query($conexion,$query);

$rows = array();
while($r = $sth->fetch_assoc()) {
	$rows[] = $r;
	//echo $r;
}

echo json_encode($rows);

mysqli_close($conexion);
?>
