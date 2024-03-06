<?php

// stel php in dat deze fouten weergeeft
// ini_set('display_errors',1);

error_reporting( E_ALL );

require_once( '../Connections/PDO_connection.php' );

session_start();

if ( empty( $_POST[ 'zoek' ] ) )$_POST[ 'zoek' ] = $_SESSION[ 'zoek' ];
if ( empty( $_POST[ 'zoeknaam' ] ) )$_POST[ 'zoeknaam' ] = $_SESSION[ 'zoeknaam' ];

// print_all($_POST);
// print_all($_SESSION);

// build the form action
$editFormAction = $_SERVER[ 'PHP_SELF' ] . ( isset( $_SERVER[ 'QUERY_STRING' ] ) ? "?" . $_SERVER[ 'QUERY_STRING' ] : "" );

if ( ( isset( $_POST[ 'zoek' ] ) ) && ( $_POST[ 'zoek' ] == 'zoek' )OR( isset( $_SESSION[ 'zoeknaam' ] )AND $_SESSION[ 'zoeknaam' ] !== '' ) ) {

	// begin Recordset
	if ( empty( $_SESSION[ 'zoeknaam' ] ) )$zk = '-1';
	else $zk = $_SESSION[ 'zoeknaam' ];

	if ( isset( $_POST[ 'zoeknaam' ] ) ) {
		$zk = $_SESSION[ 'zoeknaam' ] = $_POST[ 'zoeknaam' ];
	}
	// $zk = 'trajecti';
	$query_zoek = "SELECT * FROM concert WHERE Datum LIKE '%%$zk%%' OR Ensemble LIKE '%%$zk%%' OR ConcertTitel LIKE '%%$zk%%' OR Mmv LIKE '%%$zk%%' OR Plaats LIKE '%%$zk%%' ORDER BY datum ASC";
	// print_all($query_zoek);
	$zoek = select_query( $query_zoek );
	// var_dump($zoek);
	// end Recordset
}

if ( ( isset( $_POST[ "Toevoegen" ] ) ) && ( $_POST[ "Toevoegen" ] == "Toevoegen" ) ) {
	$insertSQL = sprintf( "INSERT INTO concert (Ensemble, Link, Olv, Mmv, ConcertTitel, Details, Datum, Tijd, Plaats, Prijsinfo, Reserveren, Digilink) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
		$_POST[ 'Ensemble' ],
		$_POST[ 'Link' ],
		$_POST[ 'Olv' ],
		$_POST[ 'Mmv' ],
		$_POST[ 'ConcertTitel' ],
		$_POST[ 'Details' ],
		$_POST[ 'Datum' ],
		$_POST[ 'Tijd' ],
		$_POST[ 'Plaats' ],
		$_POST[ 'Prijsinfo' ],
		$_POST[ 'Reserveren' ],
		$_POST[ 'Digilink' ] );

	// print_all($insertSQL);

	exec_query( $insertSQL );
}

if ( ( isset( $_POST[ "Wijzigen" ] ) ) && ( $_POST[ "Wijzigen" ] == "Wijzigen" ) ) {
	$updateSQL = sprintf( "UPDATE concert SET Ensemble='%s', Link='%s', Olv='%s', Mmv='%s', ConcertTitel='%s', Details='%s', Datum='%s', Tijd='%s', Plaats='%s', Prijsinfo='%s', Reserveren='%s', Digilink='%s' WHERE ConcertId=%d",
		$_POST[ 'Ensemble' ],
		$_POST[ 'Link' ],
		$_POST[ 'Olv' ],
		$_POST[ 'Mmv' ],
		$_POST[ 'ConcertTitel' ],
		$_POST[ 'Details' ],
		$_POST[ 'Datum' ],
		$_POST[ 'Tijd' ],
		$_POST[ 'Plaats' ],
		$_POST[ 'Prijsinfo' ],
		$_POST[ 'Reserveren' ],
		$_POST[ 'Digilink' ],
		$_POST[ 'ConcertId' ] );

	// print_all($updateSQL);

	exec_query( $updateSQL );
}

