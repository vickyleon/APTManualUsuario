<?php
	class ControladorEmail{
		//propiedades de la clase
		private $destinatario = array();
		private $asunto;
		private $mensaje;
		private $cabecera;
		private $tipoMensaje;
		/* Los tipos de mensajes serán:
		** 0: Registro de socios. Correo con datos como nombre, numero de socio, correo y contraseña al registrarse en el sitio.
		** 1: Reestablecimiento de contraseña. Correo con una nueva contraseña generada por el sistema.
		** 2: Notificacion de nuevo boletin. Correo con enlace de descarga del boletin para los socios que quieren recibirlo.
		** 3: Nuevo evento. Correo con información de un evento dado de alta en el sistema. 
		*/
		
		public function __construct($destino, $tipoMsg){
			$this->destinatario[] = $destino;
			$this->tipoMensaje = $tipoMsg;
			
			$this->cabecera = "MIME-Version: 1.0"."\r\n";
			$this->cabecera.= "Content-type: text/html; charset=utf-8"."\r\n";	
			$this->cabecera.= 'From: AAPT-MX<no-reply@aaptmx.com>';
		}
		
		public function formarMensaje($datosAdicionales){
			$this->mensaje = '<html><body><img src="http://aapt-mx.org/web/img/bannerAaptMx.png"><br>';
			switch($this->tipoMensaje){
				case 0: //Registro de socios.
					$this->asunto = "Registro en AAPT-MX";
					$this->mensaje.= "<h2>Bienvenido a AAPT-MX</h2>";
					$this->mensaje.= $datosAdicionales;
				break;
				case 1: //Reestablecimiento de contraseña.
					$this->asunto = "Reestablecimiento de contraseña en AAPT-MX";
					$this->mensaje.= "<h2>mensaje tipo 1</h2>";
				break;
				case 2: //Notificacion de nuevo boletin.
					$this->asunto = "Nuevo número del boletín de AAPT-MX disponible";
					$this->mensaje.= "<h2>mensaje tipo 2</h2>";
				break;
				case 3: //Nuevo evento.
					$this->asunto = "Nuevo evento registrado en AAPT-MX";
					$this->mensaje.= "<h2>mensaje tipo 3</h2>";
				break;
				default:
					echo "ERROR NO hay nada que mandar<br>";
			}
			$this->mensaje .= "</html></body>";
		}
		
		public function agregarDestinatario($email){
			$this->destinatario[] = $email;
		}
		
		public function enviarCorreo(){
			//echo "Se enviará a: ".implode(",", $this->destinatario)."<br>";
			return mail(implode(",", $this->destinatario), $this->asunto, $this->mensaje, $this->cabecera);
		}
		
		public function setAsunto($asunto){
			$this->asunto = $asunto;
		}
		public function setMensaje($msg){
			$this->mensaje = $msg;	
		}
		public function setDestinatarios($destinatarios){ //Recibe un array de emails
			$this->destinatario = $destinatarios;
		}
	}
	
	/*echo "Prueba";
	$obj = new Correo("aapt.mx.oficial@gmail.com", 0);
	$obj->formarMensaje("Oscar David");
	//$obj->setDestinatarios(array("oscar@mail.com","david@mail.com","homie@mail.com"));
	$obj->agregarDestinatario("charmin@mail.com");
	$obj->agregarDestinatario("vato@mail.com");
	$obj->enviarCorreo();
	
	echo "<pre>";
	print_r($obj);
	echo "</pre>";
	
	*/
?>