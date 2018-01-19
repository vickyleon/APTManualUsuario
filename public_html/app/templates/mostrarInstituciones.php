<?php ob_start() ?>

<h2>Instituciones</h2>
<table border="1">
	<tr>
    	<th>Nombre</th>
        <th>Siglas</th>
        <th></th>
	</tr>
    <?php foreach ($parametros['instituciones'] as $ins) :?>
        <tr>
            <td><?php echo $ins['nombre'] ?></td>
            <td><?php echo $ins['siglas']?></td>
            <td><a href="index.php?ctl=mostrarEsc&mem=<?php echo $_GET['mem']?>&idIns=<?php echo $ins['idInstitucion']?>">
                Seleccionar</a></td>
        </tr>
    <?php endforeach; ?>

</table>
<br>
<p> *Si no encuentras la institución a la que perteneces puedes registrarla presionando clic <a href="index.php?ctl=registroIns&mem=<?php echo $_GET['mem']?>">aquí</a>.
<form name="formElegirInstitucion" method="post" action="index.php?ctl=mostrarEsc">
	<input name="mem" type="hidden" value="<?php echo $_GET['mem']; ?>">
	<select name="idIns">
    <?php foreach ($parametros['instituciones'] as $ins) :?>
    	<option value="<?php echo $ins['idInstitucion']?>"><?php echo $ins['siglas']?> - <?php echo $ins['nombre'] ?></option>
    <?php endforeach; ?>
	</select>
</form>

<?php $contenido .= ob_get_clean() ?>
<?php include 'layout.php' ?>