if ( ( isset( $_POST[ "Wissen" ] ) ) && ( $_POST[ "Wissen" ] == "Wissen" )and( isset( $_POST[ 'ConcertId' ] ) )and( $_POST[ 'ConcertId' ] != "" ) ) {
	$deleteSQL = sprintf( "DELETE FROM concert WHERE ConcertId=%d",
		$_POST[ 'ConcertId' ] );

	exec_query( $deleteSQL );
}

// begin Recordset
$ConcertId = "-1";
if ( isset( $_GET[ 'ConcertId' ] ) ) {
	if ( !isset( $_POST[ "leegmaken" ] ) )$ConcertId = $_GET[ 'ConcertId' ];
	$query_concert = sprintf( "SELECT * FROM concert WHERE ConcertId = %d", $ConcertId );
	// print_all($query_concert);
	$concert = select_query( $query_concert, 1 );
	// print_all($concert);
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

<script type="text/javascript">
	//<!--
	function ToonId( Id ) {
		parent.mainframe.document.zoek.ConcertId.value = Id;
		parent.mainframe.document.zoek.Submit.click();
	}
	-- >
</script>
<style type="text/css">
	.klein {
		font-size: 70%;
		text-align: left;
	}
	
	#navcontainer li a {
		padding: 0;
		margin: 0;
		text-decoration: none;
	}
	
	#navcontainer a:link,
	#navlist a:visited {
		color: #0066FF;
	}
	
	#navcontainer a:hover,
	#navlist a:active {
		background-color: #0066FF;
		color: #fff;
	}
	
	p,
	li,
	tr,
	td,
	div {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 10pt;
	}
	
	input,
	textarea {
		background-color: lightyellow;
	}
</style>

<link href="css/horringa.css" rel="stylesheet" type="text/css">

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "260px";
  document.getElementById("navcontainer").style.width = "250px";
  document.getElementById("navcontainer").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("navcontainer").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
Try It Yourself »
</script>

</head>

