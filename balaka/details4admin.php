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
    Welcome to You @ Balaka Cinema Hall >>
    </div>
    
    <div id="data_bar">

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
		 $movie_img3=$row_run_get_movies['movie_img3'];
		 echo "<strong>Movie Name: </strong>".$movie_name."<br>";
		 echo "<strong>Cast: </strong>".$movie_cast."<br>";
		 echo "<strong>Director: </strong>".$movie_director."<br>";
		 echo "<strong>Movie Description: </strong>".$movie_desc."<br>";
		 echo "<strong>Movie Keyword: </strong>".$movie_keyword."<br>";
		 echo "</br>";
		 echo "<img src='uploaded_images/$movie_img1' width='295' height='360'>"." ";
		 echo "<img src='uploaded_images/$movie_img2' width='295' height='360'>"." ";
		 echo "<img src='uploaded_images/$movie_img3' width='295' height='360'>"."</br>";
		}
		}
		?>
        <br>
        <a href="cms_movies.php">
        <input type="button" value="Back" id="btn">
        </a>
		</center>
        </div>
        
    </div>
</div>

<!-----Section End----->



<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>