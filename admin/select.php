<?php 

require 'config.php';
include "../conf.php";

?>
<!DOCTYPE html PUBLIC
"-//W3C/DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title> Keresés </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<h1>Keresés az adatbázisban</h1></br>
<form action="" method="POST">
Tapasztalat: <br /><input type="radio" name="animexp" value="1" checked /> Já<br />
<input type="radio" name="animexp" value="0" /> Nájn <br /><br />
Nyelvtudás: <input type="text" name="languages" size="30" maxlength="32" />
<br /><br />
<input type="submit" value="Küld" /> 
<input type="reset" value="Töröl" />
</form>
</br>
<form name=logout method=POST action="<?php echo CONTROLLER; ?>">
<input type=hidden name=command value='back'/><input type=submit value=Vissza></form>
</body>
</html>
<?php
if ((isset($_POST["animexp"])) && (isset($_POST["languages"])))
            {
            $animexp = $_POST["animexp"];
			$languages = $_POST["languages"];
            }
    else    {
            $animexp = "";
			$languages = "";
            }
	$table = "appdata";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatbázissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatbázist: ".mysql_error() );
	if (($animexp<>"") && ($languages)<>"")
			{
			$result = mysql_query( "SELECT * FROM " . $table . " WHERE langs LIKE '%" . $languages . "%' AND anim=" . $animexp . " ORDER BY sdate DESC");
			if ($result) {
					echo "<table border='1'>
					<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>NATIONALITY</th>
					<th>BIRTH DATE</th>
					<th>BIRTH PLACE</th>
					<th>CURRENT CITY</th>
					<th>LANGUAGES</th>
					<th>ANIMATION EXPERIENCE</th>
					<th>DURATION</th>
					<th>DETAILS</th>
					<th>EMAIL</th>
					<th>PHONE</th>
					<th>SKYPE</th>
					<th>CV</th>
					<th>PHOTO</th>
					<th>SUBMITTED ON</th>
					</tr>";
					while($row = mysql_fetch_array($result)) {
							$id = $row['id'];
							$cvname = $row['cvname'];
							$phname = $row['phname'];
							echo " <td>" . $row['id'] . "</td>";
							echo " <td>" . $row['name'] . "</td>";
							echo " <td>" . $row['nat'] . "</td>";
							echo " <td>" . $row['bdate'] . "</td>";
							echo " <td>" . $row['bcity'] . "</td>";
							echo " <td>" . $row['ccity'] . "</td>";
							echo " <td>" . $row['langs'] . "</td>";
							echo " <td>" . $row['anim'] . "</td>";
							echo " <td>" . $row['dur'] . "</td>";
							echo " <td>" . $row['det'] . "</td>";
							echo " <td>" . $row['email'] . "</td>";
							echo " <td>" . $row['phone'] . "</td>";
							echo " <td>" . $row['skype'] . "</td>";
							echo " <td>" . "<a href=\"downloadcv.php?id=$id\">$cvname</a><br>" . "</td>";
							echo " <td>" . "<a href=\"downloadph.php?id=$id\">$phname</a><br>" . "</td>";
							echo " <td>" . $row['sdate'] . "</td>";
							echo "</tr>";
							}
					mysql_free_result($result);
					echo "</table>";
					}
			else { echo "<br/>" . "Lekérdezés nem sikerült!";}
			}
		else {
			$result = mysql_query( "SELECT * FROM " . $table . " ORDER BY sdate DESC");
			if ($result) {
					echo "<table border='1'>
					<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>NATIONALITY</th>
					<th>BIRTH DATE</th>
					<th>BIRTH PLACE</th>
					<th>CURRENT CITY</th>
					<th>LANGUAGES</th>
					<th>ANIMATION EXPERIENCE</th>
					<th>DURATION</th>
					<th>DETAILS</th>
					<th>EMAIL</th>
					<th>PHONE</th>
					<th>SKYPE</th>
					<th>CV</th>
					<th>PHOTO</th>
					<th>SUBMITTED ON</th>
					</tr>";
					while($row = mysql_fetch_array($result)) {
							$id = $row['id'];
							$cvname = $row['cvname'];
							$phname = $row['phname'];
							echo " <td>" . $row['id'] . "</td>";
							echo " <td>" . $row['name'] . "</td>";
							echo " <td>" . $row['nat'] . "</td>";
							echo " <td>" . $row['bdate'] . "</td>";
							echo " <td>" . $row['bcity'] . "</td>";
							echo " <td>" . $row['ccity'] . "</td>";
							echo " <td>" . $row['langs'] . "</td>";
							echo " <td>" . $row['anim'] . "</td>";
							echo " <td>" . $row['dur'] . "</td>";
							echo " <td>" . $row['det'] . "</td>";
							echo " <td>" . $row['email'] . "</td>";
							echo " <td>" . $row['phone'] . "</td>";
							echo " <td>" . $row['skype'] . "</td>";
							echo " <td>" . "<a href=\"downloadcv.php?id=$id\">$cvname</a><br>" . "</td>";
							echo " <td>" . "<a href=\"downloadph.php?id=$id\">$phname</a><br>" . "</td>";
							echo " <td>" . $row['sdate'] . "</td>";
							echo "</tr>";
							}
					mysql_free_result($result);
					echo "</table>";
					}
			else { echo "<br/>" . "Lekérdezés nem sikerült!";}
			}
	mysql_close( $con );
?>