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

$colname_display_sub_page = "-1";
if (isset($_GET['page_id'])) {
  $colname_display_sub_page = $_GET['page_id'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_display_sub_page = sprintf("SELECT * FROM pages WHERE page_id = %s", GetSQLValueString($colname_display_sub_page, "int"));
$display_sub_page = mysql_query($query_display_sub_page, $db_connection) or die(mysql_error());
$row_display_sub_page = mysql_fetch_assoc($display_sub_page);
$totalRows_display_sub_page = mysql_num_rows($display_sub_page);
 error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OSC</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS Hover Effects/css/hover.css">
<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
<meta name="keywords" content="<?php echo $row_display_sub_page['page_keyword']; ?>" />
<meta name="description" content="<?php echo $row_display_sub_page['page_description']; ?>" />
</head>
<body>

<!----- Start Top Bar ----->
<?php include("topbar.php");?>
<!----- End Top Bar ----->



<!----- Logo Bar Start ----->
<?php include("logobar.php");?>
<!----- Logo Bar End ----->


<!-----Section Start----->

<div id="section" style="height:600px !important;">
	<div id="message_bar" style="height:10% !important;">
   	<center><h3><?php echo $row_display_sub_page['page_name']; ?></h3></center>
    </div>
    
    <div id="data_bar" style="height:90% !important;">
    <table width="95%" align="center" cellpadding="10" cellspacing="10">
    <tr>
    	<td>
        <?php echo $row_display_sub_page['page_content']; ?>
        </td>
    </tr>
    </table>	
    </div>
</div>

<!-----Section End----->

<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>
<?php
mysql_free_result($display_sub_page);
?>