<body>
	<div class="w3-row w3-main">
		<div id="navcontainer" class="w3-col w3-sidenav w3-card-4 w3-collapse w3-light-grey" style="width:250px">
			<form id="vinden" method="post" action="<?php echo $_SERVER['../PHP_SELF']; ?>">
				<div class="w3-panel">
					<label>Zoekterm: <br><input name="zoeknaam" type="text" id="zoeknaam" value="<?php echo $_POST['zoeknaam']; ?>" size="10"></label>
					<input name="zoek" type="submit" id="zoek" value="zoek">
					</td>
				</div>
				<?php if (isset($zoek)) { ?>
				<div class="w3-container">
					<?php echo(count($zoek)); ?> resultaten. <br>Klik een item aan: </div>
				<ul id="navlist" class="w3-ul">
					<li><a href="#" onclick="w3_close()" class="w3-closenav w3-xxlarge w3-hide-large">Close &times;</a>
					</li>
					<?php foreach($zoek as $zoekitem) {
							$datum = strftime("%a %e %B %Y", strtotime($zoekitem['Datum']));?>
					<li>
						<a href="<?php echo $_SERVER['PHP_SELF'].'?ConcertId='.$zoekitem['ConcertId']; ?>">
							<?php if (isset($zoek)) echo "{$zoekitem['ConcertTitel']}<br><span class='klein'>($datum)</span>"; ?>
						</a>
					</li>
					<?php 
						}?>
				</ul>

				<?php }?>
			</form>
		</div>
		<div class="w3-main w3-container" style="margin-left:260px;">
			<span class="w3-opennav w3-hide-large" onclick="w3_open()">&#9776;</span>
			<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="concert" id="concert">
				<div class="w3-margin-top w3-card-4" style="max-width: 900px; float: left;">
					<table class="w3-table w3-striped w3-border" id="concertgegevens">
						<tr valign="baseline">
							<td width="10%" align="right" nowrap>ConcertId:</td>
							<td><input type="text" name="ConcertId" value="<?php echo $concert['ConcertId']; ?>" size="32"/>
							</td>
							<td width="10%" align="right">Datum:<br><span class="klein">(yyyy-mm-dd)</span></td>
							<td><input type="text" name="Datum" value="<?php echo $concert['Datum']; ?>" size="40"/>
							</td>
						</tr>
						<tr valign="baseline">
							<td width="10%" align="right" nowrap>Ensemble:</td>
							<td><input type="text" name="Ensemble" value="<?php echo $concert['Ensemble']; ?>" size="32"/>
							</td>
							<td align="right">Tijd:<br><span class="klein">(hh:mm)</span></td>
							<td><input type="text" name="Tijd" value="<?php echo $concert['Tijd']; ?>" size="40"/>
							</td>
						</tr>
						<tr valign="baseline">
							<td width="10%" align="right" nowrap>Website:</td>
							<td><input type="text" name="Link" value="<?php echo $concert['Link']; ?>" size="32"/>
							</td>
							<td align="right" nowrap>Plaats:</td>
							<td><input type="text" name="Plaats" value="<?php echo $concert['Plaats']; ?>" size="40"/>
							</td>
						</tr>
						<tr valign="baseline">
							<td width="10%" align="right" nowrap>O.l.v.:</td>
							<td><input type="text" name="Olv" value="<?php echo $concert['Olv']; ?>" size="32"/>
							</td>
							<td align="right" nowrap>Prijsinfo:</td>
							<td><input type="text" name="Prijsinfo" value="<?php echo $concert['Prijsinfo']; ?>" size="40"/>
							</td>
						</tr>
						<tr valign="baseline">
							<td width="10%" align="right" nowrap>M.m.v.:</td>
							<td><input type="text" name="Mmv" value="<?php echo $concert['Mmv']; ?>" size="32"/>
							</td>
							<td align="right" nowrap>Reserveren:</td>
							<td><input type="text" name="Reserveren" value="<?php echo $concert['Reserveren']; ?>" size="40"/>
							</td>
						</tr>
						<tr valign="baseline">
							<td width="10%" align="right" nowrap>Concerttitel:</td>
							<td><input type="text" name="ConcertTitel" value="<?php echo htmlspecialchars($concert['ConcertTitel']); ?>" size="32"/>
							</td>
							<td align="right" nowrap>Digiflyer:</td>
							<td><input type="text" name="Digilink" value="<?php echo $concert['Digilink']; ?>" size="40"/>
							</td>
						</tr>
						<tr valign="baseline">
							<td width="10%" align="right" valign="top" nowrap>Details:</td>
							<td colspan="2">
								<textarea name="Details" cols="33" rows="5"><?php echo stripslashes($concert['Details']); ?></textarea>
							</td>
							<td align="center" valign="top">
								<p>
									<label>Deze afbeelding uploaden:
										<input name="fileField" type="file" id="fileField" onchange="checkOneFileUpload(this,'GIF,JPG,JPEG,BMP,PNG',false,'','','','','','','')" />
									</label>
								</p>
								<p>Uploaden
									<input type="submit" name="uploaden" id="uploaden" value="Submit"/> <button onclick="window.open('http://www.horringa.net')" class="w3-btn w3-yellow">Ga naar horringa.net</button>
								
								</p>
							</td>
						</tr>
						<tr valign="baseline">
							<td width="10%" align="right" nowrap>&nbsp;</td>
							<td><input name="Toevoegen" type="submit" id="Toevoegen" value="Toevoegen"/>
								<input name="Wijzigen" type="submit" id="Wijzigen" value="Wijzigen"/>
								<input name="Wissen" type="submit" id="Wissen" value="Wissen"/>
							</td>
							<td><input name="leegmaken" type="submit" id="leegmaken" value="Leegmaken"/>
							</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</div>
				<div class="w3-card-4 w3-margin-top" style="max-width: 500px; float: right;">
					<?php if (isset($concert['Digilink']) AND $concert['Digilink'] != '') echo <<<EOT
	<img class="w3-image" style="max-width: 500px;" src="../Digiflyers/<?php echo $concert['Digilink']; ?>" alt="Digiflyer <?php echo $concert['ConcertTitel']; ?>"/> 
	EOT ?>
			</div>
			</form>
		</div>
</body>

</html>
<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>