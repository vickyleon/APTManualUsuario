 <?php
 	class Controller{
		public function inicio(){
			$params = array(
				'mensaje' => 'Bienvenido al curso de symfony 1.4',
				'fecha'   => date('d-m-yyy')
				);
         require __DIR__ . '/templates/inicio.php';
     	}
		
		public function eventos(){
			require __DIR__ . '/templates/eventos.php';
     	}
		
		public function normas(){
			require __DIR__ . '/templates/normatividad.php';
     	}
		
		public function mostrarBoletines(){
			require __DIR__ . '/templates/boletin.php';
     	}
        public function materialDidactico(){
            require __DIR__ . '/templates/mdidactico.php';
        }
		
		/*public function listar(){
			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
				Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
			
			$params = array(
				'alimentos' => $m->dameAlimentos()
			);
			
			require __DIR__ . '/templates/mostrarAlimentos.php';
		}
		
		public function insertarIns(){
			$params = array(
				'nombre' => '',
                'siglas' => ''
			);
			
			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
						Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// comprobar campos formulario
				if ($m->validarDatos($_POST['nombre'], $_POST['siglas'])){
					$m->insertarIns($_POST['nombre'], $_POST['siglas']);
					//header('Location: index.php?ctl=listar');
				}
				else {
					$params = array(
						'nombre' => $_POST['nombre'],
                     	'siglas' => $_POST['siglas']
					);
					$params['mensaje'] = 'No se ha podido insertar el alimento. Revisa el formulario';
				}
			}
			require __DIR__ . '/templates/formInsertarInstitucion.php';
		}
		
		public function buscar(){
			$params = array(
				'nombre' => '',
				'resultado' => array()
			);
			
			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                     Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$params['nombre'] = $_POST['nombre'];
				$params['resultado'] = $m->buscarAlimentosPorNombre($_POST['nombre']);
			}
			
			require __DIR__ . '/templates/buscarPorNombre.php';
		}
		
		public function ver(){
			if (!isset($_GET['id'])) {
				throw new Exception('Página no encontrada');
			}
			
			$id = $_GET['id'];
			
			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                     Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
					 
			$alimento = $m->dameAlimento($id);
			
			$params = $alimento;
			
			require __DIR__ . '/templates/verAlimento.php';
		}*/
	}
?>