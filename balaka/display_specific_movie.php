<?php require_once('Connections/db_connection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_display_specific_movie = "-1";
if (isset($_GET['movie_id'])) {
  $colname_display_specific_movie = $_GET['movie_id'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_display_specific_movie = sprintf("SELECT * FROM movies WHERE movie_id = %s", GetSQLValueString($colname_display_specific_movie, "int"));
$display_specific_movie = mysql_query($query_display_specific_movie, $db_connection) or die(mysql_error());
$row_display_specific_movie = mysql_fetch_assoc($display_specific_movie);
$totalRows_display_specific_movie = mysql_num_rows($display_specific_movie);
 error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
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
        	<?php
			global $con;
            $get_categories="select * from categories";
			$run_get_categories=mysqli_query($con,$get_categories);
			while ($row_run_get_categories=mysqli_fetch_array($run_get_categories))
			{
			$category_id=$row_run_get_categories['category_id'];
			$category_name=$row_run_get_categories['category_name'];
			echo "<li><a href='index.php?cat=$category_id'>
			<i class='fa fa-check-circle'></i>&nbsp; $category_name</a></li>";
			}
			?>
        </ul>
        <br>
        <center><h1>Brands</h1></center>
        <br>
        <ul>
        	<?php
			global $con;
            $get_brands="select * from brands";
			$run_get_brands=mysqli_query($con,$get_brands);
			while ($row_run_get_brands=mysqli_fetch_array($run_get_brands))
			{
			$brand_id=$row_run_get_brands['brand_id'];
			$brand_name=$row_run_get_brands['brand_name'];
			echo "<li><a href='index.php?brand=$brand_id'>
			<i class='fa fa-check-circle'></i>&nbsp; $brand_name</a></li>";
			}
			?>
        </ul>
        </div>
        
        <div id="right_data_bar">
        <center><h2>Specific Movie Information</h2></center>
        <table width="90%" align="center" cellpadding="5" cellspacing="5">
        	<tr>
            	<td bgcolor="#e71838"><strong>Movie Title</strong></td>
                <td bgcolor="#eeeeee">
                <?php echo $row_display_specific_movie['movie_title']; ?>
                </td>
            </tr>
            
            <tr>
            	<td bgcolor="#e71838"><strong>Movie Price</strong></td>
                <td bgcolor="#eeeeee">
                <?php echo $row_display_specific_movie['movie_price']; ?>
                </td>
            </tr>
            
            <tr>
            	<td bgcolor="#e71838"><strong>Movie Description</strong></td>
                <td bgcolor="#eeeeee">
                <?php echo $row_display_specific_movie['movie_desc']; ?>
                </td>
            </tr>
            
            <tr>
            	<td bgcolor="#e71838"><strong>Movie Keyword</strong></td>
                <td bgcolor="#eeeeee">
                <?php echo $row_display_specific_movie['movie_keyword']; ?>
                </td>
            </tr>
            
            <tr>
            	<td bgcolor="#e71838"><strong>Movie Status</strong></td>
                <td bgcolor="#eeeeee">
                <?php echo $row_display_specific_movie['status']; ?>
                </td>
            </tr>
            
            <tr>
            	<td bgcolor="#e71838"><strong>Movie Image 1</strong></td>
                <td bgcolor="#eeeeee">
                <img src="uploaded_images/<?php echo $row_display_specific_movie['movie_img1']; ?>" width="150" height="150">
                </td>
            </tr>
            
            <tr>
            	<td bgcolor="#e71838"><strong>Movie Image 2</strong></td>
                <td bgcolor="#eeeeee">
                <img src="uploaded_images/<?php echo $row_display_specific_movie['movie_img2']; ?>" width="150" height="150">
                </td>
            </tr>
            
            <tr>
            	<td bgcolor="#e71838"><strong>Movie Image 3</strong></td>
                <td bgcolor="#eeeeee">
                <img src="uploaded_images/<?php echo $row_display_specific_movie['movie_img3']; ?>" width="150" height="150">
                </td>
            </tr>
            
            
        </table>
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
<?php
mysql_free_result($display_specific_movie);
?>
