<?php session_start();?>
<?php require_once('Connections/db_connection.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "admin_login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

$colname_welcome_admin = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_welcome_admin = $_SESSION['MM_Username'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_welcome_admin = sprintf("SELECT * FROM `admin` WHERE admin_email = %s", GetSQLValueString($colname_welcome_admin, "text"));
$welcome_admin = mysql_query($query_welcome_admin, $db_connection) or die(mysql_error());
$row_welcome_admin = mysql_fetch_assoc($welcome_admin);
$totalRows_welcome_admin = mysql_num_rows($welcome_admin);
 error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS Hover Effects/css/hover.css">
</head>
<body>

<!----- Start Top Bar ----->
<?php include("topbar.php");?>
<!----- End Top Bar ----->


<!----- Logo Bar Start ----->
<?php include("logobar.php");?>
<!----- Logo Bar End ----->


<!-----Section Start----->

<div id="section" style="height:650px !important;">
	
	<div id="message_bar" style="height:7% !important;">
   	<center><h3>Welcome <?php echo "Admin!!! Now Show your Power"; ?> || <a href="<?php echo $logoutAction ?>"><input name="Logout" type="button" value="Logout" /><a href="index.php"><input name="Home" type="button" value="Home" />
   	</a></h3></center>
        </div>
    
    	<div id="data_bar" style="height:98% !important;">
    		<div id="admin_operation">
        	<center><h2>Operations</h2></center>
			<ul>
        	<li><a href="add_categories.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Add Now Show Categories</a></li>
        	<li><a href="cms_quality.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Add Now Show Quality</a></li>
        	<li><a href="insert_now_movies.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Add Now Showing Movies</a></li>
        	<li><a href="cms_movies.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Update Now Showing Movies</a></li>
        	<li><a href="add_categories2.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Add Upcoming Categories</a></li>
        	<li><a href="cms_quality2.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Add Upcoming Quality</a></li>
        	<li><a href="insert_upcoming_movies.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Add Upcoming Movies</a></li>
        	<li><a href="cms_movies2.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Update Upcoming Movies</a></li>
        	<li><a href="customers_detail.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Customers Detail</a></li>
       	 	<li><a href="display_customer_order.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Customer Ticket Booking</a></li>
        	<li><a href="display_customer_payment.php" target="_blank"><i class="fa fa-check-circle"></i>&nbsp; Customer Payment</a></li>
		    
			</ul>
        	</div>
        
        	<div id="admin_pic">
        	<img src="images/administrator.jpg" width="100%" height="100%">
        	</div>
        
    	</div>
</div>
<!-----Section End----->


<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>
<?php
mysql_free_result($welcome_admin);
?>
