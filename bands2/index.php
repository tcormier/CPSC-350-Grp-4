<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<title>Bands and Venue Search</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
	<ul id="nav">
		<li><a href="http://localhost/bands2/">home</a></li>
		<li><a href="http://localhost/bands2/addBand.php">add band</a></li>
		<li><a href="http://localhost/bands2/addVenue.php">add venue</a></li>
		<li><a href="http://localhost/bands2/">login</a></li>
	</ul>
	<h1><a href="http://localhost/bands2/"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a></h1>
	<div id="body">
		<div id="bodyi">
			<div id="bodyj">
				<div id="sidebar">
					<div class="content">
						<h2>Seaches</h2>
						<p><b>Search For Artists</b></p>
						<form method="post" action="searchName.php">
						<input type="text" id="searchbox" name="searchbox" />
						<input type="submit" value="go" name="submit" />
						</form>
	
						<p><b>Search For Venue</b></p>
						<form method="post" action="searchVenue.php">
						<input type="text" id="searchbox" name="searchbox" />
						<input type="submit" value="go" name="submit" />
						</form>
					</div>
					<div class="divider"></div>
					<div class="content">
						<h2>Featured Artist &amp; Updates</h2>
						<h3>June 23, 2005</h3>
						<p><?php include "featured.php"?>
						<img src="images/pic_3.jpg" width="65" height="43" alt="pic 3" />
						</p>
					</div>
				</div>
				<div id="content">
					<img src="images/dmb.jpg" width="346" height="234" alt="dmb" />
					<div class="content">
						<h2>Latest Album</h2>
						<img src="images/pic_4.jpg" width="82" height="80" alt="Unwired album cover" class="left" />
						<p>This is one of the albums of one of the artists that we recomend
						you go see. You will have a blast at any one of our featured bands,
						but this is one band that you can't miss in concert.</p>
						<div class="divider"></div>
						<h2>Featured Venue</h2>
						<?php
						include "db_connect.php";
						$query = "SELECT description, location, venue FROM venue ORDER BY RAND() LIMIT 1;";
						$result = mysqli_query($db, $query)
						or die("Error Querying Database");
						while($row = mysqli_fetch_array($result)) {
	
						$description = $row['description'];
						$location = $row['location'];
						//$picture = $row['picture_file'];
	
						$name = $row['venue_name'];
																	}?>
						<table summary="Venue" border="0" cellspacing="0">
						<tr>
							<th width="55%">Venue</th>
							<?php echo "<td> $name </td>";?>
							<th>Place</th>
						</tr>
						<tr>
							<td><img src="images/pic_5.jpg" width="94" height="90" alt="Venue" class="left" /></td>
							<?php echo "<td> $location</td>";?>
						</tr>
						<th>Description</th>
						<?php echo "<td> $description </td>";?>
						</table>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<p id="power">Powered by Artist and Venue Search</p>
</div>
</body>
</html>