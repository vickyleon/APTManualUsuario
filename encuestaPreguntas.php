<?php
	session_start();
	$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
	mysqli_set_charset($conexion,"utf8");
	$contesto=$_SESSION["acceso"][3];
	//echo $contesto;
	$Area=$_SESSION["acceso"][5];
	echo $_SESSION["acceso"][5];
	if($_SESSION["acceso"][7]==21){
		//checo que sea medico
		if($_SESSION["acceso"][5]!=2){
			//NO ES MEDICO
			echo "entreeeee";
			$sqlp="update usuario set contestoEncuesta='Si' WHERE id=".$_SESSION["acceso"][6].";";
			$contesto="Si";
			unset($_SESSION["acceso"]);
			$paises=mysqli_query($conexion,$sqlp);
		}
	}
	if($_SESSION["acceso"][7]==26){
		//YA ACABO
		
		$sqlp="update usuario set contestoEncuesta='Si' WHERE id=".$_SESSION["acceso"][6].";";
		$contesto="Si";
		$paises=mysqli_query($conexion,$sqlp);
		unset($_SESSION["acceso"]);
	}	
	//$_SESSION["acceso"][7]=2;
	///////////////////////////////////////////////////////$_SESSION["acceso"][7]=1;
	//// OBTENGO LA ULTIMA PREGUNTA QUE CONTESTO EL USUARIO
	//echo $_SESSION["acceso"][6];
	$sql="select UltimaPregunta from usuario where id=".$_SESSION["acceso"][6].";";
	$pai=mysqli_query($conexion,$sql);
	if($pai)//Si me regresa tuplas significa que ya esta registrado
				{
					
						while($cuba=mysqli_fetch_array($pai,MYSQLI_BOTH)){
							$cuba[0]+=1;
							$_SESSION["acceso"][7]=$cuba[0];
						
							//echo $cuba[0];
	}
					
				}
	else{
		echo mysqli_error($conexion);
	}
	

	$sqlp="select pregunta,pathImg from pregunta where idPregunta=".$_SESSION["acceso"][7].";";
	$paises=mysqli_query($conexion,$sqlp);
	$sql="select * from opciones where idPregunta=".$_SESSION["acceso"][7].";";
	$respuestas=mysqli_query($conexion,$sql);
	//echo $Area;
	
	if($Area==1 || $Area==2 || $Area==3)
	{
		if(strcmp("No", $contesto)==0){
			
			
?>


<!doctype html>
<html lang="es">
    <!-- InstanceBegin template="/Templates/plantillaLogueado.dwt" codeOutsideHTMLIsLocked="false" -->

    <head>
        <?php require_once("controlador/verificar.php");
        require_once("controlador/connection.php");
        ?>
        <meta charset="utf-8">


        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <script type="text/javascript" src="js/materialize.min.js"></script>

        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!-- links-->
        <link rel="shortcut icon" href="images/atom.ico" />
        <script type="text/javascript" src="js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">

        <title>Grupo de investigación en la enseñanza de física</title>
    </head>
    <script>
        $(document).ready(function() {
			//alert("Hola");
              $('.modal').modal();
           
            $(".button-collapse").sideNav();
            // Initialize collapsible (uncomment the line below if you use the dropdown variation)
            //$('.collapsible').collapsible();
        
		$("#btn-Registrar").click(function(e) {
			//alert("hola");	
			//alert($("#respuesta").serialize());
			$.ajax({
				type: "post",
				url: "controlador/registraRespuesta.php",
				data: $("#respuesta").serialize(),
				success: function(resp) {
					alert(resp);
					location.reload();

				}
			});

			return false;

			});
		});


    </script>

    <body>

        <?php
        include ("barra.html");
        ?>


        <!-- InstanceBeginEditable name="encabezados" -->
        <div id='banner'>
            <div class="row">
                <header>
                    <div class="col s12 m5 l6">
                        <!--Aquí va el titulo de la pagina que aparece al lado del logo-->
                        <h2 style="padding:20%;">Sistema 4MAT</h2>
                        <!--------------------------------------------------------------->
                    </div>
                    <div class="col s12 m6 l6">
                        <img src="images/4matl.png" alt="logo" class="imagenLogo" />
                    </div>
                </header>
            </div>
        </div>





        <?php 
                include("BarraConfiguracion.php");
        ?>

        <!-- InstanceBeginEditable name="content" -->
        <div class="contenido">
            <h2 style="color:black;"><?php echo "Pregunta ".$_SESSION["acceso"][7];?></h2>
        
            
            <a><input type="text" placeholder="username" name="Empezar Encuesta" href="encuesta.php"></a>
            <ul>
                <li>
                    <?php
						while($pais=mysqli_fetch_array($paises,MYSQLI_BOTH)){
							echo $pais[0];

						
					?>
                </li>
            </ul>   
            <?php
						echo "<div class='row'><div class='col s6 offset-s4'><img src='$pais[1]' class='materialboxed'></div></div>";	
						}
			?>
            
           
               
         <form action="#" id="respuesta" name=respuesta>
         	<?php
			 	while($miau=mysqli_fetch_array($respuestas,MYSQLI_BOTH)){
					echo "<p><input name='group1' type='radio' id='".$miau[0]."' value='".$miau[0]."'><label for='".$miau[0]."'></label>".$miau[1]."</p>";
				}
			 ?>
        
               
            
            
            
            <div class="row">
   
      <div class="row">
        <div class="input-field col s12">
          <textarea id="opinion" class="materialize-textarea" name="opinion"></textarea>
          <label for="textarea1">Opinion De la Pregunta</label>
        </div>
      </div>
      </div>
      </form>
     
       <div class="input-field col s6" style="padding-left:45%;">
									<a href="encuestaPreguntas.php"><button class="btn waves-effect waves-light" style="color:white;" id="btn-Registrar" name="btn-Registrar" >Siguiente
										<i class="material-icons right">send</i>
                                        </button></a>
								</div>
        
        </div>
        <!-- InstanceEndEditable -->
        <footer>
            <!--Aqui va el pie de pagina-->
            <br>
            <p>2015 © physics-education.tlamatiliztli.mx | All Rights Reserved | Desarrollado por alumnos PIFI</p>
            <br>
        </footer>
    </body>
    <!-- InstanceEnd -->

</html>
<?php
						  }
		else{
			echo "<script language=Javascript> location.href=\"4mat.php\"; </script>"; 
		}
	}
	else{
		
		echo "<script language=Javascript> location.href=\"4mat.php\"; </script>"; 
	}

?>






