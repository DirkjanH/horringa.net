<?php 
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

Kint::$enabled_mode = false; //($_SERVER['REMOTE_ADDR'] === '83.85.191.103');
Kint\Renderer\RichRenderer::$folder = false;

?>

<!doctype html>
<html xml:lang="en" lang="en"><!-- InstanceBegin template="/Templates/horringa_EN.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="https://horringa.net/EN/"/>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="keywords" content="conductor, chef de chœur, chorleiter, chef d'orchestre, choirmaster, Utrecht, Holland, Netherlands, vocal, zang, zangtechniek,  clarinet, viola, Bratsche, alto, baritone, ensemble"/>
	<meta name="description" content="Musical activities of conductor Dirkjan Horringa"/>
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>Dirkjan Horringa, conductor</title>
	<!-- InstanceEndEditable -->
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/horringa.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<!-- Javascript -->
<script type="text/javascript">
  function klapdiensten(id) {
   if (document.getElementById) {
   var cont = document.getElementById(id).style;
    if (cont.display == "block") {
    cont.display = "none";
    } else {
    cont.display= "block";
   }
   return false;
   } else {
   return true;
  }
  }

</script>
<!-- InstanceEndEditable -->
</head>

<body>
<?php require("navigatie_EN.php"); ?>

<div class="w3-main w3-padding" style="margin-left: 250px;">
<span class="w3-opennav w3-hide-large w3-xxlarge" onclick="w3_open()">&#9776;</span>
<!-- InstanceBeginEditable name="MainText" -->
<table border=0 cellpadding=0 cellspacing=0>
  <tr>
    <td><div class="fotolinks"> <a href="../images/dirkjan-groot.jpg"><img src="../images/dirkjan.jpg" alt="Dirkjan Horringa" width="250" height="355"></a><br>
        Dirkjan Horringa <br>
        <span class="Titelkleur">(please click the image to download <br>
        a high resolution version of the picture)</span></div>
      <p>Dirkjan Horringa studied both musicology and choral and orchestral conducting
        at the Utrecht University and the Utrecht Conservatoire. He now specializes in leading semi-professional choirs and orchestras, which have a rather high musical level in Holland. This makes the work of leading these
        ensembles a fascinating combination of musical education and serious music making,
        which is a challenge to a professional musician.</p>
      <p><a href="#" class="leesmeer" onclick="return klapdiensten('bio');"><em>Read more...</em></a></p>
		<div id="bio">
			<p>His main field of interest is
				music of the 16th, 17th  and early 18th century, from Ockeghem, Obrecht and Josquin
				via Monteverdi’s Vespers and Schütz to the world of renaissance and baroque music
				theatre and oratorio.<br>
				<br>
				Dirkjan Horringa works with several vocal ensembles and orchestras all over the Netherlands
				and the <i>La Pellegrina ProjectOrkest</i>, is a guest conductor to
				the Czech vocal ensemble <i>Vaganti, </i>the Ukrainian vocal ensemble <i>Musitchnyj
					Asamblej</i> (Kiev)<i>,</i> the
				Lithuanian vocal ensemble Brevis (Vilnius) and the choir <i>Confido
					Domino</i> (Minsk,
				Belarus). He has been a tutor in several summer schools in Italy, Poland
				and the Czech Republic. </p>
			<p>With Cappella ad Fluvium he recorded Johann Theile's Matthäuspassion from 1673. With the Chamber Orchestra Driebergen he recorded a CD with mainly contemporary Dutch symphonic music. With Trajecti Voces and the La Pellegrina ProjectOrkest he recorded a live registration of the Requiem by Dafydd Bullock (*1953). Trajecti Voces released a CD in 2014 with highlights of the last 15 years. The anniversary CD 'Sound the Trumpet' by the Amer Consort features Purcell's 'Hail bright Cecilia' and Bach's Magnificat in E-flat. With Trajecti Voces he recorded Mozart's Requiem and other Freemason music. In 2018 a CD was released with parts from Bach's Christmas Oratorio, with Trajecti Voces and the Amer Consort in collaboration with four leading soloists and the Baroque Orchestra Eik &amp; Linde.<br>
				<br>
				He is privately active as a singing tutor and
				vocal coach and teaches conducting. His fields of interest are thus not restricted only to choral
				music, but
				also to the world of music theatre, especially renaissance and baroque
				music theatre.</p>
		</div></td>
  </tr>
</table>
<!-- InstanceEndEditable -->

<h4><a href="javascript: history.go(-1)">Back</a></h4>
</div>
	
</body>
<!-- InstanceEnd --></html>