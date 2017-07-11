<?php
session_start();
include("db.php");

if(isset($_GET['edit_account']))
{
$customer_email=$_SESSION['customer_email'];
$get_customer="select * from customer where customer_email='$customer_email'";
global $db;
$run_get_default=mysqli_query($db,$get_customer);
$record=mysqli_fetch_array($run_get_default);
$customer_id=$record['customer_id'];
$customer_name=$record['customer_name'];
$customer_email=$record['customer_email'];
$customer_password=$record['customer_password'];
$customer_contact_no=$record['customer_contact_no'];
$customer_city=$record['customer_city'];
$customer_address=$record['customer_address'];
}

?>

<form action="" method="post">
  <table width="95%" align="center" bgcolor="#CCCCCC">
    <tr>
    	<td width="26%">Name</td>
        <td width="74%" align="center" bgcolor="#FF0033">
        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
      </td>
    </tr>
    <tr>
    	<td>Email</td>
        <td align="center" bgcolor="#FF0033">
        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
        </td>
    </tr>
    <tr>
    	<td>Password</td>
        <td align="center" bgcolor="#FF0033">
        <input type="password" name="customer_password" value="<?php echo $customer_password; ?>">
        </td>
    </tr>
    <tr>
    	<td>Contact No</td>
        <td align="center" bgcolor="#FF0033">
        <input type="text" name="customer_contact_no" value="<?php echo $customer_contact_no; ?>">
        </td>
    </tr>
    <tr>
    	<td>City</td>
        <td align="center" bgcolor="#FF0033">
        <input type="text" name="customer_city" value="<?php echo $customer_city; ?>">
        </td>
    </tr>
    <tr>
    	<td>Address</td>
        <td align="center" bgcolor="#FF0033">
        <input type="text" name="customer_address" value="<?php echo $customer_address; ?>">
        </td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
        <td align="center" bgcolor="#FF0033">
        <input type="submit" value="Update" name="update_btn">
        </td>
    </tr>
    </table>
</form>

<?php
if(isset($_POST['update_btn']))
{
$c_id=$customer_id;
$c_name=$_POST['customer_name'];
$c_email=$_POST['customer_email'];
$c_password=$_POST['customer_password'];
$c_contact_no=$_POST['customer_contact_no'];
$c_country=$_POST['customer_country'];
$c_city=$_POST['customer_city'];
$c_address=$_POST['customer_address'];

$update_customer=
					"
					UPDATE customer SET 	
					customer_name='$c_name',customer_password='$c_password',
					customer_email='$c_email',customer_contact_no='$c_contact_no',
					customer_country='$c_country',
					customer_city='$c_city',customer_address='$c_address' 
					WHERE customer_id='$c_id';
					";
global $con;
$run_update_customer=mysqli_query($con,$update_customer);
if($run_update_customer)
{
echo "<script>alert('Your Account Has Been Updated!')</script>";
echo "<script>window.open('customer_account.php','_self')</script>";
}
}

?>