<?php
global $db;
$db=mysqli_connect("localhost","root","","balaka");


function getmovie()
{
		global $db;
		if(!isset($_GET['category']))
		{
		if(!isset($_GET['quality']))
		{
        $get_movies="select * from movies where status='on'
		order by rand() LIMIT 0,6";
		$run_get_movies=mysqli_query($db,$get_movies);
		while($row_run_get_movies=mysqli_fetch_array($run_get_movies))
		{
		 $movie_id=$row_run_get_movies['movie_id'];
		 $movie_name=$row_run_get_movies['movie_name'];
		 $movie_cast=$row_run_get_movies['movie_cast'];
		 $movie_img1=$row_run_get_movies['movie_img1'];
		 $movie_img2=$row_run_get_movies['movie_img2'];
		 echo 
		 "
		 <div id='single_movie'>
		 <b style='background:#ffffff; 
		 color:#ff0000; font-family:'Times New Roman', Times, serif;>
		 Movie:&nbsp; $movie_name &nbsp; <br> &nbsp; Cast:&nbsp;$movie_cast</b>
		 <br>
		 <br>
		 <img src='uploaded_images/$movie_img1' width='100%' height='100%'>
		 <div id='caption_single_movie'>
		 <br>
		 <img src='uploaded_images/$movie_img2' width='100%' height='80%'>
		 <br>
		 <a href='details.php?movie_id=$movie_id'>
		 <input name='Detail' type='button' value='Detail' id='btn' />
		 </a> 
		 ||
		 <a href='cart.php?add_cart=$movie_id'> 
		 <input name='Add to Cart' type='button' value='Buy Ticket' id='btn' />
		 </a>
		 </div>
		 </div>
		 ";
		}
		}
		}
		}


function getcategorymovie()
{
		
		global $db;
		if(isset($_GET['category']))
		{
		$category_id=$_GET['category'];
        $get_movies="select * from movies 
		where category_id='$category_id' AND status='on'
		order by rand() LIMIT 0,6";
		$run_get_movies=mysqli_query($db,$get_movies);
		while($row_run_get_movies=mysqli_fetch_array($run_get_movies))
		{
		 $movie_id=$row_run_get_movies['movie_id'];
		 $movie_name=$row_run_get_movies['movie_name'];
		 $movie_cast=$row_run_get_movies['movie_cast'];
		 $movie_img1=$row_run_get_movies['movie_img1'];
		 $movie_img2=$row_run_get_movies['movie_img2'];
		 echo 
		 "
		 <div id='single_movie'>
		 <b style='background:#ffffff; 
		 color:#ff0000; font-family:'Times New Roman', Times, serif;'>
		 Movie:&nbsp; $movie_name &nbsp; <br> &nbsp; Cast:&nbsp;$movie_cast</b>
		 <br>
		 <br>
		 <img src='uploaded_images/$movie_img1' width='100%' height='100%'>
		 <div id='caption_single_movie'>
		 <br>
		 <img src='uploaded_images/$movie_img2' width='100%' height='80%'>
		 <br>
		 <a href='details.php?movie_id=$movie_id'>
		 <input name='Detail' type='button' value='Detail' id='btn' />
		 </a> 
		 ||
		 <a href='cart.php?add_cart=$movie_id'> 
		 <input name='Add to Cart' type='button' value='Cart' id='btn' />
		 </a>
		 </div>
		 </div>
		 ";
		}
		}
		}






