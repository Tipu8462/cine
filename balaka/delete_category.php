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

if ((isset($_GET['category_id'])) && ($_GET['category_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM categories WHERE category_id=%s",
                       GetSQLValueString($_GET['category_id'], "int"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($deleteSQL, $db_connection) or die(mysql_error());

  $deleteGoTo = "add_categories.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_delete_category = "-1";
if (isset($_GET['category_id'])) {
  $colname_delete_category = $_GET['category_id'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_delete_category = sprintf("SELECT * FROM categories WHERE category_id = %s", GetSQLValueString($colname_delete_category, "int"));
$delete_category = mysql_query($query_delete_category, $db_connection) or die(mysql_error());
$row_delete_category = mysql_fetch_assoc($delete_category);
$totalRows_delete_category = mysql_num_rows($delete_category);

mysql_free_result($delete_category);
?>
