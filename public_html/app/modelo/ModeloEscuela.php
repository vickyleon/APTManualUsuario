<?php
	class ModeloEscuela{
		protected $db;
		
		public function __construct(){
			$this->db = new Connection();
			$this->db ->conectar();
		}
		
		public function validarDatos($bean){
			//echo 'Desde el modelo: '.$socio->getNombreCompleto();
			return 1;
		}
		
		public function insertar($bean){
			$query  = 'insert into escuela(nombre,direccion,idInstitucion) ';
			$query .= 'values("'.$bean->getNombre().'","'.$bean->getDireccion().'","'.$bean->getIdInstitucion().'")';
			$this->db -> myQuery($query);
		}
		
		public function getEscuelas($busqueda){
			$query = 'select * from escuela order by idInstitucion, nombre';
			
			if($busqueda != ''){
				$query = 'select * from escuela where nombre LIKE "%'.$busqueda.'%" order by idInstitucion, nombre';
			}
			$this->db -> myQuery($query);
			
			$datos = array();
			while ($row = $this->db ->getArrayFila()) {
				$datos[] = $row;
   			}
			
			return $datos;
		}
		
		public function buscarPorInstitucion($busqueda){
			$query = 'select * from escuela';
			
			if($busqueda != ''){
				$query .= ' where idInstitucion = '.$busqueda.' order by nombre';
			}
			$this->db -> myQuery($query);
			
			$datos = array();
			while ($row = $this->db ->getArrayFila()) {
				$datos[] = $row;
   			}
			
			return $datos;
		}
		
		public function buscarPorNombre($nombre, $direccion){
			$query = 'select idEscuela from escuela where nombre LIKE "'.$nombre.'" and direccion LIKE "'.$direccion.'"';
			$this->db -> myQuery($query);
			$datos = $this->db ->getArrayFila();
			return  $datos['idEscuela'];// Regresa el id de una escuela
		}
	}
?>