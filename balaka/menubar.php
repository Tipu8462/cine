<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<title>Menubar</title>

<div id="menu">
	<ul>
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
        		<a href='customer_login.php'><i class='fa fa-smile-o'></i> Login</a></li>";
		
		}
		
	?>
        <li style="background:#F00;" class="wobble-top">
        <a href="customer_register.php"><i class="fa fa-cloud-download"></i> SignUp</a></li>
        <li style="background:#C39;" class="wobble-top">
        <a href="cart.php"><i class="fa fa-ticket"></i> Buy Ticket</a></li>
	<li style="background:#9F0;" class="wobble-top">
        <a href="#"><i class="fa fa-download"></i> App</a></li>
    </ul>
</div>