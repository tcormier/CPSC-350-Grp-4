<b>Featured Band</b>
<?php
 include "db_connect.php";
 $query = "SELECT description, hometown, band_name FROM band ORDER BY RAND() LIMIT 1;";
 $result = mysqli_query($db, $query)
 or die("Error Querying Database");

 while($row = mysqli_fetch_array($result)) {
	
	$description = $row['description'];
	$location = $row['hometown'];
	//$picture = $row['picture_file'];
	
	$name = $row['band_name'];
 }
 
 //<img src="$picture">
 echo "<div class='content'><p>$name</p>";
 echo "<p>$location</p>";
 
 echo "<p>$description</p></div>";
 ?>