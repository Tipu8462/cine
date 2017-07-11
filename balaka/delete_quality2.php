<?php require_once('Connections/db_connection.php'); ?>
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

if ((isset($_GET['quality_id'])) && ($_GET['quality_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM quality2 WHERE quality_id=%s",
                       GetSQLValueString($_GET['quality_id'], "int"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($deleteSQL, $db_connection) or die(mysql_error());

  $deleteGoTo = "cms_quality2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_delete_quality = "-1";
if (isset($_GET['quality_id'])) {
  $colname_delete_quality = $_GET['quality_id'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_delete_quality = sprintf("SELECT * FROM quality WHERE quality_id = %s", GetSQLValueString($colname_delete_quality, "int"));
$delete_quality = mysql_query($query_delete_quality, $db_connection) or die(mysql_error());
$row_delete_quality = mysql_fetch_assoc($delete_quality);
$totalRows_delete_quality = mysql_num_rows($delete_quality);

mysql_free_result($delete_quality);
?>
