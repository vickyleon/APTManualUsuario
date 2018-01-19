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
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!-- links-->
        <link rel="stylesheet" type="text/css" href="css/estilo.css">      

        <link rel="shortcut icon" href="images/atom.ico" />
        <script type="text/javascript" src="js/validaciones.js"></script>


        <title>Grupo de investigación en la enseñanza de física</title>
    </head>
   
    <script>
      
        $(document).ready(function(){
        // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
            $('.modal').modal();
            $(".button-collapse").sideNav();
            // Initialize collapse button
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
                        <h2>Bienvenidos <img src="images/corazonazul.png" alt="logo" width="80%" /></h2>
                    </div>
                    <div class="col s12 m5 l6">
                        <img src="images/logoIndex.png" alt="logo" width="80%" />
                    </div>
                </header>
            </div>
        </div>
        <!-- Si tiene una sesion abierta -->
        <?php
        include("minibarra.php");
        ?>

        <!-- InstanceBeginEditable name="content" -->        
        <div class="contenido">
            <div class="row">
                <article>
                    <div class ="col s12 m12 l6">
                        <p>Esta es la página del Grupo de Investigación en Física Educativa. Este grupo está formado por investigadores interesados en los procesos de aprendizaje, enseñanza, evaluación, gestión administrativa e investigación educativa alrededor de la física. Somos profesores de nivel bachillerato, universitario y posgrado que hemos tenido la oportunidad de retroalimentar nuestras experiencias docentes y de investigación en la enseñanza de la física. Nuestro grupo trabajan invegadores de diferentes centros educativos distribuidos en la república Mexicana como son: IPN, UNAM, ITESM, Universidad de Coahuila, UANL, Universidad Politécnica del Centro, Universidad de la Ciudad de México entre otros y estamos abiertos a profesores e investigadores de todo el país que deseen integrarse con nosotros.</p>

                    </div>
                    <div class="col s15 m11 l5">
                        <div class ="imagen">
                            <img src="images/lapIma.png" />
                        </div>
                    </div>
                    <div class="col s12 m12 l10">
                        <p>En este portal hallaras cuestionarios, artículos de interés, ligas y otros tópicos que te pueden ser de interés si estas en el área de la docencia de la física, como profesor o investigador. Nuestro objetivo final es la mejora del aprendizaje de la física a todos los niveles y modalidades, esperamos que esta página sea de tu interés y te agradecemos el colaborar con nosotros.</p>
                    </div>
                </article>

            </div>

        </div>
        <!-- InstanceEndEditable -->
        <footer> 
            <!--Aqui va el pie de pagina-->
            <br><p>2015 © physics-education.tlamatiliztli.mx | All Rights Reserved | Desarrollado por alumnos PIFI</p><br>
        </footer>          	 	
    </body>
    <!-- InstanceEnd --></html>
