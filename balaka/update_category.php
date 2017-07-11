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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update_category")) {
  $updateSQL = sprintf("UPDATE categories SET category_name=%s WHERE category_id=%s",
                       GetSQLValueString($_POST['category_name'], "text"),
                       GetSQLValueString($_POST['category_id'], "int"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($updateSQL, $db_connection) or die(mysql_error());

  $updateGoTo = "add_categories.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_update_category = "-1";
if (isset($_GET['category_id'])) {
  $colname_update_category = $_GET['category_id'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_update_category = sprintf("SELECT * FROM categories WHERE category_id = %s", GetSQLValueString($colname_update_category, "int"));
$update_category = mysql_query($query_update_category, $db_connection) or die(mysql_error());
$row_update_category = mysql_fetch_assoc($update_category);
$totalRows_update_category = mysql_num_rows($update_category);

$colname_admin_users = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_admin_users = $_SESSION['MM_Username'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_admin_users = sprintf("SELECT * FROM `admin` WHERE admin_email = %s", GetSQLValueString($colname_admin_users, "text"));
$admin_users = mysql_query($query_admin_users, $db_connection) or die(mysql_error());
$row_admin_users = mysql_fetch_assoc($admin_users);
$totalRows_admin_users = mysql_num_rows($admin_users);
 error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Now Show Category</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS Hover Effects/css/hover.css">
<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<link href="js/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<script src="js/SpryValidationTextField.js" type="text/javascript"></script>

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

<div id="section" style="height:600px !important;">
	<div id="message_bar" style="height:10% !important;">
    Welcome to You @ Balaka Cinema Hall >>
    </div>
    
    <div id="data_bar" style="height:90% !important;">
    	
        <center><h2>Update Category</h2></center>
        <br>
        <form id="update_category" name="update_category" method="POST" action="<?php echo $editFormAction; ?>">
          <table width="90%" border="0" align="center" cellpadding="40" cellspacing="40">
            <tr>
              <td align="center" bgcolor="#CCCCCC">Category Name</td>
            </tr>
            <tr>
              <td align="center" bgcolor="#e71838"><span id="sprytextfield1">
                <label for="category_name"></label>
                <input name="category_name" type="text" id="category_name" value="<?php echo $row_update_category['category_name']; ?>" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td align="center"><input type="submit" name="Update_Category_Btn" id="Update_Category_Btn" value="Update" /></td>
            </tr>
          </table>
          <input name="category_id" type="hidden" id="category_id" value="<?php echo $row_update_category['category_id']; ?>" />
          <input type="hidden" name="MM_update" value="update_category" />
        </form>
      
</div>

<!-----Section End----->


<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
</body>
</html>
<?php
mysql_free_result($update_category);

mysql_free_result($admin_users);
?>
