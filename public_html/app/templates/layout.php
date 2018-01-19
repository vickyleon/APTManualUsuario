<!doctype html>
<html class=""><head>
<meta charset="utf-8">
<title>AAPT | México</title>
<link type="text/css" rel="stylesheet" href="app/templates/css/materialize.css" media="screen,projection" />
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

<link rel="stylesheet" href="web/css/estilo.css" media="all"> 
<link rel="stylesheet" href="web/css/iconos.css" media="all"> 
<link rel="stylesheet" href="web/css/popup.css" media="all">
<link rel="shortcut icon" href="web/img/aaptmx.ico">
<script type="text/javascript" src="web/js/validaciones.js"></script>

<!-- Insert to your webpage before the </head> -->

<script src="app/templates/carouselengine/amazingcarousel.js"></script>
<link rel="stylesheet" type="text/css" href="app/templates/carouselengine/initcarousel-1.css">
<script src="app/templates/carouselengine/initcarousel-1.js"></script>
<!-- End of head section HTML codes -->

<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">





</head>
<script>
	$(document).ready(function() {
			// Show or hide the sticky footer button
			$(window).scroll(function() {
				if ($(this).scrollTop() > 200) {
					$('.go-top').fadeIn(200);
				} else {
					$('.go-top').fadeOut(200);
				}
			});

			// Animate the scroll to top
			$('.go-top').click(function(event) {
				event.preventDefault();

				$('html, body').animate({scrollTop: 0}, 300);
			})
		});
	</script>
	
	<body>
		<nav class="Columnas">
			<div class="nav-wrapper">
				<ul id="menu" id="nav-mobile" class="right hide-on-med-and-down" style="display:inherit !important;">
					<li><a class="active" href="index.php">Inicio</a></li>
					<li>
						<a href="#eventosYavisos">Eventos</a>	  
						<ul class="children">
							<li><a href="#">Pasados</a></li>
						</ul>
					</li>
					<li><a href="index.php?ctl=normatividad">Normatividad</a></li>
					
					<?php
					$sesion = new Sesion();
					$usuario = $sesion->getSesion('login');

					if($usuario == false){?>
					<li>
						<a href="#modal1">Boletin</a>
					</li>
					<li><a href="index.php#Login">Inicia Sesión</a></li>

					<?php }	else{ 
						$socio = $sesion->getSesion('socio');

						?>
						<li>
						<a href="index.php?ctl=boletin">Boletin</a>
						</li>
						<li>
							<a href="index.php?ctl=material">Material Didáctico</a> 

						</li>
						<li style="width: 43px; text-align: right;"><img  class="perfil" src="app/templates/css/imagenes/perfil.png"></li>
						<li><a href=""> <?php echo $socio->getPrefijo().' '.$socio->getNombreCompleto(); ?></a>
							<ul class="children">
								<li><a href="index.php?ctl=logout">Cerrar Sesión</a></li>
							</ul>
						</li>
						<?php }	?>
					</ul>
				</div>
			</nav>

			<header>
				<div class="slider">
					<ul>
						<li><a href="#"><img src="web/img/bannerAaptMx.png" alt=""></a></li>
						<li><a href="#"><img src="web/img/bannerAaptMx2.png" alt=""></a></li>
						<li><a href="#"><img src="web/img/bannerAaptMx3.png" alt=""></a></li>
						<li><a href="#"><img src="web/img/bannerAaptMx4.png" alt=""></a></li>                

					</ul>
				</div>
			</header>

			<div id="contenido">

				<!-- Aqui va el contenido del contenedor blanco-->
				<?php echo $contenido ?>		


				<div id="eventosYavisos">
					<div class="Columnas">            	
						<div class="columna2">
							<h3>Proximos Eventos</h3>
							<div id="eventos">
								<!-- --------------------EJEMPLO BLOQUE DE EVENTO-------------------------->
								<div class="Columnas">
									<div class="calendarE">
										<img src="web/img/calendar146.png" class="centrado">
										<p class="fecha">17-18/Nov/2016</p>
									</div>
									<aside class="evento">
										<p class="negritas">Reunión Anual AAPT-MX 2016</p>
										<p>El evento se llevará acabo en el Centro de Educación Continua Unidad Cancún IPN. <a href="index.php?ctl=eventos">Más información.</a></p>
									</aside>
								</div>
								<hr>
								<!-- ----------------------------------------------------------------- -->              
							</div>                                                                            
						</div>
						<div class="columna2">
							<h3>Avisos</h3>
							<div id="avisos">
								<!-- ------------------------EJEMPLO BLOQUE AVISO------------------> 
								<aside>
									<aside>
										<p class="negritas"><span class="icon-announcement"></span>Nuevo sitio WEB.</p>
										<p class="fechaAviso">05/Septiembre/2016</p>
										<p>Les informamos que la fecha de recepción de trabajos ha sido extendida al día martes 20 de septiembre.<br>
											A todos aquellos que realizaron este proceso en la primera fecha estipulada (31 de agosto), recibirán el veredicto de su trabajo para el 7 de septiembre.</p>
										</aside>
									</aside>
									<hr>
									<!-- ---------------------------------------------------------- -->                        


								</div>                      
							</div>
						</div>         
					</div>
				</div> <!-- Terminacion div eventos-->
				<footer>
					<div class="Columnas">
						<aside class="columna2">
							<img class="social" alt="YouTube" src="web/img/youtube30.png">
							<a href="https://www.facebook.com/AAPTMX" target="_blank"><img class="social" alt="Facebook" src="web/img/logotype15.png"></a>
						</aside>
						<aside id="formContacto" class="columna2" style="min-height:350px">
							<form method="post" action="#" name="contacto" id="contacto">
								<h2>Contacto Directo</h2>
								<input name="nombre" placeholder="Su nombre..." size="27" maxlength="50" required type="text">
								<input name="email" placeholder="Su email..." size="27" maxlength="50" required type="email">
								<p></p>
								<textarea name="mensaje" rows="5" placeholder="Escriba aquí su mensaje..." required></textarea> <!-- Debe ir en una sola linea o no furula -->
								<input name="btnEnviar" value="Enviar" class="btn" type="submit">
							</form>
						</aside>
					</div>
					<hr>
					<span class="copy"><br>Copyright © 2016 - Todos los derechos reservados. | Desarrollado por: RAM© <br><br></span>
				</footer>


				<div id="modal1" class="modal">
					<div class="modal-content">
						<h4>Acceso Restringido</h4>
						<p>Para poder ver nuestro bolet&iacute;n debe iniciar sesi&oacute;n</p>
					</div>
					<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
					</div>
				</div>

			</body></html>

			<script type="text/javascript">
				 $(document).ready(function(){
				    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
				    $('.modal').modal();
				  });
			</script>
