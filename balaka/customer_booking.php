
<?php
include("db.php");

$customer_email=$_SESSION['customer_email'];
$get_customer="select * from customer where customer_email='$customer_email'";
global $db;
$run_get_default=mysqli_query($db,$get_customer);
$record=mysqli_fetch_array($run_get_default);
$customer_id=$record['customer_id'];

?>

<table width="90%" align="center" cellpadding="2" cellspacing="2" bgcolor="#CCCCCC">
	<tr align="center" bgcolor="#FF0033">
    	<th height="50">Serial No</th>
        <th>Order No</th>
        <th>Due Amount</th>
        <th>Invoice No</th>
        <th>Total Products</th>
        <th>Order Date</th>
        <th>Paid/Unpaid</th>
        <th>Status</th>
        <th>Payment</th>
  </tr>
<?php
$get_orders="select * from customer_orders where customer_id='$customer_id'";
global $con;
$run_get_orders=mysqli_query($con,$get_orders);
$i=0;
while ($order_record=mysqli_fetch_array($run_get_orders))
{
$order_id=$order_record['order_id'];
$due_amount=$order_record['due_amount'];
$invoice_no=$order_record['invoice_no'];
$total_products=$order_record['total_products'];
$order_date=$order_record['order_date'];
$order_status=$order_record['order_status'];
if($order_status=='Pending')
{
$amount_status="Unpaid";
}
else
{
$amount_status="Paid";
}


$i++;
echo 	"
		<tr align='center'>
			<td  height='50'>$i</td>
			<td>$order_id</td>
			<td>$due_amount</td>
			<td>$invoice_no</td>
			<td>$total_products</td>
			<td>$order_date</td>
			<td>$amount_status</td>
			<td>$order_status</td>
			<td>
			<a href='customer_payment.php?order_id=$order_id'>Pay</a>
			</td>
		</tr>
		";
}

?>

</table>