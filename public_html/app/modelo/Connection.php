<?php
	class Connection{
		/****************CONEXION****************************/
		private $server;
		private $bd;
		private $user;
		private $pwd;
		private $conexion;
		/****************************************************/
		/*************Resultado de consulta******************/
		private $resultado;
		private $total_filas;
		/****************************************************/
		
		public function __construct(){
				$this->server = Config::$mvc_bd_hostname;
				$this->user = Config::$mvc_bd_usuario;
				$this->pwd = Config::$mvc_bd_clave;
				$this->bd = Config::$mvc_bd_nombre;
		}
		
		public function conectar(){
			$this->conexion = mysqli_connect($this->server, $this->user, $this->pwd, $this->bd);
			//mysql_select_db($this->bd, $this->conexion);
			if(!$this->conexion)
				die("Error al conectar: ".mysql_error());
			//else
				//echo "Conectado<br>";
		}
		
		public function desconectar(){
			mysqli_close($this->conexion);
			//echo "Desconectado<br>";
		}
		
		public function myQuery($query){
			$this->resultado = mysqli_query($this->conexion, $query) or die(mysqli_error($this->conexion));
			//$this->total_filas = mysql_num_rows($this->resultado);
			
			/*
			if ($this->total_filas > 0) {
   				while ($rowEmp = mysql_fetch_assoc($this->resultado)) {
			      	echo "<strong>".$rowEmp['dni']."</strong><br>";
    	  			echo "Direccion: ".$rowEmp['nombre']."<br>";
	      			echo "Telefono: ".$rowEmp['password']."<br><br>";
   				}
			}*/
		}
		
		public function getFilas(){
			return mysqli_num_rows($this->resultado);
		}
		
		public function getArrayFila(){
			return mysqli_fetch_assoc($this->resultado);
		}
	}
	
/*	$a = new connection();
	$a->conectar();
	
	//$a->myQuery("INSERT INTO usuario(dni,nombre,password,foto) VALUES(NULL,'marga123','marga23','jpg')");
	$a->myQuery("SELECT * FROM tareas WHERE fechaentrega > '2013-06-14' ORDER BY fechaentrega asc");
	echo($a->getFilas()."<br>");
	while ($rowEmp = $a->getArrayFila()) {
			      	echo "<strong>".$rowEmp['materia']."</strong><br>";
    	  			echo "Direccion: ".$rowEmp['fechaentrega']."<br>";
	      			echo "Telefono: ".$rowEmp['descripcion']."<br><br>";
   				}
	$a->desconectar();*/
?>
