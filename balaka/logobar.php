
<div id="logo">
	
  <?php 
$add_movie="SELECT * FROM movies";

global $con;
$result=mysqli_query($con,$add_movie);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<a href = "details.php?movie_id='. $row['movie_id'] .'"><img class="mySlides" src="uploaded_images/' . $row['movie_img1'] . '" style="height: 500px;width:100%"></a>';
    }
}

?>

</div>
<script>

var slideIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1} 
    x[slideIndex-1].style.display = "block"; 
    setTimeout(carousel, 3000); // Change image every 2 seconds
}
</script>

