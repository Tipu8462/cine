<form action=""  name="change_password_form" method="post">
	<table width="68%" align="center" cellpadding="10" cellspacing="10">
        <tr align="center">
        	<td colspan="4"><h2>Change your password:</h2></td>
        </tr>
        <tr>
        	<td align="right" bgcolor="#CCCCCC">Current Password:</td>
          <td align="center" bgcolor="#FF0033"><input type="password" name="old_password" required/></td>
        </tr>
        <tr>
        	<td align="right" bgcolor="#CCCCCC">New Password:</td>
          <td align="center" bgcolor="#FF0033"><input type="password" name="new_password" required/></td>
        </tr>
        <tr>
        	<td align="right" bgcolor="#CCCCCC">Confirm Password</td>
          <td align="center" bgcolor="#FF0033"><input type="password" name="confirm_password" required/></td>
        </tr>
        <tr align="center">
        	<td colspan="4" bgcolor="#333333"><input type="submit" name="update_password_btn" value="Update" /></td>
        </tr>
    </table>
</form>
<?php 
include("db.php"); 
$c = $_SESSION['customer_email'];
if(isset($_POST['update_password_btn']))
{
$old_password = $_POST['old_password']; 
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
$get_real_pass = "select * from customer where customer_password='$old_password'";
global $con;
$run_real_pass = mysqli_query($con, $get_real_pass); 
$check_pass = mysqli_num_rows($run_real_pass);
if($check_pass==0)
{
echo "<script>alert('Your current password is not valid, try again')</script>";
exit();			
}
if($new_password!=$confirm_password)
{
echo "<script>alert('New password did not match, try again')</script>";
exit();
}
else 
{					
$update_pass = "update customer set customer_password='$new_password' where customer_email='$c'";
global $con;
$run_pass = mysqli_query($con, $update_pass); 
echo "<script>alert('Your pass has been successfully changed!')</script>";
echo "<script>window.open('customer_account.php','_self')</script>";
}
}

	
	


?>