<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<?php include("functions.php");?>
<?php
if(isset($_GET['order_id']))
{
$order_id=$_GET['order_id'];
$get_order="select * from customer_orders where order_id='$order_id'";
global $con;
$run_get_order=mysqli_query($con,$get_order);
$order_record=mysqli_fetch_array($run_get_order);
$customer_id=$order_record['customer_id'];
}
?>
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


<!----- Dynamic Menu Start ----->
<?php include("dynamicmenu.php");?>
<!----- Dynamic Menu End ----->





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
        &nbsp; Change Password
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
        <center><h3>Customer Account</h2></center>
        <br />
        <center><h1>Pay Your Invoice</h1></center>
        <br>
        <hr>
        <br>
        <form name="customer_payment_form" 
        action="customer_payment.php?update_id=<?php echo $order_id; ?>" method="post">
        <table width="95%" align="center" cellpadding="20" cellspacing="20" bgcolor="#CCCCCC">
        <tr>
        	<td bgcolor="#FF0033">Invoice No</td>
            <td align="center"><input type="text" name="invoice_no" placeholder="Invoice No....."
            style="outline:0; border:#333; color:#FFF; font-size:18px; text-align:center;
            background:#333;"></td>
        </tr>
        
        <tr>
        	<td bgcolor="#FF0033">Amount Paid</td>
            <td align="center"><input type="text" name="amount_paid" placeholder="Amount Paid....."
            style="outline:0; border:#333; color:#FFF; font-size:18px; text-align:center;
            background:#333;"></td>
        </tr>
        
        <tr>
        	<td bgcolor="#FF0033">Source</td>
            <td align="center">
            <select name="payment_source"
            style="outline:0; border:#333; color:#FFF; font-size:18px; text-align:center;
            background:#333;">
            <option value="Payment Source" selected="selected" disabled="disabled">Payment Source</option>
            <option value="Easy Paisa">Easy Paisa</option>
            <option value="UBL OMNI">UBL Omni</option>
            <option value="Bank A/c">Bank A/c</option>
            <option value="Paypal">Paypal</option>
            </select>
            </td>
        </tr>
        
        <tr>
        	<td bgcolor="#FF0033">Transition ID</td>
            <td align="center"><input type="text" name="transition_id" placeholder="Transition ID....."
            style="outline:0; border:#333; color:#FFF; font-size:18px; text-align:center;
            background:#333;"></td>
        </tr>
        
        <tr>
        	<td bgcolor="#FF0033">Pass Code</td>
            <td align="center"><input type="text" name="pass_code" placeholder="Pass Code....."
            style="outline:0; border:#333; color:#FFF; font-size:18px; text-align:center;
            background:#333;"></td>
        </tr>
        
        <tr>
        	<td bgcolor="#FF0033">Date</td>
            <td align="center"><input type="text" name="date" placeholder="Date....."
            style="outline:0; border:#333; color:#FFF; font-size:18px; text-align:center;
            background:#333;"></td>
        </tr>
        
        <tr>
        	<td>&nbsp;</td>
            <td bgcolor="#FF0033" align="center"><input type="submit" name="paid_btn" value="Paid"></td>
        </tr>
        </table>
        </form>
        
        <br>
        <hr>
        <?php
        if(isset($_POST['paid_btn']))
		{
		$update_id=$_GET['update_id'];
		$invoice_no=$_POST['invoice_no'];
		$amount_paid=$_POST['amount_paid'];
		$payment_source=$_POST['payment_source'];
		$transition_id=$_POST['transition_id'];
		$pass_code=$_POST['pass_code'];
		$date=$_POST['date'];
		$status='Complete';
		$insert_customer_payment="INSERT INTO customer_payment
		(order_id,customer_id, invoice_no, 
		amount_paid, source, transition_id, 
		pass_code, date) 
		VALUES 
		('$update_id','$customer_id','$invoice_no',
		'$amount_paid','$payment_source','$transition_id',
		'$pass_code','$date')";
		global $con;
		$run_insert_customer_payment=mysqli_query($con,$insert_customer_payment);
		if($run_insert_customer_payment)
		{
		$update_order="UPDATE customer_orders SET order_status='$status' where order_id='$update_id'";
		global $con;
		$run_update_order=mysqli_query($con,$update_order);
		echo "<script>alert('Thank You , We Have Received Your Payment. We Will Be Back Soon')</script>";
		echo "<script>window.open('customer_account.php','_self')</script>";
		}
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