<?php
	session_start();
	session_destroy();	
	echo "Has cerrado sesión :(";
	header('Location: ../index.php');
?>