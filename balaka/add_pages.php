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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add_page")) {
  $insertSQL = sprintf("INSERT INTO pages (page_name) VALUES (%s)",
                       GetSQLValueString($_POST['page_name'], "text"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($insertSQL, $db_connection) or die(mysql_error());

  $insertGoTo = "cms_pages.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_db_connection, $db_connection);
$query_add_pages = "SELECT * FROM pages";
$add_pages = mysql_query($query_add_pages, $db_connection) or die(mysql_error());
$row_add_pages = mysql_fetch_assoc($add_pages);
$totalRows_add_pages = mysql_num_rows($add_pages);

mysql_select_db($database_db_connection, $db_connection);
$query_cms_pages = "SELECT * FROM pages";
$cms_pages = mysql_query($query_cms_pages, $db_connection) or die(mysql_error());
$row_cms_pages = mysql_fetch_assoc($cms_pages);
$totalRows_cms_pages = mysql_num_rows($cms_pages);

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
   	<center><h3>CMS Pages || Create Upto 4 Pages Only</h3></center>
    </div>
    
    <div id="data_bar" style="height:90% !important;">
      <form id="add_page" name="add_page" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="20%" border="0" align="center" cellpadding="5" cellspacing="5">
          <tr>
            <td align="center" bgcolor="#FF0033">Page Name</td>
          </tr>
          <tr>
            <td align="center"><span id="sprytextfield1">
              <label for="page_name"></label>
              <input type="text" name="page_name" id="page_name" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#333333"><input type="submit" name="add_page_btn" id="add_page_btn" value="Add Page" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="add_page" />
      </form>
      <hr>
      <br>
      <center><h1>
      <?php if ($totalRows_cms_pages == 0) { // Show if recordset empty ?>
  <?php echo "No Page in Data Base"; ?>
  <?php } // Show if recordset empty ?>
  </h1></center>
<?php if ($totalRows_cms_pages > 0) { // Show if recordset not empty ?>
  <table border="0" cellpadding="10" cellspacing="10" width="95%" align="center">
    <tr align="center" bgcolor="#FF0033">
      <td>Page ID</td>
      <td>Page Name</td>
      <td>Delete</td>
      <td>Update</td>
    </tr>
    <?php do { ?>
      <tr align="center" bgcolor="#CCCCCC">
        <td><?php echo $row_cms_pages['page_id']; ?></td>
        <td><?php echo $row_cms_pages['page_name']; ?></td>
        <td><a href="delete_page.php?page_id=<?php echo $row_cms_pages['page_id']; ?>"><input name="Delete" type="button" value="Delete" /></a></td>
        <td><a href="update_page.php?page_id=<?php echo $row_cms_pages['page_id']; ?>"><input name="Update" type="button" value="Update" /></a></td>
      </tr>
      <?php } while ($row_cms_pages = mysql_fetch_assoc($cms_pages)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
    </div>
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
mysql_free_result($add_pages);

mysql_free_result($cms_pages);

mysql_free_result($admin_users);
?>
