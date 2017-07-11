<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<?php include("functions.php");?>
<?php include("ip_add.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Please!!!</title>
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

<div id="section">
	<div id="message_bar">
    <?php
    if(isset($_SESSION['admin_email']))
	{
	echo "Welcome! ".$_SESSION['admin_email']." "."at cinebd.com";
	}
	else
	{
	echo "Welcome! Guest at cinebd.com";
	}
	?>
    <i class="fa fa-shopping-cart"></i>:<?php get_items(); ?>
    <i class="fa fa-money"></i><?php get_price(); ?> 
    <a href="cart.php"><input type="button" name="cart_btn" value="Go2Cart"></a>
    <?php
    if(!isset($_SESSION['admin_email']))
	{
	echo "<a href='checkout.php'><input type='button' value='Login'></a>";
	}
	else
	{
	echo "<a href='logout.php'><input type='button' value='Logout'></a>";
	}
	?>
   
    </div>
    
    <div id="data_bar">
    
        <center><h2>Owner Registration</h2></center>
        <form name="owner_register_form" method="post" action="hall_owner_register.php"
        enctype="multipart/form-data">
        
        <table width="95%" align="center" cellpadding="12" cellspacing="12">
	
	<tr>
        <td width="35%" bgcolor="#FF0033">User Type</td>
        <td width="65%" align="center">
        <input type="text" name="user_type" required="required" placeholder="admin/owner"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </td>
        </tr>
 
        
        <tr>
        <td bgcolor="#FF0033">Owner Email</td>
        <td align="center">
        <input type="email" name="admin_email" required="required" placeholder="Owner Email"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </td>
        </tr>
        
        <tr>
        <td bgcolor="#FF0033">Owner Password</td>
        <td align="center">
        <input type="password" name="admin_password" required="required" placeholder="Owner Password"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </td>
        </tr>
        
        <tr>
        <td bgcolor="#FF0033">Owner Contact No</td>
        <td align="center">
        <input type="text" name="contact_no" required="required" placeholder="Owner Contact No"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </td>
        </tr>

	<tr>
        <td width="35%" bgcolor="#FF0033">Hall Name</td>
        <td width="65%" align="center">
        <input type="text" name="hall_name" required="required" placeholder="Hall Name"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </td>
        </tr>
  
        
        <tr>
        <td bgcolor="#333333">&nbsp;</td>
        <td align="center" bgcolor="#FF0033"><input type="submit" name="register_btn" value="Register"></td>
        </tr>
        </table>
        
        </form>
      </div>
</div>

<!-----Section End----->



<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>


<?php
if(isset($_POST['register_btn']))
{
$user_type=$_POST['user_type'];
$admin_email=$_POST['admin_emai'];
$admin_password=$_POST['admin_password'];
$contact_no=$_POST['contact_no'];
$hall_name=$_POST['hall_name'];
$insert_admin="INSERT INTO 'admin'
				(user_type, admin_email, admin_password, 
				 contact_no, hall_name) 
				VALUES 
				($user_type, $admin_email,$admin_password,
				$contact_no, $hall_no)";
global $con;
$run_admin=mysqli_query($con,$insert_admin);
$run_cart=mysqli_query($con,$sel_cart);
$check_cart=mysqli_num_rows($run_cart);
if($check_cart>0)
{
$_SESSION['admin_email']=$admin_email;
echo "<script>alert('Account Created Successfully, Thank You!')</script>";
echo "<script>window.open('checkout.php','_self')</script>";
}
else
{
$_SESSION['admin_email']=$admin_email;
echo "<script>alert('Account Created Successfully, Thank You!')</script>";
echo "<script>window.open('admin.php','_self')</script>";
}
}

?>