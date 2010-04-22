<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title>Trees are Awesome!</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center><h1>
TREES!!!
</h1></center>

<img src="http://i39.tinypic.com/2e5l7bd.png" width="531" height="475" alt="Trees" />
<p>I love trees soooooo much. Lets just blog about trees! I love small trees and big trees. I love skinny trees and fat trees.</p>
<p>Trees change colors in autumn but only deciduous ones. Autumn is my favorite season! I love to jump in a pile of leaves.</p>
<p>We need trees to live because we breathe oxygen! I think it's bad to cut down trees! Because they're nice.</p>
<p>1 tree, 2 trees; red trees, blue trees. I once found a tree in a hat and called it Matt...</p>
<p></p>
<p>...</p>
<center>
<table>
<td><font size="2" face="Verdana"><b>Add your own comment about trees:</b></td>
	<form method="POST" action="index.php">
    <tr><td><p>Your name:</p><TEXTAREA NAME="author" COLS=40 ROWS=1 value="$author"></TEXTAREA></td></tr>
	<tr><td><p>Your comment:</p><TEXTAREA NAME="comments" COLS=40 ROWS=6 value="$comments"></TEXTAREA></td></tr>
    <tr><td><input type="submit" name="submit"></td>
	</form>
    </tr>
</table>
</center>
<p></p>

<?php
 $conn = new Mongo();
 $db = $conn->trees;
 
 $collection = $db->blogs;

 $comment = $_POST['comments'];
 $author = $_POST['author'];
 if($comment!="") $collection->insert(array("text"=>$comment, "author"=>$author, "id"=>$author.$comment));
 
 $deleted = $_POST['deleted'];
 if($deleted!="") $collection->remove(array("id"=>$deleted));
 
 $edited = $_POST['edited'];
 $newText = $_POST['newText'];
 $newAuthor = $_POST['newAuthor'];
 if($edited!=""){
	$collection->update(array("id"=>$edited), array('$set'=>array("text"=>$newText)));
	$collection->update(array("id"=>$edited), array('$set'=>array("author"=>$newAuthor)));
 }
 
 $cursor = $collection->find();
 
 echo "<h1><center><table border='1' width='600'>";
 echo "<p>...</p><p>Other peoples' comments:</p>";
 echo "<input type=\"hidden\" name=\"deleted\" value=\"\" />";
 foreach($cursor as $doc) {
	if($doc['author']!="") echo "<tr><td>" . "Posted by: " . $doc['author'] . "</td>";
	else echo "<tr><td>Anonymous</td>";
    echo "<p><td>" . $doc['text'] . "</td>";
	echo "<td><form method=\"POST\" action=\"index.php\"><input type=\"submit\" value=\"delete\" name=\"delete\"></td>";
	echo "<input type=\"hidden\" name=\"deleted\" value=\"".$doc['id']."\" /></form>";
	echo "<td><form method=\"POST\" action=\"edit.php\"><input type=\"submit\" value=\"edit\" name=\"edit\"></td>";
	echo "<input type=\"hidden\" name=\"edited\" value=\"".$doc['id']."\" />";
	echo "<input type=\"hidden\" name=\"text\" value=\"".$doc['text']."\" />";
	echo "<input type=\"hidden\" name=\"author\" value=\"".$doc['author']."\" /></form></tr>";
}
echo "</table></center></h1>";

$conn->close();
?><p></p>

</body>
</html>