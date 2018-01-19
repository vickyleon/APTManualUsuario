<?php
	
	class Escuela
	{
		//Atributos
		private $idEscuela;
		private $nombre;
		private $direccion;
		private $idInstitucion;
		
		//Constructor
		public function __construct($idEscuela, $nombre, $direccion, $idInstitucion)
		{
			$this->idEscuela =$idEscuela;
			$this->nombre =$nombre;
			$this->direccion =$direccion;
			$this->idInstitucion =$idInstitucion;	
		}
		
		//Metodos getters
		
		public function getIdEscuela (){
			return $this->idEscuela ;
		}
		
		public function getNombre (){
			return $this-> nombre;
		}
		
		public function getDireccion (){
			return $this-> direccion;
		}
			
		public function getIdInstitucion (){
			return $this-> idInstitucion;
		}
		
		//Metodos  setters
		public function setIdEscuela ($idEscuela){
			$this-> idEscuela = $idEscuela;
		}
		
		public function setNombre($nombre){
			$this-> nombre = $nombre;
		}
		
		public function setDireccion ($direccion){
			$this-> direccion = $direccion;
		}
		
		public function setIdInstitucion ($idInstitucion){
			$this->idInstitucion  = $idInstitucion;
		}
		
	}
?>