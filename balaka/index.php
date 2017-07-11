<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome at cinebd.com</title>
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





<!----- Menu Bar Start ----->
<div id="menu">
	<ul>
	<li style="background:#9F0;" class="wobble-top">
        <a href="/cine/home.php"><i class="fa fa-home"></i> Home</a></li>
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
    <li style="background:#C39;" class="wobble-top" id="sub">
        <a href="#"><i class="fa fa-film"></i> Login</a>
		<ol>
		<li style="background:#F3C;" class="wobble-top">
        	<a href="customer_login.php"> User</a></li>
		<li style="background:#F3C;" class="wobble-top">
        	<a href="owner_login.php"> Owner</a></li>
		<li style="background:#F3C;" class="wobble-top">
        	<a href="admin_login.php"> Admin</a></li>
		</ol>
	</li>    
		<li style="background:#F00;" class="wobble-top">
        <a href="customer_register.php"><i class="fa fa-cloud-download"></i> SignUp</a></li>
        <li style="background:#C39;" class="wobble-top">
        <a href="cart.php"><i class="fa fa-ticket"></i> Buy Ticket</a></li>
		
    </ul>
</div>
<!----- Menu Bar End ----->



<!----- Logo Bar Start ----->
<?php include("logobar.php");?>
<!----- Logo Bar End ----->


<!----- Slide Bar Start ----->
<?php include("slider.php");?>
<!----- Slide Bar Start ----->



<!-----Footer Start---->
<?php include("footer.php");?>
<!-----Footer End---->


<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>