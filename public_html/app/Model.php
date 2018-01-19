<?php
/*	class Model{
		protected $conexion;
		
		public function __construct($dbname,$dbuser,$dbpass,$dbhost){
			$mvc_bd_conexion = mysql_connect($dbhost, $dbuser, $dbpass);
			
			if (!$mvc_bd_conexion) {
				die('No ha sido posible realizar la conexión con la base de datos: ' . mysql_error());
			}
			
			mysql_select_db($dbname, $mvc_bd_conexion);
			mysql_set_charset('utf8');
			
			$this->conexion = $mvc_bd_conexion;
		}
		
		public function bd_conexion(){
			
		}
		
		public function dameAlimentos(){
			$sql = "select * from alimentos order by energia desc";
			$result = mysql_query($sql, $this->conexion);
			
			$alimentos = array();
			while ($row = mysql_fetch_assoc($result)){
				$alimentos[] = $row;
			}
			
			return $alimentos;
		}
		
		public function buscarAlimentosPorNombre($nombre){
			$nombre = htmlspecialchars($nombre);
			
			$sql = "select * from alimentos where nombre like '" . $nombre . "' order by energia desc";
			$result = mysql_query($sql, $this->conexion);
			
			$alimentos = array();
			
			while ($row = mysql_fetch_assoc($result)){
				$alimentos[] = $row;
			}
			
			return $alimentos;
		}
		
		public function dameAlimento($id){
			$id = htmlspecialchars($id);
			
			$sql = "select * from alimentos where id=".$id;
			$result = mysql_query($sql, $this->conexion);
			
			$alimentos = array();
			$row = mysql_fetch_assoc($result);
			
			return $row;
		}
		
		public function insertarIns($n, $e){
			$n = htmlspecialchars($n);
			$e = htmlspecialchars($e);
			
			$sql = "insert into institucion (nombre, siglas) values ('" .$n. "','" . $e . "')";
			$result = mysql_query($sql, $this->conexion);
			
			return $result;
		}
		
		public function validarDatos($n, $e){
			return (is_string($n) &
                 is_string($e)
				 );
		}
	}
	*/
?>