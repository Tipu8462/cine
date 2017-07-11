<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php session_start();?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Balaka Cinema Hall</title>
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
<div id="menu">
	<ul>
	<li style="background:#C39;" class="wobble-top">
        <a href="index.php"><i class="fa fa-home"></i> Home</a></li>
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
        	<a href="owner.php"> Owner</a></li>
			<li style="background:#F3C;" class="wobble-top">
			<a href="admin.php"> Admin</a></li>
		</ol>
	</li>
        <li style="background:#F00;" class="wobble-top">
        <a href="customer_register.php"><i class="fa fa-cloud-download"></i> SignUp</a></li>
    </ul>
</div>
<!----- Menu Bar End ----->




<!-----Section Start----->

<div id="section" style="height:400px !important;">
	<div id="message_bar" style="height:8% !important;">
    <?php
    if(isset($_SESSION['customer_email']))
	{
	echo "Welcome! ".$_SESSION['customer_email']." "."at Balaka Cinema Hall";
	}
	else
	{
	echo "Welcome! Guest at cinebd.com";
	}
	?>
    <i class="fa fa-shopping-cart"></i>:<?php get_items(); ?>
    <i class="fa fa-money"></i><?php get_price(); ?> 
    <a href="index.php"><input type="button" name="cart_btn" value="Go Back"></a>
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
    	
        <center><h2>View Cart</h2></center>
        <br />
       	<form name="cart_form" action="cart.php" enctype="multipart/form-data"
        method="post">
        	<table width="95%" align="center" cellpadding="5" cellspacing="5">
            <tr align="center" bgcolor="#FF0033">
            	<td>Remove</td>
                <td>Movie(s)</td>
                <td>Quantity</td>
                <td>Price</td>
            </tr>
<?php
global $con;
$ip_add=getUserIP();
$total_price=0;
$sel_price="select * from cart where ip_add='$ip_add'";
$run_sel_price=mysqli_query($con,$sel_price);
while($record=mysqli_fetch_array($run_sel_price))
{
$movie_id=$record['movie_id'];
$pro_price="select * from movies where movie_id='$movie_id'";
$run_pro_price=mysqli_query($con,$pro_price);
while ($p_price=mysqli_fetch_array($run_pro_price))
{
$movie_name=$p_price['movie_name'];
$single_movie_price=$p_price['movie_price'];
$movie_img1=$p_price['movie_img1'];
$movie_price=array($p_price['movie_price']);
$values=array_sum($movie_price);
$total_price= $total_price + $values;

//echo " Tk. ".$total_price." /- ";
			?>
            <tr align="center">
            	<td>
                <input type="checkbox" name="remove[]" value="<?php echo $movie_id ?>">
                </td>
                <td>
                <?php echo $movie_name ?>
                <br>
                <img src="uploaded_images/<?php echo $movie_img1 ?>" width="200" height="100">
                </td>
                <td>
                <input type="text" value="1" name="qty" size="5">
                </td>
                <td><?php echo $single_movie_price; ?></td>
            </tr>
<?php }}?>
			<tr align="center" >
            	<td>&nbsp;</td>
                <td>&nbsp;</td>
                <td bgcolor="#FF0033">Subtotal</td>
                <td bgcolor="#FF0033"><?php echo " Tk. ".$total_price." /- "; ?></td>
            </tr>
            <tr align="center" bgcolor="#FF0033">
            	<td>
                <input type="submit" value="Delete Movie" name="delete_movie"
                style="outline:0; border:#333; background:#333; color:#FFF;
                width:150px; height:30px;">
                
                </td>
                <td>
                <a href="checkout.php">
                <input type="button" value="Check Out" name="check_out"
                style="outline:0; border:#333; background:#333; color:#FFF;
                width:150px; height:30px;">
                </a>
                </td>
                <td>
                <a href="index.php">
                <input type="button" value="Continue Booking" name="continue_Booking"
                style="outline:0; border:#333; background:#333; color:#FFF;
                width:150px; height:30px;">
                </a>
                </td>
                <td>
                <a href="#">
                <input type="button" value="Register / Login" name="register_login"
                style="outline:0; border:#333; background:#333; color:#FFF;
                width:150px; height:30px;">
                </td>
            </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['delete_movie']))
		{
		foreach($_POST['remove'] as $remove_id)
		{
		global $con;
		$delete_movie="delete from cart where movie_id='$remove_id'";
		$run_delete_movie=mysqli_query($con,$delete_movie);
		if($run_delete_movie)
		{
		echo "<script>window.open('cart.php','_self')</script>";
		}
		}
		}
		?>
       
</div>

<!-----Section End----->



<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>