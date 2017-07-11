<?php include("db.php");?>
<?php include("functions.php");?>
<?php
if(isset($_GET['c_id']))
{
$customer_id=$_GET['c_id'];
}



global $con;
$ip_add=getUserIP();
$total_price=0;
$sel_price="select * from cart where ip_add='$ip_add'";
$run_sel_price=mysqli_query($con,$sel_price);
$count_pro=mysqli_num_rows($run_sel_price);
$invoice_no=mt_rand();
$order_status='Pending';
while($record=mysqli_fetch_array($run_sel_price))
{
$product_id=$record['product_id'];
$pro_price="select * from products where product_id='$product_id'";
global $con;
$run_pro_price=mysqli_query($con,$pro_price);
while ($p_price=mysqli_fetch_array($run_pro_price))
{
$product_price=array($p_price['product_price']);
$values=array_sum($product_price);
$total_price= $total_price + $values;
}
}

$get_cart="select * from cart where ip_add='$ip_add'";
global $con;
$run_get_cart=mysqli_query($con,$get_cart);
$get_qty=mysqli_fetch_array($run_get_cart);
$qty=$get_qty['qty'];


$insert_order="INSERT INTO customer_orders
				(customer_id, due_amount, invoice_no, 
				total_products,order_status) 
				VALUES 
				('$customer_id','$total_price','$invoice_no',
				'$count_pro','$order_status')";
global $con;
$run_insert_order=mysqli_query($con,$insert_order);
if($run_insert_order)
{
echo "<script>alert('Your Order Has Been Submited!')</script>";
echo "<script>window.open('customer_account.php','_self')</script>";
$insert_pending_orders="INSERT INTO pending_orders
						(customer_id,invoice_no,product_id, 
						qty,order_status) 
						VALUES 
						('$customer_id','$invoice_no','$product_id',
						'$qty','$order_status')";
global $con;
$run_insert_peding_orders=mysqli_query($con,$insert_pending_orders);

$empty_cart="delete from cart where ip_add='$ip_add'";
global $con;
$run_empty_cart=mysqli_query($con,$empty_cart);


}
?>