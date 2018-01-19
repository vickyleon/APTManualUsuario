<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
	<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>
<br/>

<form action="index.php?ctl=registroIns" method="post">
   	<h2>Registra tu institución</h2>
    <input type="text" placeholder=" &#127979; Nombre de la institución" name="txtInst"> 
    <input type="text" placeholder=" &#127979; Siglas" name="txtSiglas">
    <input name="mem" type="hidden" value="<?php echo $_GET['mem']; ?>">    
    <input type="submit" value="Registrar">
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>