function getqualitymovie()
{
		
		global $db;
		
		if(isset($_GET['quality']))
		{
		$quality_id=$_GET['quality'];
        $get_movies="select * from movies
		where quality_id='$quality_id' AND status='on'
		order by rand() LIMIT 0,6";
		$run_get_movies=mysqli_query($db,$get_movies);
		while($row_run_get_movies=mysqli_fetch_array($run_get_movies))
		{
		 $movie_id=$row_run_get_movies['movie_id'];
		 $movie_name=$row_run_get_movies['movie_name'];
		 $movie_cast=$row_run_get_movies['movie_cast'];
		 $movie_img1=$row_run_get_movies['movie_img1'];
		 $movie_img2=$row_run_get_movies['movie_img2'];
		 echo 
		 "
		 <div id='single_movie'>
		 <b style='background:#ffffff; 
		 color:#ff0000; font-family:'Times New Roman', Times, serif;'>
		 Movie:&nbsp; $movie_name &nbsp;<br> &nbsp; Cast:&nbsp;$movie_cast</b>
		 <br>
		 <br>
		 <img src='uploaded_images/$movie_img1' width='100%' height='100%'>
		 <div id='caption_single_movie'>
		 <br>
		 <img src='uploaded_images/$movie_img2' width='100%' height='80%'>
		 <br>
		 <a href='details.php?movie_id=$movie_id'>
		 <input name='Detail' type='button' value='Detail' id='btn' />
		 </a> 
		 ||
		 <a href='cart.php?add_cart=$movie_id'> 
		 <input name='Add to Cart' type='button' value='Cart' id='btn' />
		 </a>
		 </div>
		 </div>
		 ";
		}
		}
		}
		





function getcategory()
			{
			global $db;
            $get_categories="select * from categories";
			$run_get_categories=mysqli_query($db,$get_categories);
			while ($row_run_get_categories=mysqli_fetch_array($run_get_categories))
			{
			$category_id=$row_run_get_categories['category_id'];
			$category_name=$row_run_get_categories['category_name'];
			echo "<li><a href='display_now_movies.php?category=$category_id'>
			<i class='fa fa-check-circle'></i>&nbsp; $category_name</a></li>";
			}
			}


function getquality()
			{
			global $db;
            		$get_quality="select * from quality";
			$run_get_quality=mysqli_query($db,$get_quality);
			while ($row_run_get_quality=mysqli_fetch_array($run_get_quality))
			{
			$quality_id=$row_run_get_quality['quality_id'];
			$quality_name=$row_run_get_quality['quality_name'];
			echo "<li><a href='display_now_movies.php?quality=$quality_id'>
			<i class='fa fa-check-circle'></i>&nbsp; $quality_name</a></li>";
			}
			}


//Upcoming Movie

function getmovie2()
{
		global $db;
		if(!isset($_GET['category']))
		{
		if(!isset($_GET['quality']))
		{
        $get_movies="select * from movies2 where status='on'
		order by rand() LIMIT 0,6";
		$run_get_movies=mysqli_query($db,$get_movies);
		while($row_run_get_movies=mysqli_fetch_array($run_get_movies))
		{
		 $movie_id=$row_run_get_movies['movie_id'];
		 $movie_name=$row_run_get_movies['movie_name'];
		 $movie_cast=$row_run_get_movies['movie_cast'];
		 $movie_img1=$row_run_get_movies['movie_img1'];
		 $movie_img2=$row_run_get_movies['movie_img2'];
		 echo 
		 "
		 <div id='single_movie'>
		 <b style='background:#ffffff; 
		 color:#ff0000; font-family:'Times New Roman', Times, serif;>
		 Movie:&nbsp; $movie_name &nbsp; <br> &nbsp; Cast:&nbsp;$movie_cast</b>
		 <br>
		 <br>
		 <img src='uploaded_images/$movie_img1' width='100%' height='100%'>
		 <div id='caption_single_movie'>
		 <br>
		 <img src='uploaded_images/$movie_img2' width='100%' height='80%'>
		 <br>
		 <a href='details2.php?movie_id=$movie_id'>
		 <input name='Detail' type='button' value='Detail' id='btn' />
		 </a> 
		 ||
		 <a href='cart.php?add_cart=$movie_id'> 
		 <input name='Add to Cart' type='button' value='Buy Ticket' id='btn' />
		 </a>
		 </div>
		 </div>
		 ";
		}
		}
		}
		}


