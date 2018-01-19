<?php
if(isset($_GET['id']))
    $idCuestionario=$_GET['id'];
else
    $idCuestionario=1;
?>
<!doctype html>
<html lang="es"><!-- InstanceBegin template="/Templates/plantillaLogueado.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <?php require_once("controlador/verificar.php");
        require_once("controlador/connection.php");
        ?>
        <meta charset="utf-8">

        <link rel="shortcut icon" href="images/atom.ico" />
        <script type="text/javascript" src="js/validaciones.js"></script>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!-- links-->
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <title>Grupo de investigación en la enseñanza de física</title>
    </head>
    <script>
        $(document).ready(function() {

            $('.modal').modal();
            $(".button-collapse").sideNav();
            // Initialize collapse button
          
        });

    </script>
    <body>
        <?php
        include("barra.html");
        ?>
        <!-- InstanceBeginEditable name="encabezados" -->
        <?php 
        if($banderaSesion == false) //Verificas si no esta logueado
        {
            echo "<script language='JavaScript' type='text/javascript'> 
                	location.href='4mat.php';
                </script>";	
        }
        //Si esta logueado entonces, verificas si ya contesto el cuestionario HOY!
        $conexion = new connection();
        $query="select * from cuestionarioResuelto where idUsuario=".$usuario->getId()." and idCuestionario=".$idCuestionario." and fecha=CURDATE()";
        $conexion->conectar();
        $conexion->myQuery($query);
        if($conexion->getFilas())//Si me regresa tuplas significa que ya lo contesto HOY y no lo puede volver a contestar
        {
            //Lo redirigimos a ver sus resultados
            echo "<script language='JavaScript' type='text/javascript'> 
               	location.href='resultados.php?id=".$idCuestionario."';
                </script>";  ///////////////////////////////////////CAMBIAR AQUI LA ACCION!!!
        }
        ?>        
        <!-- InstanceBeginEditable name="Banner" -->
        <div id='banner'>
            <div class="row"> 
                <header>
                    <div class="col s12 m5 l6">
                        <!--Aquí va el titulo de la pagina que aparece al lado del logo-->
                        <h2 style="padding:20%;" >Registro de usuario</h2> 
                        <!--------------------------------------------------------------->
                    </div>
                    <div class="col s12 m6 l6">
                        <img src="images/4matl.png" alt="logo" class="imagenLogo"/>
                    </div>
                </header>
            </div>
        </div>
        <!-- InstanceEndEditable -->


        <!-- InstanceEndEditable -->

        <?php 
        include("minibarra.php");
        ?>

        <!-- InstanceBeginEditable name="content" -->  
        <?php 			
        $query="select * from cuestionario where idCuestionario=".$idCuestionario."";
        $conexion->conectar();
        $conexion->myQuery($query);
        $rs=$conexion->getArrayFila();

        ?>
        
        <div class="contenido">
            <article>            	
                <?php
                echo "<h4>".$rs['nombre']."</h4>\n";
                echo "<p>".$rs['instrucciones']."</p>\n";
                $conexion->desconectar();					
                ?>
                <div class="row">

                    <div <?php if($idCuestionario==1){?>class= <?php } ?>>
                        <form action="controlador/procesaCuest.php" method="POST" id="formCuestionario" onSubmit="return verificaEnvio(<?php echo $idCuestionario ?>)">
                            <?php
                              $query="select * from pregunta where idCuestionario=".$idCuestionario."";
                              $conexion->conectar();
                              $conexion->myQuery($query);
                              $cont=1;
                              while($rs=$conexion->getArrayFila())
                              {
                                  echo "<div class='input-field col s12 l6 '>";
                                  $query="select * from respuesta where idPregunta=".$rs['idPregunta']."";
                                  //echo "Subquery: ".$query;
                                  echo "<div>
                                <input type=\"radio\" name=\"P-".$cont."\" id=\"P-".$cont."\" onclick=\"resetSelect('P-".$cont."')\">".$rs['descripcionP']."</div>\n";

                                  echo "<div class='respuestas'>\n";
                                  echo "<ul>\n";
                                  $conexion2 = new connection();
                                  $conexion2->conectar();
                                  $conexion2->myQuery($query);
                                  $contador=1;
                                  while($rs2=$conexion2->getArrayFila())
                                  {
                                      echo "<li>\n";

                                      echo"<select style='width: auto;display: -webkit-inline-box; border:1px solid #0f7196; height:26px;'  name=\"".$cont."-".$contador."\" id=\"".$cont."-".$contador."\" onblur=\"validaSelect('".$cont."-".$contador."')\">\n";

                                      echo"<option value=\"\">-</option>\n";
                                      for($i=1;$i<=4;$i++)
                                      {
                                          echo "<option value=\"".$rs2['idEstilo']."-".$i."\">".$i."</option>\n";
                                      }

                                      echo "</select>\n";

                                      echo"<label style=' font-size: 1rem;  color: black; position:inherit;' for='".$rs2['descripcionR']."'>".$rs2['descripcionR']."</label>\n";
                                      echo "</li>\n"; 
                                      $contador++;
                                  }
                                  $conexion2->desconectar();
                                  echo "</ul>\n";

                                  echo"</div>\n";
                                  $cont++;
                                  echo"</div>\n";
                              }

                              //$conexion->desconectar();


                            ?>

                            <br><br><br>

                            <input type="submit" id="Enviar" value="Enviar" class='btn'/>
                            <input name="16-1" type="hidden" id="16-1" value="<?php echo $idCuestionario; ?>-<?php echo $usuario->getId(); ?>"/>
                            <br><br><br>
                        </form>
                    </div>

                </div>

            </article>
        </div>

        <!-- InstanceEndEditable -->
        <footer> 
            <!--Aqui va el pie de pagina-->
            <br><p>2015 © physics-education.tlamatiliztli.mx | All Rights Reserved | Desarrollado por alumnos PIFI</p><br>
        </footer>          	 	
    </body>
    <!-- InstanceEnd --></html>
