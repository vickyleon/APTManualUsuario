<?php
	class connection{
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
		
		public function connection(){
				/*************************************************************/
				$this->server = "mssql.tlamatiliztli.net";
				$this->user = "tlama_4mat_2";
				$this->pwd = "rszY7?75";
				$this->bd = "tlamatil_4mat_beta_2";
				/*************************************************************
				$this->server = "localhost";
				$this->user = "root";
				$this->pwd = "";
				$this->bd = "4mat";
				/*************************************************************/
		}
		
		public function conectar(){
			$this->conexion = mysql_connect($this->server, $this->user, $this->pwd);
			mysql_select_db($this->bd, $this->conexion);
			if(!$this->conexion)
				die("Error al conectar: ".mysql_error());
			//else
				//echo "Conectado<br>";
		}
		
		public function desconectar(){
			mysql_close($this->conexion);
			//echo "Desconectado<br>";
		}
		
		public function myQuery($query){
			$this->resultado = mysql_query($query, $this->conexion) or die(mysql_error());
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
			return mysql_num_rows($this->resultado);
		}
		
		public function getArrayFila(){
			return mysql_fetch_assoc($this->resultado);
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