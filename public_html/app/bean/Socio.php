<?php
	class Socio
	{
		//Atributos
		private $noMembresia;
		private $nombreCompleto;
		private $prefijo;         // Valores: Dr. | M. en C. | Ing. | Lic. | C. 
		private $email;
		private $estudProf;       // Valores: 0 := Profesor | 1 := Estudiante
		private $niClase;         // Valores: posgrado | ns := Nivel Superior | nms | basico
		private $avisoBoletin;    // Valores: 1 := Si | 0 := No
		protected $password;
		private $idEscuela;
		private $idTrabajo;
		
		//Constructor
		public function __construct($noMembresia, $nombreCompleto, $prefijo, $email, $estudProf, $niClase, $avisoBoletin, $password, $idTrabajo, $idEscuela)
		{
			$this -> noMembresia= $noMembresia;
			$this -> nombreCompleto = $nombreCompleto ;
			$this -> prefijo= $prefijo;
			$this -> email= $email;
			$this -> estudProf = $estudProf ;
			$this -> niClase= $niClase ;
			$this -> avisoBoletin= $avisoBoletin ;
			$this -> password= $password ;
			$this -> idEscuela = $idEscuela;
			$this -> idTrabajo = $idTrabajo;
			
		}
		
		//Metodos getters
		public function getNoMembresia(){
			return $this -> noMembresia;
		}
		
		public function getNombreCompleto(){
			return $this -> nombreCompleto ;
		}
		
		public function getPrefijo(){
			return $this -> prefijo;
		}
		
		public function getEmail(){
			return $this -> email;
		}
		
		public function getEstudProf(){
			return $this -> estudProf;
		}
		
		public function getNiClase(){
			return $this -> niClase;
		}
		
		public function getAvisoBoletin(){
			return $this -> avisoBoletin;
		}
		
		public function getPassword(){
			return $this -> password;
		}
		
		public function getIdEscuela(){
			return $this ->idEscuela ;
		}
		
		public function getIdTrabajo(){
			return $this -> idTrabajo;
		}
	
		//Metodos setters
		public function setNoMembresia($noMembresia){
			$this -> noMembresia = $noMembresia;
		}
		
		public function setNombreCompleto($nombreCompleto){
			$this -> nombreCompleto = $nombreCompleto;
		}
		
		public function setPrefijo($prefijo){
			$this -> prefijo = $prefijo;
		}
		
		public function setEmail($email){
			$this -> email = $email;
		}
		
		public function setEstudProf($estudProf){
			$this -> estudProf = $estudProf;
		}
		
		public function setNiClase($niClase){
			$this -> niClase   = $niClase;
		}
		
		public function setAvisoBoletin($avisoBoletin){
			$this -> avisoBoletin = $avisoBoletin;
		}
		
		public function setPassword($password){
			$this -> password = $password;
		}
		
		public function setIdEscuela($idEscuela){
			$this ->idEscuela = $idEscuela;
		}
		
		public function setIdTrabajo($idTrabajo){
			$this -> idTrabajo = $idTrabajo;
		}
	}	
?>