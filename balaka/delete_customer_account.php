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

if ((isset($_GET['customer_id'])) && ($_GET['customer_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM customer WHERE customer_id=%s",
                       GetSQLValueString($_GET['customer_id'], "int"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($deleteSQL, $db_connection) or die(mysql_error());

  $deleteGoTo = "customers_detail.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_delete_user_account = "-1";
if (isset($_GET['customer_id'])) {
  $colname_delete_user_account = $_GET['customer_id'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_delete_user_account = sprintf("SELECT * FROM customer WHERE customer_id = %s", GetSQLValueString($colname_delete_user_account, "int"));
$delete_user_account = mysql_query($query_delete_user_account, $db_connection) or die(mysql_error());
$row_delete_user_account = mysql_fetch_assoc($delete_user_account);
$totalRows_delete_user_account = mysql_num_rows($delete_user_account);

mysql_free_result($delete_user_account);
?>
