<?php 
	
	class ComiteAAPT extends Socio
	{
			//Atributos
			private $idComite;
			private $cargo;
			private $fechaInicio;
			private $fechaFin;
			private $urlFoto;
			private $semblanza;
			
			//Constructor
			public function __construct($noMembresia, $nombreCompleto, $prefijo, $email, $estudProf, $niClase, $avisoBoletin, $password, $idTrabajo, $idEscuela ,$idComite, $cargo, $fechaInicio, $fechaFin, $urlFoto, $semblanza)
			{
				parent::__construct($noMembresia, $nombreCompleto, $prefijo, $email, $estudProf, $niClase, $avisoBoletin, $password, $idTrabajo, $idEscuela);
				$this->idComite = $idComite;
				$this->cargo = $cargo;
				$this->fechaInicio = $fechaInicio;
				$this->fechaFin = $fechaFin;
				$this->urlFoto = $urlFoto;
				$this->semblanza = $semblanza;
			}		
			
			//Metodos getters
			public function getIdComite(){
				return $this->idComite;
			}
			
			public function getCargo(){
				return $this->cargo;
			}
			
			public function getFechaInicio(){
				return $this->fechaInicio;
			}
			
			public function getFechaFin(){
				return $this->fechaFin;
			}
			
			public function getUrlFoto(){
				return $this->urlFoto;
			}
			
			public function getSemblanza(){
				return $this->semblanza;
			}
			
			
			//Metodos setters
			public function setIdComite($idComite){
				$this->idComite = $idComite;
			}
			
			public function setCargo($cargo){
				$this->cargo = $cargo;
			}
			
			public function setFechaInicio($fechaInicio){
				$this->fechaInicio = $fechaInicio;
			}
			
			public function setFechaFin($fechaFin){
				$this->fechaFin = $fechaFin;
			}
			
			public function setUrlFoto($urlFoto){
				$this->urlFoto = $urlFoto;
			}
			
			public function setSemblanza($semblanza){
				$this->semblanza = $semblanza;
			}
	}
	
?>