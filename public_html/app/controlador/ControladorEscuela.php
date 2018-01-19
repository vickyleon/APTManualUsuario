<?php
	class ControladorEscuela{
		public function registroEscuela($dir){
			$parametros = array(
				
			);
			
			$modelo = new ModeloEscuela();
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				//Creacion del bean Escuela
				$escuela = new Escuela(0, htmlspecialchars($_POST['txtEsc']),htmlspecialchars($_POST['txtDir']), $_POST['idIns']);
				
				//Validar datos
				if($modelo->validarDatos($escuela)){
					$modelo->insertar($escuela);
					$escuela->setIdEscuela($modelo->buscarPorNombre($escuela->getNombre(), $escuela->getDireccion()));
					
					$url = 'index.php?ctl=registroCom&mem='.$_POST['mem'].'&idEsc='.$escuela->getIdEscuela();
					echo '<script type="text/javascript">window.location="'.$url.'";</script>';
				}
				else{
					
				}
			}
			//require $dir.'/app/templates/fomRegistroEscuela.php';
			require $dir.'/app/templates/inicio.php';
		}
		
		public function mostrarEscuela($dir){
			$modelo = new ModeloEscuela();
			$busqueda = '';
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['txtBuscar'])) {
				//Se recupera el parametro de la busqueda
				$busqueda = $_POST['txtBuscar'];
			}
			if(isset($_POST['idIns'])){
				$busquedaIdIns = $_POST['idIns'];
				
				$parametros = array(
					'escuelas' => $modelo->buscarPorInstitucion($busquedaIdIns)
				);
			}
			
			else{
				$parametros = array(
					'escuelas' => $modelo->getEscuelas($busqueda)
				);
			}
			
			//require $dir.'/app/templates/formBuscarEscuela.php';
			//require $dir.'/app/templates/mostrarEscuelas.php';
			require $dir.'/app/templates/inicio.php';
		}
	}
?>