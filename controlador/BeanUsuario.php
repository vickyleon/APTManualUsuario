<?php
	require_once("connection.php");
	class BeanUsuario
	{		
		/****************Atributos****************/
		private $idUsuario;
		private $tipo;
		private $nombre;
		private $fechaNac;
		private $sex;
		private $ocupacion;
		private $institucion;
		private $email;
		
		private $estilo;
		private $descEstilo;
		private $combinaEstilos;
		/******************************************/		
		
		public function BeanUsuario($idUsuario,$nombre,$fechaNac,$sex,$ocupacion,$institucion,$email,$tipo)
		{
			$this->idUsuario = $idUsuario;
			$this->nombre = $nombre;
			$this->fechaNac=$fechaNac;
			$this->sex=$sex;
			$this->ocupacion=$ocupacion;
			$this->institucion=$institucion;
			$this->email=$email;
			$this->tipo=$tipo;
		}
		/******************METODOS GETTERS************************/
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getId()
		{
			return $this->idUsuario;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getFechaNac()
		{
			return $this->fechaNac;
		}
		public function getSex()
		{
			return $this->sex;
		}
		public function getOcupacion()
		{
			return $this->ocupacion;
		}
		public function getInstitucion()
		{
			return $this->institucion;
		}
		public function getEmail()
		{
			return $this->email;
		}
		public function getEstilo()
		{
			return $this->estilo;	
		}
		public function getDescEstilo()
		{
			return $this->descEstilo;
		}
		/******************METODOS SETTERS***********************/
		public function setEstilo($numestilo)
		{
			$this->estilo=$numestilo;
		}
		public function setDescEstilo($descip)
		{			
			$this->descEstilo=$descip;
		}
		public function setTipo($tipo)
		{
			$this->tipo = $tipo;
		}
		public function setId($idUsuario)
		{
			$this->idUsuario = $idUsuario;
		}
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
		}
		public function setFechaNac($fechaNac)
		{
			$this->fechaNac=$fechaNac;
		}
		public function setSex($sex)
		{
			$this->sex=$sex;
		}
		public function setOcupacion($ocupacion)
		{
			$this->ocupacion=$ocupacion;
		}
		public function setInstitucion($institucion)
		{
			$this->institucion=$institucion;
		}
		public function setEmail($email)
		{
			$this->email=$email;
		}
		public function calcularEstilo($mR)
		{			
			$conexion = new connection();
			//-----------------------------------------------------------
			$query="call obtenerRespuesta(".$this->getId().",1,".$mR.")";
			//echo $query;
			$conexion->conectar();
			$conexion->myQuery($query);			
			$rs=$conexion->getArrayFila();
			$estilo1=$rs['count(*)'];
			$conexion->desconectar();
			//echo $estilo1."<br>";
			//-----------------------------------------------------------
			$query="call obtenerRespuesta(".$this->getId().",2,".$mR.")";
			//echo $query;	
			$conexion->conectar();		
			$conexion->myQuery($query);			
			$rs=$conexion->getArrayFila();
			$estilo2=$rs['count(*)'];
			$conexion->desconectar();
			//echo $estilo2."<br>";			
			//-----------------------------------------------------------
			$query="call obtenerRespuesta(".$this->getId().",3,".$mR.")";
			//echo $query;
			$conexion->conectar();			
			$conexion->myQuery($query);			
			$rs=$conexion->getArrayFila();
			$estilo3=$rs['count(*)'];
			$conexion->desconectar();
			//echo $estilo3."<br>";			
			//-----------------------------------------------------------
			$query="call obtenerRespuesta(".$this->getId().",4,".$mR.")";
			//echo $query;	
			$conexion->conectar();		
			$conexion->myQuery($query);			
			$rs=$conexion->getArrayFila();
			$estilo4=$rs['count(*)'];
			$conexion->desconectar();
			//echo $estilo4."<br>";			
			//-----------------------------------------------------------		
			$array = array
			(
		    	1 => $estilo1,
		    	2 => $estilo2,
				3 => $estilo3,
				4 => $estilo4,
			);		
			arsort($array);
			foreach($array as $key => $valor)
			{
				break;
			}
			//echo $Estilo;
			$query="select descripcionE from estilo where idEstilo='".$key."'";
			//$this->setEstilo($key);
			//echo $query;		
			$conexion->conectar();
			$conexion->myQuery($query);			
			$rs=$conexion->getArrayFila();
			$this->setDescEstilo($rs['descripcionE']);
			$conexion->desconectar();
						
			//echo "<br><br>Tu estilo es: ".$Estilo." <br>Descipcion: ".$descripcion."<br>";
			return $key;			
			
		}
		public function calcular()
		{
			$res4=$this->calcularEstilo(4);
			$res3=$this->calcularEstilo(3);
			$res2=$this->calcularEstilo(2);
			$res1=$this->calcularEstilo(1);
			if($res4==$res3 && $res3== $res2 && $res2==$res1)
				$this->setEstilo("No Contestado");
			else	
				if(($res4+$res3+$res2+$res1)==10)
					$this->setEstilo($res4."-".$res3."-".$res2."-".$res1);
				else
					$this->setEstilo("Mal contestado");
			
			
		}
	}
?>