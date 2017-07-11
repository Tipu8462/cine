<?php

$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if ((($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "audio/wma")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg"))

&& ($_FILES["file"]["size"] < 20000)
&& in_array($extension, $allowedExts))

  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>

shareimprove this answer
	
edited May 23 at 12:34
Community?
11
	
answered Aug 13 '13 at 21:37
Fred -ii-
75k94281
	
   	 
	
exactly what i need at least for the time being will edit it later for better functionaity thanks a lot :) – ustone07 Aug 20 '13 at 16:40
4 	 
	
This is an example of a really good answer, simple, practical, precise, includes code, the code tackles all possible scenarios, not a selfless "take a look at the documentation" answer. Very well done! – adelriosantiago Jan 5 '15 at 2:19
2 	 
	
@AlejandrodelRío Thank you Alejandro, cheers – Fred -ii- Jan 5 '15 at 2:21
   	 
	
Videos no bigger than 20000 bytes? :-/ – Chuck Le Butt Jul 9 '15 at 11:01
   	 
	
Why i cant upload a .MOV file.. I commented the file $extension – Leoh Jul 30 '15 at 13:54
show 4 more comments
up vote
1
down vote
	

HTML Code

<html>
<body>

<head>
<title></title>
</head>

<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file"><span>Filename:</span></label>
    <input type="file" name="file" id="file" /> 
    <br />
<input type="submit" name="submit" value="Submit" />
</form>



<?php

    //============================= DATABASE CONNECTIVITY d ====================
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    else

    //============================= DATABASE CONNECTIVITY u ====================
    //============================= Retrieve data from DB d ====================
    $sql = "SELECT name, size, type FROM videos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
        {
        $path = "uploaded/" . $row["name"];

            echo $path . "<br>";

        }
    } else {
        echo "0 results";
    }
    $conn->close();
    //============================= Retrieve data from DB d ====================

?>


</body>
</html>

