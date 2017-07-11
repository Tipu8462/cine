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

$maxRows_customers_detail = 4;
$pageNum_customers_detail = 0;
if (isset($_GET['pageNum_customers_detail'])) {
  $pageNum_customers_detail = $_GET['pageNum_customers_detail'];
}
$startRow_customers_detail = $pageNum_customers_detail * $maxRows_customers_detail;

mysql_select_db($database_db_connection, $db_connection);
$query_customers_detail = "SELECT * FROM customer";
$query_limit_customers_detail = sprintf("%s LIMIT %d, %d", $query_customers_detail, $startRow_customers_detail, $maxRows_customers_detail);
$customers_detail = mysql_query($query_limit_customers_detail, $db_connection) or die(mysql_error());
$row_customers_detail = mysql_fetch_assoc($customers_detail);

if (isset($_GET['totalRows_customers_detail'])) {
  $totalRows_customers_detail = $_GET['totalRows_customers_detail'];
} else {
  $all_customers_detail = mysql_query($query_customers_detail);
  $totalRows_customers_detail = mysql_num_rows($all_customers_detail);
}
$totalPages_customers_detail = ceil($totalRows_customers_detail/$maxRows_customers_detail)-1;

$colname_admin_users = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_admin_users = $_SESSION['MM_Username'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_admin_users = sprintf("SELECT * FROM `admin` WHERE admin_email = %s", GetSQLValueString($colname_admin_users, "text"));
$admin_users = mysql_query($query_admin_users, $db_connection) or die(mysql_error());
$row_admin_users = mysql_fetch_assoc($admin_users);
$totalRows_admin_users = mysql_num_rows($admin_users);

$queryString_customers_detail = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_customers_detail") == false && 
        stristr($param, "totalRows_customers_detail") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_customers_detail = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_customers_detail = sprintf("&totalRows_customers_detail=%d%s", $totalRows_customers_detail, $queryString_customers_detail);
 error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Balaka Cinema Hall</title>
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

<div id="section" style="height:720px !important;">
	<div id="message_bar" style="height:8% !important;">
   	<center><h3>Admin Panel</h3></center>
    </div>
    
    <div id="data_bar" style="height:88% !important;">
        <center><h3>Customers Detail</h3></center>
        <center>
Start:<?php echo ($startRow_customers_detail + 1) ?> Of:<?php echo min($startRow_customers_detail + $maxRows_customers_detail, $totalRows_customers_detail) ?> Total:<?php echo $totalRows_customers_detail ?>
    </center>
    <center>
          <a href="<?php printf("%s?pageNum_customers_detail=%d%s", $currentPage, 0, $queryString_customers_detail); ?>"><input name="First" type="button" value="First" /></a> | <a href="<?php printf("%s?pageNum_customers_detail=%d%s", $currentPage, max(0, $pageNum_customers_detail - 1), $queryString_customers_detail); ?>"><input name="Pre" type="button" value="Pre" /></a> | <a href="<?php printf("%s?pageNum_customers_detail=%d%s", $currentPage, min($totalPages_customers_detail, $pageNum_customers_detail + 1), $queryString_customers_detail); ?>"><input name="Next" type="button" value="Next" /></a> | <a href="<?php printf("%s?pageNum_customers_detail=%d%s", $currentPage, $totalPages_customers_detail, $queryString_customers_detail); ?>"><input name="Last" type="button" value="Last" /></a>
        </center>
        <br>
          <table border="0" cellpadding="2" cellspacing="2" align="center" width="95%">
            <tr>
              
              <td align="center" bgcolor="#FF0033">Customer Name</td>
              <td align="center" bgcolor="#FF0033">Customer Email</td>
              <td align="center" bgcolor="#FF0033">Customer Contact No</td>
              <td align="center" bgcolor="#FF0033">Customer Image</td>
              <td align="center" bgcolor="#FF0033">Delete Account</td>
              
            </tr>
            <?php do { ?>
              <tr>
                
                <td align="center" bgcolor="#CCCCCC"><?php echo $row_customers_detail['customer_name']; ?></td>
                <td align="center" bgcolor="#CCCCCC"><?php echo $row_customers_detail['customer_email']; ?></td>
                <td align="center" bgcolor="#CCCCCC"><?php echo $row_customers_detail['customer_contact_no']; ?></td>
                <td align="center" bgcolor="#FF0033">
				<img src="customer_images/<?php echo $row_customers_detail['customer_image']; ?>" width="100" height="100">
				</td>
                <td align="center" bgcolor="#FF0033"><a href="delete_customer_account.php?customer_id=<?php echo $row_customers_detail['customer_id']; ?>"><input name="Delete" type="button" value="Delete" /></a></td>
            </tr>
              <?php } while ($row_customers_detail = mysql_fetch_assoc($customers_detail)); ?>
          </table>
       
</div>

<!-----Section End----->

<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>
<?php
mysql_free_result($customers_detail);

mysql_free_result($admin_users);
?>
