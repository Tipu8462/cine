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

$maxRows_cms_display_movies = 4;
$pageNum_cms_display_movies = 0;
if (isset($_GET['pageNum_cms_display_movies'])) {
  $pageNum_cms_display_movies = $_GET['pageNum_cms_display_movies'];
}
$startRow_cms_display_movies = $pageNum_cms_display_movies * $maxRows_cms_display_movies;

mysql_select_db($database_db_connection, $db_connection);
$query_cms_display_movies = "SELECT * FROM movies";
$query_limit_cms_display_movies = sprintf("%s LIMIT %d, %d", $query_cms_display_movies, $startRow_cms_display_movies, $maxRows_cms_display_movies);
$cms_display_movies = mysql_query($query_limit_cms_display_movies, $db_connection) or die(mysql_error());
$row_cms_display_movies = mysql_fetch_assoc($cms_display_movies);

if (isset($_GET['totalRows_cms_display_movies2'])) {
  $totalRows_cms_display_movies = $_GET['totalRows_cms_display_movies2'];
} else {
  $all_cms_display_movies = mysql_query($query_cms_display_movies);
  $totalRows_cms_display_movies = mysql_num_rows($all_cms_display_movies);
}
$totalPages_cms_display_movies = ceil($totalRows_cms_display_movies/$maxRows_cms_display_movies)-1;

$colname_admin_users = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_admin_users = $_SESSION['MM_Username'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_admin_users = sprintf("SELECT * FROM `admin` WHERE admin_email = %s", GetSQLValueString($colname_admin_users, "text"));
$admin_users = mysql_query($query_admin_users, $db_connection) or die(mysql_error());
$row_admin_users = mysql_fetch_assoc($admin_users);
$totalRows_admin_users = mysql_num_rows($admin_users);

$queryString_cms_display_movies = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_cms_display_movies") == false && 
        stristr($param, "totalRows_cms_display_movies") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_cms_display_movies = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_cms_display_movies = sprintf("&totalRows_cms_display_movies=%d%s", $totalRows_cms_display_movies, $queryString_cms_display_movies);
 error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>All Now Showing Movies</title>
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

<div id="section">
	<div id="message_bar">
    Welcome to You @ Balaka Cinema Hall >>
    </div>
    
    <div id="data_bar">
    	
        <center><h2>Now Showing Movies</h2></center>
        <center>
<strong>Start</strong>:<?php echo ($startRow_cms_display_movies + 1) ?> <strong>of</strong>:<?php echo min($startRow_cms_display_movies + $maxRows_cms_display_movies, $totalRows_cms_display_movies) ?> <strong>Total</strong>:<?php echo $totalRows_cms_display_movies ?> &nbsp; 
<br><a href="<?php printf("%s?pageNum_cms_display_movies=%d%s", $currentPage, 0, $queryString_cms_display_movies); ?>"><input name="First" type="button" value="First" id="btn" /></a> || <a href="<?php printf("%s?pageNum_cms_display_movies=%d%s", $currentPage, max(0, $pageNum_cms_display_movies - 1), $queryString_cms_display_movies); ?>"><input name="Pre" type="button" value="Pre" id="btn" /></a> || <a href="<?php printf("%s?pageNum_cms_display_movies=%d%s", $currentPage, min($totalPages_cms_display_movies, $pageNum_cms_display_movies + 1), $queryString_cms_display_movies); ?>"><input name="Next" type="button" value="Next" id="btn" /></a> || <a href="<?php printf("%s?pageNum_cms_display_movies=%d%s", $currentPage, $totalPages_cms_display_movies, $queryString_cms_display_movies); ?>"><input name="Last" type="button" value="Last" id="btn" /></a>
        </center>
        <br>
        <?php if ($totalRows_cms_display_movies > 0) { // Show if recordset not empty ?>
  <table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
    <tr>
      
      <td align="center" bgcolor="#CCCCCC">Name</td>
      <td align="center" bgcolor="#CCCCCC">Cast</td>
      <td align="center" bgcolor="#CCCCCC">Status</td>
      <td align="center" bgcolor="#CCCCCC">Image</td>
      <td align="center" bgcolor="#CCCCCC">Detail</td>
      <td align="center" bgcolor="#CCCCCC">Update</td>
      <td align="center" bgcolor="#CCCCCC">Delete</td>
      
      
    </tr>
    <?php do { ?>
      <tr>
        <td align="center"><?php echo $row_cms_display_movies['movie_name']; ?></td>
        <td align="center"><?php echo $row_cms_display_movies['movie_cast']; ?></td>
        <td align="center"><?php echo $row_cms_display_movies['status']; ?></td>
        <td align="center">
          <img src='uploaded_images/<?php echo $row_cms_display_movies['movie_img1']; ?>'
              width="150" height="150">
        </td>
        <td align="center"><a href="details4admin.php?movie_id=<?php echo $row_cms_display_movies['movie_id']; ?>"><input name="Detail" type="button" value="Detail" id="btn" /></a></td>
        <td align="center"><a href="update_movie.php?movie_id=<?php echo $row_cms_display_movies['movie_id']; ?>" target="_blank"><input name="Update" type="button" value="Update" id="btn" /></a></td>
        <td align="center"><a href="delete_movie.php?movie_id=<?php echo $row_cms_display_movies['movie_id']; ?>"><input name="Delete" type="button" value="Delete" id="btn" /></a></td>
      </tr>
      <?php } while ($row_cms_display_movies = mysql_fetch_assoc($cms_display_movies)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
    </div>

<!-----Section End----->


<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>
<?php
mysql_free_result($cms_display_movies);

mysql_free_result($admin_users);
?>
