<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
<?php include("functions.php");?>
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
    Welcome to You @ Balaka Cinema Hall >>
    </div>
    
    <div id="data_bar">
    	<div id="left_data_bar">
        
        <center><h1>Categories</h1></center>
        <br>
        <ul>
        <?php getcategory(); ?>
        </ul>
        <br>
        <center><h1>Brands</h1></center>
        <br>
        <ul>
        <?php getbrands(); ?>	
        </ul>
        </div>
        
        <div id="right_data_bar">
        <center><h2>Display Movies</h2></center>
        <br />

		<?php
		global $con;
		if(isset($_GET['search_btn']))
		{
		$user_search=$_GET['search'];
        $get_movies="select * from movies 
		where movie_keyword like '%$user_search%'
		order by rand() LIMIT 0,6";
		$run_get_movies=mysqli_query($con,$get_movies);
		while($row_run_get_movies=mysqli_fetch_array($run_get_movies))
		{
		 $movie_id=$row_run_get_products['movie_id'];
		 $movie_name=$row_run_get_movies['movie_name'];
		 $movie_price=$row_run_get_movies['movie_price'];
		 $movie_img1=$row_run_get_movies['movie_img1'];
		 $movie_img2=$row_run_get_movies['movie_img2'];
		 echo 
		 "
		 <div id='single_movie'>
		 <b style='background:#e71838; 
		 color:#FFF; font-family:'Times New Roman', Times, serif;'>
		 Movie:&nbsp; $movie_name &nbsp;||&nbsp; Price:&nbsp;$movie_price</b>
		 <br>
		 <br>
		 <img src='uploaded_images/$movie_img1' width='90%' height='90%'>
		 <div id='caption_single_movie'>
		 <br>
		 <img src='uploaded_images/$movie_img2' width='80%' height='90%'>
		 <br>
		 <a href='details.php?pro_id=$movie_id'>
		 <input name='Detail' type='button' value='Detail' id='btn' />
		 </a> 
		 ||
		 <a href='index.php?add_cart=$movie_id'> 
		 <input name='Add to Cart' type='button' value='Cart' id='btn' />
		 </a>
		 </div>
		 </div>
		 ";
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