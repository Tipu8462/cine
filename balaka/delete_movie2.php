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

if ((isset($_GET['movie_id'])) && ($_GET['movie_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM movies2 WHERE movie_id=%s",
                       GetSQLValueString($_GET['movie_id'], "int"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($deleteSQL, $db_connection) or die(mysql_error());

  $deleteGoTo = "cms_movies2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_delete_movie = "-1";
if (isset($_GET['movie_id'])) {
  $colname_delete_movie = $_GET['movie_id'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_delete_movie = sprintf("SELECT * FROM movies2 WHERE movie_id = %s", GetSQLValueString($colname_delete_movie, "int"));
$delete_movie = mysql_query($query_delete_movie, $db_connection) or die(mysql_error());
$row_delete_movie = mysql_fetch_assoc($delete_movie);
$totalRows_delete_movie = mysql_num_rows($delete_movie);

mysql_free_result($delete_movie);
?>
