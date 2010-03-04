<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add a Band</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<form method="post" action="postBand.php">

<br/>
<br/>
<h1>
<a href="http://localhost/bands2/"><img src="images/logo.gif" width="118" height="25" alt="Rock Band" /></a><br/>
Enter the following information to add a new Band
</h1>
<br/>
<table>
<tr>
<td><b>Band Name:</b></td><td><input text="" name="band_name" size="15"/></td>
</tr>
</table>
<table>
<tr>
<td><h2>Hometown City and State: <h2></br></td>              
</tr>
<table>
<tr>
<td><b>City:</b></td>  <td><input text="" name="city" size="50" /> </td></tr>
	
<td><b>State(abbreviation):<b></td><td>  <input text="" name="state" size="2" /></td>
</tr>
</table>
<table>
<tr>
<td><b>Genre:<b></tr>
				<tr>
				<tr><td><input text="" name="genre1" size="20" /></td></tr>
				<tr><td><input text="" name="genre2" size="20" /></td></tr>
				<tr><td><input text="" name="genre3" size="20" /></tr></td>
				</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr><td>Description:</td></tr>
<tr><td><TEXTAREA NAME="description" COLS=40 ROWS=6></TEXTAREA></td>
</tr>
<tr>
<td>Albums:</td></tr>
<tr><td><input text="" name="albums1" size="20"/></td></tr>
<tr><td><input text="" name="albums2" size="20"/></td></tr>
<tr><td><input text="" name="albums3" size="20"/></td></tr>
<tr><td><input text="" name="albums4" size="20"/></td></tr>
<tr><td><input text="" name="albums5" size="20"/></td></tr>
<tr>
<td>Picture File:</td><td><input type="file" id="picture" name="picture"  /></td>
</tr>
<tr>
<td>
<input type="submit" name="submit" value="Submit"/>
<input type="reset" name="reset" value="Clear Form"/>
</td>
</tr>
</table>
</body>
</html>