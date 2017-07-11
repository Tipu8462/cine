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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update_movie")) {
  $updateSQL = sprintf("UPDATE movies2 SET category_id=%s, quality_id=%s, movie_name=%s, movie_cast=%s, movie_director=%s, movie_desc=%s, movie_keyword=%s, status=%s WHERE movie_id=%s",
                       GetSQLValueString($_POST['category_id'], "int"),
                       GetSQLValueString($_POST['quality_id'], "int"),
                       GetSQLValueString($_POST['movie_name'], "text"),
                       GetSQLValueString($_POST['movie_cast'], "text"),
					   GetSQLValueString($_POST['movie_director'], "text"),
                       GetSQLValueString($_POST['movie_desc'], "text"),
                       GetSQLValueString($_POST['movie_keyword'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['movie_id'], "int"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($updateSQL, $db_connection) or die(mysql_error());

  $updateGoTo = "cms_movies2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_db_connection, $db_connection);
$query_pro_cats = "SELECT * FROM categories2";
$pro_cats = mysql_query($query_pro_cats, $db_connection) or die(mysql_error());
$row_pro_cats = mysql_fetch_assoc($pro_cats);
$totalRows_pro_cats = mysql_num_rows($pro_cats);

mysql_select_db($database_db_connection, $db_connection);
$query_pro_brands = "SELECT * FROM quality2";
$pro_brands = mysql_query($query_pro_brands, $db_connection) or die(mysql_error());
$row_pro_brands = mysql_fetch_assoc($pro_brands);
$totalRows_pro_brands = mysql_num_rows($pro_brands);

$colname_update_movie = "-1";
if (isset($_GET['movie_id'])) {
  $colname_update_movie = $_GET['movie_id'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_update_movie = sprintf("SELECT * FROM movies2 WHERE movie_id = %s", GetSQLValueString($colname_update_movie, "int"));
$update_movie = mysql_query($query_update_movie, $db_connection) or die(mysql_error());
$row_update_movie = mysql_fetch_assoc($update_movie);
$totalRows_update_movie = mysql_num_rows($update_movie);

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
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Upcoming Movie</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS Hover Effects/css/hover.css">
<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<link href="js/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="js/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="js/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<script src="js/SpryValidationTextField.js" type="text/javascript"></script>
<script src="js/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="js/SpryValidationSelect.js" type="text/javascript"></script>

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

<div id="section" style="height:750px !important;">
	<div id="message_bar" style="height:6% !important;">
    Welcome to You @ Balaka Cinema Hall >>
    </div>
    
    <div id="data_bar" style="height:90% !important;">
    	
        <center><h2>Display Movies</h2></center>
        <form id="update_movie" name="update_movie" method="POST" action="<?php echo $editFormAction; ?>">
          <table width="90%" border="0" cellspacing="10" cellpadding="10">
            <tr>
              <td width="31%" bgcolor="#CCCCCC">Movie Name</td>
              <td width="69%"><span id="sprytextfield1">
                <label for="movie_name"></label>
                <input name="movie_name" type="text" id="movie_name" value="<?php echo $row_update_movie['movie_name']; ?>" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            
            
           <tr>
              <td bgcolor="#CCCCCC">Category</td>
              <td><span id="spryselect2">
                <label for="category_id"></label>
                <select name="category_id" id="category_id">
                  <?php
do {  
?>
                  <option value="<?php echo $row_pro_cats['category_id']?>"<?php if (!(strcmp($row_pro_cats['category_id'], $row_update_movie['category_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_pro_cats['category_name']?></option>
                  <?php
} while ($row_pro_cats = mysql_fetch_assoc($pro_cats));
  $rows = mysql_num_rows($pro_cats);
  if($rows > 0) {
      mysql_data_seek($pro_cats, 0);
	  $row_pro_cats = mysql_fetch_assoc($pro_cats);
  }
?>
                </select>
              <span class="selectRequiredMsg">Please select an item.</span></span></td>
            </tr>

            <tr>
              <td bgcolor="#CCCCCC">Quality</td>
              <td><span id="spryselect1">
                <label for="quality_id"></label>
              <select name="quality_id" id="quality_id">
                <?php
do {  
?>
                <option value="<?php echo $row_pro_brands['quality_id']?>"<?php if (!(strcmp($row_pro_brands['quality_id'], $row_update_movie['quality_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_pro_brands['quality_name']?></option>
                <?php
} while ($row_pro_brands = mysql_fetch_assoc($pro_brands));
  $rows = mysql_num_rows($pro_brands);
  if($rows > 0) {
      mysql_data_seek($pro_brands, 0);
	  $row_pro_brands = mysql_fetch_assoc($pro_brands);
  }
?>
              </select>
              <span class="selectRequiredMsg">Please select an item.</span></span></td>
            </tr>
                        <tr>
              <td bgcolor="#CCCCCC">Cast</td>
              <td><span id="sprytextfield2">
                <label for="movie_cast"></label>
                <input name="movie_cast" type="text" id="movie_cast" value="<?php echo $row_update_movie['movie_cast']; ?>" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            
            <tr>
              <td bgcolor="#CCCCCC">Director</td>
              <td><span id="sprytextfield2">
                <label for="movie_director"></label>
                <input name="movie_director" type="text" id="movie_director" value="<?php echo $row_update_movie['movie_director']; ?>" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td bgcolor="#CCCCCC">Keyword</td>
              <td><span id="sprytextfield3">
                <label for="movie_keyword"></label>
                <input name="movie_keyword" type="text" id="movie_keyword" value="<?php echo $row_update_movie['movie_keyword']; ?>" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td bgcolor="#CCCCCC">Description</td>
              <td><span id="sprytextarea1">
                <label for="movie_desc"></label>
                <textarea name="movie_desc" id="movie_desc" cols="45" rows="4"><?php echo $row_update_movie['movie_desc']; ?></textarea>
              <span class="textareaRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td bgcolor="#CCCCCC">Status</td>
              <td><span id="sprytextfield4">
                <label for="status"></label>
                <input name="status" type="text" id="status" value="<?php echo $row_update_movie['status']; ?>" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td><input name="movie_id" type="hidden" id="movie_id" value="<?php echo $row_update_movie['movie_id']; ?>" /></td>
              <td><input type="submit" name="Update" id="Update" value="Update" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="update_movie" />
        </form>
        
</div>

<!-----Section End----->


<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script>
</body>
</html>
<?php
mysql_free_result($pro_cats);

mysql_free_result($pro_brands);

mysql_free_result($update_movie);

mysql_free_result($admin_users);
?>
