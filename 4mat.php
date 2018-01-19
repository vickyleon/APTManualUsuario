<!doctype html>
<html lang="es">
	<!-- InstanceBegin template="/Templates/plantillaLogueado.dwt" codeOutsideHTMLIsLocked="false" -->

	<head>
		<?php require_once("controlador/verificar.php");
		require_once("controlador/connection.php");
		?>
		<meta charset="utf-8">

		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
		<script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
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
		include("minibarra.php");
		?>


		<!-- InstanceBeginEditable name="content" -->
		<div class="contenido">
			<?php if($banderaSesion == false){ ?>
			<div class="row">
				<article>
					<div class="col s12 m10 l6">

						<img src="images/Bienvenidos.png" style=" width: 60%;" />

						<p>En esta página encontrará una serie de instrumentos para evaluar estilos de aprendizaje, estilos de enseñanza y hemisfericidad cerebral.</p>
						<p>Al contestarlo nos ayudaras en diversos proyectos de investigación educativa, tus datos se guardarán de manera confidencial.</p>
						<p>Siga las siguientes indicaciones:</p>
						<br />
						<ol>
							<li><strong>Si no se a registrado, se necesita crear una cuenta.</strong></li>
							<li><strong>Si esta registrado, por favor accese a su cuenta, con el login de usuario y su password.</strong></li>
							<li><strong>Ya dentro de su cuenta , por favor introduzca los datos que se le solicitan.</strong></li>
						</ol>
					</div>
				</article>

				<div class="col s12 m10 l6">
					<?php
	include("login.html");
					?>

				</div>
			</div>
			<?php }
			else
			{
			?>    
			<br>
			<br>
			<br>
			<h4>Bienvenido</h4>
			<article>

				<p>Mario H. Ramírez Díaz. Actualmente es profesor titular en el programa de posgrado en Física Educativa del Centro de Investigación en Ciencia Aplicada y Tecnología Avanzada del Instituto Politécnico Nacional de México. Es Doctor en Física Educativa, Maestro en Ciencias con Especialidad en Física y Licenciado en Física y Matemáticas, todos por el Instituto Politécnico Nacional. Ha sido profesor en varias Universidades en México y es miembro del Sistema Nacional de Investigadores. Sus trabajos de investigación y publicaciones incluyen los Estilos de aprendizaje, el modelo de educación por competencias y la enseñanza de la física, además de trabajos sobre la sociofísica.</p>
				<div class="centrado"><img src="images/bienvenida.jpg" alt="Bienvenido"></div>
			</article>
			<?php
			}
			?>
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
