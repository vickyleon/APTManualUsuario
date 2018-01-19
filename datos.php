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


				$('.modal').modal();
				$(".button-collapse").sideNav();
				// Initialize collapsible (uncomment the line below if you use the dropdown variation)
				$('.collapsible').collapsible();
				$('select').material_select();
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
			
			
			
				<h2 style="color: black;">Profesor <?php $sqlps="SELECT u.ApPaterno, u.ApMaterno,u.Nombre, U.Edad, u.Email, p.nombre as pais, i.nombre as institucion, a.nombre as area, n.nivel from usuario u, pais p, nivel n, institucion i, area a where u.IDPais=p.IDPais and u.IDInst=i.IDInst and u.idArea=a.IDArea and n.idNivel=u.idNivel and u.ID=".$_SESSION["acceso"][8].";"; $sth = mysqli_query($conexion,$sqlps);
					while($REP=mysqli_fetch_array($sth)){
						echo $REP[0] ." ".$REP[1]." ".$REP[2];
                        $miau1=$REP[3];
                        $miau2=$REP[4];
                        $miau3=$REP[5];
                        $miau4=$REP[6];
                        $miau5=$REP[7];
                        $miau6=$REP[8];
					}
					?> </h2>
					
					<!--Tabla de los usuarios-->
			    <table>
                    <thead>
                      <tr>
                          <th>Edad</th>
                          <th>Email</th>
                          <th>Pais</th>
                          <th>Institución</th>
                          <th>Area</th>
                          <th>Nivel</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><?php echo $miau1; ?></td>
                        <td><?php echo $miau2; ?></td>
                        <td><?php echo $miau3; ?></td>
                        <td><?php echo $miau4; ?></td>
                        <td><?php echo $miau5; ?></td>
                        <td><?php echo $miau6; ?></td>
                      </tr>
                      
                    </tbody>
                  </table>
				<div id="container" style="width: 75%;">
					<canvas id="canvas" ></canvas>
				</div>

					<table class="highlight">
					<thead>
						<tr>
							<th>Pregunta</th>
							<th>Opini&oacute;n</th>
							
						</tr>
					</thead>
					<?php
						$consulta="select b.idpregunta, b.Opinion FROM usuario a, respuestaprofesor b where a.ID=b.ID and b.ID=".$_SESSION["acceso"][8].";";
						$html="<tbody>";
						echo $html;
						$jack=mysqli_query($conexion,$consulta);
						while($REP=mysqli_fetch_array($jack)){
							//$html+="<tr><td>".$REP[0] ." ".$REP[1]." ".$REP[2]."</td><td>".$REP[3]."<td></tr>";
							echo "<tr><td>Pregunta ".$REP[0]."</td><td>".$REP[1]."<td></tr>";
							
						}
						$html="</tbody>";
						echo $html;
					?>
					
				</table>

			<br>
			<div class="row">
				<a class="waves-effect waves-light btn-large offset-s5 col s2" id="btnback">Volver</a>
			</div>
			<br>
			<br>
			</div>
			<footer>
				<!--Aqui va el pie de pagina-->
				<br>
				<p>2015 © physics-education.tlamatiliztli.mx | All Rights Reserved | Desarrollado por alumnos PIFI</p>
				<br>
			</footer>
		</body>
		<script>
			
			$("#btnback").click(function(e) {
				//alert($("#desp2").serialize());

				$.ajax({
				type: "post",
				url: "controlador/asignaCuadro.php",
				data: $("#desp2").serialize(),
				success: function(resp) {
					//alert(resp);
					window.location.replace("administracionEncuesta.php");

				}
			});

			return false;

			});
		</script>
		<script>
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
							//while($registros2=mysqli_fetch_array($result2)){
								//ahora obtengo las respuestas
								$sql3="select rango from respuestaprofesor where id=".$_SESSION["acceso"][8]." order by idpregunta;";
								//echo $sql3;
								$result3=mysqli_query($conexion,$sql3);
								$sql4="select ApPaterno, ApMaterno, Nombre from usuario where id=".$_SESSION["acceso"][8].";";
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
							//}
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