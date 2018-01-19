<?php
class Sesion {
	function __construct() {
		//session_start();
	}

	public function setSesion($nombre, $valor) {
		$_SESSION [$nombre] = serialize($valor);
	}

	public function getSesion($nombre) {
		if (isset ( $_SESSION [$nombre] )) {
			return unserialize( $_SESSION [$nombre]);
		} 
		else {
			return false;
		}
	}

	public function eliminaSesion($nombre) {
		unset ( $_SESSION [$nombre] );
	}

	public function terminaSesion() {
		$_SESSION = array();
		session_destroy ();
	}
}
?>