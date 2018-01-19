<?php
session_start();
$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
mysqli_set_charset($conexion,"utf8");
$contesto=$_SESSION["acceso"][3];
//echo $contesto;
$Area=$_SESSION["acceso"][5];
/*if($_SESSION["acceso"][7]==21){
    //checo que sea medico
    if($_SESSION["acceso"][5]!=2){
        //NO ES MEDICO
        $sqlp="update usuario set contestoEncuesta='Si' WHERE id=".$_SESSION["acceso"][6].";";
        $contesto="Si";
        //unset($_SESSION["acceso"]);
        $paises=mysqli_query($conexion,$sqlp);
    }
}*/
if($_SESSION["acceso"][7]==30){
    //YA ACABO

    $sqlp="update usuario set contestoEncuesta='Si' WHERE id=".$_SESSION["acceso"][6].";";
    $contesto="Si";
    $paises=mysqli_query($conexion,$sqlp);
    //unset($_SESSION["acceso"]);
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
		
		if($cuba[0]>30){
			$cuba[0]=30;
		}
        if($cuba[0]<0){
            $cuba[0]=1;
        }
        $_SESSION["acceso"][7]=$cuba[0];

        //echo $_SESSION["acceso"][7];
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
   // if(strcmp("No", $contesto)==0){ para redir


?>

<!doctype html>
<html lang="es">
    <!-- InstanceBegin template="/Templates/plantillaLogueado.dwt" codeOutsideHTMLIsLocked="false" -->

    <head>
        <?php require_once("controlador/verificar.php");
                                   require_once("controlador/connection.php");
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=.9,maximum-scale=.9">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
        <!-- links-->
        <link rel="shortcut icon" href="images/atom.ico" />
        <script type="text/javascript" src="js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">

        <title>Grupo de investigación en la enseñanza de física</title>
    </head>
    <script>
        $(document).ready(function() {

            $('.modal').modal();
			<?php
				if($_SESSION["acceso"][7]==30){
			?>
                  //  $('#modal1').modal('open');
			 //alert("Usted ha terminado de contestar nuestro cuestionario. Si necesita hacer una modificación a sus respuestas anteriores, puede hacerlo");
			<?php
				}
			?>
            $(".button-collapse").sideNav();
            // Initialize collapse button
            // Initialize collapsible (uncomment the line below if you use the dropdown variation)
            //$('.collapsible').collapsible();

            //tipo parallax
            /*
			$('.pushpin-demo-nav').each(function() {
				var $this = $(this);
				var $target = $('#' + $(this).attr('data-target'));
				$this.pushpin({
					//top: $target.offset().top,
					bottom: $target.offset().top + $target.outerHeight() - $this.height()
				});
			});*/

            $('.target').pushpin({
                top: 0,
                bottom: 1000,
                offset: 0
            });

            $("#btn-submit").click(function(e){
               //alert("holaaa");
                //alert($("#respuesta").serialize());
                $.ajax({
                    type: "post",
                    url: "controlador/registraRespuestaProfesor.php",
                    data: $("#respuesta").serialize(),
                    success: function(resp) {
                        //alert(resp);
                        location.reload();

                    }
                });
				
				 $.ajax({
                    type: "post",
                    url: "controlador/opinionGeneral.php",
                    data: $("#opGeneral").serialize(),
                    success: function(resp) {
                        //alert(resp);
                        location.reload();

                    }
                });

                return false;
            });
            $("#btn-finalizar").click(function(e){
                $('#modal1').modal('open');
               //alert("holaaa");
                //alert($("#respuesta").serialize());
                
               
            });
			
			
			$("#getback").click(function(e){
                	//alert("holaaa");
                
                $.ajax({
                    type: "post",
                    url: "controlador/regresaPregunta.php",
                    data: $("#respuesta").serialize(),
                    success: function(resp) {
                        //alert(resp);
                        location.reload();

                    }
                });
				 $.ajax({
                    type: "post",
                    url: "controlador/opinionGeneral.php",
                    data: $("#opGeneral").serialize(),
                    success: function(resp) {
                        //alert(resp);
                        location.reload();

                    }
                });


                return false;
            });
			
        });

        var slider = document.getElementById('test5');
        noUiSlider.create(slider, {
            start: [20, 80],
            connect: true,
            step: 1,
            range: {
                'min': 0,
                'max': 100
            },
            format: wNumb({
                decimals: 0
            })
        });
        function outputUpdate(vol) {
            document.querySelector('#escala').value = vol;
        }


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


            <div class="row">
                <div class="col s12 m6 l6">
                    <h2 style="color:black;">Cuestionario propuesto</h2>
                    <!-- NUEVO-->
                    <h4> Pregunta 
                        <?php
                            echo $_SESSION["acceso"][7];
                        ?>
                    </h4>
                    <ul>
                        <li>
                            <?php
									
                                   while($pais=mysqli_fetch_array($paises,MYSQLI_BOTH)){
                                       //echo $pais[0];
									   $pais[0]=str_replace("<img>", "<div class='barraLateral'>
                          <div class='row'>
                                    <div class='col s5 offset-s1'>
                                        <img src='$pais[1]' class='materialboxed' style='width:250%;'  >
                                    </div>
                                </div>
                                </div>", $pais[0]);
									   $pais[0]=str_replace("<imgsmall>", "<div class='barraLateral'>
                          <div class='row'>
                                    <div class='col s5 offset-s1'>
                                        <img src='$pais[1]' class='materialboxed' style='width:150%;'  >
                                    </div>
                                </div>
                                </div>", $pais[0]);
									   echo $pais[0];


                            ?>
                        </li>
                    </ul>   
                    <?php
                          /*echo "<div class='barraLateral'>
                          <div class='row'>
                                    <div class='col s5 offset-s1'>
                                        <img src='$pais[1]' class='materialboxed' style='width:250%;'  >
                                    </div>
                                </div>
                                </div>";	*/
                                   }
                    ?>



                    <form action="#" id="respuesta" name=respuesta>
                        <?php
                                   while($miau=mysqli_fetch_array($respuestas,MYSQLI_BOTH)){
                                       echo "<p><input name='group1' type='radio' id='".$miau[0]."' value='".$miau[0]."' disabled='disabled'><label for='".$miau[0]."'></label>".$miau[1]."</p>";
                                   }
                        ?>

                        <p class="range-field">
                            <label for="fader">Escala de Dificultad </label>
                             <br>
                              <label for="fader">0=Muy fácil, 10=Muy difícil</label>
                            <?php
                                $query="select rango, opinion, id from respuestaprofesor where id=".$_SESSION["acceso"][6]." and idpregunta=".$_SESSION["acceso"][7].";";
                                $respu=mysqli_query($conexion,$query);
                                while($miaus=mysqli_fetch_array($respu,MYSQLI_BOTH)){
                                       $rango=$miaus[0];
                                        $op=$miaus[1];
                                }
                              if($rango==""){
                                  $rango=5;
                              }    
                            ?>
                        <div class="col s12 m9 l10" >
                            <input type="range" id="fader" value="<?php echo $rango; ?>" name="fader "min="0" max="10" step="1" oninput="outputUpdate(value)" />
                        </div>
                        <div class="col l2">
                            <output for="fader" id="escala" name="escala"><?php echo $rango; ?></output>   
                        </div>    

                        <div class="input-field col s12">
                            <textarea id="opinion" class="materialize-textarea" name="opinion"><?php echo $op; ?></textarea>
                            <label for="textarea1">Opinion De la Pregunta</label>
                        </div>
                    </form>
                </div>

                <!-- FIN NUEVO-->
                <?php
                    $cons='select Texto from opiniongeneral where id='.$_SESSION["acceso"][6].';';
                    $res=mysqli_query($conexion,$cons);
                    $ac=0;
                    $arreglo[]=array();
                                while($pra=mysqli_fetch_array($res,MYSQLI_BOTH)){
                                        
                                       $arreglo[$ac]=$pra[0];
                                       //echo $arreglo[$ac];   
                                       $ac++;
                                }
                ?>

			
                <div class="col s12 m6 l6">
                    
                            <h5>Opini&oacute;n del cuestionario en general</h5>
                            <ol>	
                                <li>Presentación de las preguntas. ¿El tipo y tamaño de letra son adecuados?, ¿las imágenes están bien distribuidas?, etc.
                                </li>
                                <form action="" id="opGeneral" name="opGeneral">
                                <div class="row">
                                   
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="text1" name="text1" class="materialize-textarea" ><?php if(mysqli_num_rows($res)!=0){echo $arreglo[0];} ?></textarea>
                                                <label for="text1">Opinion </label>
                                            </div>
                                        </div>
                                    
                                </div>
                                <li>
                                	Redacción de las preguntas. ¿La redacción de las preguntas es suficientemente clara como para evitar ambigüedades?, ¿se puede extraer con claridad la información, así como comprender lo que se pregunta?
                                </li>
                                <div class="row">
                                   
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="text2" name="text2" class="materialize-textarea"><?php if(mysqli_num_rows($res)!=0){echo $arreglo[1];} ?></textarea>
                                                <label for="text2">Opinion </label>
                                            </div>
                                        </div>
                                    
                                </div>
                                <li>
                                	Calidad de los distractores, ¿los distractores permitirían discriminar entre un estudiante que comprende adecuadamente los conceptos y otro que tenga errores conceptuales?
                                </li>
                                <div class="row">
                                   
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="text3" name="text3" class="materialize-textarea"><?php if(mysqli_num_rows($res)!=0){echo $arreglo[2];} ?></textarea>
                                                <label for="text3">Opinion </label>
                                            </div>
                                        </div>
                                    
                                </div>
                                <li>
                                    Nivel de dificultad del cuestionario en su conjunto. ¿Considera el cuestionario con un bajo nivel de dificultad, con un alto nivel de dificultad, o bien, con un nivel adecuado para ser aplicado a estudiantes de pregrado?
                                </li>
                                <div class="row">
                                   
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="text4" name="text4" class="materialize-textarea"><?php if(mysqli_num_rows($res)!=0){echo $arreglo[3];} ?></textarea>
                                                <label for="text4">Opinion </label>
                                            </div>
                                        </div>
                                    
                                </div>
                                <li>
                                    Tiempo estimado de respuesta del cuestionario. ¿Cuánto tiempo estima usted necesario para responder el cuestionario? Considere dos casos: a) incluyendo la selección del nivel de seguridad y la justificación de la respuesta y b) solo respondiendo cada pregunta.
                                </li>
                                <div class="row">
                                   
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="text5" name="text5" class="materialize-textarea"><?php if(mysqli_num_rows($res)!=0){echo $arreglo[4];} ?></textarea>
                                                <label for="text5">Opinion </label>
                                            </div>
                                        </div>
                                    
                                </div>
                                <li>
                                	Otros comentarios que considere pertinentes
                                </li>
                                <div class="row">
                                   
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="text6" name="text6" class="materialize-textarea"><?php if(mysqli_num_rows($res)!=0){echo $arreglo[5];} ?></textarea>
                                                <label for="text6">Opinion </label>
                                            </div>
                                        </div>
                                    
                                </div>
                                </form>
                            </ol>
                        </div>
                   
            </div>
            <div class="row">
               <?php
					if($_SESSION["acceso"][7]!=1 && $_SESSION["acceso"][7]!=30 ){
				?>
                <div class="input-field col s6" style=" position: relative;text-align: right;">
                    <a href="todasPreguntas.php" id="getback" name="getback"><button class="btn waves-effect waves-light" style="color:white;"  >Anterior
                        <i class="material-icons right">arrow_back</i>
                        </button></a>
                </div>
                
                 <div class="input-field col s6" >
                    <a href="todasPreguntas.php" id="btn-submit" name="btn-submit"><button class="btn waves-effect waves-light" style="color:white;"  >Siguiente
                        <i class="material-icons right">send</i>
                        </button></a>
                </div>
            
                <?php
					}
	
					else if($_SESSION["acceso"][7]==30){
					
						?>
					  	 
				 <div class="input-field col s6" style=" position: relative;text-align: right;">
                    <a href="todasPreguntas.php" id="getback" name="getback"><button class="btn waves-effect waves-light" style="color:white;"  >Anterior
                        <i class="material-icons right">arrow_back</i>
                        </button></a>
                </div>
                <div class="input-field col s6" >
                    <a  id="btn-finalizar" name="btn-submit"><button class="btn waves-effect waves-light" style="color:white;"  >Finalizar
                        <i class="material-icons right">check</i>
                        </button></a>
                </div>
            </div>
						
						
						<?php
						
					}
					 else{
						 ?>
						 
						  <div class="input-field col s6" style=" position: relative;text-align: right;">
                    <a href="todasPreguntas.php" id="btn-submit" name="btn-submit"><button class="btn waves-effect waves-light" style="color:white;"  >Siguiente
                        <i class="material-icons right">send</i>
                        </button></a>
                </div>
            </div>
						 
						 
						 <?php
					 }
				?>
            
            

            

            <!-- InstanceEndEditable -->
            <footer>
                <!--Aqui va el pie de pagina-->
                <br>
                <p>2015 © physics-education.tlamatiliztli.mx | All Rights Reserved | Desarrollado por alumnos PIFI</p>
                <br>
            </footer>
            
             <div id="modal1" class="modal">
				<div class="modal-content">
				  <h4>Cuestionario completado</h4>
				  <p>Usted ha terminado de contestar nuestro cuestionario. Si necesita hacer una modificación a sus respuestas anteriores, puede hacerlo.</p>
				</div>
				<div class="modal-footer">
				  <a href="EncuestaPiloto.php" class="modal-action modal-close waves-effect waves-green btn-flat ">Aceptar</a>
				  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Continuar en el cuestionario</a>
				</div>
			  </div>
       
            </body>
        <!-- InstanceEnd -->

        </html>
    <?php
                                  }
   /* else{ //para redir
        echo "<script language=Javascript> location.href=\"4mat.php\"; </script>"; 
    }*/
//}
else{

    echo "<script language=Javascript> location.href=\"4mat.php\"; </script>"; 
}

    ?>

