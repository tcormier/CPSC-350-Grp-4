<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title>Trees</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php

$author = $_POST['author'];
$text = $_POST['text'];
$_id = $_POST['edited'];

echo "
<img src=\"http://www2.slac.stanford.edu/tip/2005/may6/trees-web.jpg\" width=\"450\" height=\"326\" alt=\"Trees\" />
<p></p>
<p></p>
<table>
<td><font size=\"2\" face=\"Verdana\"><b>Edit your comment:</b></td>
    </tr>
    <form method=\"POST\" action=\"index.php\">
	<tr>
    <td><p>Author:</p><TEXTAREA name=\"newAuthor\" COLS=40 ROWS=1 value=\"$newAuthor\">$author</TEXTAREA></td>
    </tr>
	<tr>
    <td><p>Comment:</p><TEXTAREA name=\"newText\" COLS=40 ROWS=6 value=\"$newText\">$text</TEXTAREA></td>
    </tr>
    <tr>
    <td>
    <input type=\"submit\" name=\"submit\"></td>
	<input type=\"hidden\" name=\"edited\" value=\"".$_id."\" />
	</form>
    </tr>
</table>
<p></p>

";?>

<p></p>
<img src="http://dolphinblueinc.files.wordpress.com/2009/09/maple-trees-12_3.jpg" width="200" height="150" alt="Trees" />
</body>
</html>