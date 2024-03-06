<?php
//Connection statement
require_once('../Connections/Concerten.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

date_default_timezone_set('Europe/Amsterdam');

/* Stel de character set in */
mysql_query("SET NAMES UTF8;");

if ((isset($_POST["zoek"])) && ($_POST["zoek"] == "zoek")) {

		// begin Recordset
		$zk = '-1';
		if (isset($_POST['zoeknaam'])) {
		  $zk = $_POST['zoeknaam'];
		}
		$query_zoek = "SELECT * FROM concert WHERE `Datum` LIKE '%%$zk%%' OR `Ensemble` LIKE '%%$zk%%' OR `ConcertTitel` LIKE '%%$zk%%' OR `Mmv` LIKE '%%$zk%%' OR `Plaats` LIKE '%%$zk%%' ORDER BY datum ASC";
		$zoek = $Concerten->SelectLimit($query_zoek) or die($Concerten->ErrorMsg());
		$totalRows_zoek = $zoek->RecordCount();
		// end Recordset
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>zoek concert</title>
<meta charset="utf-8">
<script type="text/javascript">
//<!--
function ToonId(Id){
	parent.mainframe.document.zoek.ConcertId.value = Id;
	parent.mainframe.document.zoek.Submit.click();
}
-->
</script>
<style type="text/css">
<!--
#navcontainer a {

	display: block;
	padding: 3px;
	width: 180px;
	border-bottom: 1px solid #0066FF;
	font-weight: bold;
	text-decoration: none;
}
#navcontainer ul {

	margin-left: 0px;
	padding-left: 0px;
	list-style-type: none;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.klein {

	font-size: 70%;
	text-align: left;
}
#navcontainer li {

	padding-bottom: 0px;
	padding-top: 0px;
	margin-top: 3px;
	margin-bottom: 0px;
}
#navcontainer a:link, #navlist a:visited {

	color: #0066FF;
}
#navcontainer a:hover, #navlist a:active {

background-color: #0066FF;
color: #fff;
}
p, tr, td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10pt;
	background-color: #FFFFFF;
	color: #000000;
}
-->
</style>
<link href="/concerten/horringa.css" rel="stylesheet" type="text/css">
</head>
<body>
<form id="vinden" method="post" action="<?php echo $_SERVER['../PHP_SELF']; ?>">
   <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
         <td><label><br>
         Zoekterm:
               <input name="zoeknaam" type="text" id="zoeknaam" value="<?php echo $_POST['zoeknaam']; ?>" size="10">
	          </label>
            <input name="zoek" type="submit" id="zoek" value="zoek"></td>
      </tr>
            	<?php if (isset($zoek)) { ?>
      <tr>
         <td valign="top"><p><?php echo($totalRows_zoek); ?> resultaten. Klik
                een item aan:
            </p>
            <div id="navcontainer">
				<ul id="navlist">
					<?php while (!$zoek->EOF) {
					/* Set locale to Dutch */
					setlocale(LC_ALL, 'nl_NL');
					
					$datum = strftime("%a %e %B %Y", strtotime($zoek->Fields('Datum')));?>
               <li id="active"><a href="javascript:ToonId(<?php if (isset($zoek)) echo $zoek->Fields('ConcertId'); ?>)"; ><?php 
					if (isset($zoek)) echo "{$zoek->Fields('ConcertTitel')} <br><span class='klein'>($datum)</span>"; ?></a></li>
               <?php $zoek->MoveNext(); 
					}?>
				</ul>
            </div>
			</td>
      </tr>
<?php }?>
   </table>
</form>
</body>
</html>
<?php
if (isset($zoek)) $zoek->Close();
?>