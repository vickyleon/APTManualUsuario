<?php
    session_start();
	$Area=$_SESSION["acceso"][5];
	//echo $Area;
	if($Area==1 || $Area==2 || $Area==3)
	{

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


            $(".button-collapse").sideNav();
            // Initialize collapse button
            $('.modal').modal();
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
            <article>
                    <div>
                       <center>
                           <img src="images/Bienvenidos.png" style=" width: 35%;" />
                       </center> 

                      
                    </div>
                </article>
            <div class="row">
               <div class="col s12 l6">
                   <iframe  src="https://www.youtube.com/embed/kClegf3b984" frameborder="0" style=" width: 100%; height: 320px;" ></iframe>
               </div>
          
               <div class="col s12 l6">

                <div>
                   
                       <p>
                     Estimado(a) investigador(a), en esta página encontrará un cuestionario de 30 preguntas que tiene por objetivo conocer el grado de comprensión, principalmente, de los fenómenos de reflexión y refracción de ondas sonoras en estudiantes de pregrado (bachillerato y licenciatura). Las primeras 20 preguntas guardan relación con los fenómenos señalados desde un punto de vista general y las últimas diez incluyen aspectos relacionados con el ámbito de la salud, de tal manera que, si los estudiantes no pertenecen a carreras del área de la salud, solo serían aplicables las primeras 20 preguntas y si pertenecen, entonces sería aplicable la totalidad del cuestionario. Cada pregunta tiene cinco alternativas de respuesta, de las cuales una sola es correcta.</p>
                       	<p>
						Cuando usted ingrese al cuestionario para su análisis, al final de cada pregunta, encontrará una escala que busca medir el grado de dificultad que usted considera que tiene cada pregunta, donde cero quiere decir que la pregunta es demasiado fácil y diez que es muy compleja. Elija el número que más se acerque a su percepción. Posteriormente, habrá un espacio donde podrá agregar algún comentario que considere pertinente a la pregunta, ya sea sobre la redacción, la misma dificultad de la pregunta, su coherencia, etc. </p>
						<p>
						Adicionalmente, en el lado derecho del cuestionario, encontrará seis preguntas que buscan obtener su impresión, no de cada pregunta en particular, sino del cuestionario en su conjunto. </p>
						<p>
						El sistema guardará automáticamente todos sus comentarios al pasar de una pregunta a otra y usted podrá modificarlos, así como entrar y salir del cuestionario, la veces que estime conveniente.
						<p>
						Agradecemos sinceramente su valiosa cooperación.
                       </p>
                      
                        <br />

                </div>
            </div>
            </div>
            <?php
				//if($_SESSION["acceso"][3]=="No"){
					if($_SESSION["acceso"][4]=="Default"){
						
					
					
			?>
          
           <div class="row">
           <!-- para los alumnos --->
           <div class="input-field col s2" style="padding-left:45%;"> 
                                    <!-- encuestaPreguntas.php-->
									<a href="#modalverifica"><button class="btn waves-effect waves-light" style="color:white;" >Empezar Cuestionario
										<i class="material-icons right">send</i>
                                        </button></a>
            </div>
               
              <?php
			   	}
					else if($_SESSION["acceso"][4]=="Administrador"){
						?>
						<div class="col s6" style="padding-left:47.7%;">
                  <a href="administracionEncuesta.php">
                  <button class="btn waves-effect waves-light" style="color:white;" >Administración
							
                      </button></a>
          </div>
						<div class="input-field col s6" style="padding-left:45%;">
                                    <a href="todasPreguntas.php"><button class="btn waves-effect waves-light" style="color:white;" >Empezar Cuestionario
                                        <i class="material-icons right">send</i>
                                        </button></a>
                                </div>
						
						<?php
					}
                else if((!strcmp($_SESSION["acceso"][21],"Secundaria") || !strcmp($_SESSION["acceso"][21],"Bachillerato")) && $_SESSION["acceso"][4]=="Profesor"){
                    
                    ?>
                    
                    <div class="input-field col s6" style="padding-left:45%;">
                                    <a href="#modalverifica"><button class="btn waves-effect waves-light" style="color:white;" >Empezar Cuestionario
                                        <i class="material-icons right">send</i>
                                        </button></a>
                                </div>
                    
                    <?php
                }
				else{
			   ?>
            <!--para los profesores-->   
            <div class="input-field col s6" style="padding-left:45%;">
                                    <a href="todasPreguntas.php"><button class="btn waves-effect waves-light" style="color:white;" >Empezar Cuestionario
                                        <i class="material-icons right">send</i>
                                        </button></a>
                                </div>
            
        </div>
           
            <?php
					}
				//}
	 			/*
	 			else{
					
			?>
				<div class="input-field col s6" style="padding-left:45%;">
									<p>Usted ya ha contestado anteriormente la encuesta.</p>
			</div>
			<?php
					
				}*/
			?>
            
        
        </div>
        
        <!--modal para verificar si es alumno o profesor-->
          <div id="modalverifica" class="modal">
            <div class="modal-content">
              <h4>En construcción:</h4>
              <p>Esta sección no esta habilitada para los alumnos.</p>
            </div>
            <div class="modal-footer">
              <a href="" class="modal-action modal-close waves-effect waves-green btn-flat"></a>
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
?>




