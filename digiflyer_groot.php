<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Digiflyer groot</title>
<link href="horringa.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="90%" align="center">
   <tr>
      <td align="center">
<?php
$url = urldecode($_GET['flyer']);
$link = $_GET['link'];
echo "<a href=\"$link\" target=\"_blank\"><img src=\"$url\" alt=\"digiflyer\" border=\"1\"></a>"; 
?></td>
   </tr>
   <tr>
      <td height="60" align="center" valign="bottom"><strong><a href="javascript: history.go(-1)">
		Ga terug naar concertoverzicht</a> of klik op plaatje voor link naar site</strong></td>
   </tr>
</table>

</body>
</html>