function getcategorymovie2()
{
		
		global $db;
		if(isset($_GET['category']))
		{
		$category_id=$_GET['category'];
        $get_movies="select * from movies2 
		where category_id='$category_id' AND status='on'
		order by rand() LIMIT 0,6";
		$run_get_movies=mysqli_query($db,$get_movies);
		while($row_run_get_movies=mysqli_fetch_array($run_get_movies))
		{
		 $movie_id=$row_run_get_movies['movie_id'];
		 $movie_name=$row_run_get_movies['movie_name'];
		 $movie_cast=$row_run_get_movies['movie_cast'];
		 $movie_img1=$row_run_get_movies['movie_img1'];
		 $movie_img2=$row_run_get_movies['movie_img2'];
		 echo 
		 "
		 <div id='single_movie'>
		 <b style='background:#ffffff; 
		 color:#ff0000; font-family:'Times New Roman', Times, serif;'>
		 Movie:&nbsp; $movie_name &nbsp; <br> &nbsp; Cast:&nbsp;$movie_cast</b>
		 <br>
		 <br>
		 <img src='uploaded_images/$movie_img1' width='100%' height='100%'>
		 <div id='caption_single_movie'>
		 <br>
		 <img src='uploaded_images/$movie_img2' width='100%' height='80%'>
		 <br>
		 <a href='details2.php?movie_id=$movie_id'>
		 <input name='Detail' type='button' value='Detail' id='btn' />
		 </a> 
		 ||
		 <a href='cart.php?add_cart=$movie_id'> 
		 <input name='Add to Cart' type='button' value='Cart' id='btn' />
		 </a>
		 </div>
		 </div>
		 ";
		}
		}
		}


function getqualitymovie2()
{
		
		global $db;
		
		if(isset($_GET['quality']))
		{
		$quality_id=$_GET['quality'];
        $get_movies="select * from movies2
		where quality_id='$quality_id' AND status='on'
		order by rand() LIMIT 0,6";
		$run_get_movies=mysqli_query($db,$get_movies);
		while($row_run_get_movies=mysqli_fetch_array($run_get_movies))
		{
		 $movie_id=$row_run_get_movies['movie_id'];
		 $movie_name=$row_run_get_movies['movie_name'];
		 $movie_cast=$row_run_get_movies['movie_cast'];
		 $movie_img1=$row_run_get_movies['movie_img1'];
		 $movie_img2=$row_run_get_movies['movie_img2'];
		 echo 
		 "
		 <div id='single_movie'>
		 <b style='background:#ffffff; 
		 color:#ff0000; font-family:'Times New Roman', Times, serif;'>
		 Movie:&nbsp; $movie_name &nbsp;<br> &nbsp; Cast:&nbsp;$movie_cast</b>
		 <br>
		 <br>
		 <img src='uploaded_images/$movie_img1' width='100%' height='100%'>
		 <div id='caption_single_movie'>
		 <br>
		 <img src='uploaded_images/$movie_img2' width='100%' height='80%'>
		 <br>
		 <a href='details2.php?movie_id=$movie_id'>
		 <input name='Detail' type='button' value='Detail' id='btn' />
		 </a> 
		 ||
		 <a href='cart.php?add_cart=$movie_id'> 
		 <input name='Add to Cart' type='button' value='Cart' id='btn' />
		 </a>
		 </div>
		 </div>
		 ";
		}
		}
		}
		





function getcategory2()
			{
			global $db;
            $get_categories="select * from categories2";
			$run_get_categories=mysqli_query($db,$get_categories);
			while ($row_run_get_categories=mysqli_fetch_array($run_get_categories))
			{
			$category_id=$row_run_get_categories['category_id'];
			$category_name=$row_run_get_categories['category_name'];
			echo "<li><a href='display_upcoming_movies.php?category=$category_id'>
			<i class='fa fa-check-circle'></i>&nbsp; $category_name</a></li>";
			}
			}


