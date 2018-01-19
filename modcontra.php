<?php
if(isset($_GET['id']))
    $idCuestionario=$_GET['id'];
else
    $idCuestionario=1;
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
		$(document).ready(function() {

			$('.modal').modal();

			$(".button-collapse").sideNav();
			// Initialize collapse button
			$(".button-collapse").sideNav();
			// Initialize collapsible (uncomment the line below if you use the dropdown variation)
			//$('.collapsible').collapsible();
			$("#btn-modificar").click(function(e) {
				//alert($("#modificar").serialize());

				$.ajax({
					type: "post",
					url: "controlador/modcontra.php",
					data: $("#modificar").serialize(),
					success: function(resp) {
						//alert(resp);
						if (resp == 1) {
							$('#modal1').modal('open');

						} 
						else if(resp == 2) {
							$('#modal2').modal('open');
						}
						else{
							$('#modal3').modal('open');
						}

					}
				});
				return false;

			});
		});

	</script>

	<body>

		<?php 
        include("barra.html");
        ?>

			<!-- InstanceBeginEditable name="Banner" -->
			<div id='banner'>
				<div class="row">
					<header>
						<div class="col s12 m5 l6">
							<!--Aquí va el titulo de la pagina que aparece al lado del logo-->
							<h2 style="padding:20%;">Registro de usuario</h2>
							<!--------------------------------------------------------------->
						</div>
						<div class="col s12 m6 l6">
							<img src="images/4matl.png" alt="logo" class="imagenLogo" />
						</div>
					</header>
				</div>
			</div>
			<!-- InstanceEndEditable -->


			<?php 
        include("minibarra.php");
        ?>
				
				<div class="contenido">
					<article>
						<h3>Modifica tu contaseña</h3>
						<p>Cambia los datos que desees. Si quieres cambiar de correo, marca la casilla y coloca el nuevo correo. Recuerda que éste es el identificador para entrar a tu cuenta.</p>
						<p>Por motivos de seguridad, la contraseña no se incluye dentro del siguiente formulario.</p>
						<?php
                require_once('controlador/BeanUsuario.php');
                //require_once('../controlador/connection.php');
                //session_start();
                $usuario = $_SESSION["login"];
                $usuario = unserialize($usuario);
                $nombre= $usuario->getNombre();
                $arrayNombre=explode(" ",$nombre,3);
                ?>

							<div id="formRegistro">
								<form name="formUsuario" class="pure-form pure-form-stacked" id="modificar">

									<div class="row">

										<div class="input-field col s12">
											<i class="material-icons prefix">https</i>
											<input type="password" name="txtPwd" id="txtPwd" oninput="pass()" minlength="6" maxlength="10" placeholder="password" required/>

											<label for="txtEmail" id="labelEmail"><pre style='display:inline'>&#09;</pre></label>
										</div>

										<div class="input-field col s12">
											<i class="material-icons prefix">https</i>
											<input type="password" name="txtPwd2" id="txtPwd2" oninput="pass()" min="6" maxlength="10" placeholder="Confirmar password" required/>

											<label for="txtPwd2" id="labelPassC" size="40"><pre style='display:inline'>&#09;</pre></label>

										</div>

										<div class="input-field col s6" style="padding-left:45%;">
											<button type="submit" value="Registrar" class="btn waves-effect waves-light" style="color:white;" id="btn-modificar">Modificar <i class="material-icons right">send</i>
											</button>
										</div>




									</div>




								</form>
							</div>

					</article>
				</div>

				<!-- InstanceEndEditable -->
				<footer>
					<!--Aqui va el pie de pagina-->
					<br>
					<p>2015 © physics-education.tlamatiliztli.mx | All Rights Reserved | Desarrollado por alumnos PIFI</p>
					<br>
				</footer>
				<div id="modal1" class="modal">
					<div class="modal-content">
						<h4>Tus datos han sido actualizados con &eacute;xito!!</h4>
					</div>
					<div class="modal-footer">
						<a href="controlador/logout.php" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
					</div>
				</div>
				<div id="modal2" class="modal">
					<div class="modal-content">
						<h4>No hemos podido actualizar</h4>
						<p>Tus contraseñas est&aacute;n vac&iacute;as</p>
					</div>
					<div class="modal-footer">
						<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
					</div>
				</div>
				<div id="modal3" class="modal">
					<div class="modal-content">
						<h4>No hemos podido actualizar</h4>
						<p>Tus contrase&ntilde;as no coinciden</p>
					</div>
					<div class="modal-footer">
						<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
					</div>
				</div>
	</body>
	<!-- InstanceEnd -->

	</html>
