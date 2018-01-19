<?php
	class Institucion
	{
		//Atributos
		private $idInstitucion;
		private $nombre;
		private $siglas;
		
		//Constructor
		public function __construct($idInstitucion, $nombre, $siglas)
		{
			$this -> idInstitucion  = $idInstitucion;
			$this ->  nombre= $nombre;
			$this -> siglas = $siglas;
		}		
				
		//Metodos
		//getters
		public function getIdInstitucion(){
			return $this -> idInstitucion;
		}
		
		public function getNombre(){
			return $this -> nombre;
		}
		
		public function getSiglas(){
			return $this -> siglas;
		}
		
		//Setters
		public function setIdInstitucion($idInstitucion){
			$this -> idInstitucion = $idInstitucion;
		}
		
		public function setNombre($nombre){
			$this -> nombre = $nombre;
		}
		
		public function setSiglas($siglas){
			$this -> siglas = $siglas;
		}
	}
	
	
?>