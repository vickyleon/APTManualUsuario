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
  $updateSQL = sprintf("UPDATE respuesta SET idEstilo=%s, idPregunta=%s, descripcionR=%s WHERE idRespuesta=%s",
                       GetSQLValueString($_POST['idEstilo'], "int"),
                       GetSQLValueString($_POST['idPregunta'], "int"),
                       GetSQLValueString($_POST['descripcionR'], "text"),
                       GetSQLValueString($_POST['idRespuesta'], "int"));

  mysql_select_db($database_rem, $rem);
  $Result1 = mysql_query($updateSQL, $rem) or die(mysql_error());
}

mysql_select_db($database_rem, $rem);
$query_verResp = "SELECT * FROM respuesta";
$verResp = mysql_query($query_verResp, $rem) or die(mysql_error());
$row_verResp = mysql_fetch_assoc($verResp);
$totalRows_verResp = mysql_num_rows($verResp);

$colname_buscarResp = "-1";
if (isset($_POST['idRespuesta'])) {
  $colname_buscarResp = $_POST['idRespuesta'];
}
mysql_select_db($database_rem, $rem);
$query_buscarResp = sprintf("SELECT * FROM respuesta WHERE idRespuesta = %s", GetSQLValueString($colname_buscarResp, "int"));
$buscarResp = mysql_query($query_buscarResp, $rem) or die(mysql_error());
$row_buscarResp = mysql_fetch_assoc($buscarResp);
$totalRows_buscarResp = mysql_num_rows($buscarResp);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<form name="form1" method="post" action="">
id Respuesta
  <input type="text" name="idRespuesta" id="idRespuesta">
  <input type="submit" name="buscar" id="buscar" value="Enviar">
</form>
<p>&nbsp;</p>
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">IdRespuesta:</td>
      <td><?php echo $row_buscarResp['idRespuesta']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">IdEstilo:</td>
      <td><input type="text" name="idEstilo" value="<?php echo htmlentities($row_buscarResp['idEstilo'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">IdPregunta:</td>
      <td><input type="text" name="idPregunta" value="<?php echo htmlentities($row_buscarResp['idPregunta'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">DescripcionR:</td>
      <td><textarea name="descripcionR"><?php echo $row_buscarResp['descripcionR']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2">
  <input type="hidden" name="idRespuesta" value="<?php echo $row_buscarResp['idRespuesta']; ?>">
</form>
<p>&nbsp;</p>
<table border="1">
  <tr>
    <td>idRespuesta</td>
    <td>idEstilo</td>
    <td>idPregunta</td>
    <td>descripcionR</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_verResp['idRespuesta']; ?></td>
      <td><?php echo $row_verResp['idEstilo']; ?></td>
      <td><?php echo $row_verResp['idPregunta']; ?></td>
      <td><?php echo $row_verResp['descripcionR']; ?></td>
    </tr>
    <?php } while ($row_verResp = mysql_fetch_assoc($verResp)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($verResp);

mysql_free_result($buscarResp);
?>
