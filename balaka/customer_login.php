<?php @session_start(); ?>
<?php include ("db.php");?>
<?php include ("ip_add.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome at cinebd.com</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS Hover Effects/css/hover.css">

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


<div id="menu">
	<ul>
	
	<li style="background:#F00;" class="wobble-top">
        <a href="index.php"><i class="fa fa-home"></i> Home</a></li>
	<li style="background:#C39;" class="wobble-top" id="sub">
        <a href="#"><i class="fa fa-film"></i> Cinema</a>
		<ol>
		<li style="background:#F3C;" class="wobble-top">
        	<a href="display_now_movies.php"> Now Showing</a></li>
		<li style="background:#F3C;" class="wobble-top">
        	<a href="display_upcoming_movies.php"> Upcoming</a></li>
		</ol>
	</li>
        <li style="background:#9F0;" class="wobble-top">
        <a href="schedule.php"><i class="fa fa-ticket"></i> Schedule</a></li>
        <li style="background:#C39;" class="wobble-top">
        <a href="cart.php"><i class="fa fa-ticket"></i> Buy Ticket</a></li>
	<li style="background:#9F0;" class="wobble-top">
        <a href="#"><i class="fa fa-download"></i> App</a></li>
    </ul>
</div>

<div>
<form action="customer_account.php" method="post" name="customer_login_form">
<table width="70%" align="center" bgcolor="#333333" cellpadding="5" cellspacing="5">
<tr>
<td bgcolor="#FF0033">E-mail</td>
<td>
<input type="email" name="customer_email" placeholder="Email....." required="required"
style="background:#FFF; color:#333; width:200px; height:30px; outline:0; border:#FFF; text-align:center;">
</td>
<td bgcolor="#FF0033">Password</td>
<td><input type="password" name="customer_password" placeholder="Password....." required="required"
style="background:#FFF; color:#333; width:200px; height:30px; outline:0; border:#FFF; text-align:center;"></td>
<td bgcolor="#FF0033"><input type="submit" name="login_btn" value="Login"
style="background:#333; width:80px; height:30px; font-size:18px; color:#FFF; outline:0; border:#333; "></td>
<td bgcolor="#FF0033">
<a href="customer_register.php">
<input type="button" name="register_btn" value="Register"
style="background:#333; width:80px; height:30px; font-size:18px; color:#FFF; outline:0; border:#333; ">
</a>
</td>
    
</tr>
<tr>
<td>&nbsp;</td>
<td colspan="5" align="right"><a href="forget_password.php">
  <input type="button" value="Forget Password" name="forget_password_btn"
style="background:#333; width:500px; height:30px; font-size:18px; color:#FFF; outline:0; border:#333; text-align:right;">
</a></td>

</tr>
</table>
</form>

</div>

<?php
if(isset($_POST['login_btn']))
{
global $con;
$customer_email=$_POST['customer_email'];
$customer_password=$_POST['customer_password'];
$sel_user="select * from customer where customer_email='$customer_email' AND customer_password='$customer_password'";
$run=mysqli_query($con,$sel_user);
$check_customer = mysqli_num_rows($run); 
$ip_add=ip();
$sel_cart = "select * from cart where ip_add='$ip_add'";
$run_cart = mysqli_query($con, $sel_cart); 
$check_cart = mysqli_num_rows($run_cart); 
	if($check_customer==0)
	{
	echo "<script>alert('Password or Email address is not correct, try again!')</script>";
	exit();
	}
	if($check_customer==1 AND $check_cart==0)
	{
	$_SESSION['customer_email']=$customer_email;
	echo "<script>alert('Your Cart is Empty However You Successfully Logged in and You are Re-Direct to You into Your Account!')</script>";
	echo "<script>window.open('customer_account.php','_self')</script>";
	}
	else 
	{
	$_SESSION['customer_email']=$customer_email;
	echo "<script>alert('You Successfully Logged in, Thank You For Booking, So You Can Order Now!')</script>";
	include("payment_options.php");
	}
}
?>