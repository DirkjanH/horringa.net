<?php error_reporting(E_ALL);

require_once('../Connections/PDO_connection.php');

if ((isset($_POST["zoek"])) && ($_POST["zoek"] == "zoek")) {

		// begin Recordset
		$zk = '-1';
		if (isset($_POST['zoeknaam'])) {
		  $zk = $_POST['zoeknaam'];
		}
		$zk = 'trajecti';
		$query_zoek = "SELECT * FROM concert WHERE `Datum` LIKE '%%$zk%%' OR `Ensemble` LIKE '%%$zk%%' OR `ConcertTitel` LIKE '%%$zk%%' OR `Mmv` LIKE '%%$zk%%' OR `Plaats` LIKE '%%$zk%%' ORDER BY datum ASC";
		$zoek = select_query($query_zoek);
		var_dump($zoek);
		// end Recordset
}

?>
<!doctype html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

<head>
<title>concert-onderhoud</title>
</head>

<body>
Joehoe!
</body>
</html>
<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>