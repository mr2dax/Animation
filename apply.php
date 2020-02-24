<?php require "conf.php"?>

<!DOCTYPE html PUBLIC
"-//W3C/DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title> J E L E N T K E Z Z ! ! ! </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel=stylesheet href="style.css" type=text/css media=screen>
</head>
<body><center><h1>Töltsd ki a lenti ûrlapot az adataiddal és ha van valami számodra, felvesszük veled a kapcsolatot!</h1>
<form enctype="multipart/form-data" action="" method="POST">
<table border=0 class=apply>
<tr><td>
Keresztnév:</td><td><input type="text" required = "required" name="fname" pattern="[íéáûõúóüöA-Za-z ]+" size="17" maxlength="15" /></td></tr><br/>
<tr><td>
Vezetéknév:</td><td><input type="text" required = "required" name="lname" pattern="[íéáûõúóüöA-Za-z ]+" size="17" maxlength="15" /></td></tr><br/>
<tr><td>
Nemzetiség:</td><td><input type="text" required = "required" name="nat" pattern="[íéáûõúóüöA-Za-z ]+" size="22" maxlength="20" /></td></tr><br/>
<tr><td>
Születési hely: (pl: Budapest)</td><td><input type="text" required = "required" pattern="[íéáûõúóüöA-Za-z ]+" name="bcity" size="12" maxlength="10" /></td></tr><br/>
<tr><td>
Születési idõ: (pl: 1985.01.28)</td><td><input type="text" required = "required" pattern="[0-9.]+" name="bdate" size="12" maxlength="10" /></td></tr><br/>
<tr><td>
Tartózkodási hely: (pl: Budapest)</td><td><input type="text" required = "required" pattern="[íéáûõúóüöA-Za-z ]+" name="ccity" size="22" maxlength="20" /></td></tr><br/>
<tr><td>
Nyelv/szint? (pl: angol közép)</td><td><input type="text" required = "required" pattern="[íéáûõúóüöA-Za-z ]+" name="langs" size="30" maxlength="100" /></td></tr><br/>
<tr><td>
Animációs tapasztalat?</td><td><input type="radio" name="anim" value="1"> Van <br><input type="radio" name="anim" value="0" checked> Nincs<br></td></tr><br/>
<tr><td>
Összes idõtartam? (pl: 1-1,5 év)</td><td><input type="text" name="dur" pattern="[íéáûõúóüöA-Za-z0-9 ]+" size="22" maxlength="20" /></td></tr><br/>
<tr><td>
Részletek: (pl: cég, hotel neve, ország, város, idõtartam)</td><td><textarea name="det" pattern="[íéáûõúóüöA-Za-z0-9.,!() ]+" cols="40" rows="5" maxlength="100" /></textarea></td></tr><br/>
<tr><td>
Email</td><td><input type="text" required = "required" name="email" pattern="[A-Za-z0-9.@]+" size="22" maxlength="20" /></td></tr><br/>
<tr><td>
Telefon</td><td><input type="text" required = "required" name="phone" pattern="[0-9]+" value="0036" size="22" maxlength="20" /></td></tr><br/>
<tr><td>
Skype</td><td><input type="text" required = "required" name="skype" pattern="[A-Za-z0-9.]+" size="22" maxlength="20" /></td></tr><br/>
<tr><td>
CV</td><td><input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input name="cv" type="file"></td></tr><br/>
<tr><td>
Photo</td><td><input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input name="photo" type="file"></td></tr><br/>
</table>
<br/>
<input type="submit" value="Küldés" /> 
<input type="reset" value="Törlés" />
</form>
<br/><br/><br/><br/>
</center></body>
</html>
<?php
//INSERT
if (isset($_POST["fname"]) && ($_FILES["cv"]["size"] > 0) && ($_FILES["photo"]["size"] > 0) && isset($_POST["lname"]) && isset($_POST["nat"]) && isset($_POST["bcity"]) && isset($_POST["bdate"]) && isset($_POST["anim"]) && isset ($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["skype"]) && isset($_POST["ccity"]) && isset($_POST["langs"]))
   {
	
	$cvfn = $_FILES["cv"]["name"];
	$cvtn  = $_FILES["cv"]["tmp_name"];

	$fc      = fopen($cvtn, 'r');
	$cv = fread($fc, filesize($cvtn));
	$cv = addslashes($cv);
	$cvname = $_FILES["cv"]["name"];
	$cvsize = $_FILES["cv"]["size"];
	fclose($fc);

	if(!get_magic_quotes_gpc())
		{
		$cvfn = addslashes($cvfn);
		}
		
	$phfn = $_FILES["photo"]["name"];
	$phtn  = $_FILES["photo"]["tmp_name"];

	$fp      = fopen($phtn, 'r');
	$photo = fread($fp, filesize($phtn));
	$photo = addslashes($photo);
	$phname = $_FILES["photo"]["name"];
	$phsize = $_FILES["photo"]["size"];
	fclose($fp);

	if(!get_magic_quotes_gpc())
		{
		$phfn = addslashes($phfn);
		}
		
    $name = $_POST["lname"] . " " . $_POST["fname"];
	$nat = $_POST["nat"];
	$bcity = $_POST["bcity"];
	$bdate = $_POST["bdate"];
	$anim = $_POST["anim"];
	$dur = $_POST["dur"];
	$det = $_POST["det"];
	$langs = $_POST["langs"];
	$ccity = $_POST["ccity"];	
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$skype = $_POST["skype"];
	
	$table = "appdata";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatbázissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatbázist: ".mysql_error() );
	if (($name <>"") && ($nat <>"") && ($bcity <>"") && ($bdate <> "") && ($email <> "") && ($phone <> "") && ($skype <> ""))
			{
			$result = "INSERT INTO ". $table . " (name, nat, bdate, bcity, ccity, langs, anim, dur, det, email, phone, skype, cv, cvname, cvsize, photo, phname, phsize) VALUES ('" . $name . "','" . $nat . "','" . $bdate . "','". $bcity . "','". $ccity . "','". $langs . "','". $anim . "','" . $dur . "','" . $det . "','" . $email . "','" . $phone . "','" . $skype . "','" . $cv . "','" . $cvname . "','" . $cvsize . "','" . $photo . "','" . $phname . "','" . $phsize . "')";
			if (!mysql_query($result,$con))
				{
				die('Error: ' . mysql_error());
				}
				else {
					if ($result) {
							echo "Köszönjük a jelentkezésed!";
							}
		}
mysql_close($con);
            }
   }
?>