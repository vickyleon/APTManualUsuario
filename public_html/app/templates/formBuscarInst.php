<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
	<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>
<br/>

<!--
<form action="index.php?ctl=mostrarIns" method="post">
  	<h2>Busca tu Institución</h2>
    <input type="text" placeholder=" &#128270; Nombre de la institución" name="txtBuscar">        
    <input type="submit" value="Buscar">
</form>
-->
<div id="RegistroP2" class="modalDialog">
	<a href="#" title="Close" class="close">X</a> 
<form name="formElegirInstitucion" method="post" action="index.php?ctl=mostrarEsc">
	<h1><span class="icon-mode_edit"></span>Registro Paso 2 de 3</h1>
    <h2>Selecciona tu Institución</h2>
	<input name="mem" type="hidden" value="<?php echo $_GET['mem']; ?>">
	<select name="idIns">
    	<option value="-1">Selecciona una opción...</option>
    <?php foreach ($parametros['instituciones'] as $ins) :?>
    	<option value="<?php echo $ins['idInstitucion']?>"><?php echo $ins['siglas']?> - <?php echo $ins['nombre'] ?></option>
    <?php endforeach; ?>
	</select>
     <input type="submit" value="Siguiente">
     <p> *Si no encuentras la institución a la que perteneces puedes registrarla presionando clic <a href="index.php?ctl=registroIns&mem=<?php echo $_GET['mem']?>">aquí</a>.</p>
</form>
</div>
<?php $contenido = ob_get_clean() ?>

