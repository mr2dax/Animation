<html>
<head>

<script language=JavaScript>

var message="";

function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}

document.oncontextmenu=new Function("return false")

</script>

<SCRIPT language="JavaScript" type="text/javascript">

var newwindow = ''
function popitup(url) {
if (newwindow.location && !newwindow.closed) {
    newwindow.location.href = url; 
    newwindow.focus(); } 
else { 
    newwindow=window.open(url,'htmlname','width=404,height=316,resizable=1');} 
}

function tidy() {
if (newwindow.location && !newwindow.closed) { 
   newwindow.close(); } 
}

</SCRIPT>
</head>
<body onUnload="tidy()">
<table>
<?php
// define directory path
$dir = "./pics";

// iterate through files
// look for JPEGs
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
		echo "<tr>";
        while (($file = readdir($dh)) !== false) {
            if (preg_match("/.jpg/", $file)) {
                // read EXIF headers
               
                // get thumbnail
                // link to full image
                echo "<td valign=top><a href=\"javascript:popitup('$dir/$file')\"><img src=thumbnail.php?file=$file height=150 width=150></a></td>";
				$count++;
                if (($count % 5 == 0) && ($count > 0)) echo '</tr><tr>';
           }
        }
       closedir($dh);
   }
}
?>
</table>
</body>
</html>