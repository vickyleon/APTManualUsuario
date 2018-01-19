<?php ob_start() ?>
<?php 
	$sesion = new Sesion();
	$usuario = $sesion->getSesion('login');

        if($usuario!=false){
?>
<div class="Columnas">
	<!-- Aqui va el contenido del contenedor blanco-->
	<article class="columna2">
		<h1>Boletín Volumen 2 / Número 1</h1>
		<p>Recuerda que para poder descargar el boletín deberás estar registrado en el sistema.</p>
		<p class="centrado"><a href="web/descargas/Boletin201604.pdf" target="_blank"><img src="web/img/word-document1.png" width="96" height="96" />Descargar</a></p>
		<p>&nbsp;</p>
	</article>
    <article class="columna2">
    	<h1>Boletín Volumen 2 / Número 2</h1>
        <p>Recuerda que para poder descargar el boletín deberás estar registrado en el sistema.</p>
        <p class="centrado"><a href="web/descargas/Boletin201608.pdf" target="_blank"><img src="web/img/word-document1.png" width="96" height="96" />Descargar</a></p>
        <p>&nbsp;</p>
    </article>
    <article class="columna2">
		<h1>Boletín Volumen 3 / Número 1</h1>
		<p>Recuerda que para poder descargar el boletín deberás estar registrado en el sistema.</p>
		<p class="centrado"><a href="web/descargas/Boletin20172.pdf" target="_blank"><img src="web/img/word-document1.png" width="96" height="96" />Descargar</a></p>
		<p>&nbsp;</p>
	</article>
    <article class="columna2">
		<h1>Boletín Volumen 3 / Número 2</h1>
		<p>Recuerda que para poder descargar el boletín deberás estar registrado en el sistema.</p>
		<p class="centrado"><a href="web/descargas/BoletinAAPTMx201705.pdf" target="_blank"><img src="web/img/word-document1.png" width="96" height="96" />Descargar</a></p>
		<p>&nbsp;</p>
	</article>
</div><!--Columnas-->
<?php
	}
	else{
		 echo "<script language=Javascript> location.href=\"index.php\"; </script>"; 
	}
?>
<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
