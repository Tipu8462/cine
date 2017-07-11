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

mysql_select_db($database_db_connection, $db_connection);
$query_owner_users = "SELECT * FROM `owner`";
$owner_users = mysql_query($query_owner_users, $db_connection) or die(mysql_error());
$row_owner_users = mysql_fetch_assoc($owner_users);
$totalRows_owner_users = mysql_num_rows($owner_users);
?>




<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['owner_password'])) {
  $loginUsername=$_POST['owner_email'];
  $password=$_POST['owner_password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "owner.php";
  $MM_redirectLoginFailed = "owner_login.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_db_connection, $db_connection);
  
  $LoginRS__query=sprintf("SELECT owner_email, owner_password FROM `owner` WHERE owner_email=%s AND owner_password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $db_connection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
  
 
  
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>




<?php
error_reporting(E_ALL ^ E_NOTICE); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Please!!!</title>
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

<div id="section" style="height:550px !important;">
	<div id="message_bar" style="height:10% !important;">
   	<center><h3>Login Panel</h3></center>
    </div>
    
    <div id="data_bar" style="height:90% !important;">
    <br>
    <br>
      <form id="owner_login_form" name="owner_login_form" method="POST" action="<?php echo $loginFormAction; ?>">
        <table width="500" border="0" cellspacing="5" cellpadding="5" align="center">
          
	<tr>
            <td width="107" height="77" bgcolor="#CCCCCC">Email ID</td>
            <td width="358" bgcolor="#333333"><span id="sprytextfield1">
            <label for="owner_email"></label>
              <input type="text" name="owner_email" id="owner_email" />
          </tr>
          <tr>
            <td height="84" bgcolor="#CCCCCC">Password</td>
            <td bgcolor="#333333"><span id="sprypassword1">
              <label for="owner_password"></label>
              <input type="password" name="owner_password" id="owner_password" />
          </tr>
          <tr>
            <td height="78">&nbsp;</td>
            <td align="center" bgcolor="#FF0033"><input type="submit" name="owner_login_btn" id="owner_login_btn" value="Submit" /></td>
          </tr>
        </table>
      </form>
    </div>
</div>

<!-----Section End----->

<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>
</html>
<?php
mysql_free_result($owner_users);
?>