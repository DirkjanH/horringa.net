<?php 
//Connection statement
require_once('../Connections/Concerten.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

/* Stel de character set in */
$Concerten->Execute("SET NAMES UTF8;");

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

if ((isset($_POST["Toevoegen"])) && ($_POST["Toevoegen"] == "Toevoegen")) {
  $insertSQL = sprintf("INSERT INTO concert (Ensemble, Link, Olv, Mmv, ConcertTitel, Details, Datum, Tijd, Plaats, Prijsinfo, Reserveren, Digilink) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(stripslashes($_POST['Ensemble']), "text"),
                       GetSQLValueString(stripslashes($_POST['Link']), "text"),
                       GetSQLValueString(stripslashes($_POST['Olv']), "text"),
                       GetSQLValueString(stripslashes($_POST['Mmv']), "text"),
                       GetSQLValueString(stripslashes($_POST['ConcertTitel']), "text"),
                       GetSQLValueString(stripslashes($_POST['Details']), "text"),
                       GetSQLValueString($_POST['Datum'], "date"),
                       GetSQLValueString($_POST['Tijd'], "date"),
                       GetSQLValueString($_POST['Plaats'], "text"),
                       GetSQLValueString(stripslashes($_POST['Prijsinfo']), "text"),
                       GetSQLValueString(stripslashes($_POST['Reserveren']), "text"),
                       GetSQLValueString($_POST['Digilink'], "text"));

  $Result1 = $Concerten->Execute($insertSQL) or die($Concerten->ErrorMsg());
}

if ((isset($_POST["Wijzigen"])) && ($_POST["Wijzigen"] == "Wijzigen")) {
  $updateSQL = sprintf("UPDATE concert SET Ensemble=%s, Link=%s, Olv=%s, Mmv=%s, ConcertTitel=%s, Details=%s, Datum=%s, Tijd=%s, Plaats=%s, Prijsinfo=%s, Reserveren=%s, Digilink=%s WHERE ConcertId=%s",
                       GetSQLValueString(stripslashes($_POST['Ensemble']), "text"),
                       GetSQLValueString(stripslashes($_POST['Link']), "text"),
                       GetSQLValueString(stripslashes($_POST['Olv']), "text"),
                       GetSQLValueString(stripslashes($_POST['Mmv']), "text"),
                       GetSQLValueString(stripslashes($_POST['ConcertTitel']), "text"),
                       GetSQLValueString(stripslashes($_POST['Details']), "text"),
                       GetSQLValueString($_POST['Datum'], "date"),
                       GetSQLValueString($_POST['Tijd'], "date"),
                       GetSQLValueString($_POST['Plaats'], "text"),
                       GetSQLValueString(stripslashes($_POST['Prijsinfo']), "text"),
                       GetSQLValueString(stripslashes($_POST['Reserveren']), "text"),
                       GetSQLValueString($_POST['Digilink'], "text"),
                       GetSQLValueString($_POST['ConcertId'], "int"));

  $Result1 = $Concerten->Execute($updateSQL) or die($Concerten->ErrorMsg());
}

if ((isset($_POST["Wissen"])) && ($_POST["Wissen"] == "Wissen") and (isset($_POST['ConcertId'])) and ($_POST['ConcertId'] != "")) {
  $deleteSQL = sprintf("DELETE FROM concert WHERE ConcertId=%s",
                       GetSQLValueString($_POST['ConcertId'], "int"));

  $Result1 = $Concerten->Execute($deleteSQL) or die($Concerten->ErrorMsg());
}

// begin Recordset
$ConcertId = "-1";
if (isset($_GET['ConcertId'])) {
  	if (!isset($_POST["leegmaken"])) $ConcertId = $_GET['ConcertId'];
	$query_concert = sprintf("SELECT * FROM concert WHERE ConcertId = %s", $ConcertId);
	$concert = $Concerten->SelectLimit($query_concert) or die($Concerten->ErrorMsg());
}
else
// end Recordset

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Update database concerten</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/horringa.css" rel="stylesheet" type="text/css" />
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>
</head>

<body>

<form action="<?php echo $editFormAction; ?>" method="get" name="zoek" target="_self" id="zoek">
   <br />
   <table width="80%" align="center">
   <tr>
      <td width="50%"><div align="right">ConcertId =
         <input name="ConcertId" type="text" size="5" />
      </div></td>
      <td width="50%"><input type="submit" name="Submit" value="Zoek"></td>
   </tr>
</table>
<?php if (isset($_GET['ConcertId'])) {

?>
</form>

<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="concert" id="concert" onsubmit="
document.getElementById("Digilink").value = 'test';
alert('De file heet: '+document.getElementById('fileField').value);
return document.MM_returnValue;;;checkFileUpload(this,'GIF,JPG,JPEG,BMP,PNG',false,'','','','','','','');
showProgressWindow('blueFlashProgress.htm',300,100);
"
>
   <table width="100%" align="left">
      <tr valign="baseline">
         <td width="10%" align="right" nowrap>ConcertId:</td>
         <td><input type="text" name="ConcertId" value="<?php echo $concert->Fields('ConcertId'); ?>" size="32" /></td>
         <td align="right" nowrap>Datum (yyyy-mm-dd):</td>
         <td width="300"><input type="text" name="Datum" value="<?php echo $concert->Fields('Datum'); ?>" size="40" /></td>
      </tr>
      <tr valign="baseline">
         <td width="10%" align="right" nowrap>Ensemble:</td>
         <td><input type="text" name="Ensemble" value="<?php echo $concert->Fields('Ensemble'); ?>" size="32" /></td>
         <td align="right" nowrap>Tijd (hh:mm):</td>
         <td width="300"><input type="text" name="Tijd" value="<?php echo $concert->Fields('Tijd'); ?>" size="40" /></td>
      </tr>
      <tr valign="baseline">
         <td width="10%" align="right" nowrap>Website:</td>
         <td><input type="text" name="Link" value="<?php echo $concert->Fields('Link'); ?>" size="32" /></td>
         <td align="right" nowrap>Plaats:</td>
         <td width="300"><input type="text" name="Plaats" value="<?php echo $concert->Fields('Plaats'); ?>" size="40" /></td>
      </tr>
      <tr valign="baseline">
         <td width="10%" align="right" nowrap>O.l.v.:</td>
         <td><input type="text" name="Olv" value="<?php echo $concert->Fields('Olv'); ?>" size="32" /></td>
         <td align="right" nowrap>Prijsinfo:</td>
         <td width="300"><input type="text" name="Prijsinfo" value="<?php echo $concert->Fields('Prijsinfo'); ?>" size="40" /></td>
      </tr>
      <tr valign="baseline">
         <td width="10%" align="right" nowrap>M.m.v.:</td>
         <td><input type="text" name="Mmv" value="<?php echo $concert->Fields('Mmv'); ?>" size="32" /></td>
         <td align="right" nowrap>Reserveren:</td>
         <td width="300"><input type="text" name="Reserveren" value="<?php echo $concert->Fields('Reserveren'); ?>" size="40" /></td>
      </tr>
      <tr valign="baseline">
         <td width="10%" align="right" nowrap>Concerttitel:</td>
         <td><input type="text" name="ConcertTitel" value="<?php echo htmlspecialchars($concert->Fields('ConcertTitel')); ?>" size="32" /></td>
         <td align="right" nowrap>Digiflyer:</td>
         <td width="300"><input type="text" name="Digilink" value="<?php echo $concert->Fields('Digilink'); ?>" size="40" /></td>
      </tr>
      <tr valign="baseline">
         <td width="10%" align="right" valign="top" nowrap>Details:</td>
         <td colspan="2"><textarea name="Details" cols="60" rows="20"><?php echo $concert->Fields('Details'); ?></textarea>         </td>
         <td width="300" align="center" valign="top"><?php  if ($concert->Fields('Digilink') != "") 
				{
					 $flyer = $concert->Fields('Digilink');
					 echo "<a href=\"../digiflyer_groot.php?flyer=$flyer&link={$concert->Fields('Link')}\" target=\"_top\"><img 
					 src=\"../Digiflyers/$flyer\" width=150  border=\"1\" vspace=\"5\"
					 alt=\"$flyer\" border=\"0\"></a>"; 
				} ?>
         <p>
           <label>Deze afbeelding uploaden:
             <input name="fileField" type="file" id="fileField" onchange="checkOneFileUpload(this,'GIF,JPG,JPEG,BMP,PNG',false,'','','','','','','')" />
           </label>
         </p>
         <p>Uploaden
           <input type="submit" name="uploaden" id="uploaden" value="Submit" />
         </p></td>
      </tr>
      <tr valign="baseline">
         <td width="10%" align="right" nowrap>&nbsp;</td>
         <td><input name="Toevoegen" type="submit" id="Toevoegen" value="Toevoegen" />
         <input name="Wijzigen" type="submit" id="Wijzigen" value="Wijzigen" />
         <input name="Wissen" type="submit" id="Wissen" value="Wissen" /></td>
         <td><input name="leegmaken" type="submit" id="leegmaken" value="Leegmaken" /></td>
         <td width="300">&nbsp;</td>
      </tr>
   </table>
</form>
<?php $concert->Close();
}
?>
</body>
</html>