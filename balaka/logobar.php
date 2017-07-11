<div id="logo">
	<div class="w3-content w3-display-container">
  <img class="mySlides" src="../images/coffee.jpg" style="width:100%">
  <img class="mySlides" src="../images/sound.jpg" style="width:100%">
  <img class="mySlides" src="../images/workbench.jpg" style="width:100%">
</div>
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

