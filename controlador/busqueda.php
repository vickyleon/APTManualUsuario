<?php	
	class Busqueda{
		private $txtBuscar;
		private $idCuestionario;
		private $sexo;
		private $txtFechaNac1;
		private $txtFechaNac2;
		private $txtFechaRe1;
		private $txtFechaRe2;
		
		private $query;
		private $matrizResultados;
		private $banderaImprimir;
		
		public function Busqueda(){
			$this->txtBuscar = "";
			$this->idCuestionario = 1;
			$this->sexo = "";
			$this->txtFechaNac1 = "";
			$this->txtFechaNac2 = "";
			$this->txtFechaRe1 = "";
			$this->txtFechaRe2 = "";
			
			$this->query = "";
			$this->banderaImprimir = false;
		}
		
		public function principal(){
			if(isset($_POST['btnALL'])){
				$this->mostrarTodos();
				$_SESSION['ma'] = serialize($this->matrizResultados);
			}
			if(isset($_POST['btnBuscar'])){
				$this->busquedaFiltrada();
				$_SESSION['ma'] = serialize($this->matrizResultados);
			}
			if(isset($_GET['cr'])){
				$this->matrizResultados = unserialize($_SESSION['ma']);
				$this->matrizResultados = $this->ordenarTuplas($this->matrizResultados,$_GET['cr']);
				$this->banderaImprimir = true;
			}
			
			if($this->banderaImprimir){
				$this->llenarTabla($this->matrizResultados, count($this->matrizResultados));
			}
			
		}
		
		public function mostrarTodos(){
			$this->idCuestionario = $_POST['idCuest'];
			$this->query = "SELECT u.nombre, u.fechaNac, u.sex, u.ocupacion, u.institucion, r.fecha, r.resultado, TIMESTAMPDIFF(YEAR,u.fechaNac, CURRENT_DATE) as edad FROM usuario u, cuestionarioResuelto r WHERE u.idUsuario = r.idUsuario AND r.idCuestionario = ".$this->idCuestionario." ORDER BY r.fecha";
			$conexion = new connection();
			$conexion->conectar();
			$conexion->myQuery($this->query);
 			
			if($conexion->getFilas() > 0){
				$this->matrizResultados = $this->getMatrizResultados($conexion);
				$this->banderaImprimir = true;
			}
			else{
				echo "<p><strong>No hay resultados para mostrar :(</strong></p>";
				$this->banderaImprimir = "false";
			}
			$conexion->desconectar();
		}
		
		public function busquedaFiltrada(){
			$banderaError = false;
			$this->idCuestionario = $_POST['idCuest'];
			$this->query = "SELECT u.nombre, u.fechaNac, u.sex, u.ocupacion, u.institucion, r.fecha, r.resultado, TIMESTAMPDIFF(YEAR,u.fechaNac, CURRENT_DATE) as edad FROM usuario u, cuestionarioResuelto r WHERE u.idUsuario = r.idUsuario AND r.idCuestionario = ".$this->idCuestionario." ";
			$var_desicion = 0;
			if($_POST['fechaNac2'] != ""){
				$var_desicion += 1;
			}
			if($_POST['fechaNac1'] != ""){
				$var_desicion += 2;
			}
			if($_POST['fechaCuest2'] != ""){
				$var_desicion += 4;
			}
			if($_POST['fechaCuest1'] != ""){
				$var_desicion += 8;
			}
			if($_POST['txtBuscar'] != ""){
				$var_desicion += 16;
			}
			//echo "<h1>$var_desicion</h1>";
			switch($var_desicion){
				case 0:
					
					break;
				case 3:
					$fecha1 = $this->convertirFecha($_POST['fechaNac1']);
					$fecha2 = $this->convertirFecha($_POST['fechaNac2']);
					$this->query .= "AND u.fechaNac BETWEEN '".$fecha1."' AND '".$fecha2."' ";
					break;
				case 12:
					$fecha1 = $this->convertirFecha($_POST['fechaCuest1']);
					$fecha2 = $this->convertirFecha($_POST['fechaCuest2']);
					$this->query .= "AND r.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' ";
					break;
				case 15:
					$fecha1 = $this->convertirFecha($_POST['fechaCuest1']);
					$fecha2 = $this->convertirFecha($_POST['fechaCuest2']);
					$fecha3 = $this->convertirFecha($_POST['fechaNac1']);
					$fecha4 = $this->convertirFecha($_POST['fechaNac2']);
					$this->query .= "AND u.fechaNac BETWEEN '".$fecha3."' AND '".$fecha4."' ";
					$this->query .= "AND r.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' ";
					break;								
				case 16:
					$var_busqueda = $_POST['txtBuscar'];
					$this->query .= "AND (u.nombre LIKE '%$var_busqueda%' or u.institucion LIKE '%$var_busqueda%') ";
					break;
				case 19:
					$var_busqueda = $_POST['txtBuscar'];
					$fecha1 = $this->convertirFecha($_POST['fechaNac1']);
					$fecha2 = $this->convertirFecha($_POST['fechaNac2']);
					$this->query .= "AND (u.nombre LIKE '%$var_busqueda%' or u.institucion LIKE '%$var_busqueda%') ";
					$this->query .= "AND u.fechaNac BETWEEN '".$fecha1."' AND '".$fecha2."' ";
					break;
				case 28:
					$var_busqueda = $_POST['txtBuscar'];
					$this->query .= "AND (u.nombre LIKE '%$var_busqueda%' or u.institucion LIKE '%$var_busqueda%') ";
					$fecha1 = $this->convertirFecha($_POST['fechaCuest1']);
					$fecha2 = $this->convertirFecha($_POST['fechaCuest2']);
					$this->query .= "AND r.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' ";
					break;
				case 31:
					$var_busqueda = $_POST['txtBuscar'];
					$this->query .= "AND (u.nombre LIKE '%$var_busqueda%' or u.institucion LIKE '%$var_busqueda%') ";
					$fecha1 = $this->convertirFecha($_POST['fechaCuest1']);
					$fecha2 = $this->convertirFecha($_POST['fechaCuest2']);
					$fecha3 = $this->convertirFecha($_POST['fechaNac1']);
					$fecha4 = $this->convertirFecha($_POST['fechaNac2']);
					$this->query .= "AND u.fechaNac BETWEEN '".$fecha3."' AND '".$fecha4."' ";
					$query .= "AND r.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' ";
					break;
				default:
					$banderaError = true;
					echo "Error, revisa los campos de búsqueda.";								
			}
			if($_POST['sexo'] != 'A'){
				$this->query .= "AND u.sex = '".$_POST['sexo']."' ";
			}
			if($_POST['ocupacion'] != 'A'){
				$this->query .= "AND u.ocupacion = '".$_POST['ocupacion']."' ";
			}
			//echo $query;
			if($banderaError == false){
				$conexion = new connection();
				$conexion->conectar();
				$conexion->myQuery($this->query);

				if($conexion->getFilas() > 0){
					$this->matrizResultados = $this->getMatrizResultados($conexion);
					$this->banderaImprimir = true;
				}
				else{
					echo "<p><strong>No hay resultados para mostrar :(</strong></p>";
					$this->banderaImprimir = false;
				}
				$conexion->desconectar();
			}
		}
		
		function getMatrizResultados($con){	
			$contador = 0;
			while($res = $con->getArrayFila()){
				$matriz[$contador]["nombre"] = $res['nombre'];
				$matriz[$contador]["fechaNac"] = $res['fechaNac'];
				$matriz[$contador]["edad"] = $res['edad'];
				$matriz[$contador]["sexo"] = $res['sex'];
				$matriz[$contador]["ocupacion"] = $res['ocupacion'];
				$matriz[$contador]["institucion"] = $res['institucion'];
				$matriz[$contador]["fechaRe"] = $res['fecha'];
				$matriz[$contador]["resultado"] = $res['resultado'];
				$contador += 1;
			}
			return $matriz;
		}
	
		function imprime($matriz){
			foreach($matriz as $array){
				print_r($array);
				echo "<br>";
			}
		}
					
		function convertirFecha($fecha){
			$fecha = new DateTime($fecha);
			$fecha = $fecha->format('Y-m-d');
			return($fecha);
		}
	
		function ordenarTuplas($matriz, $criterio){
			foreach($matriz as $clave => $fila){
				$array[$clave] = $fila[$criterio];
			}
			array_multisort($array, SORT_ASC, $matriz);
			return $matriz;
		}
		
		function getCoincidecias($valor_a_buscar){
			$matriz = $this->matrizResultados;
			$numero = 0;
			if($matriz != NULL){
				foreach($matriz as $array){
					if($valor_a_buscar == $array['ocupacion']){
						$numero = $numero + 1;
					}
				}
			}
			return $numero;
		}
					
		function llenarTabla($matriz, $numTuplas){
			echo "<p><strong>Haga clic sobre el encabezado de una columna para ordenar los resultados.</strong></p>";
			echo "<p><strong>Se han encontrado ".$numTuplas." coincidencias.</strong></p>"; 
			?>
			<table class="responsive-table">
			<thead>
				<tr>
					<th><a href="?cr=nombre#resultados">Nombre</a></th>
					<th><a href="?cr=fechaNac#resultados">Fecha de nacimiento</a></th>
					<th><a href="?cr=edad#resultados">Edad</a></th>
					<th><a href="?cr=sexo#resultados">Sexo</a></th>
					<th><a href="?cr=ocupacion#resultados">Ocupación</a></th>
					<th><a href="?cr=institucion#resultados">Institución</a></th>
					<th><a href="?cr=fechaRe#resultados">Fecha de resolución</a></th>
					<th><a href="?cr=resultado#resultados">Resultado</a></th>
				</tr>
                </thead>
                <tbody>
				<?php
					foreach($matriz as $res){
						$fechaNac = date_create($res['fechaNac']);
						$fechaRe = date_create($res['fechaRe']);
						echo "<tr>";
						echo "<td>".$res['nombre']."</td>";
						echo "<td>".date_format($fechaNac,"d/F/Y")."</td>";
						echo "<td>".$res['edad']."</td>";
						echo "<td>".$res['sexo']."</td>";
						echo "<td>".$res['ocupacion']."</td>";
						echo "<td>".$res['institucion']."</td>";
						echo "<td>".date_format($fechaRe,"d/F/Y")."</td>";
						echo "<td>".$res['resultado']."</td>";
						echo "</tr>";	
					}
			   ?>
                </tbody>
			</table>    						
	<?php 
		}
	}
?>	