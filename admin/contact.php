<?php

require 'config.php';
include "../conf.php";

function edit ($t, $i, $te) {
	echo "<br> $te szekci� m�dos�t�sa... <br><br>";

	include "../conf.php";

	if (isset($_POST["text"]))
            {
            $text = $_POST["text"];
            }
    else    {
            $text = "";
            }
	$table = $t;
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	if ($text<>"")
			{
			$result = "UPDATE ". $table . " SET id='$i', text='" . $text . "' WHERE id='$i'";
			if (!mysql_query($result,$con)) {
				echo "Hiba!";
			}
			else {
				echo "M�dos�tva!";
				$con = mysql_connect( "127.0.0.1", $user, $pass );
				if ( ! $con )
					die( "Nincs kapcsolat az adatb�zissal." );
				mysql_select_db( $db, $con )
					or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
				$result = mysql_query( "SELECT id, text FROM " . $table . " WHERE id='$i'");
				if ($result) {
						$row = mysql_fetch_array($result);
						$$i = $row['text'];
						mysql_free_result($result);
				}
				else { echo "<br/>" . "Lek�rdez�s nem siker�lt!";}
			}
	}
	mysql_close( $con );

	$table = $t;
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query( "SELECT id, text FROM " . $table . " WHERE id='$i'");
	if ($result) {
			echo "<table border='0'>";
			$row = mysql_fetch_array($result);
			$$i = $row['text'];
			echo "<tr>";
			echo "<td><textarea name=\"text\" rows=\"10\" cols=\"20\">" . $$i . "</textarea></td>";
			echo "</tr>";
			mysql_free_result($result);
			echo "</table>";
	}
	else { echo "<br/>" . "Lek�rdez�s nem siker�lt!";}
mysql_close( $con );
}
?>

<!DOCTYPE html PUBLIC
"-//W3C/DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>ADMIN</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<h1>Kontakt</h1></br>
<form action="" method="POST">
<?php
	edit("text", "contact", "A kontakt");
?>
<br />
<input type="submit" value="K�ld" />
</form>
<br /><br />
</form>
<form name=logout method=POST action="<?php echo CONTROLLER; ?>">
<input type=hidden name=command value='back'/><input type=submit value=Vissza></form>
</body>
</html>
