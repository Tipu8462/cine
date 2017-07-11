<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Account</title>
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
        
        <li style="background:#F00;" class="wobble-top">
        <a href="customer_register.php"><i class="fa fa-cloud-download"></i> SignUp</a></li>
        <li style="background:#C39;" class="wobble-top">
        <a href="cart.php"><i class="fa fa-ticket"></i> Buy Ticket</a></li>
	<li style="background:#9F0;" class="wobble-top">
        <a href="#"><i class="fa fa-download"></i> App</a></li>
    </ul>
</div>
<!----- Menu Bar End ----->


<!-----Section Start----->

<div id="section">
	<div id="message_bar">
    <?php
    if(isset($_SESSION['customer_email']))
	{
	echo "Welcome! ".$_SESSION['customer_email']." "."at cinebd.com";
	}
	else
	{
	echo "Welcome! Guest at cinebd.com";
	}
	?>
    <i class="fa fa-shopping-cart"></i>:<?php get_items(); ?>
    <i class="fa fa-money"></i><?php get_price(); ?> 
    <a href="cart.php">
    <input type="button" name="cart_btn" value="Go2Cart">
    </a>
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
    	<div id="left_data_bar">
        <center><h3 style="background:#333; margin:0px; padding:0px; height:50px; line-height:2.5;">
        Manage Account!</h3></center>
        <?php
        $customer_email=$_SESSION['customer_email'];
		$get_customer="select * from customer where customer_email='$customer_email'";
		global $con;
		$run_get_customer=mysqli_query($con,$get_customer);
		$record=mysqli_fetch_array($run_get_customer);
		$customer_id=$record['customer_id'];
		$customer_name=$record['customer_name'];
		$customer_image=$record['customer_image'];
		?>
        <?php
        echo "<img src='customer_images/$customer_image' width='100%' height='25%'>";
		?>
        <center><h4 style="background:#333; margin:0px; padding:0px; height:20px;
        color:#FFF !important;">
        <?php echo $customer_name?>
        </h4></center>
        <ul>
        <li>
        <a href="customer_account.php?my_orders">
        <i class="fa fa-check-circle"></i> 
        &nbsp; My Orders
        </a>
        </li>
        
        <li>
        <a href="customer_account.php?edit_account">
        <i class="fa fa-check-circle"></i>
        &nbsp; Edit Account
        </a>
        </li>
        
        <li>
        <a href="customer_account.php?change_password">
        <i class="fa fa-check-circle"></i>
        &nbsp;Change Pass
        </a>
        </li>
        
        <li>
        <a href="customer_account.php?delete_account">
        <i class="fa fa-check-circle"></i>
        &nbsp; Delete Account
        </a>
        </li>
        
        <li>
        <a href="#">
        <i class="fa fa-check-circle"></i>
        &nbsp; Pay Offline
        </a>
        </li>
        
        <li>
        <a href="logout.php">
        <i class="fa fa-check-circle"></i>
        &nbsp; Logout
        </a>
        </li>
        
        </ul>
        </div>
        
        <div id="right_data_bar">
        <center><h2>Your Account Details</h2></center>
        <br />
        <?php get_default();?>
        <?php
        if(isset($_GET['my_orders']))
		{
		include ("my_orders.php");	
		}
		?>
        <?php
        if(isset($_GET['edit_account']))
		{
		include ("edit_account.php");	
		}
		?>
        <?php
        if(isset($_GET['change_password']))
		{
		include ("change_password.php");	
		}
		?>
        <?php
        if(isset($_GET['delete_account']))
		{
		include ("customer_delete_account.php");	
		}
		?>
        </div>
        
    </div>
</div>

<!-----Section End----->



<!-----Footer Start---->
<?php include("footer.php");?>
<!-----Footer End---->


<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>