function getquality2()
			{
			global $db;
            		$get_quality="select * from quality2";
			$run_get_quality=mysqli_query($db,$get_quality);
			while ($row_run_get_quality=mysqli_fetch_array($run_get_quality))
			{
			$quality_id=$row_run_get_quality['quality_id'];
			$quality_name=$row_run_get_quality['quality_name'];
			echo "<li><a href='display_upcoming_movies.php?quality=$quality_id'>
			<i class='fa fa-check-circle'></i>&nbsp; $quality_name</a></li>";
			}
			}


function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();







function cart()
{
if(isset($_GET['add_cart']))
{
global $db;
$ip_add=getUserIP();
$p_id=$_GET['add_cart'];
$check_pro="select * from cart where ip_add='$ip_add' AND movie_id='$p_id'";
$run_check_pro=mysqli_query($db,$check_pro);
if(mysqli_num_rows($run_check_pro)>0)
{
echo "";
}
else
{
global $db;
$q="insert into cart (movie_id,ip_add) values('$p_id','$ip_add')";
$run_q=mysqli_query($db,$q);
echo "<script>window.open('index.php','_self')</script>";
}
}
}



function get_items()
{
if(isset($_GET['add_cart']))
{
global $db;
$ip_add=getUserIP();
$p_id=$_GET['add_cart'];
$get_items="select * from cart where ip_add='$ip_add'";
$run_get_items=mysqli_query($db,$get_items);
$count_items=mysqli_num_rows($run_get_items);
}
else
{
global $db;
$ip_add=getUserIP();
$p_id=$_GET['add_cart'];
$get_items="select * from cart where ip_add='$ip_add'";
$run_get_items=mysqli_query($db,$get_items);
$count_items=mysqli_num_rows($run_get_items);
}
echo $count_items;
}







function get_price()
{
global $db;
$ip_add=getUserIP();
$total_price=0;
$sel_price="select * from cart where ip_add='$ip_add'";
$run_sel_price=mysqli_query($db,$sel_price);
while($record=mysqli_fetch_array($run_sel_price))
{
$movie_id=$record['movie_id'];
$pro_price="select * from movies where movie_id='$movie_id'";
$run_pro_price=mysqli_query($db,$pro_price);
while ($p_price=mysqli_fetch_array($run_pro_price))
{
$movie_price=array($p_price['movie_price']);
$values=array_sum($movie_price);
$total_price= $total_price + $values;
}
}
echo " Tk. ".$total_price." /- ";
}





function get_default()
{
$customer_email=$_SESSION['customer_email'];
$get_customer="select * from customer where customer_email='$customer_email'";
global $db;
$run_get_default=mysqli_query($db,$get_customer);
$record=mysqli_fetch_array($run_get_default);
$customer_id=$record['customer_id'];

if(!isset($_GET['my_orders']))
{
if(!isset($_GET['edit_account']))
{
if(!isset($_GET['change_password']))
{
if(!isset($_GET['delete_account']))
{
$get_orders="select * from customer_orders where customer_id='$customer_id' AND order_status='Pending'";
global $db;
$run_get_orders=mysqli_query($db,$get_orders);
$count_orders=mysqli_num_rows($run_get_orders);
if($count_orders>0)
{
echo "
	<h1>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Important Information for Customer!
	</h1>
	<center>
	<div style='padding:10px;'>
	<h3>You Have <span style='color:#e71838;'>$count_orders</span> Pending Order's </h3>
	</div>
	</center>
	
	<center>
	<div style='padding:10px;'>
	<h3>If You Want to Check Detail of Your Booking's then:
	<a href='customer_account.php?my_orders'>
	Click Here
	</a>
	</h3>
	</div>
	</center>
	
	";
}
else
{
echo "
	<h1>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Important Information for Customer!
	</h1>
	<center>
	<div style='padding:10px;'>
	<h3>You Have 'NO' Pending Booking's </h3>
	</div>
	</center>
	
	<center>
	<div style='padding:10px;'>
	<h3>If You Want to Check Detail of Your Booking's then:
	<a href='customer_account.php?my_orders'>
	Click Here
	</a>
	</h3>
	</div>
	</center>
	
	";
}
}
}
}
}
}

?>