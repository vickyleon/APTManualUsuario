<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
	<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>
<br/>

<form action="index.php?ctl=registroEsc" method="post">
   	<h2>Registra tu escuela</h2>
    <input type="text" placeholder=" &#127979; Nombre de la escuela" name="txtEsc"> 
    <input type="text" placeholder=" &#128506; Dirección" name="txtDir">
    <input name="idIns" type="hidden" value="<?php echo $_GET['idIns']; ?>">
    <input name="mem" type="hidden" value="<?php echo $_GET['mem']; ?>">
    <input type="submit" value="Registrar">
</form>
<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>