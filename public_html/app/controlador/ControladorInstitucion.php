<?php
	class ControladorInstitucion{
		public function registroInstitucion($dir){
			$parametros = array(
				
			);
			
			$modelo = new ModeloInstitucion();
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				//Creacion del beanInstitucion
				$ins = new Institucion(0, htmlspecialchars($_POST['txtInst']),htmlspecialchars($_POST['txtSiglas']));
				
				//Validar datos
				if($modelo->validarDatos($ins)){
					$modelo->insertar($ins);
					$ins->setIdInstitucion($modelo->buscarPorNombre($ins->getNombre(), $ins->getSiglas()));

					$url = 'index.php?ctl=registroEsc&mem='.$_POST['mem'].'&idIns='.$ins->getIdInstitucion().'#RegistroP3Esc';
					echo '<script type="text/javascript">window.location="'.$url.'";</script>';
				}
				else{
					
				}
			}
			//require $dir.'/app/templates/fomRegistroIns.php';
			require $dir.'/app/templates/inicio.php';
		}
		
		public function mostrarInstitucion($dir){
			$modelo = new ModeloInstitucion();
			$busqueda = '';
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				//Se recupera el parametro de la busqueda
				$busqueda = $_POST['txtBuscar'];
			}
			
			$parametros = array(
				'instituciones' => $modelo->getInstituciones($busqueda)
			);
			
			//require $dir.'/app/templates/formBuscarInst.php';
			//require $dir.'/app/templates/mostrarInstituciones.php';
			require $dir.'/app/templates/inicio.php';
		}		
	}
?>