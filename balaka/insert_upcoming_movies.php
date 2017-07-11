<?php session_start();?>
<?php require_once('Connections/db_connection.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "admin_login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$colname_admin_users = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_admin_users = $_SESSION['MM_Username'];
}
mysql_select_db($database_db_connection, $db_connection);
$query_admin_users = sprintf("SELECT * FROM `admin` WHERE admin_email = %s", GetSQLValueString($colname_admin_users, "text"));
$admin_users = mysql_query($query_admin_users, $db_connection) or die(mysql_error());
$row_admin_users = mysql_fetch_assoc($admin_users);
$totalRows_admin_users = mysql_num_rows($admin_users);
 error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include("db.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Upcoming Movies</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS Hover Effects/css/hover.css">
<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
</head>
<body>

<!----- Start Top Bar ----->
<?php include("topbar.php");?>
<!----- End Top Bar ----->

<!----- Logo Bar Start ----->
<?php include("logobar.php");?>
<!----- Logo Bar End ----->

<!-----Section Start----->

<div id="section">
	<div id="message_bar">
    Add / Insert Movie
    </div>
    
    <div id="data_bar">
    
        <form name="insert_now_movies" action="insert_upcoming_movies.php" enctype="multipart/form-data" method="post">
        <table width="95%" align="center" cellpadding="1" cellspacing="20">
            <tr>
                <td><strong>Movie Name</strong></td>
                <td>
                <input type="text" name="movie_name" placeholder="Movie Name"
                id="insert_movie_form_name">
                </td>
        	</tr>



	<tr>
             	<td><strong>Movie Cast</strong></td>
                <td>
                <input type="text" name="movie_cast" 
                placeholder="Type Movie Cast (Max 100 Char)" id="insert_movie_form_cast">
             </tr>
            <tr>
             	<td><strong>Director Name</strong></td>
                <td>
                <input type="text" name="movie_director" 
                placeholder="Type Director Name (Max 100 Char)" id="insert_movie_form_director">
             </tr>
            
            <tr>
                <td><strong>Select Category</strong></td>
                <td>
                <select name="category_id" id="insert_movie_form_category">
                <option value="Select Category" selected="selected" disabled="disabled">
                Select Category
                </option>
                <?php
			global $con;
            $get_categories="select * from categories2";
			$run_get_categories=mysqli_query($con,$get_categories);
			while ($row_run_get_categories=mysqli_fetch_array($run_get_categories))
			{
			$category_id=$row_run_get_categories['category_id'];
			$category_name=$row_run_get_categories['category_name'];
			echo "<option value='$category_id'>$category_name</option>";
			}
			?>
                
                </select>
                </td>
        	</tr>

			<tr>
                <td><strong>Select Quality</strong></td>
                <td>
                <select name="quality_id" id="insert_movie_form_quality">
                <option value="Select quality" selected="selected" disabled="disabled">
                Select Quality
                </option>
                <?php
			global $con;
            $get_quality="select * from quality2";
			$run_get_quality=mysqli_query($con,$get_quality);
			while ($row_run_get_quality=mysqli_fetch_array($run_get_quality))
			{
			$quality_id=$row_run_get_quality['quality_id'];
			$quality_name=$row_run_get_quality['quality_name'];
			echo "<option value='$quality_id'>$quality_name</option>";
			}
			?>
                
                </select>
                </td>
        	</tr>


          <tr>
            	<td><strong>Movie Image1</strong></td>
            <td><input type="file" name="movie_img1"></td>
            </tr>
            
            <tr>
            	<td><strong>Movie Image2</strong></td>
                <td><input type="file" name="movie_img2"></td>
            </tr>
            
            <tr>
            	<td><strong>Movie Image3</strong></td>
                <td><input type="file" name="movie_img3"></td>
            </tr>
            
            
            
            
            <tr>
            	<td><strong>Movie Description</strong></td>
                <td>
                <textarea name="movie_desc" rows="10" cols="30"
                placeholder="Type Movie Description" id="insert_movie_form_desc">
                </textarea>
                </td>
            </tr>
            
             <tr>
             	<td><strong>Movie Keyword</strong></td>
                <td>
                <input type="text" name="movie_keyword" 
                placeholder="Type Movie Keyword" id="insert_movie_form_keyword">
             </tr>
            
            <tr>
            	<td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Add Movie" id="btn">
            </tr>
        </table>
        </form>
        
</div>

<!-----Section End----->





<!-----Copy Right Bar Start ---->
<?php include("copyrightbar.php");?>
<!-----Copy Right Bar End ---->

</body>
</html>


<?php
mysql_free_result($admin_users);

if(isset($_POST['submit']))
{
$movie_name='';
$movie_cast='';
$movie_director='';
$movie_category='';
$movie_quality='';
$movie_img1_name_only='';
$movie_img2_name_only='';
$movie_img3_name_only='';
$movie_img1_name='';
$movie_img2_name='';
$movie_img3_name='';
$movie_img1_tmp_name='';
$movie_img2_tmp_name='';
$movie_img3_tmp_name='';
$movie_img1_size='';
$movie_img2_size='';
$movie_img3_size='';
$movie_img1_type='';
$movie_img2_type='';
$movie_img3_type='';
$movie_desc='';
$movie_keyword='';
$status='';
$uploaded_img_size_limit=778240999999;


$movie_name=$_POST['movie_name'];
$movie_cast=$_POST['movie_cast'];
$movie_director=$_POST['movie_director'];
$movie_category=$_POST['category_id'];
$movie_quality=$_POST['quality_id'];
$movie_img1_name_only=$_FILES['movie_img1']['name'];
$movie_img2_name_only=$_FILES['movie_img2']['name'];
$movie_img3_name_only=$_FILES['movie_img3']['name'];
$movie_img1_name=time().'_'.$_FILES['movie_img1']['name'];
$movie_img2_name=time().'_'.$_FILES['movie_img2']['name'];
$movie_img3_name=time().'_'.$_FILES['movie_img3']['name'];
$movie_img1_tmp_name=$_FILES['movie_img1']['tmp_name'];
$movie_img2_tmp_name=$_FILES['movie_img2']['tmp_name'];
$movie_img3_tmp_name=$_FILES['movie_img3']['tmp_name'];
$movie_img1_size=$_FILES['movie_img1']['size'];
$movie_img2_size=$_FILES['movie_img2']['size'];
$movie_img3_size=$_FILES['movie_img3']['size'];
$movie_img1_type=$_FILES['movie_img1']['type'];
$movie_img2_type=$_FILES['movie_img2']['type'];
$movie_img3_type=$_FILES['movie_img3']['type'];
$movie_desc=$_POST['movie_desc'];
$movie_keyword=$_POST['movie_keyword'];
$status='on';


if($movie_name==''
OR $movie_cast==''
OR $movie_director=='' 
OR $movie_category=='' 
OR $movie_quality==''
OR $movie_img1_name_only=='' 
OR $movie_img2_name_only=='' 
OR $movie_img3_name_only=='' 
OR $movie_desc=='' 
OR $movie_keyword=='')
{
echo "<script>alert('Please Fill the Form Completely')</script>";
exit();
}


if($movie_img1_size>$uploaded_img_size_limit)
{
echo "<script>alert('Image 1 Size Must be Equal or Less than 756KB ')</script>";
exit();
}

if($movie_img2_size>$uploaded_img_size_limit)
{
echo "<script>alert('Image 2 Size Must be Equal or Less than 756KB ')</script>";
exit();
}


if($movie_img3_size>$uploaded_img_size_limit)
{
echo "<script>alert('Image 3 Size Must be Equal or Less than 756KB ')</script>";
exit();
}



if($movie_img1_type 	  != 'image/jpeg'
	&&  $user_picture_type != 'image/jpg'
	&&  $user_picture_type != 'image/gif'
	&& $user_picture_type  != 'image/png')
{
echo "<script>alert('Please Upload Only Image File in Image 1 ')</script>";
exit();
}


if($movie_img2_type 	  != 'image/jpeg'
	&&  $user_picture_type != 'image/jpg'
	&&  $user_picture_type != 'image/gif'
	&& $user_picture_type  != 'image/png')
{
echo "<script>alert('Please Upload Only Image File in Image 2 ')</script>";
exit();
}



if($movie_img3_type 	  != 'image/jpeg'
	&&  $user_picture_type != 'image/jpg'
	&&  $user_picture_type != 'image/gif'
	&& $user_picture_type  != 'image/png')
{
echo "<script>alert('Please Upload Only Image File in Image 3 ')</script>";
exit();
}

else
{
$uploaded_images_dir="uploaded_images/";
move_uploaded_file($movie_img1_tmp_name,$uploaded_images_dir.$movie_img1_name);
move_uploaded_file($movie_img2_tmp_name,$uploaded_images_dir.$movie_img2_name);
move_uploaded_file($movie_img3_tmp_name,$uploaded_images_dir.$movie_img3_name);

$add_movie="INSERT INTO movies2
(category_id, quality_id, movie_name, movie_cast, movie_director, 
movie_img1, movie_img2, movie_img3, movie_desc, movie_keyword, status) 
VALUES 
('$movie_category','$movie_quality','$movie_name', '$movie_cast', '$movie_director',
'$movie_img1_name','$movie_img2_name','$movie_img3_name','$movie_desc','$movie_keyword','$status')";

global $con;
$run_add_movie=mysqli_query($con,$add_movie);

if($run_add_movie)
{
echo "<script>alert('Movie Has Been Uploaded and Added ')</script>";
exit();
}

}
}

?>