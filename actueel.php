<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once('Connections/PDO_connection.php');
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">

<head>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-27993630-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; 

ga.src = ('https:' == document.location.protocol ? 'https://' : 'https://') + 'stats.g.doubleclick.net/dc.js';

var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<title>actueel</title>
<link href="css/horringa.css" rel="stylesheet" type="text/css">
<style type="text/css">
h1, h2, h3, p {
	background: inherit;
}
div.digiflyer {
	display: block;
	float: right;
	margin-top: 15px;
}
div.digiflyer img {
	border: thin solid rgba(0,0,0,1);
	width: 100%;
}
.details {
	font-size: x-small;
}
</style>
</head>
<body>
<?php $stmt = $db->query('SELECT * FROM concert WHERE Datum > ADDDATE(NOW(), -7) ORDER BY Datum ASC');

if ($stmt->rowCount() == 0) exit('Momenteel geen concerten gepland<br><br><br>'); 
	foreach($stmt as $c) {
	  $id = $c['ConcertId'];
?>
  <div class="w3-row-padding w3-container w3-white w3-border-top w3-border-deep-orange">
    <div class="w3-panel w3-third" style="max-width: 300px;">
      <div class="w3-container w3-card w3-right-align"><p class="w3-small">
        <?php 
				$datum = strtotime($c['Datum']);
				$datumdelen['weekdag'] = strftime("%A", $datum);
				$datumdelen['dag'] = ltrim(strftime("%d", $datum), "0");
	  			$datumdelen['maand'] = strftime("%B", $datum);
				echo implode(" ", $datumdelen); ?>

<?php echo ' | '.(substr($c['Tijd'], 0, -3) . " uur"); ?><br>
			<?php echo stripslashes($c['Plaats']); ?></p></div>
      <?php  if ($c['Digilink'] != "") 
				{
					 if (!(strstr($c['Digilink'], 'http'))) {
						 $flyer = 'Digiflyers/'.$c['Digilink'];
						 $flyer_enc = urlencode('Digiflyers/'.$c['Digilink']);
					 }
						 else {
							 $flyer = $c['Digilink'];
							 $flyer_enc = urlencode($c['Digilink']);
						 }
					 echo '<div class="digiflyer">'."<a href=\"digiflyer_groot.php?flyer=$flyer_enc&link={$c['Link']}\" target=\"_top\" target=\"_blank\"><img 
					 src=\"$flyer\" width=\"150\" alt=\"{$c['Digilink']}\"></a></div>"; 
				} ?>
    </div>
    <div class="w3-container w3-panel w3-rest">
		<div class="w3-container w3-card"><h4><a href="<?php echo $c['Link']; ?>" target="_blank"><?php echo stripslashes($c['Ensemble']); ?></a>
        <?php if ($c['Olv'] != null) echo ' o.l.v. '.$c['Olv']; 
      if ($c['Mmv'] != null) echo ("<br>m.m.v. " . $c['Mmv']); ?>
      </h4></div>
      <h3 class="w3-panel w3-deep-blue"><?php echo $c['ConcertTitel']; ?></h3>
      <p class="w3-panel w3-small"><?php echo stripslashes(nl2br($c['Details'])); ?><br>
      </p>
      <p class="w3-panel">
        <?php $prijs = substr($c['Prijsinfo'], 0, 1);
	  if (ctype_digit($prijs)) echo "Entree: &#8364; {$c['Prijsinfo']}";
	  elseif ($c['Prijsinfo'] == "") echo '???'; 
	  else echo $c['Prijsinfo'];
	  if ($c['Reserveren'] != '') { 
	  	if (!stripos($c['Reserveren'], 'https://'))
	  	echo ' | Reserveren: ' . stripslashes($c['Reserveren']);} 
		else {
	  	echo ' | Reserveren: <a href="' . $url . '" target="_blank">' . stripslashes($c['Reserveren']) . '</a>';} ?>
        <br>
      </p></div>
      </div>
  <?php
  }
?>
</body>
</html>