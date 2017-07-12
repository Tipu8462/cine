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



<!----- Menu Bar Start ----->
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
        <?php
		if(isset($_SESSION['customer_email']))
		{
		echo	"<li style='background:#FF0;' class='wobble-top'>
        		<a href='customer_account.php'><i class='fa fa-smile-o'></i> My Account</a></li>";
		}
		else
		{
		
		echo	"<li style='background:#FF0;' class='wobble-top'>
        		<a href='checkout.php'><i class='fa fa-smile-o'></i> Login</a></li>";
		
		}
		
	?>
        
        <li style="background:#C39;" class="wobble-top">
        <a href="cart.php"><i class="fa fa-ticket"></i> Buy Ticket</a></li>
    </ul>
</div>
<!----- Menu Bar End ----->



<!-----Section Start----->

<div id="section">
	<div id="message_bar">
    <?php
    if(isset($_SESSION['customer_email']))
	{
	echo "Welcome! ".$_SESSION['customer_email']." "."at Balaka Cinema Hall";
	}
	else
	{
	echo "Welcome! Guest at Balaka Cinema Hall";
	}
	?>
    <i class="fa fa-shopping-cart"></i>:<?php get_items(); ?>
    <i class="fa fa-money"></i><?php get_price(); ?> 
    <a href="cart.php"><input type="button" name="cart_btn" value="Go2Cart"></a>
    <?php
    if(!isset($_SESSION['customer_email']))
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
    
        <center><h2>Customer Registration</h2></center>
        <form name="customer_register_form" method="post" action="customer_register.php"
        enctype="multipart/form-data">
        
        <table width="95%" align="center" cellpadding="12" cellspacing="12">
        <tr>
        <td width="35%" bgcolor="#FF0033">Customer Name</td>
        <td width="65%" align="center">
        <input type="text" name="customer_name" required="required" placeholder="Customer Name"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </td>
        </tr>
        
        <tr>
        <td bgcolor="#FF0033">Customer Email</td>
        <td align="center">
        <input type="email" name="customer_email" required="required" placeholder="Customer Email"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </td>
        </tr>
        
        <tr>
        <td bgcolor="#FF0033">Customer Password</td>
        <td align="center">
        <input type="password" name="customer_password" required="required" placeholder="Customer Password"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </td>
        </tr>
        
        <tr>
        <td bgcolor="#FF0033">Customer Contact No</td>
        <td align="center">
        <input type="text" name="customer_contact_no" required="required" placeholder="Customer Contact No"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </td>
        </tr>
      
        
        <tr>
        <td bgcolor="#FF0033">Customer City</td>
        <td align="center">
        <select name="customer_city"
        style="width:300px; height:50px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        <option value="Select City" selected="selected" disabled="disabled">Select City</option>
        <option value="Dhaka">Dhaka</option>
        <option value="Narayanganj">Narayanganj</option>
        <option value="Dubai">Munshiganj</option>
        </select>
        </td>
        </tr>
        
        <tr>
        <td bgcolor="#FF0033">Customer Address</td>
        <td align="center">
        <textarea name="customer_address" placeholder="Address....." cols="20" rows="4"
        style="width:300px; height:130px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        </textarea>
        </td>
        </tr>
        
        <tr>
        <td bgcolor="#FF0033">Customer Image</td>
        <td align="center"><input type="file" name="customer_image"></td>
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
$customer_name=$_POST['customer_name'];
$customer_email=$_POST['customer_email'];
$customer_password=$_POST['customer_password'];
$customer_contact_no=$_POST['customer_contact_no'];
$customer_country=$_POST['customer_country'];
$customer_city=$_POST['customer_city'];
$customer_address=$_POST['customer_address'];
$customer_image_name=time().' '.$_FILES['customer_image']['name'];
$customer_image_tmp=$_FILES['customer_image']['tmp_name'];
$ip_add=ip();
$insert_customer="INSERT INTO `customer`
				(customer_name, customer_password, 
				customer_email, customer_contact_no, customer_country, 
				customer_city, customer_address, customer_image, ip_add) 
				VALUES 
				('$customer_name','$customer_password',
				'$customer_email','$customer_contact_no','$customer_country',
				'$customer_city','$customer_address','$customer_image_name','$ip_add')";
global $con;
$run_customer=mysqli_query($con,$insert_customer);
$uploaded_images_dir="customer_images/";
move_uploaded_file($customer_image_tmp,$uploaded_images_dir.$customer_image_name);
$sel_cart="select * from cart where ip_add='$ip_add'";
$run_cart=mysqli_query($con,$sel_cart);
$check_cart=mysqli_num_rows($run_cart);
if($check_cart>0)
{
$_SESSION['customer_email']=$customer_email;
echo "<script>alert('Your Account Created Successfully, Thank You for Booking!')</script>";
echo "<script>window.open('checkout.php','_self')</script>";
}
else
{
$_SESSION['customer_email']=$customer_email;
echo "<script>alert('Your Account Created Successfully, Thank You!')</script>";
echo "<script>window.open('index.php','_self')</script>";
}
}

?>