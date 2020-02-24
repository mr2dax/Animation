<?php 

require 'config.php';
include "../conf.php";

?>
<!DOCTYPE html PUBLIC
"-//W3C/DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title> ADMIN </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<h1>Hír hozzáadása</h1></br>
<form action="" method="POST">
<table border='0'><tr><td><input type="text" name="title" size="30" maxlength="32" /></td><td><textarea name="text" rows="10" cols="20"></textarea></td></tr>
<?php
	if ((isset($_POST["title"])) && (isset($_POST["text"]))) {
		$title = $_POST["title"];
		$text = $_POST["text"];
		$table = "feed";
		$con = mysql_connect( "127.0.0.1", $user, $pass );
		if ( ! $con )
			die( "Nincs kapcsolat az adatbázissal." );
		mysql_select_db( $db, $con )
			or die ( "Nem lehet megnyitni a $db adatbázist: ".mysql_error() );
		$result = "INSERT INTO ". $table . " (title, news) VALUES ('" . $title . "','" . $text . "')";
		if (!mysql_query($result,$con))
				{
				die('Error: ' . mysql_error());
				}
				else {
					if ($result) {
							echo "Hír hozzáadva!";
							}
					}
		mysql_close($con);
	}
?>
</table>
<br />
<input type="submit" value="Küld" /> 
<input type="reset" value="Töröl" />
</form>
</br></br>
<form name=logout method=POST action="<?php echo CONTROLLER; ?>">
<input type=hidden name=command value='back'/><input type=submit value=Vissza></form>
</body>
</html>