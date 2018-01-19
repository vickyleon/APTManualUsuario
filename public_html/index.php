<?php
	session_start(); //Debe de ir aqui de otra forma no funciona
	// Controlador frontal
	// index.php
	$directorio = __DIR__;

	// Carga de Beans
	require_once __DIR__ . '/app/bean/Socio.php';
	require_once __DIR__ . '/app/bean/Escuela.php';
	require_once __DIR__ . '/app/bean/Institucion.php';
	
	// Carga de Modelos
	require_once __DIR__ . '/app/Config.php';
	require_once __DIR__ . '/app/Model.php';
	require_once __DIR__ . '/app/modelo/Connection.php';
	require_once __DIR__ . '/app/modelo/ModeloSocio.php';
	require_once __DIR__ . '/app/modelo/ModeloEscuela.php';
	require_once __DIR__ . '/app/modelo/ModeloInstitucion.php';
	
	// Carga de controladores
	require_once __DIR__ . '/app/Controller.php';
	require_once __DIR__ . '/app/controlador/ControladorSocio.php';
	require_once __DIR__ . '/app/controlador/ControladorEscuela.php';
	require_once __DIR__ . '/app/controlador/ControladorInstitucion.php';
	require_once __DIR__ . '/app/controlador/ControladorEmail.php';
	require_once __DIR__ . '/app/controlador/Sesion.php';
	
	
	// enrutamiento
	$map = array(
		'inicio'      => array('controller' => 'Controller',             'action' => 'inicio'),
		'eventos'     => array('controller' => 'Controller',             'action' => 'eventos'),
		'normatividad'=> array('controller' => 'Controller',             'action' => 'normas'),
		'boletin'	  => array('controller' => 'Controller',             'action' => 'mostrarBoletines'),
        'material'	  => array('controller' => 'Controller',             'action' => 'materialDidactico'),
		'registroSoc' => array('controller' => 'ControladorSocio',       'action' => 'registroSocio'),
		'registroCom' => array('controller' => 'ControladorSocio',       'action' => 'registroCompletado'),
		'login'       => array('controller' => 'ControladorSocio',       'action' => 'iniciarSesion'),
		'logout'      => array('controller' => 'ControladorSocio',       'action' => 'cerrarSesion'),
		'mostrarEsc'  => array('controller' => 'ControladorEscuela',     'action' => 'mostrarEscuela'), //Sirve para listar todo y hacer busquedas por nombre
		'registroEsc' => array('controller' => 'ControladorEscuela',     'action' => 'registroEscuela'),
		'registroIns' => array('controller' => 'ControladorInstitucion', 'action' => 'registroInstitucion'), //Sirve para listar todo y hacer busquedas por nombre
		'mostrarIns'  => array('controller' => 'ControladorInstitucion', 'action' => 'mostrarInstitucion')
 );

 // Parseo de la ruta
 if (isset($_GET['ctl'])) {
     if (isset($map[$_GET['ctl']])) {
         $ruta = $_GET['ctl'];
     } else {
         header('Status: 404 Not Found');
         echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                 $_GET['ctl'] .
                 '</p></body></html>';
         exit;
     }
 } else {
     $ruta = 'inicio';
 }

 $controlador = $map[$ruta];
 // Ejecución del controlador asociado a la ruta

 if (method_exists($controlador['controller'],$controlador['action'])) {
     call_user_func(array(new $controlador['controller'], $controlador['action']), $directorio);
 } else {

     header('Status: 404 Not Found');
     echo '<html><body><h1>Error 404: El controlador <i>' .
             $controlador['controller'] .
             '->' .
             $controlador['action'] .
             '</i> no existe</h1></body></html>';
 }