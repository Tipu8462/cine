<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Options</title>
</head>

<body>

<?php
include("db.php");
?>

<?php
$ip_add=getUserIP();
$get_customer="select * from customer where ip_add='$ip_add'";
global $con;
$run=mysqli_query($con,$get_customer);
$record=mysqli_fetch_array($run);
$customer_id=$record['customer_id'];
?>

<div style="text-align:center;">
<img src="images/payment_option.jpg" width="600" height="300">
<br>
<a href="order.php?c_id=<?php echo $customer_id ?>">
<input type="button" value="Pay Offline" name="pay_offline_btn" style="background:#F03; width:100px; height:30px; font-size:18px; color:#FFF; outline:0; border:#333; ">
</a>
</div>

</body>
</html>