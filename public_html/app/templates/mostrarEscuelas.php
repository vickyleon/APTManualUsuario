<?php ob_start() ?>

<h2>Escuelas</h2>
<table border="1">
	<tr>
    	<th>Nombre</th>
        <th>Institución</th>
        <th>Direccion</th>
        <th></th>
	</tr>
    <?php foreach ($parametros['escuelas'] as $school) :?>
        <tr>
            <td><?php echo $school['nombre'] ?></td>
            <td><?php echo $school['idInstitucion'] ?></td>
            <td><?php echo $school['direccion']?></td>
            <td><a href="index.php?ctl=registroCom&mem=<?php echo $_GET['mem']?>&idEsc=<?php echo $school['idEscuela']?>">
                Seleccionar</a></td>
        </tr>
    <?php endforeach; ?>

</table>
<br>
<p> *Si no encuentras la escuela a la que perteneces puedes registrarla presionando clic <a href="index.php?ctl=registroEsc&idIns=<?php echo $_GET['idIns']?>&mem=<?php echo $_GET['mem']?>">aquí</a>.

<?php $contenido .= ob_get_clean(); ?>
<?php include 'layout.php' ?>