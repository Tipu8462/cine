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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add_quality")) {
  $insertSQL = sprintf("INSERT INTO quality (quality_name) VALUES (%s)",
                       GetSQLValueString($_POST['quality_name'], "text"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($insertSQL, $db_connection) or die(mysql_error());

  $insertGoTo = "cms_quality.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_db_connection, $db_connection);
$query_add_quality = "SELECT * FROM quality";
$add_quality = mysql_query($query_add_quality, $db_connection) or die(mysql_error());
$row_add_quality = mysql_fetch_assoc($add_quality);
$totalRows_add_quality = mysql_num_rows($add_quality);

$maxRows_display_quality = 3;
$pageNum_display_quality = 0;
if (isset($_GET['pageNum_display_quality'])) {
  $pageNum_display_quality = $_GET['pageNum_display_quality'];
}
$startRow_display_quality = $pageNum_display_quality * $maxRows_display_quality;

mysql_select_db($database_db_connection, $db_connection);
$query_display_quality = "SELECT * FROM quality";
$query_limit_display_quality = sprintf("%s LIMIT %d, %d", $query_display_quality, $startRow_display_quality, $maxRows_display_quality);
$display_quality = mysql_query($query_limit_display_quality, $db_connection) or die(mysql_error());
$row_display_quality = mysql_fetch_assoc($display_quality);

if (isset($_GET['totalRows_display_quality'])) {
  $totalRows_display_quality = $_GET['totalRows_display_quality'];
} else {
  $all_display_quality = mysql_query($query_display_quality);
  $totalRows_display_quality = mysql_num_rows($all_display_quality);
}
$totalPages_display_quality = ceil($totalRows_display_quality/$maxRows_display_quality)-1;

$colname_admin_users = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_admin_users = $_SESSION['MM_Username'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_admin_users = sprintf("SELECT * FROM `admin` WHERE admin_email = %s", GetSQLValueString($colname_admin_users, "text"));
$admin_users = mysql_query($query_admin_users, $db_connection) or die(mysql_error());
$row_admin_users = mysql_fetch_assoc($admin_users);
$totalRows_admin_users = mysql_num_rows($admin_users);

$queryString_display_quality = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_display_quality") == false && 
        stristr($param, "totalRows_display_quality") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_display_quality = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_display_quality = sprintf("&totalRows_display_quality=%d%s", $totalRows_display_quality, $queryString_display_quality);
 error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Quality</title>
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

<div id="section">
	<div id="message_bar">
    Welcome to You @ Balaka Cinema Hall >>
    </div>
    
    <div id="data_bar">
    	
        <center><h2>Add: Quality</h2></center>
        <center>
        <h3> Start:<?php echo ($startRow_display_quality + 1) ?> of:<?php echo min($startRow_display_quality + $maxRows_display_quality, $totalRows_display_quality) ?> Total:<?php echo $totalRows_display_quality ?> </h3>
        <a href="<?php printf("%s?pageNum_display_quality=%d%s", $currentPage, 0, $queryString_display_quality); ?>"><input name="First" type="button" value="First" id="btn" /></a> || <a href="<?php printf("%s?pageNum_display_quality=%d%s", $currentPage, max(0, $pageNum_display_quality - 1), $queryString_display_quality); ?>"><input name="Pre" type="button" value="Pre" id="btn" /></a> || <a href="<?php printf("%s?pageNum_display_quality=%d%s", $currentPage, min($totalPages_display_quality, $pageNum_display_quality + 1), $queryString_display_quality); ?>"><input name="Next" type="button" value="Next" id="btn" /></a> || <a href="<?php printf("%s?pageNum_display_quality=%d%s", $currentPage, $totalPages_display_quality, $queryString_display_quality); ?>"><input name="Last" type="button" value="Last" id="btn" /></a>
        </center>
        <form id="add_quality" name="add_quality" method="POST" action="<?php echo $editFormAction; ?>">
          <table width="90%" border="0" align="center" cellpadding="20" cellspacing="20">
            <tr>
              <td align="center"><span id="sprytextfield1">
                <label for="quality_name"></label>
                <input type="text" name="quality_name" id="quality_name" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td align="center" bgcolor="#e71838"><input type="submit" name="Add quality" id="Add quality" value="Submit" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="add_quality" />
        </form>
        <center><h2>DML: Quality</h2></center>
        <?php if ($totalRows_display_quality > 0) { // Show if recordset not empty ?>
  <table border="0" align="center" cellpadding="20" cellspacing="20">
    <tr>
      <td align="center" bgcolor="#CCCCCC">Quality ID</td>
      <td align="center" bgcolor="#CCCCCC">Quality Name</td>
      <td align="center" bgcolor="#CCCCCC">Delete</td>
      <td align="center" bgcolor="#CCCCCC">Update</td>
    </tr>
    <?php do { ?>
      <tr>
        <td align="center" bgcolor="#e71838"><?php echo $row_display_quality['quality_id']; ?></td>
        <td align="center" bgcolor="#e71838"><?php echo $row_display_quality['quality_name']; ?></td>
        <td align="center" bgcolor="#e71838"><a href="delete_quality.php?quality_id=<?php echo $row_display_quality['quality_id']; ?>"><input name="Delete" type="button" value="Delete" id="btn" /></a></td>
        <td align="center" bgcolor="#e71838"><a href="update_quality.php?quality_id=<?php echo $row_display_quality['quality_id']; ?>"><input name="Update" type="button" value="Update" id="btn" /></a></td>
      </tr>
      <?php } while ($row_display_quality = mysql_fetch_assoc($display_quality)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
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
mysql_free_result($add_quality);

mysql_free_result($display_quality);

mysql_free_result($admin_users);
?>
