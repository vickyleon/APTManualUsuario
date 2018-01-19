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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE cuestionario SET nombre=%s, instrucciones=%s WHERE idCuestionario=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['instrucciones'], "text"),
                       GetSQLValueString($_POST['idCuestionario'], "int"));

  mysql_select_db($database_rem, $rem);
  $Result1 = mysql_query($updateSQL, $rem) or die(mysql_error());
}

mysql_select_db($database_rem, $rem);
$query_verCuest = "SELECT * FROM cuestionario";
$verCuest = mysql_query($query_verCuest, $rem) or die(mysql_error());
$row_verCuest = mysql_fetch_assoc($verCuest);
$totalRows_verCuest = mysql_num_rows($verCuest);

$colname_buscarCuest = "-1";
if (isset($_POST['idCuestionario'])) {
  $colname_buscarCuest = $_POST['idCuestionario'];
}
mysql_select_db($database_rem, $rem);
$query_buscarCuest = sprintf("SELECT * FROM cuestionario WHERE idCuestionario = %s", GetSQLValueString($colname_buscarCuest, "int"));
$buscarCuest = mysql_query($query_buscarCuest, $rem) or die(mysql_error());
$row_buscarCuest = mysql_fetch_assoc($buscarCuest);
$totalRows_buscarCuest = mysql_num_rows($buscarCuest);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
id Cuestionario
  <input type="text" name="idCuestionario" id="idCuestionario" />
  <input type="submit" name="buscar" id="buscar" value="Enviar" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">IdCuestionario:</td>
      <td><?php echo $row_buscarCuest['idCuestionario']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="<?php echo $row_buscarCuest['nombre']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Instrucciones:</td>
      <td><textarea name="instrucciones" rows="15" cols="100"><?php echo $row_buscarCuest['instrucciones']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="idCuestionario" value="<?php echo $row_buscarCuest['idCuestionario']; ?>" />
</form>
<p>&nbsp;</p>
<table border="1">
  <tr>
    <td>idCuestionario</td>
    <td>nombre</td>
    <td>instrucciones</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_verCuest['idCuestionario']; ?></td>
      <td><?php echo $row_verCuest['nombre']; ?></td>
      <td><?php echo $row_verCuest['instrucciones']; ?></td>
    </tr>
    <?php } while ($row_verCuest = mysql_fetch_assoc($verCuest)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($verCuest);

mysql_free_result($buscarCuest);
?>
