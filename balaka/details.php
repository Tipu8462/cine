<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
<?php include("functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Movie Details</title>
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


<!-----Section Start----->

<div id="section">
	<div id="message_bar">
    Welcome to You @ cinebd.com >>
    </div>
    
    <div id="data_bar">
		<div id="right_data_bar">

        <center><h2>Movie Information</h2></center>
		<center>
		<?php
		global $con;
		if(isset($_GET['movie_id']))
		{
		$movie_id=$_GET['movie_id'];
        $get_movies="select * from movies where movie_id='$movie_id'";
		$run_get_movies=mysqli_query($con,$get_movies);
		while($row_run_get_movies=mysqli_fetch_array($run_get_movies))
		{
		 $movie_id=$row_run_get_movies['movie_id'];
		 $movie_name=$row_run_get_movies['movie_name'];
		 $movie_cast=$row_run_get_movies['movie_cast'];
		 $movie_director=$row_run_get_movies['movie_director'];
		 $movie_desc=$row_run_get_movies['movie_desc'];
		 $movie_keyword=$row_run_get_movies['movie_keyword'];
		 $movie_img1=$row_run_get_movies['movie_img1'];
		 $movie_img2=$row_run_get_movies['movie_img2'];
		 echo "<strong>Movie Name: </strong>".$movie_name."<br>";
		 echo "<strong>Cast: </strong>".$movie_cast."<br>";
		 echo "<strong>Director: </strong>".$movie_director."<br>";
		 echo "<strong>Movie Description: </strong>".$movie_desc."<br>";
		 echo "<strong>Movie Keyword: </strong>".$movie_keyword."<br>";
		 echo "</br>";
		 echo "<img src='uploaded_images/$movie_img1' width='295' height='360'>"." ";
		 echo "<img src='uploaded_images/$movie_img2' width='295' height='360'>"." ";
		}
		}
		?>
        <br>
        <a href="display_now_movies.php">
        <input type="button" value="Back" id="btn">
        </a>
		</center>
        </div>
		<div id="left_data_bar">
<video width="270" controls>
  <source src="bekhudi.mp" type="video/mp4">
  <source src="mov_bbb.ogg" type="video/ogg">
  Your browser does not support HTML5 video.
</video>

<p>
Trailor 
</p>

<div>
<h4>Buy Tickets</h4>
<form id="buyticket" class="form" method="post" action="confirmation.php">
  </div>
        
	<br><br>

	<tr>
        <td align="center">
        <select name="date"
        style="width:250px; height:40px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        <option value="Select Hall" selected="selected" disabled="disabled">Choose Date</option>
        <option value="#">17/06/2017</option>
        <option value="#">18/06/2017</option>
	<option value="#">19/06/2017</option>
	<option value="#">20/06/2017</option>
	<option value="#">21/06/2017</option>
	<option value="#">22/06/2017</option>
	<option value="#">23/06/2017</option>
        </select>
        </td>
        </tr>
	<br><br>

	
	<tr>
        <td align="center">
        <select name="time"
        style="width:250px; height:40px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        <option value="Select Hall" selected="selected" disabled="disabled">Choose Show Time</option>
        <option value="#">10 AM</option>
        <option value="#">02 PM</option>
        </select>
        </td>
        </tr>
	<br><br>
	
	
                
	<tr>
        <td align="center">
        <select name="seat"
        style="width:250px; height:40px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        <option value="Select Seat" selected="selected" disabled="disabled">Choose Seat</option>
        <option value="Premium">Premium (Each 200 Tk)</option>
        <option value="Regular">Regular (Each 100 Tk)</option>
        </select>
        </td>
        </tr>
	<br><br>
	<tr>
        <td align="center">
        <select name="seat_amount"
        style="width:250px; height:40px; background:#333; outline:0; border:#F03; text-align:center;
        color:#FFF; font-size:16px;">
        <option value="Seat Amount" selected="selected" disabled="disabled">Seat Amount (Max. 4)</option>
        <option value="1">1</option>
        <option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
        </select>
		<?php
		if(isset($_POST['confrm'])){
		 $val=$_POST['seat_amount'];
		 $val2=$val*200;
		 }
		 echo $val2;
		?>
        </td>
        </tr>
        <!-- mobile -->
        <div class="input-group" id="client_mobile_id">
         <div class="form-group is-empty"><input class="form-control" name="pickup_mobile" id="pickup_mobile" placeholder="01XXXXXXXXX" onkeyup="numericFilter(this)" autocomplete="off" type="text"><span class="material-input"></span></div>              
                        <span style="color:#8C27A0;" id="pickup_mobile_validate"></span>
                    </div>
                    <div class="input-group" id="client_mobile_id">
                        <div class="form-group is-empty"><input class="form-control" name="con_pickup_mobile" id="con_pickup_mobile" placeholder="Confirm Mobile Number" onkeyup="numericFilter(this)" autocomplete="off" type="text"><span class="material-input"></span></div>

                        <span style="color:#8C27A0;" id="con_pickup_mobile_validate"></span>
                    </div>
                    <!-- mobile -->
                    <p class=" text-center text-strong" id="priceTotal">
                        <label class="text-left">Total Cost:</label> <span class="pull-center">BDT.  0.00</span>
                        <input name="total_price" type="hidden">
                    </p>
</tr>     
                <td><input type="submit" name="submit" value="Confirm" id="btn">
            </tr>
                </div>
                

                </div>
            </form>
        </div>
    </div>
</div>
<!-- end row -->


        
    </div>
</div>

<!-----Section End----->



<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->


<form method='post' enctype='multipart/form-data'>
video:<input type='file' name='video'/><br/>
<input type='submit'/>
</form>

</body>
</html>