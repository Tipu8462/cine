<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pay Offline</title>
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
<?php include("menubar.php");?>
<!----- Menu Bar End ----->


<!----- Slider Start----->
<?php include("slider.php");?>
<!----- Slider End----->


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
        <center><h3 style="background:#333; margin:0px; padding:0px; height:60px; line-height:2.5;">
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
        &nbsp; Change Pass
        </a>
        </li>
        
        <li>
        <a href="customer_account.php?delete_account">
        <i class="fa fa-check-circle"></i>
        &nbsp; Delete Account
        </a>
        </li>
        
        <li>
        <a href="pay_offline.php">
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
        <center><h2>Customer Account</h2></center>
        <br />
        <center><h3>Pay Offline</h3></center>
        <table width="95%" align="center" cellpadding="10" cellspacing="10" bgcolor="#CCCCCC">
        
        	<tr>
            <td bgcolor="#FF0033">Bank A/c Info.</td>
            <td>
            <pre>
            Account Title: XXXXXXXXXX
            Bank Name:     XXXXXXXXXX
            Bank A/c No:   XXXXXXXXXX
            City:          XXXXXXXXXX
            Swift Code:    XXXXXXXXXX
            IBAN No:       XXXXXXXXXX
            </pre>
            </td>
            </tr>
            

            
            <tr>
            <td height="140" bgcolor="#FF0033">Bkash</td>
            <td>
            <pre>
            Mobile No:      XXXXXXXXXX
            Transaction ID: XXXXXXXXXX
            </pre>
            </td>
            </tr>

        </table>
        
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