<?php require "conf.php";
include error_reporting(0);
?>

<!DOCTYPE html PUBLIC
"-//W3C/DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Ideal Animation</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="copyright" content="Copyright (c) 2012 Ideal Animation All rights reserved. Minden jog fenntartva." />
<meta name="distribution" content="global" /><meta name="description" content="Ideal Animation - A legjobb anim�tormel� k�zvet�t�k!" />
<meta name="keywords" content="k�lf�ldi munka, sz�llodai anim�ci�, anim�ci�, sz�llodai anim�tor, anim�tor, hotel animation, animation, hotel animator, animator, hotel entertainment, entertainer, hotel entertainer, k�lf�ldi munkalehet�s�g, ny�ri munka, ny�ri munkalehet�s�g, szezon�lis munka, szezon�lis munkalehet�s�g, g�r�g, g�r�g munka, g�r�g munkalehet�s�g, g�r�gorsz�g, g�r�gorsz�gi munka, g�r�gorsz�gi munkalehet�s�g, ciprus, ciprusi munka, ciprusi munkalehet�s�g, sz�llodai programszervez�, programszervez�, programszervez�s, spanyol, spanyol munka, spanyol munkalehet�s�g, spanyolorsz�g, spanyolorsz�gi munka, spanyolorsz�gi munkalehet�s�g," />
<link rel=stylesheet href="style.css" type=text/css media=screen>
</head>
<body class=indexdoc><p><center>
<table border=0 width=70% background="tengerpart.jpg">
	<tr><td><table border=0 width=100% background="beach.jpeg">
				<tr><td width=75%><h1>Ideal Animation</h1></td><td><img src="hun.jpg" width="30" height="30"></td></tr>
			</table></td></tr>
	<tr><td></td></tr>
	<tr><td><table border=0 width=100%>
				<tr class="cimsor"><td>
				<input type=button value='Kezd�lap' class=button onClick="document.index.command.value='kezd'; document.index.submit();"></td>
				<td>
				<input type=button value='Gal�ria' class=button onClick="document.index.command.value='gallery'; document.index.submit();"></td>
				<td>
				<input type=button value='A munk�r�l' class=button onClick="document.index.command.value='about'; document.index.submit();"></td>
				<td>
				<input type=button value='C�l�llom�sok' class=button onClick="document.index.command.value='places'; document.index.submit();"></td>
				<td>
				<input type=button value='V�lem�nyek' class=button onClick="document.index.command.value='ref'; document.index.submit();"></td>
				<td>
				<input type=button value='Kontakt' class=button onClick="document.index.command.value='contact'; document.index.submit();"></td>
				</tr>
			</table>
				<form name='index' action="" method=POST>
				<input type='hidden' name='command' value=''>
				</form>
			</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><table border=0 width=100%>
				<tr><td align=center><a href="apply.php" target="_blank"><input type=button value='Jelentkezz!' class=gomb></a></td></tr>
			</table></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><table border=0 width=100%>
				<tr><td align=center><?php			
function clearing_input($input_array) {
  foreach ($input_array as $key=>$value) {
    $value = strip_tags($value, '<b><i><u>');
    $value = preg_replace('/\r\n|\r|\n/', '<br>', $value);
    $value = str_replace('|', '&#124;', $value);
    $input_array[$key] = $value;
  }
  return $input_array;
}

$parameter = array_merge($_GET, $_POST);
$parameter = clearing_input($parameter);

switch($parameter['command']) {
  case 'kezd':
	$table = "text";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT text FROM ". $table . " WHERE id='intro'");
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
					echo "<h3>" . $row['text'] . "</h3><br><br>";
					}
				}
	mysql_close($con);
    $table = "feed";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT title, news FROM ". $table);
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
					echo "<h2>" . $row['title'] . "</h2><br>";
					echo "<h3>" . $row['news'] . "</h3><br><br>";
					}
				}
	mysql_close($con);
    break;
	case 'gallery':
	require "gallery.php";
    break;
	case 'about':
	$table = "text";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT text FROM ". $table . " WHERE id='work'");
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
					echo "<h3>" . $row['text'] . "</h3><br>";
					}
				}
	mysql_close($con);
    break;
	case 'places':
	$table = "places";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT land, region, hotel FROM ". $table);
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
					echo "<h3>" . $row['land'] . ", " . $row['region'] . ", " . $row['hotel'] . "</h3><br><br>";
					}
				}
	mysql_close($con);
    break;
	case 'ref':
	$table = "ref";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT title, news FROM ". $table);
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
				
					echo "<h3>" . $row['title'] . "</h3><br><br>";
					echo $row['news'];
					echo "<br><br>";
					}
				}
	mysql_close($con);    
    break;
	case 'contact':
	$table = "text";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT text FROM ". $table . " WHERE id='contact'");
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
					echo "<h3>" . $row['text'] . "</h3><br>";
					}
				}
	mysql_close($con);    
    break;
	case '':
	$table = "text";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT text FROM ". $table . " WHERE id='intro'");
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
					echo "<h3>" . $row['text'] . "</h3><br><br>";
					}
				}
	mysql_close($con);
    $table = "feed";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT title, news FROM ". $table);
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
					echo "<h2>" . $row['title'] . "</h2><br>";
					echo "<h3>" . $row['news'] . "</h3><br><br>";
					}
				}
	mysql_close($con);
    break;
	default:
	$table = "text";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT text FROM ". $table . " WHERE id='intro'");
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
					echo "<h3>" . $row['text'] . "</h3><br><br>";
					}
				}
	mysql_close($con);
    $table = "feed";
	$con = mysql_connect( "127.0.0.1", $user, $pass );
	if ( ! $con )
		die( "Nincs kapcsolat az adatb�zissal." );
	mysql_select_db( $db, $con )
		or die ( "Nem lehet megnyitni a $db adatb�zist: ".mysql_error() );
	$result = mysql_query("SELECT title, news FROM ". $table);
			if (!$result)
				{
				die('Error: ' . mysql_error());
				}
			else {
				while($row = mysql_fetch_array($result)) {
					echo "<h2>" . $row['title'] . "</h2><br>";
					echo "<h3>" . $row['news'] . "</h3><br><br>";
					}
				}
	mysql_close($con);
    break;
	}
?>				
</td></tr>
			</table></td></tr>
	<tr><td></td></tr>
	<tr><td><table border=0 width=100%>
				<tr><td><a href="http://www.facebook.com" target="_blank"><img src="face.png" width="40" height="40"></a>&nbsp;&nbsp;<a href="http://www.youtube.com" target="_blank"><img src="yout.png" width="40" height="40"></a></td></tr>
			</table></td></tr></td></tr>
	<tr><td><i>Web by Xero 2012</i></td></tr>
</table>
</center></p>
</body>
</html>