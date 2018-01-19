<?php
	class ControladorSocio{
		public function registroSocio($dir){
			$parametros = array(
				'noMembresia' => '',
				'nombreCompleto' => '',
				'prefijo' => '',
				'email' => '',
				'estudProf' => '',
				'niClase' => '',
				'avisoBoletin' => '',
				'password' => '',
				'idEscuela' => '',
				'idTrabajo' => ''
			);
			
			$modSocio = new ModeloSocio();
						
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				//Creacion del beanSocio
				$socio = new Socio(0, htmlspecialchars($_POST['txtNombre']), htmlspecialchars($_POST['cboPrefijo']), htmlspecialchars($_POST['txtEmail']), htmlspecialchars($_POST['cboEstudiante']), htmlspecialchars($_POST['cboNivel']), htmlspecialchars($_POST['cboAviso']), htmlspecialchars($_POST['txtPass']), 0,0);
				//echo '<pre>';
				//print_r($socio);
				//echo '</pre>';
				// comprobar campos formulario
				if ($modSocio->validarDatosSocio($socio)){
					$modSocio->insertarSocio($socio);
					$socio = $modSocio->buscarPorEmail($socio->getEmail());
					$url = 'index.php?ctl=mostrarIns&mem='.$socio->getNoMembresia().'#RegistroP2';
					echo '<script type="text/javascript">window.location="'.$url.'";</script>';
				}
				
				else {
					$parametros = array(
						'noMembresia' => '',
						'nombreCompleto' => htmlspecialchars($_POST['txtNombre']),
						'prefijo' => htmlspecialchars($_POST['cboPrefijo']),
						'email' => htmlspecialchars($_POST['txtEmail']),
						'estudProf' => htmlspecialchars($_POST['cboEstudiante']),
						'niClase' => htmlspecialchars($_POST['cboNivel']),
						'avisoBoletin' => htmlspecialchars($_POST['cboAviso']),
						'password' => htmlspecialchars($_POST['txtPass']),
						'idEscuela' => '',
						'idTrabajo' => ''
					);
					$parametros['mensaje'] = 'Alguno de los datos es incorrecto. Favor de revisar el formulario.';
				}
			}
			require $dir.'/app/templates/inicio.php'; // <----------------------------------------REVISAR ESTA LINEA
		}
		
		public function registroCompletado(){
			if(isset($_POST['mem'], $_POST['idEsc'])){
				$modSocio = new ModeloSocio();
				$modSocio->actualizarEscuela($_POST['mem'], $_POST['idEsc']);
				$socio = $modSocio->buscarPorNoMem($_POST['mem']);
				
				$correo = new ControladorEmail($socio->getEmail(), 0);
				$correo->formarMensaje('Hola '.$socio->getPrefijo().' '.$socio->getNombreCompleto().'<br>'.'Correo: '.$socio->getEmail().'<br>'.'Contraseña: '.$socio->getPassword());
				$correo->enviarCorreo();
				$url = 'index.php#RegistroCompletado';
				echo '<script type="text/javascript">window.location="'.$url.'";</script>';
				//header('Location: index.php');
			}
			else{
				if(isset($_GET['mem'], $_GET['idEsc'])){
					$modSocio = new ModeloSocio();
					$modSocio->actualizarEscuela($_GET['mem'], $_GET['idEsc']);
					$url = 'index.php';
					echo '<script type="text/javascript">window.location="'.$url.'";</script>';
					//header('Location: index.php');
				}	
			}
		}
		
		public function iniciarSesion(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$email = $_POST['txtEmailLogin'];
				$pwd = $_POST['txtPassLogin'];
				
				$modelo = new ModeloSocio();
				$socio = $modelo->buscarPorEmail($email);
				if($socio != NULL && strcmp($pwd, $socio->getPassword()) == 0){
					$sesion = new Sesion();
					$sesion->setSesion("login", true);
					$sesion->setSesion("socio", $socio/*->getNombreCompleto()*/);
							
				}
				else{
					echo '<br> Datos incorrectos';
				}
				$url = 'index.php';
				echo '<script type="text/javascript">window.location="'.$url.'";</script>';
			}
		}
		
		public function cerrarSesion(){
			$sesion = new Sesion();
			$sesion->eliminaSesion('login');
			$sesion->terminaSesion();
			$url = 'index.php';
			echo '<script type="text/javascript">window.location="'.$url.'";</script>';
		}
	}