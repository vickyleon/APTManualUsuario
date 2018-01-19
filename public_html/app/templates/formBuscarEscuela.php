<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
	<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>
<br/>

<!--
<form action="index.php?ctl=mostrarEsc" method="post">
	<h1><span class="icon-mode_edit"></span>Registro Paso 3 de 3</h1>
    <h2>Selecciona tu Escuela</h2>
    <input type="text" placeholder=" &#128270; Nombre de la escuela" name="txtBuscar">        
    <input type="submit" value="Buscar">
</form>
-->
<div id="RegistroP" class="modalDialog">
	<a href="#" title="Close" class="close">X</a> 
<form name="formElegirInstitucion" method="post" action="index.php?ctl=mostrarEsc">
	<h1><span class="icon-mode_edit"></span>Registro Paso 3 de 3</h1>
    <h2>Selecciona tu Escuela</h2>
    <input name="mem" type="hidden" value="<?php echo $_POST['mem']; ?>">
	<select name="idEsc">
    	<option value="-1">Selecciona una opción...</option>
    <?php foreach ($parametros['escuelas'] as $school) :?>
    	<option value="<?php echo $school['idEscuela']?>"><?php echo $school['nombre'] ?> - <?php echo $school['direccion']?></option>
    <?php endforeach; ?>
	</select>
     <input type="submit" value="Siguiente">
     <p> *Si no encuentras la escuela a la que perteneces puedes registrarla presionando clic <a href="index.php?ctl=registroEsc&idIns=<?php echo $_POST['idIns']?>&mem=<?php echo $_POST['mem']?>">aquí</a>.</p>
</form>
</div>

<?php $contenido = ob_get_clean() ?>

