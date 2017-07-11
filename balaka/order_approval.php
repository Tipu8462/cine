<?php session_start();?>
<?php require_once('Connections/db_connection.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "admin_login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_order_approval = 5;
$pageNum_order_approval = 0;
if (isset($_GET['pageNum_order_approval'])) {
  $pageNum_order_approval = $_GET['pageNum_order_approval'];
}
$startRow_order_approval = $pageNum_order_approval * $maxRows_order_approval;

mysql_select_db($database_db_connection, $db_connection);
$query_order_approval = "SELECT * FROM pending_orders";
$query_limit_order_approval = sprintf("%s LIMIT %d, %d", $query_order_approval, $startRow_order_approval, $maxRows_order_approval);
$order_approval = mysql_query($query_limit_order_approval, $db_connection) or die(mysql_error());
$row_order_approval = mysql_fetch_assoc($order_approval);

if (isset($_GET['totalRows_order_approval'])) {
  $totalRows_order_approval = $_GET['totalRows_order_approval'];
} else {
  $all_order_approval = mysql_query($query_order_approval);
  $totalRows_order_approval = mysql_num_rows($all_order_approval);
}
$totalPages_order_approval = ceil($totalRows_order_approval/$maxRows_order_approval)-1;

$colname_admin_users = "-1";
if (isset($_POST['MM_Username'])) {
  $colname_admin_users = $_POST['MM_Username'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_admin_users = sprintf("SELECT * FROM `admin` WHERE admin_email = %s", GetSQLValueString($colname_admin_users, "text"));
$admin_users = mysql_query($query_admin_users, $db_connection) or die(mysql_error());
$row_admin_users = mysql_fetch_assoc($admin_users);
$totalRows_admin_users = mysql_num_rows($admin_users);

$queryString_order_approval = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_order_approval") == false && 
        stristr($param, "totalRows_order_approval") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_order_approval = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_order_approval = sprintf("&totalRows_order_approval=%d%s", $totalRows_order_approval, $queryString_order_approval);
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
</head>
<body>

<!----- Start Top Bar ----->
<?php include("topbar.php");?>
<!----- End Top Bar ----->



<!----- Logo Bar Start ----->
<?php include("logobar.php");?>
<!----- Logo Bar End ----->


<!-----Section Start----->

<div id="section" style="height:500px !important;">
	<div id="message_bar" style="height:10% !important;">
   	<center><h3>Admin Panel</h3></center>
    </div>
    
    <div id="data_bar" style="height:90% !important;">
    <center><h3>Order Approval</h3></center>
    <center>
Start:<?php echo ($startRow_order_approval + 1) ?> Of:<?php echo min($startRow_order_approval + $maxRows_order_approval, $totalRows_order_approval) ?> Total:<?php echo $totalRows_order_approval ?>
    </center>
    <br>
  <center>
    <a href="<?php printf("%s?pageNum_order_approval=%d%s", $currentPage, 0, $queryString_order_approval); ?>"><input name="First" type="button" value="First" /></a> | <a href="<?php printf("%s?pageNum_order_approval=%d%s", $currentPage, max(0, $pageNum_order_approval - 1), $queryString_order_approval); ?>"><input name="Pre" type="button" value="Pre" /></a> | <a href="<?php printf("%s?pageNum_order_approval=%d%s", $currentPage, min($totalPages_order_approval, $pageNum_order_approval + 1), $queryString_order_approval); ?>"><input name="Next" type="button" value="Next" /></a> | <a href="<?php printf("%s?pageNum_order_approval=%d%s", $currentPage, $totalPages_order_approval, $queryString_order_approval); ?>"><input name="Last" type="button" value="Last" /></a>
  </center>
    <br>
    <table border="0" cellpadding="2" cellspacing="2" align="center" width="95%">
      <tr align="center" bgcolor="#FF0033">
        <td>Customer ID</td>
        <td>Invoice No</td>
        <td>Product ID</td>
        <td>QTY</td>
        <td>Order Status</td>
        <td>Update</td>
      </tr>
      <?php do { ?>
      <tr align="center">
          <td><?php echo $row_order_approval['customer_id']; ?></td>
          <td><?php echo $row_order_approval['invoice_no']; ?></td>
          <td><?php echo $row_order_approval['product_id']; ?></td>
          <td><?php echo $row_order_approval['qty']; ?></td>
          <td><?php echo $row_order_approval['order_status']; ?></td>
          <td><a href="update_approval.php?invoice_no=<?php echo $row_order_approval['invoice_no']; ?>"><input name="Update" type="button" value="Update" /></a></td>
      </tr>
        <?php } while ($row_order_approval = mysql_fetch_assoc($order_approval)); ?>
    </table>
</div>

<!-----Section End----->

<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>
<?php
mysql_free_result($order_approval);

mysql_free_result($admin_users);
?>
