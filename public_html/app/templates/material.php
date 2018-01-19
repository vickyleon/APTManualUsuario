<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Materil Didactico</title>
<link rel="stylesheet" type="text/css" href="jscripts/dropzone/min/dropzone.min.css">
<script language="javascript" type="text/javascript" src="jscripts/jquery-3.1.1.min.js"></script>
<script language="javascript" type="text/javascript" src="jscripts/dropzone/min/dropzone.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/material.css">

<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
<script>
	/* *****************************************
	//Tomado de: http://www.dropzonejs.com/
	*******************************************/
	Dropzone.autoDiscover = false;
	$(document).ready(function(e) {
		var myDropzone = new Dropzone("#myDropZone", { 
			url: "material.php",
			autoProcessQueue:false,
			init:function(){
				this.on("drop",function(file){
					
				});
				this.on("success",function(file,resp){
					$("#resp_Upl").html(resp);
				});
			}
		});
		
		
		$("#btnFileUpl").on("click",function(e){
			alert("Estamos subiendo su archivo, por favor espere");
			e.preventDefault();
			myDropzone.processQueue();  
		});    	
    });
</script>
</head>

<?php
	function formatBytes($bytes, $precision ) { 
	    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

	    $bytes = max($bytes, 0); 
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	    $pow = min($pow, count($units) - 1); 
	    return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 

	require("../controlador/Sesion.php");
	require("../bean/Socio.php");
	if(isset($_FILES["file"])){

		//Directorio donde quiero 'subir' el archivo
		//$directorio = "C:/wamp64/www/otros/sem20171/uploadFiles/";;
		session_start();
		$directorio = getcwd()."/docs/";
		$sesion = new Sesion();
		$usuario = $sesion->getSesion('login');
		$socio = $sesion->getSesion('socio');
		$mem=$socio->getNoMembresia();

		$nombreArchivo = basename($_FILES["file"]["name"]);
		$filesize= round(($_FILES["file"]["size"])/1024, 2);
		$filesize.=" KB";

		
		//Respetar el nombre original del archivo
		
		/*
		//Asignar un nombre fijo al archivo. Primero recupero la extensión del archivo
		
		$tmp = explode(".", $_FILES["archivoUpl"]["name"]);
		$extensionArchivo = end($tmp);
		$nombreArchivo = "archivoQueSubi.".$extensionArchivo;
		
		
		//Asignar nombre dinamicamente. Primero recupero la extensión del archivo
		
		$tmp = explode(".", $_FILES["archivoUpl"]["name"]);
		$extensionArchivo = end($tmp);
		$idArchivo = uniqid();
		$nombreArchivo = $idArchivo.".".$extensionArchivo;
		
		*/	
		$rutaArchivo = $directorio.$nombreArchivo;
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $rutaArchivo)){
			$conexion=mysqli_connect("aapt-mx.org","aaptmx","ylatesis?","aaptmx_db_prueba");
	        $sql="insert into material (Nombre, noMembresia, Tamano, Fecha, Paths) values ('$nombreArchivo',$mem,'$filesize',CURDATE(),'$rutaArchivo');";
	        //echo $sql;
	        $res = mysqli_query($conexion, $sql);
	        
    
		
			/*echo "<h3 style='color:green'>= = = = El fichero es válido y se subió con éxito. = = = =</h3>";
			echo "<code>";
			echo "Nombre de archivo: ". $_FILES["file"]["name"];
			echo "<br>";
			echo "Tipo de archivo: ". $_FILES["file"]["type"];
			echo "<br>";
			echo "Tama&ntilde;o de archivo: ". round(($_FILES["file"]["size"])/1024, 2)." KB";
			echo "</code>";*/
			 echo "<script> alert (\"Se ha subido el archivo con éxito\"); </script>"; 
		} else {
			echo "<h3 style='color:red'>¡Posible ataque de subida de ficheros!</h3>";
		}
		//echo "<p><a href='material.php'>Regresar</a></p>";
    }else{
?>

<body>
	<div id="myDropZone" class="dropzone" style="background:none;">
	 <span id="mispan">
	     <h5>Arrastre su archivo o de click aquí</h5>
	 </span>
	</div>
   <center>
       <a class="waves-effect waves-light btn"><i class="material-icons right">cloud</i><input type="button" id="btnFileUpl" value="Enviar"></a>
    <div id="resp_Upl"></div>
   </center>
    
</body>
</html>
<?php
	}
?>
