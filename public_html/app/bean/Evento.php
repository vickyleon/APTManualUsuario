<?php
	
	class Evento
	{
		//Atributos
		private $idEvento;
		private $nombreEvento;
		private $fechaInicio;
		private $fechaFin;
		private $sede;
		private $direccion;
		private $cartel;
		private $bases;
		private $hoteles;
		private $contacto;
		
		public function __construct($idEvento, $nombreEvento, $fechaInicio, $fechaFin, $sede, $direccion, $cartel, $bases, $hoteles, $contacto)
		{
				$this->idEvento  =$idEvento;
				$this-> nombreEvento =$nombreEvento;
				$this->fechaInicio  =$fechaInicio;
				$this-> fechaFin =$fechaFin;
				$this-> sede =$sede;
				$this-> direccion =$direccion;
				$this->  cartel=$cartel;
				$this-> bases =$bases;
				$this-> hoteles =$hoteles;
				$this-> contacto =$contacto;
				
		}
		
		//Metodos getters
		public function getIdEvento(){
			return $this->idEvento;
		}
		
		public function getNombreEvento (){
			return $this-> nombreEvento;
		}
		
		public function getFechaInicio (){
			return $this-> fechaInicio;
		}
		
		public function getFechaFin (){
			return $this-> fechaFin;
		}
		
		public function getSede (){
			return $this->sede;
		}
		
		public function getDireccion (){
			return $this->direccion ;
		}
		
		public function getCartel (){
			return $this-> cartel;
		}
		
		public function getBases (){
			return $this-> bases;
		}

		public function getHoteles (){
			return $this->hoteles ;
		}

		public function getContacto (){
			return $this-> contacto;
		}

		//Metodos setters
		public function setIdEvento($idEvento){
			$this -> idEvento = $idEvento;
		}
		
		public function setNombreEvento($nombreEvento){
			$this -> nombreEvento  = $nombreEvento;
		}
		
		public function setFechaInicio($fechaInicio){
			$this -> fechaInicio = $fechaInicio;
		}
		
		public function setFechaFin($fechaFin){
			$this -> fechaFin  = $fechaFin;
		}
		
		public function setSede($sede){
			$this -> sede = $sede;
		}
		
		public function setDireccion($direccion){
			$this ->  direccion = $direccion;
		}
		
		public function setCatel($cartel){
			$this -> cartel  = $cartel;
		}
		
		public function setBases($bases){
			$this -> bases= $bases;
		}
		
		public function setHoteles($hoteles){
			$this -> hoteles = $hoteles;
		}
		
		public function setContacto($contacto){
			$this -> contacto = $contacto;
		}
	
	}
	
?>