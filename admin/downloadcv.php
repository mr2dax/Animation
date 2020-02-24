<?php
if(isset($_GET['id'])) 
{
// if id is set then get the file with the id from database

include "../conf.php";
$id    = $_GET['id'];
$table = "appdata";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatbázissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatbázist: ".mysql_error() );

$result = mysql_query("SELECT cv, cvname, cvsize FROM $table WHERE id = '$id'") or die('Error, query failed');
list($cv, $cvname, $cvsize) = mysql_fetch_array($result);

header("Content-length: $cvsize");
header("Content-Disposition: attachment; filename=$cvname");
echo $cv;

mysql_free_result($result);
mysql_close( $con );
exit;
}

?>