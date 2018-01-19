<?php
session_start();
if($_SESSION["acceso"][5]==1 || $_SESSION["acceso"][5]==2 || $_SESSION["acceso"][5]==3 || $_SESSION["acceso"][5]==4){
$conexion=mysqli_connect("mssql.tlamatiliztli.net","tlama_Encuesta","ylatesis?","tlamatil_Encuesta");
$sql="select distinct idpregunta from respuestaprofesor order by idpregunta;";
$result=mysqli_query($conexion,$sql);

//obtengo el numero de profesores que contestaron la encuesta

$sql2="select distinct id from respuestaprofesor;";
$result2=mysqli_query($conexion,$sql2);
//genero n resulsets


$profes=0;
echo $profes;
?>


<span style="font-style:italic;"><!doctype html>
	<html lang="es">
		<style>
			canvas {
				-moz-user-select: none;
				-webkit-user-select: none;
				-ms-user-select: none;
			}
		</style>
		<!-- InstanceBegin template="/Templates/plantillaLogueado.dwt" codeOutsideHTMLIsLocked="false" -->

		<head>
			<?php require_once("controlador/verificar.php");
			require_once("controlador/connection.php");
			?>
			<meta charset="utf-8">


			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">

			<script src="js/utils.js"></script>
			<script src="js/Chart.bundle.js"></script>

			<script
					src="https://code.jquery.com/jquery-3.2.1.min.js"
					integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
					crossorigin="anonymous"></script>
			<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
			<script type="text/javascript" src="js/materialize.min.js"></script>

			<script type="text/javascript" src="js/materialize.min.js"></script>
			<!-- links-->
			<link rel="shortcut icon" href="images/atom.ico" />
			<script type="text/javascript" src="js/validaciones.js"></script>
			<link rel="stylesheet" type="text/css" href="css/estilo.css">

			<title>Grupo de investigación en la enseñanza de física</title>
		</head>
		<script>
			$(document).ready(function() {

				var divOne = document.getElementById('btn1');
				divOne.style.visibility = 'hidden';
				var divOnes = document.getElementById('btn2');
				divOnes.style.visibility = 'hidden';
				$('.modal').modal();
				$(".button-collapse").sideNav();
				// Initialize collapsible (uncomment the line below if you use the dropdown variation)
				$('.collapsible').collapsible();
				$('select').material_select();

				$(function () {
					$("#desp1").change(function () {
						//$("#segundo").html("cambioo");
						//alert("change");
						//alert($("#desp1").serialize());
						var x="seleccion=1";
						var w="seleccion=2";
						var y=$("#desp1").serialize();
						if(x.localeCompare(y)==0){


							$.ajax({
								type: "post",
								url: "ObtieneProfesores.php",
								data: $("#desp1").serialize(),
								success: function(r) {

									var resp=$.parseJSON(r);
									//alert(resp.length);
									var boxe = "";
									boxe='<form action="" id="desp2"><div class="input-field col s12"><select  class="select-dropdown" id="seleccion2" name="seleccion2"><option value="" disabled selected>Seleccionar profesor</option>';

									for (i = 0; i < resp.length; i++) {
										//alert(boxe);
										boxe+='<option value="'+resp[i].ID+'">'+resp[i].ApPaterno+' '+resp[i].ApMaterno+' '+resp[i].Nombre+'</option>';	
									}
									boxe+="</select></div></form>";
									$("#segundo").html(boxe);
									divOne.style.visibility = 'visible';

									/*if (resp == 1) {
									$('#modal1').openModal();
								} else {
									alert(resp);
									$('#modal2').openModal();

								}*/
								}
							});

							return false;
						}
						if(w.localeCompare(y)==0){
							$.ajax({
								type: "post",
								url: "ObtieneNum.php",
								data: $("#desp1").serialize(),
								success: function(r) {

									var resp=$.parseJSON(r);
									//alert(resp.length);
									var boxe = "";
									boxe='<form action="" id="desp2"><div class="input-field col s12"><select id="seleccion2" name="seleccion2"><option value="" disabled selected>Seleccionar pregunta</option>';

									for (i = 0; i < resp.length; i++) {
										//alert(boxe);
										boxe+='<option value="'+resp[i].IDPregunta+'">Pregunta '+resp[i].IDPregunta+'</option>';	
									}
									boxe+="</select></div></form>";
									$("#segundo").html(boxe);
									divOnes.style.visibility = 'visible';

									/*if (resp == 1) {
									$('#modal1').openModal();
								} else {
									alert(resp);
									$('#modal2').openModal();

								}*/
								}
							});

							return false;
						}
						else{
							$("#tercero").html("");
							var ctx = document.getElementById("canvas");
							var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
							var color = Chart.helpers.color;
							/*var barChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["Dog", "Cat", "Pangolin"],
					datasets: [{
						backgroundColor: '#00ff00',
						label: '# of Votes 2016',
						data: [12, 19, 3]
					}]
				}
			});*/
							var barChartData = new Chart(ctx, {
								type:'bar',
								data:{
									labels: [
										<?php
										while($registros=mysqli_fetch_array($result)){
										?>

										'<?php echo $registros[0]; ?>',
										<?php
										}
										?>
									],
									datasets: [{
										label: 'Dataset 1',
										backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
										borderColor: window.chartColors.red,
										borderWidth: 1,
										data: [
											0,0
										]
									}]

								}});

							//un data set por cada profesor, cada dataset tiene las respuestas por pregunta
							<?php
							while($registros2=mysqli_fetch_array($result2)){
								//ahora obtengo las respuestas
								$sql3="select rango from respuestaprofesor where id=".$registros2["id"]." order by idpregunta;";
								//echo $sql3;
								$result3=mysqli_query($conexion,$sql3);
								$sql4="select ApPaterno, ApMaterno, Nombre from usuario where id=".$registros2["id"].";";
								$result4=mysqli_query($conexion,$sql4);
								while($registros4=mysqli_fetch_array($result4)){
									$nombre=$registros4["ApPaterno"]." ".$registros4["ApMaterno"]." ".$registros4["Nombre"];
								}
							?>

							addData(barChartData,'<?php echo $nombre; ?>', '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6), [
								<?php
								while($registro3=mysqli_fetch_array($result3)){
								?>
								<?php echo $registro3["rango"]?>,
								<?php
								}
								?>
							]);


							<?php
							}
							?>




							window.onload = function() {
								var ctx = document.getElementById("canvas").getContext("2d");
								window.myBar = new Chart(ctx, {
									type: 'bar',
									data: barChartData,
									options: {
										responsive: true,
										legend: {
											position: 'top',
										},
										title: {
											display: true,
											text: 'Chart.js Bar Chart'
										}
									}
								});

							};

							document.getElementById('randomizeData').addEventListener('click', function() {
								var zero = Math.random() < 0.2 ? true : false;
								barChartData.datasets.forEach(function(dataset) {
									dataset.data = dataset.data.map(function() {
										return zero ? 0.0 : randomScalingFactor();
									});

								});
								window.myBar.update();
							});

							var colorNames = Object.keys(window.chartColors);


							document.getElementById('addData').addEventListener('click', function() {
								if (barChartData.datasets.length > 0) {
									var month = MONTHS[barChartData.labels.length % MONTHS.length];
									barChartData.labels.push(month);

									for (var index = 0; index < barChartData.datasets.length; ++index) {
										//window.myBar.addData(randomScalingFactor(), index);
										barChartData.datasets[index].data.push(randomScalingFactor());
									}

									window.myBar.update();
								}
							});

							document.getElementById('removeDataset').addEventListener('click', function() {
								barChartData.datasets.splice(0, 1);
								window.myBar.update();
							});

							document.getElementById('removeData').addEventListener('click', function() {
								barChartData.labels.splice(-1, 1); // remove the label first

								barChartData.datasets.forEach(function(dataset, datasetIndex) {
									dataset.data.pop();
								});

								window.myBar.update();
							});

							function addData(chart, label, color, data) {
								chart.data.datasets.push({
									label: label,
									backgroundColor: color,
									data: data
								});
								chart.update();
							}

						}
					});


				});



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
			<div class="container">

				<form action="" id="desp1">

					<div class="input-field col s12">
						<select id="seleccion" name="seleccion">
							<option value="" disabled selected>Ver datos:</option>
							<option value="1">Por profesor</option>
							<option value="2">Por pregunta</option>
							<option value="3">Ver todo</option>
							<option value="4">Opiniones del cuestionario</option>
						</select>

					</div>
				</form>

				<div id="segundo">

				</div>
				<p><a class='waves-effect waves-light btn' id='btn1'>Consultar profesor</a>
				<p><a class='waves-effect waves-light btn' id='btn2'>Consultar pregunta</a>
					<!--inicio-->
				<div id="container" style="width: 75%;">
					<canvas id="canvas" ></canvas>
				</div>
				
                 <!--tabla de comentarios generales-->
                 <ul class="collapsible" data-collapsible="accordion">
                  <li>
                    <div class="collapsible-header">
                      <i class="material-icons">filter_drama</i>
                      Nombre 
                     </div>
                    <div class="collapsible-body">
                            <table class="highlight">
                            
                              <tr>
                                  <th>Tamaño letra e imagenes</th>
                                  <td>cool</td>
                              </tr>
                                 <tr>
                                     <th>Redacción de la pregunta</th>
                                      <td>cool</td>
                                 </tr>
                                 <tr>
                                     <th>Distractores</th>
                                     <td>cool</td>
                                 </tr>
                                 <tr>
                                     <th>Dificultad</th>
                                     <td>cool</td>
                                 </tr>
                                  <tr>
                                      <th>Tiempo Estimado</th>
                                      <td>coll</td>
                                  </tr>
                                  <tr>
                                      <th>Otro Comentario</th>
                                      <td>nel</td>
                                  </tr>
                              
                        </table>
				
                    </div>
                  </li>

                </ul>
				
				
				<div class="row">
					<a class="waves-effect waves-light btn-large offset-s5 col s2" id="btnback">Volver</a>
				</div>
				<br>
				<br>
			

			<!--fin-->

			</div>
		<footer>
			<!--Aqui va el pie de pagina-->
			<br>
			<p>2015 © physics-education.tlamatiliztli.mx | All Rights Reserved | Desarrollado por alumnos PIFI</p>
			<br>
		</footer>
		</body>
	<script>
		$("#btn1").click(function(e) {
			//alert($("#desp2").serialize());

			$.ajax({
				type: "post",
				url: "controlador/asignaCuadro.php",
				data: $("#desp2").serialize(),
				success: function(resp) {
					//alert(resp);
					window.location.replace("datos.php");

				}
			});

			return false;

		});

		$("#btn2").click(function(e) {
			//alert($("#desp2").serialize());

			$.ajax({
				type: "post",
				url: "controlador/asignaCuadro.php",
				data: $("#desp2").serialize(),
				success: function(resp) {
					//alert(resp);
					window.location.replace("datos2.php");

				}
			});

			return false;

		});
		$("#btnback").click(function(e) {
				//alert($("#desp2").serialize());
				window.location.replace("EncuestaPiloto.php");
				

			});
	</script>
	<!-- InstanceEnd -->

	</html>
	<?php
	 }
    else{
    echo "<script language=Javascript> location.href=\"4mat.php\"; </script>"; 
    }
	?>
</span>


