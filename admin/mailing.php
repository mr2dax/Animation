<?php

require 'config.php';
include "../conf.php";

$table = "appdata";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	if ((isset($_POST["subject"])) && (isset($_POST["message"])))
			{
			$result = mysql_query( "SELECT name, email FROM " . $table);
			if ($result) {
				$to = "";
				while($row = mysql_fetch_array($result)) {
					$to .= $row['email'] . ",";
				}
			$to = substr($to, 0, -1);
			$subject=$_POST["subject"];
			$message=$_POST["message"];
			$headers = 'From: ali@idealanimation.com' . "\r\n" .
			'Reply-To: ali@idealanimation.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

			if (mail($to, $subject, $message, $headers)) {
				echo "H�rlev�l elk�ldve!";
				}
				else {
					echo "Gebasz";
				}
			}
			else {
				echo "Valami nem fasza...";
			}
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
<h1>H�rlev�l k�ld�se</h1></br>
<form action="" method="POST">
T�rgy: <input type="text" name="subject" size="30" maxlength="32" /></br></br>
�zenet: <textarea name="message" rows="10" cols="20"></textarea></br></br>
<br />
<input type="submit" value="K�ld" /> 
<input type="reset" value="T�r�l" />
</form>
</br></br>
<form name=logout method=POST action="<?php echo CONTROLLER; ?>">
<input type=hidden name=command value='back'/><input type=submit value=Vissza></form>
</body>
</html>