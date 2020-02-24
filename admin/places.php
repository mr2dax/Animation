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
<h1>Célállomások hozzáadása</h1></br>
<form action="" method="POST">
<table border='0'><tr><td><input type="text" name="land" size="30" maxlength="32" /></td><td><input type="text" name="region" size="30" maxlength="32" /></td><td><input type="text" name="hotel" size="30" maxlength="32" /></td></tr>
<?php
	if ((isset($_POST["land"])) && (isset($_POST["region"])) && (isset($_POST["hotel"]))) {
		$land = $_POST["land"];
		$region = $_POST["region"];
		$hotel = $_POST["hotel"];
		$table = "places";
		$con = mysql_connect( "127.0.0.1", $user, $pass );
		if ( ! $con )
			die( "Nincs kapcsolat az adatbázissal." );
		mysql_select_db( $db, $con )
			or die ( "Nem lehet megnyitni a $db adatbázist: ".mysql_error() );
		$result = "INSERT INTO ". $table . " (land, region, hotel) VALUES ('" . $land . "','" . $region . "','" . $hotel . "')";
		if (!mysql_query($result,$con))
				{
				die('Error: ' . mysql_error());
				}
				else {
					if ($result) {
							echo "Célállomás hozzáadva!";
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