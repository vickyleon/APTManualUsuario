<?php
	class ModeloInstitucion{
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
			$query  = 'insert into institucion(nombre,siglas) ';
			$query .= 'values("'.$bean->getNombre().'","'.$bean->getSiglas().'")';
			$this->db -> myQuery($query);
		}
		
		public function getInstituciones($busqueda){
			$query = 'select * from institucion order by siglas';
			
			if($busqueda != ''){
				$query = 'select * from institucion where nombre LIKE "%'.$busqueda.'%" order by siglas';
			}
			$this->db -> myQuery($query);
			
			$datos = array();
			while ($row = $this->db ->getArrayFila()) {
				$datos[] = $row;
   			}
			
			return $datos;
		}
		
		public function buscarPorNombre($nombre, $siglas){
			$query = 'select idInstitucion from institucion where nombre LIKE "'.$nombre.'" and siglas LIKE "'.$siglas.'"';
			$this->db -> myQuery($query);
			$datos = $this->db ->getArrayFila();
			return  $datos['idInstitucion'];// Regresa el id de una institucion
		}
	}
?>