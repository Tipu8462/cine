<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forget Your Password???</title>
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


<!----- News Bar Start----->
<?php include("newsbar.php");?>
<!----- News Bar End----->


<!----- Logo Bar Start ----->
<?php include("logobar.php");?>
<!----- Logo Bar End ----->



<!-----Section Start----->

<div id="section" style="height:300px !important;">	
<center><h3>Why are You Depressed Man??? I am Here!!! </h3></center>   
<form name="forget_password_form" action="forget_password.php" method="post">
	<table width="30%" align="center" cellpadding="10" cellspacing="10">
    <tr align="center" bordercolor="#FF3300">
    	<td>Just Give Your Email ID Here.</td>
    </tr>
    <tr align="center" bgcolor="#FF0033">
        <td><input type="email" name="customer_email" placeholder="Email....."></td>
    </tr>
    <tr align="center" bgcolor="#333333">
        <td><input type="submit" name="submit" value="Send Password to Email"></td>
    </tr>
    </table>
</form> 
    
</div>

<!-----Section End----->




<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>
<?php
if(isset($_POST['submit']))
{
$c_email=$_POST['customer_email'];
$get_user="select * from customer where customer_email='$c_email'";
global $con;
$run=mysqli_query($con,$get_user);
$check=mysqli_num_rows($run);
$record=mysqli_fetch_array($run);
$customer_email=$record['customer_email'];
$customer_name=$record['customer_name'];
$customer_password=$record['customer_password'];
if($check==0)
{
echo "<script>alert('Your Email ID is Wrong Try Again')</script>";	
}
else
{
$from='balaka@cinema.com';
$subject='Here is Your Password';
$message=		"
				<html>
				<h3>Dear Mr/Mrs:  $customer_name</h3>
				<h3>Your Email ID is:  $customer_email</h3>
				<h3>Your Password is:  $customer_password</h3>
				</html>
				 ";
mail($customer_email,$subject,$message,$from);
echo "<script>alert('Your Password is Send on Your Email ID Check Your Inbox')</script>";	
echo "<script>window.open('checkout.php','_self')</script>";	
}
}
?>