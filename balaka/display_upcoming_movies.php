<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upcoming Movies</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS Hover Effects/css/hover.css">
<!-- Start WOWSlider.com HEAD section -->
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
    	<li style="background:#F3C;" class="wobble-top">
        <a href="index.php"><i class="fa fa-home"></i> Home</a></li>
		<li style="background:#C39;" class="wobble-top">
        <a href="display_now_movies.php"><i class="fa fa-film"></i> Now Show</a></li>
        <li style="background:#9F0;" class="wobble-top">
        <a href="display_now_movies.php"><i class="fa fa-ticket"></i> Schedule</a></li>
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
        <li style="background:#F00;" class="wobble-top">
        <a href="customer_register.php"><i class="fa fa-cloud-download"></i> SignUp</a></li>
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
        <center><h1>Categories</h1></center>
        <br>
        <ul>
        <?php getcategory2(); ?>
        </ul>
        <br>
        <center><h1>Quality</h1></center>
        <br>
        <ul>
        <?php getquality2(); ?>	
        </ul>
        </div>
        
        <div id="right_data_bar">
        <center><h2>Upcoming Movies</h2></center>
       
        
                
        <?php cart(); ?>
        <?php getmovie2(); ?>
        <?php getcategorymovie2(); ?>
        <?php getqualitymovie2(); ?>
        

        </div>
        
     </div>
</div>
<!-----Section End----->


<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>