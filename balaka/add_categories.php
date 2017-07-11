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

$MM_restrictGoTo = "add_categories.php";
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add_categories")) {
  $insertSQL = sprintf("INSERT INTO categories (category_name) VALUES (%s)",
                       GetSQLValueString($_POST['category_name'], "text"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($insertSQL, $db_connection) or die(mysql_error());

  $insertGoTo = "add_categories.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_db_connection, $db_connection);
$query_add_categories = "SELECT * FROM categories";
$add_categories = mysql_query($query_add_categories, $db_connection) or die(mysql_error());
$row_add_categories = mysql_fetch_assoc($add_categories);
$totalRows_add_categories = mysql_num_rows($add_categories);

$maxRows_display_categories = 3;
$pageNum_display_categories = 0;
if (isset($_GET['pageNum_display_categories'])) {
  $pageNum_display_categories = $_GET['pageNum_display_categories'];
}
$startRow_display_categories = $pageNum_display_categories * $maxRows_display_categories;

mysql_select_db($database_db_connection, $db_connection);
$query_display_categories = "SELECT * FROM categories";
$query_limit_display_categories = sprintf("%s LIMIT %d, %d", $query_display_categories, $startRow_display_categories, $maxRows_display_categories);
$display_categories = mysql_query($query_limit_display_categories, $db_connection) or die(mysql_error());
$row_display_categories = mysql_fetch_assoc($display_categories);

if (isset($_GET['totalRows_display_categories'])) {
  $totalRows_display_categories = $_GET['totalRows_display_categories'];
} else {
  $all_display_categories = mysql_query($query_display_categories);
  $totalRows_display_categories = mysql_num_rows($all_display_categories);
}
$totalPages_display_categories = ceil($totalRows_display_categories/$maxRows_display_categories)-1;

$colname_admin_users = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_admin_users = $_SESSION['MM_Username'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_admin_users = sprintf("SELECT * FROM `admin` WHERE admin_email = %s", GetSQLValueString($colname_admin_users, "text"));
$admin_users = mysql_query($query_admin_users, $db_connection) or die(mysql_error());
$row_admin_users = mysql_fetch_assoc($admin_users);
$totalRows_admin_users = mysql_num_rows($admin_users);

$queryString_display_categories = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_display_categories") == false && 
        stristr($param, "totalRows_display_categories") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_display_categories = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_display_categories = sprintf("&totalRows_display_categories=%d%s", $totalRows_display_categories, $queryString_display_categories);
 error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Category</title>
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
    	
        <center><h2>Add: Categories</h2></center>
          <form id="add_categories" name="add_categories" method="POST" action="<?php echo $editFormAction; ?>">
            <table width="70%" border="0" align="center" cellpadding="20" cellspacing="20">
              <tr>
                <td align="center"><span id="sprytextfield1">
                  <label for="category_name"></label>
                  <input type="text" name="category_name" id="category_name" />
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
              </tr>
              <tr>
                <td align="center" bgcolor="#e71838"><input type="submit" name="add_category_btn" id="add_category_btn" value="Submit" /></td>
              </tr>
              
            </table>
            <input type="hidden" name="MM_insert" value="add_categories" />
          </form>
          <center><h2>DML: Categories</h2></center>
          <center>
          <h3>
Start:<?php echo ($startRow_display_categories + 1) ?> of:<?php echo min($startRow_display_categories + $maxRows_display_categories, $totalRows_display_categories) ?> Total:<?php echo $totalRows_display_categories ?>
          </h3>
            <a href="<?php printf("%s?pageNum_display_categories=%d%s", $currentPage, 0, $queryString_display_categories); ?>"><input name="First" type="button" value="First" id="btn" /></a> || <a href="<?php printf("%s?pageNum_display_categories=%d%s", $currentPage, max(0, $pageNum_display_categories - 1), $queryString_display_categories); ?>"><input name="Pre" type="button" value="Pre" id="btn" /></a> || <a href="<?php printf("%s?pageNum_display_categories=%d%s", $currentPage, min($totalPages_display_categories, $pageNum_display_categories + 1), $queryString_display_categories); ?>"><input name="Next" type="button" value="Next" id="btn" /></a> || <a href="<?php printf("%s?pageNum_display_categories=%d%s", $currentPage, $totalPages_display_categories, $queryString_display_categories); ?>"><input name="Last" type="button" value="Last" id="btn" /></a>
          </center>
      
          <?php if ($totalRows_display_categories > 0) { // Show if recordset not empty ?>
  <table border="0" align="center" cellpadding="20" cellspacing="20">
    <tr>
      <td align="center" bgcolor="#CCCCCC">Category ID</td>
      <td align="center" bgcolor="#CCCCCC">Category Name</td>
      <td align="center" bgcolor="#CCCCCC">Delete</td>
      <td align="center" bgcolor="#CCCCCC">Update</td>
    </tr>
    <?php do { ?>
      <tr>
        <td align="center" bgcolor="#e71838"><?php echo $row_display_categories['category_id']; ?></td>
        <td align="center" bgcolor="#e71838"><?php echo $row_display_categories['category_name']; ?></td>
        <td align="center" bgcolor="#e71838"><a href="delete_category.php?category_id=<?php echo $row_display_categories['category_id']; ?>"><input name="Delete" type="button" value="Delete" id="btn" /></a></td>
        <td align="center" bgcolor="#e71838"><a href="update_category.php?category_id=<?php echo $row_display_categories['category_id']; ?>"><input name="Update" type="button" value="Update" id="btn" /></a></td>
      </tr>
      <?php } while ($row_display_categories = mysql_fetch_assoc($display_categories)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
       
</div>

<!-----Section End----->


<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {hint:"Type Category Name"});
</script>
</body>
</html>
<?php
mysql_free_result($display_categories);

mysql_free_result($admin_users);

mysql_free_result($add_categories);

?>
