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
  $updateSQL = sprintf("UPDATE estilo SET descripcionE=%s WHERE idEstilo=%s",
                       GetSQLValueString($_POST['descripcionE'], "text"),
                       GetSQLValueString($_POST['idEstilo'], "int"));

  mysql_select_db($database_rem, $rem);
  $Result1 = mysql_query($updateSQL, $rem) or die(mysql_error());
}

mysql_select_db($database_rem, $rem);
$query_verEstilos = "SELECT * FROM estilo";
$verEstilos = mysql_query($query_verEstilos, $rem) or die(mysql_error());
$row_verEstilos = mysql_fetch_assoc($verEstilos);
$totalRows_verEstilos = mysql_num_rows($verEstilos);

$colname_buscarEstilo = "-1";
if (isset($_POST['idEstilo'])) {
  $colname_buscarEstilo = $_POST['idEstilo'];
}
mysql_select_db($database_rem, $rem);
$query_buscarEstilo = sprintf("SELECT * FROM estilo WHERE idEstilo = %s", GetSQLValueString($colname_buscarEstilo, "int"));
$buscarEstilo = mysql_query($query_buscarEstilo, $rem) or die(mysql_error());
$row_buscarEstilo = mysql_fetch_assoc($buscarEstilo);
$totalRows_buscarEstilo = mysql_num_rows($buscarEstilo);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<form name="form1" method="post" action="">
idEstilo
  <input type="text" name="idEstilo" id="idEstilo">
  <input type="submit" name="buscar" id="buscar" value="Enviar">
</form>
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
<table align="center">
    <tr valign="baseline">
      <td nowrap align="right">IdEstilo:</td>
      <td><?php echo $row_buscarEstilo['idEstilo']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">DescripcionE:</td>
      <td><textarea name="descripcionE" cols="50" rows="5"><?php echo $row_buscarEstilo['descripcionE']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2">
  <input type="hidden" name="idEstilo" value="<?php echo $row_buscarEstilo['idEstilo']; ?>">
</form>
<table border="1">
  <tr>
    <td>idEstilo</td>
    <td>descripcionE</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_verEstilos['idEstilo']; ?></td>
      <td><?php echo $row_verEstilos['descripcionE']; ?></td>
    </tr>
    <?php } while ($row_verEstilos = mysql_fetch_assoc($verEstilos)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($verEstilos);

mysql_free_result($buscarEstilo);
?>
