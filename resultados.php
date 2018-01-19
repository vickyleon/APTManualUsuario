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


        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!-- links-->
        <link rel="stylesheet" type="text/css" href="css/estilo.css">       	       	     	       	
        <link rel="shortcut icon" href="images/atom.ico" />
        <script type="text/javascript" src="js/validaciones.js"></script>


        <title>Grupo de investigación en la enseñanza de física</title>
    </head>
    <script>
        $(document).ready(function() {


            $(".button-collapse").sideNav();
            // Initialize collapse button
            $(".button-collapse").sideNav();
            // Initialize collapsible (uncomment the line below if you use the dropdown variation)
            //$('.collapsible').collapsible();
        });

    </script>
    <body>

        <?php 
        include("barra.html");
        ?>


        <!-- InstanceBeginEditable name="encabezados" -->     
        <?php 
        if($banderaSesion == false)
        {
            echo "<script language='JavaScript' type='text/javascript'> 
                	location.href='4mat.php';
                </script>";	
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


        <?php 
        include("minibarra.php");
        ?>

        <!-- InstanceBeginEditable name="content" -->        
        <div class="contenido">
            <article>  
                <?php
                $conexion = new connection();	
                $query="select c.*,x.nombre from cuestionarioResuelto c,cuestionario x where c.idCuestionario=x.idCuestionario and c.idUsuario=".$usuario->getId()." and c.idCuestionario=".$idCuestionario." and c.fecha=(select MAX(fecha) from cuestionarioResuelto where idUsuario=".$usuario->getId()." and idCuestionario=".$idCuestionario.")";
                $conexion->conectar();
                $conexion->myQuery($query);
                if($conexion->getFilas())//Si me regresa tuplas significa que ya esta registrado
                {
                    $rs=$conexion->getArrayFila();
                    $combinacionEstilo=$rs['resultado'];
                    $fechaCuestionario=$rs['fecha'];
                    $conexion->desconectar();
                    $nombreCuestionario=$rs['nombre'];
                    $estiloPredominante=explode("-",$combinacionEstilo); //$$estiloPredominante[0]; esta el predominante
                    $query="select * from estilo where idEstilo=".$estiloPredominante[0]."";
                    $conexion->conectar();
                    $conexion->myQuery($query);
                    $rs=$conexion->getArrayFila();
                    $descipcionE=$rs['descripcionE'];
                    $conexion->desconectar();

                ?>                      	
                <h4>Resultado de <?php echo $nombreCuestionario; ?></h4>
                <div id='resultado'>
                    <p>Combinacion de estilos: <?php echo $combinacionEstilo; ?></p>
                </div>    
                <fieldset>
                    <legend>Estilo predominante "<?php echo $estiloPredominante[0] ?>" Fecha: <?php echo $fechaCuestionario; ?></legend>
                    <p><?php echo $descipcionE; ?></p>
                </fieldset>
                <p>Para obtener más información acerca de los estilos de aprendizaje que emplea el sistema 4MAT o simplemente saber que significa su combinación de estilos resultante de <a href="#" onclick="window.open('documentos/Libro_Sistema_4MAT.pdf')">clic aquí</a></p>
                <?php  
                }//Fin si me regresa tuplas
                else
                {
                    echo "<script language='JavaScript' type='text/javascript'> 
                	location.href='cuestionario.php?id=".$idCuestionario."'; 
                </script>";	 ////////////////////////////CAMBIAR EL ACTION PARA MANDAR EL IDCUESTIONARIO
                }
                ?>                
            </article>
        </div>

        <!-- InstanceEndEditable -->
        <footer> 
            <!--Aqui va el pie de pagina-->
            <br><p>2015 © physics-education.tlamatiliztli.mx | All Rights Reserved | Desarrollado por alumnos PIFI</p><br>
        </footer>          	 	
    </body>
    <!-- InstanceEnd --></html>
