<!doctype html>
<html lang="es"><!-- InstanceBegin template="/Templates/plantillaLogueado.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <?php require_once("controlador/verificar.php");
        require_once("controlador/connection.php");
        ?>
        <meta charset="utf-8">

        <link rel="shortcut icon" href="images/atom.ico" />

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />

        <link rel="stylesheet" type="text/css" href="css/estilo.css"> 
        <script type="text/javascript" src="js/materialize.min.js"></script>

        <script type="text/javascript" src="js/validaciones.js"></script>
        <title>Grupo de investigación en la enseñanza de física</title>
    </head>
    <script>
        $(document).ready(function() {

              $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
             $('select').material_select();
             $(".button-collapse").sideNav();
                        // Initialize collapse button
        });

    </script>


    <body>

        <?php
        include("barra.html");
        ?>


        <!-- InstanceBeginEditable name="encabezados" -->        
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
                        <img src="images/4matl.png" alt="logo" class="imagenLogo"/>
                    </div>
                </header>
            </div>
        </div>




        <?php 
        include("minibarra.php");
        ?>
        
        <!-- InstanceBeginEditable name="content" -->
        <?php 
        require_once("controlador/busqueda.php"); 
        esAdministrador();//Si es un administrador lo dejamos aqui sino no puede estar en esta pagina	
        ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">



        <div class="contenido">
            <article>            	
                <h4>Panel de visualización de resultados</h4>
                <p> En esta sección encontrarás información acerca de las personas que han contestado el cuestionario, ya que podrás hacer búsquedas <strong></strong>empleando diversos parámetros.</p>
                <hr color="#70ce24">
            </article>
            <article>

                <form name="busqueda" method="post" action="#resultados">
                   <div class=row>
                   
                    
                       <div class="col s12 m12 l6">
                       <br>
                        <input type="search" name="txtBuscar" placeholder="Buscar por nombre o institución">
                       </div>
                       <div class=cuest>Rango de fechas en que se contestó el cuestionario.</div>
                        <div class="col s12 m10 l2">
                                     
                            <input type="date" class="datepicker" name="fechaCuest1">
                            
                       </div>
                         <div class="col s12 m10 l2">
                           <input type="date" class="datepicker" name="fechaCuest2">
                       </div>
                       
                       <div class="input-field col s12 m10 l3">
                            <select name="idCuest" style="display:none;">
                                <option value="1" selected>Cuestionario</option>
                                
				                <option value="1">Estilos de Aprendizaje</option>
				                <option value="2">Estilos de Enseñanza</option>
                                <option value="1">Conocimientos Historicos de Ciencia </option>                                
				            </select>
                              <label >Cuestionario</label>
                               </div>
                                <div class=" input-field col s12 m10 l3">
                                <select name="ocupacion" style="display:none;">
                                    <option value="A">Todas las ocupaciones</option>
                                    <option value="Estudiante">Estudiante</option>
                                    <option value="Egresado">Egresado</option>
                                    <option value="Profesor">Profesor</option>
                                </select>
                       </div>
                           
                       <div class="col s12 m12 l5">  Rango de fechas de nacimiento.  </div>
                       <div class="col s12 m10 l2">
                                  
                            <input type="date" class="datepicker" name="fechaCuest1">
                            
                       </div>
                         <div class="col s12 m10 l2">
                           <input type="date" class="datepicker" name="fechaCuest2">
                       </div>
                       
                        <div class="col s12 m10 l5">
                             Genero:
                               <br>   
                                <input  name="sexo" value="M" type="checkbox" id="test5" > 
                                <label for="test5">Masculino</label>
                                <input  name="sexo" value="F"  type="checkbox" id="test6" > 
                                <label for="test6">Femenino</label>
                                <input  type="checkbox" id="test7"  name="sexo" value="A" checked>
                                <label for="test7">Ambos</label> 
                       </div>      
                            
                        <div class="col s12 m10 l5">
                            <input name="btnBuscar" type="submit" class="btn" value="Buscar">
                                <input name="btnALL" type="submit" class="btn" value="Mostrar todo">
                       </div>                    
                          
                    
                       
                    </div>
                </form>
            
            </article>
                </div>

            <article>
            
                <a name="resultados"></a>
                <?php 
                $busqueda = new Busqueda();
                $busqueda->principal();
                $_SESSION['numEstudiantes'] = $busqueda->getCoincidecias("Estudiante");
                $_SESSION['numEgresados'] = $busqueda->getCoincidecias("Egresado");
                $_SESSION['numProfesores'] = $busqueda->getCoincidecias("Profesor");
                ?>	
                		
            </article>
                
            <!-- Graficas -->
            <!--Load the AJAX API-->
            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript">

                // Load the Visualization API and the piechart package.
                google.load('visualization', '1.0', {'packages':['corechart']});

                // Set a callback to run when the Google Visualization API is loaded.
                google.setOnLoadCallback(drawChart);
                
                // Callback that creates and populates a data table,
                // instantiates the pie chart, passes in the data and
                // draws it.
                function drawChart() {
                    // Create the data table.
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Topping');
                    data.addColumn('number', 'Slices');
                    data.addRows([
                        ['Estudiante', <?php if(isset($_SESSION['numEstudiantes'])) echo $_SESSION['numEstudiantes']; else echo "0"; ?>],
                        ['Egresado', <?php if(isset($_SESSION['numEgresados'])) echo $_SESSION['numEgresados']; else echo "0"; ?>],
                        ['Profesor', <?php if(isset($_SESSION['numProfesores'])) echo $_SESSION['numProfesores']; else echo "0"; ?>]
                    ]);

                    // Set chart options
                    var options = {'title':'Ocupación',
                                   'width':'100%',
                                   'height':'100%'};

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
            </script>
            
               <div class="row">
                <div class="col s12 m10 l5">
                 <div id="chart_div"></div>
            </div>
            </div>
            
            
        <!-- InstanceEndEditable -->
        <footer> 
            <!--Aqui va el pie de pagina-->
            <br><p>2017 © physics-education.tlamatiliztli.mx | All Rights Reserved | Desarrollado por alumnos BEIFI</p><br>
        </footer>          	 	
    </body>
    <!-- InstanceEnd --></html>
