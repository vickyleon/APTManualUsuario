<!doctype html>
<html lang="es">
<!-- InstanceBegin template="/Templates/plantillaCasiFull.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
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
	<!-- InstanceBeginEditable name="doctitle" -->





	<title>Grupo de investigación en la enseñanza de física</title>
	<!-- InstanceEndEditable -->
	<!-- InstanceBeginEditable name="head" -->
	<!-- InstanceEndEditable -->
</head>
<script>
	$(document).ready(function() {

		$('.modal').modal();
		$(".button-collapse").sideNav(); //boton de menu

		//para la fecha de nacimiento
		$('.datepicker').pickadate({
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 15 // Creates a dropdown of 15 years to control year
		});
		//opcion 
		$('select').material_select();
		$("#btn-Registrar").click(function(e) {
			//alert($("#Registrar").serialize());

			$.ajax({
				type: "post",
				url: "controlador/registro.php",
				data: $("#Registrar").serialize(),
				success: function(resp) {
					//alert(resp);
					
					if (resp == 1) {
						$('#modal1').modal('open');

					}
					else if (resp == 2) {
						$('#modal2').modal('open');

					}
					else if (resp == 3) {
						$('#modal3').modal('open');
					}

					else {
					
						$('#modal4').modal('open');
					}
					

				}
			});

			return false;

		});
	});

</script>

<body>

	<?php
        include ("barra.html");
        ?>




		<!-- InstanceBeginEditable name="Banner" -->
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
		<!-- InstanceBeginEditable name="Content" -->
		<div class="contenido">
			<article>
				<h3 style="text-align:-webkit-center;">Ingresa tus datos</h3>
				<p>Estos se guardarán de manera confidencial, por lo cual se te invita a realizar un registro responsable llenando los campos con tus datos reales.</p>
				<div class="formulario">
					<form name="formUsuario" action="controlador/registro.php" method="post" class="pure-form pure-form-stacked" id="Registrar">



						<div class="row">

							<div class="row">
								<div class="input-field col s12 l6">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="txtNombre" id="txtNombre" oninput="cnombre()" placeholder="Nombre (s)" required/>
									<label>Nombre(s)</label>
								</div>
								<div class="input-field col s12 l6">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_telephone" class="validate" type="text" name="txtApPat" id="txtApPat" oninput="capPaterno()" placeholder="Ap. Paterno" required/>
									<label for="icon_telephone">Apellido paterno</label>
								</div>

							</div>
							<div class="row">
								<div class="input-field col s12 l6">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="txtApMat" id="txtApMat" oninput="capMaterno()" placeholder="Ap. Materno" required//>
									<label>Apellido materno:</label>
								</div>
								<div class="input-field col s6">
									<i class="material-icons prefix">today</i>
									<input type="date" class="datepicker" name="txtFechaNac" id="txtFechaNac" maxlength="10" oninput="cfecha()" required placeholder="dd-mm-yyyy">
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<i class="material-icons prefix">perm_identity</i>
									<label for="genero" id="labelGenero">Genero:</label>
									<br>
									<p>
										<input type="radio" name="genero" value="M" id="genero_0" class="tRadio" />
										<label for="genero_0">Masculino</label>
									</p>
									<p>
										<input type="radio" name="genero" value="F" id="genero_1" class="tRadio" />
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
										<option value="Estudiante">Estudiante</option>
										<option value="Egresado">Egresado</option>
										<option value="Profesor">Profesor</option>
									</select>
								</div>
							</div>
							<div class="row">

								<div class="input-field col s12">
									<i class="material-icons prefix">label_outline</i>
									<textarea class="materialize-textarea" name="txtInstitucion" id="txtInstitucion" oninput="cinstitucion()" placeholder="Escuela-Institución" required></textarea>
									<label for="txtInstitucion">Institución (Ejemplo: ESCOM-IPN)</label>
								</div>
								<div class="input-field col s12">
									<i class="material-icons prefix">email</i>
									<input type="email" name="txtEmail" id="txtEmail" oninput="cemail()" placeholder="Email" required/>
									<label for="txtEmail">Email</label>

								</div>
								<div class="input-field col s12">
									<i class="material-icons prefix">email</i>
									<input type="email" name="txtEmail2" id="txtEmail2" oninput="cemail()" placeholder="Confirmar email" required/>
									<label for="txtEmail2" id="labelEmail">Confirmar Email:</label>
								</div>


								<div class="input-field col s12">
									<i class="material-icons prefix">https</i>
									<input type="password" name="txtPwd" id="txtPwd" oninput="pass()" minlength="6" maxlength="10" placeholder="password" required/>

									<label for="txtEmail" ><pre style='display:inline'>&#09;</pre></label>
								</div>

								<div class="input-field col s12">
									<i class="material-icons prefix">https</i>
									<input type="password" name="txtPwd2" id="txtPwd2" oninput="pass()" min="6" maxlength="10" placeholder="Confirmar password" required/>

									<label for="txtPwd2" id="labelPassC" size="40"><pre style='display:inline'>&#09;</pre></label>

								</div>

								<div class="input-field col s6" style="padding-left:45%;">
									<button type="submit" id="btn-Registrar" value="Registrar" class="btn waves-effect waves-light" style="color:white;">Registrar
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
				<h4>Has sido registrado con &eacute;xito!!</h4>
			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
			</div>
		</div>
		<div id="modal2" class="modal">
			<div class="modal-content">
				<h4>No hemos podido registrarte</h4>
				<p>Tus contraseñas no coinciden o est&aacute;n vac&iacute;as</p>
			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
			</div>
		</div>
		<div id="modal3" class="modal">
			<div class="modal-content">
				<h4>Error</h4>
				<p>Ya te has dado de alta anteriormente</p>
				
			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
			</div>
		</div>
		<div id="modal4" class="modal">
			<div class="modal-content">
				<h4>Error</h4>
				<p>Los datos que propocionaste no son suficientes</p>
				
			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
			</div>
		</div>
</body>
<!-- InstanceEnd -->

</html>
