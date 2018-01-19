<?php require_once('../Connections/rem.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE pregunta SET idCuestionario=%s, descripcionP=%s WHERE idPregunta=%s",
                       GetSQLValueString($_POST['idCuestionario'], "int"),
                       GetSQLValueString($_POST['descripcionP'], "text"),
                       GetSQLValueString($_POST['idPregunta'], "int"));

  mysql_select_db($database_rem, $rem);
  $Result1 = mysql_query($updateSQL, $rem) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE pregunta SET idCuestionario=%s, descripcionP=%s WHERE idPregunta=%s",
                       GetSQLValueString($_POST['idCuestionario'], "int"),
                       GetSQLValueString($_POST['descripcionP'], "text"),
                       GetSQLValueString($_POST['idPregunta'], "int"));

  mysql_select_db($database_rem, $rem);
  $Result1 = mysql_query($updateSQL, $rem) or die(mysql_error());
}

mysql_select_db($database_rem, $rem);
$query_preguntas = "SELECT * FROM pregunta ORDER BY idPregunta ASC";
$preguntas = mysql_query($query_preguntas, $rem) or die(mysql_error());
$row_preguntas = mysql_fetch_assoc($preguntas);
$totalRows_preguntas = mysql_num_rows($preguntas);

$colname_buscarPregunta = "-1";
if (isset($_POST['txtidPregunta'])) {
  $colname_buscarPregunta = $_POST['txtidPregunta'];
}
mysql_select_db($database_rem, $rem);
$query_buscarPregunta = sprintf("SELECT * FROM pregunta WHERE idPregunta = %s", GetSQLValueString($colname_buscarPregunta, "int"));
$buscarPregunta = mysql_query($query_buscarPregunta, $rem) or die(mysql_error());
$row_buscarPregunta = mysql_fetch_assoc($buscarPregunta);
$totalRows_buscarPregunta = mysql_num_rows($buscarPregunta);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<form name="form1" method="post" action="">
idPregunta
  <input type="text" name="txtidPregunta" id="txtidPregunta">
  <input type="submit" name="Buscar" id="Buscar" value="Enviar">
</form>
<p>&nbsp;</p>
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">IdPregunta:</td>
      <td><?php echo $row_buscarPregunta['idPregunta']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">IdCuestionario:</td>
      <td><input type="text" name="idCuestionario" value="<?php echo htmlentities($row_buscarPregunta['idCuestionario'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">DescripcionP:</td>
      <td><textarea name="descripcionP" size="32"><?php echo $row_buscarPregunta['descripcionP']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2">
  <input type="hidden" name="idPregunta" value="<?php echo $row_buscarPregunta['idPregunta']; ?>">
</form>
<p>&nbsp;</p>
<table border="1">
  <tr>
    <td>idPregunta</td>
    <td>idCuestionario</td>
    <td>descripcionP</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_preguntas['idPregunta']; ?></td>
      <td><?php echo $row_preguntas['idCuestionario']; ?></td>
      <td><?php echo $row_preguntas['descripcionP']; ?></td>
    </tr>
    <?php } while ($row_preguntas = mysql_fetch_assoc($preguntas)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($preguntas);

mysql_free_result($buscarPregunta);
?>
