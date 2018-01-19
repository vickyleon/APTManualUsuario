<?php
	//require_once('../bean/Socio.php');
	class ModeloSocio{
		protected $db;
		
		public function __construct(){
			$this->db = new Connection();
			$this->db ->conectar();
		}
		
		public function validarDatosSocio($socio){
			//echo 'Desde el modelo: '.$socio->getNombreCompleto();
			return 1;
		}
		
		public function insertarSocio($socio){
			$query  = 'insert into socio(nombreCompleto,prefijo,email,estudProf,niClase,avisoBoletin,password) ';
			$query .= 'values("'.$socio->getNombreCompleto().'","'.$socio->getPrefijo().'", "'.$socio->getEmail().'","'.$socio->getEstudProf().'","';
			$query .= $socio->getNiClase().'","'.$socio->getAvisoBoletin().'","'.$socio->getPassword().'")';
			$this->db -> myQuery($query);
		}
		
		public function buscarPorEmail($busqueda){			
			$socio = NULL;
			if($busqueda == ''){
			}
			else{
				$query = 'select * from socio';
				$query .= ' where email = "'.$busqueda.'"';
				$this->db -> myQuery($query);
			
				while ($row = $this->db ->getArrayFila()) {
					$socio = new Socio($row['noMembresia'], $row['nombreCompleto'], $row['prefijo'], $row['email'], $row['estudProf'], $row['niClase'], $row['avisoBoletin'], $row['password'], $row['idTrabajo'], $row['idEscuela']);					
   				}
			}
			
			return $socio;
		}
		
		public function buscarPorNoMem($busqueda){			
			$socio = NULL;
			if($busqueda == ''){
			}
			else{
				$query = 'select * from socio';
				$query .= ' where noMembresia = '.$busqueda.'';
				$this->db -> myQuery($query);
			
				while ($row = $this->db ->getArrayFila()) {
					$socio = new Socio($row['noMembresia'], $row['nombreCompleto'], $row['prefijo'], $row['email'], $row['estudProf'], $row['niClase'], $row['avisoBoletin'], $row['password'], $row['idTrabajo'], $row['idEscuela']);					
   				}
			}
			
			return $socio;
		}
		
		public function actualizarEscuela($noMembresia, $idEscuela){
			$query = 'update socio set idEscuela='.$idEscuela." where noMembresia=".$noMembresia;
			$this->db->myQuery($query);
		}
	}
?>