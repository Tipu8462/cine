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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update_approval_form")) {
  $updateSQL = sprintf("UPDATE pending_orders SET order_status=%s WHERE invoice_no=%s",
                       GetSQLValueString($_POST['order_status'], "text"),
                       GetSQLValueString($_POST['invoice_no'], "text"));

  mysql_select_db($database_db_connection, $db_connection);
  $Result1 = mysql_query($updateSQL, $db_connection) or die(mysql_error());

  $updateGoTo = "order_approval.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_update_approval = "-1";
if (isset($_GET['invoice_no'])) {
  $colname_update_approval = $_GET['invoice_no'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_update_approval = sprintf("SELECT * FROM pending_orders WHERE invoice_no = %s", GetSQLValueString($colname_update_approval, "text"));
$update_approval = mysql_query($query_update_approval, $db_connection) or die(mysql_error());
$row_update_approval = mysql_fetch_assoc($update_approval);
$totalRows_update_approval = mysql_num_rows($update_approval);
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

<div id="section" style="height:400px !important;">
	<div id="message_bar" style="height:10% !important;">
   	<center><h3>Admin Panel</h3></center>
    </div>
    
    <div id="data_bar" style="height:90% !important;">
    <center><h3>Update Approval</h3></center>
    <form id="update_approval_form" name="update_approval_form" method="POST" action="<?php echo $editFormAction; ?>">
      <table width="95%" align="center" border="0" cellpadding="10" cellspacing="10">
        <tr>
          <td align="center" bgcolor="#FF0033">Update Status</td>
        </tr>
        <tr>
          <td align="center" bgcolor="#CCCCCC"><span id="sprytextfield1">
            <label for="order_status"></label>
            <input name="order_status" type="text" id="order_status" value="<?php echo $row_update_approval['order_status']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#333333"><input name="invoice_no" type="hidden" id="invoice_no" value="<?php echo $row_update_approval['invoice_no']; ?>" />            <input type="submit" name="update_btn" id="update_btn" value="Update" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="update_approval_form" />
    </form>
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
mysql_free_result($update_approval);
?>
