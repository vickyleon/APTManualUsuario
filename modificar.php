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
		//para la fecha de nacimiento
		$('.datepicker').pickadate({
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 15 // Creates a dropdown of 15 years to control year
		});
		
		//opcion 

		$('select').material_select();
		$("#btn-modificar").click(function(e) {
			//alert($("#modificar").serialize());

			$.ajax({
				type: "post",
				url: "controlador/Modificar.php",
				data: $("#modificar").serialize(),
				success: function(resp) {
					//alert(resp);
					if (resp == 1) {
						$('#modal1').modal('open');
							
					} else {
						$('#modal2').modal('open');
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
		<!-- InstanceBeginEditable name="encabezados" -->
		<div id='banner'>
			<div class="row">
				<header>
					<div class="col s12 m8 l6">
						<!--Aquí va el titulo de la pagina que aparece al lado del logo-->
						<h2 style="padding:20%;">Registro de usuario</h2>
						<!--------------------------------------------------------------->
					</div>
					<div class="col s12 m8 l6">
						<img src="images/4matl.png" alt="logo" class="imagenLogo" />
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
					<h3>Modifica tus datos</h3>
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

									<div class="row">
										<div class="input-field col s12 l6">
											<i class="material-icons prefix">account_circle</i>
											<input input type="text" name="txtNombre" id="txtNombre" oninput="cnombre()" value="<?php echo $arrayNombre[0];?>" required/>
											<label>Nombre(s)</label>
										</div>
										<div class="input-field col s12 l6">
											<i class="material-icons prefix">account_circle</i>
											<input id="icon_telephone" class="validate" type="text" name="txtApPat" id="txtApPat" oninput="capPaterno()" placeholder="Ap. Paterno" value="<?php echo $arrayNombre[1];?>" required/>
											<label for="icon_telephone">Apellido paterno</label>
										</div>

									</div>
									<div class="row">
										<div class="input-field col s12 l6">
											<i class="material-icons prefix">account_circle</i>
											<input id="icon_prefix" type="text" class="validate" name="txtApMat" id="txtApMat" oninput="capMaterno()" placeholder="Ap. Materno" value="<?php echo $arrayNombre[2];?>" required>
											<label>Apellido materno:</label>
										</div>
										<div class="input-field col s6">
											<i class="material-icons prefix">today</i>
											<input type="date" class="datepicker" name="txtFechaNac" id="txtFechaNac" maxlength="10" oninput="cfecha()" required placeholder="dd-mm-yyyy" value="<?php echo $usuario->getFechaNac(); ?>">
										</div>
									</div>
									<div class="row">
										<div class="input-field col s6">
											<i class="material-icons prefix">perm_identity</i>
											<label for="genero" id="labelGenero">Genero:</label>
											<br>
											<p>
												<input type="radio" name="genero" value="M" id="genero_0" class="tRadio" <?php if($usuario->getSex() == 'M') echo "checked"; ?>/>
												<label for="genero_0">Masculino</label>
											</p>
											<p>
												<input type="radio" name="genero" value="F" id="genero_1" class="tRadio" <?php if($usuario->getSex() == 'F') echo "checked"; ?> />
												<label for="genero_1">Femenino</label>
											</p>
										</div>
										<div class="input-field col s12 l6 ">

											<label for="txtOcupacion" id="labelOcup" class="pure-checkbox">Ocupación:</label>
											<br>
											<br>
											<i class="material-icons prefix">toc</i>
											<select name="txtOcupacion" id="txtOcupacion" style="display:none;" required>
												<option value="" disabled selected>Elija una opción ...</option>
												<option value="Estudiante" <?php if($usuario->getOcupacion() == "Estudiante") echo "selected"; ?> >Estudiante</option>
												<option value="Egresado" <?php if($usuario->getOcupacion() == "Egresado") echo "selected"; ?>>Egresado</option>
												<option value="Profesor" <?php if($usuario->getOcupacion() == "Profesor") echo "selected"; ?>>Profesor</option>
											</select>
										</div>
									</div>
									<div class="row">

										<div class="input-field col s12">
											<i class="material-icons prefix">label_outline</i>
											<input type="text" class="materialize-textarea" name="txtInstitucion" id="txtInstitucion" oninput="cinstitucion()" placeholder="Escuela-Institución" value="<?php echo $usuario->getInstitucion(); ?>" required/>

										</div>
										<div class="input-field col s12">
											<i class="material-icons prefix">email</i>
											<input type="email" name="txtEmail" id="txtEmail" oninput="cemail()" placeholder="Email" value=<?php echo "'".$usuario->getEmail()."'"; ?> required/>
											<label for="txtEmail">Email</label>

										</div>
										<div class="input-field col s12">
											<i class="material-icons prefix">email</i>
											<input type="email" name="txtEmail2" id="txtEmail2" oninput="cemail()" placeholder="Confirmar email" value=<?php echo "'".$usuario->getEmail()."'"; ?> required/>
											<label for="txtEmail2">Confirmar Email:</label>
										</div>






										<div class="input-field col s6" style="padding-left:45%;">
											<button type="submit" value="Registrar" class="btn waves-effect waves-light" style="color:white;" id="btn-modificar">Modificar
												<i class="material-icons right">send</i>
											</button>
										</div>




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
					<p>Se cerrar&aacute; sesi&oacute;n para que pueda comprobar los nuevos datos</p>
				</div>
				<div class="modal-footer">
					<a href="controlador/logout.php" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
				</div>
			</div>

			<div id="modal2" class="modal">
				<div class="modal-content">
					<h4>No hemos podido actualizar</h4>
				</div>
				<div class="modal-footer">
					<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
				</div>
			</div>
</body>

<!-- InstanceEnd -->

</html>
