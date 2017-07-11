<form action="" method="post" name="customer_delete_account_form">
<table align="center" width="95%" cellpadding="10" cellspacing="10">
<tr align="center">
<td height="93" colspan="2" bgcolor="#CCCCCC"><h2>Do you really want to delete your account?</h2></td>
</tr>
<tr align="center">
<td height="103" bgcolor="#FF0033">
<input type="submit" name="yes" value="Yes, I Want to Delete" />
<input type="submit" name="no" value="No, I Do not Want to Delete" />
</td>
</tr>
</table>
</form>
<?php 
include("db.php"); 
$c = $_SESSION['customer_email'];
if(isset($_POST['yes']))
{
$delete_customer = "delete from customer where customer_email='$c'";
global $con;
$run_delete = mysqli_query($con, $delete_customer); 
if($run_delete)
{
session_destroy();
echo "<script>alert('Your Account has been deleted, Good Bye!')</script>";
echo "<script>window.open('index.php','_self')</script>";
}
}
if(isset($_POST['no'])){
echo "<script>window.open('customer_account.php','_self')</script>";
}
?>