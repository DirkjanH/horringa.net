<?php 
require("../LP/includes/LPmailer.inc.php");

$jaar = date('Y');

$mail = new LPmailer();

$boodschap = "";

if (isset($_POST['Verzenden']) and $_POST['Verzenden'] != "") {

switch ($_POST['Taal']) {
case "nl": 
   $subject = "'n gelukkig nieuw jaar {$jaar}";
	$boodschap = "Beste $voornaam,


We wensen je een prachtig jaar.


Met muzikale groet,

Dirkjan & Annemieke
";
	if (isset($_POST['boodschap']) and $_POST['boodschap'] != "") $boodschap = stripslashes($_POST['boodschap']);
   break;
case "en":
   $subject = "A very good {$jaar}";
	$boodschap = "Dear $voornaam,


With musical greetings,
	
Dirkjan & Annemieke";
   if (isset($_POST['boodschap']) and $_POST['boodschap'] != "") $boodschap = stripslashes($_POST['boodschap']);
   break;
case "cz":
   $subject = "Vše nejlepší do Nového roku {$jaar}";
	$boodschap = "Milý $voornaam,


Hodně zdraví, štěstí a krásné hudby v roce {$jaar} přejí 
	
Dirkjan & Annemieke
";
   if (isset($_POST['boodschap']) and $_POST['boodschap'] != "") $boodschap = stripslashes($_POST['boodschap']);
   break;
}
// check email:
if (empty($_POST['email']) or !strstr($_POST['email'], "@") or !strstr($_POST['email'], ".") or strstr($_POST['email'], " "))
	{
		$error = true;
		echo "Het emailadres is niet of niet correct ingevuld\n";
	}
else
	{
	$_POST['email'] = strtolower($_POST['email']);
	}

if (isset($_POST['Verzenden']) and $_POST['Verzenden'] == "Verzenden") {

		$text = nl2br($boodschap);
		
		$body = "<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<title>nieuwjaarskaart</title>
		<style type=\"text/css\">
		<!--
		body, td, p {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 13px;
			color: #663300;
			background-image: url(http://horringa.xs4all.nl/Papier.gif);

		}
		-->
		</style>
		</head>
		<body>
		<table width=\"600\" cellpadding=\"0\" cellspacing=\"10\">
			<tr>
				<td><p>{$text}</p>
				<hr /></td>
			</tr>
			<tr>
				<td><div align=\"center\">
					<p>Dirkjan Horringa, Merwedeplantsoen 73, 3522 JZ Utrecht, Nederland<br />
						tel (+31) 030-2382535 | mobiel (+31) 0619-224758<br />
					web site: <a href=\"http://www.horringa.net\" target=\"_blank\">www.horringa.net</a> </p>
					</div></td>
			</tr>
			<tr>
				<td><div align=\"center\"><IMG src=\"http://horringa.xs4all.nl/Images/boom.bmp\"><BR>
				</div></td>
			</tr>
		</table>
		</body>
		</html>
		";

		$mail->From = "dirkjan@pellegrina.net";
		$mail->FromName = "Dirkjan Horringa";
		$mail->AddAddress("{$_POST['email']}", "{$_POST['voornaam']} {$_POST['achternaam']}");
		$mail->AddBcc("{$jaar}@pellegrina.net", "Dirkjan Horringa");
		$mail->Subject = "$subject";
		$mail->Body = $body;
		$mail->AltBody = strip_tags($body);
		if(!$mail->Send())
		{
			echo "Message could not be sent. <p>";
			echo "Mailer Error: " . $mail->ErrorInfo;
			exit;
		}
		
		echo "Message has been sent";

	}

if (isset($_POST['Wissen']) and $_POST['Wissen'] == "Wissen") $_POST = "";

}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Nieuwjaarskaart <?php echo $jaar; ?></title>
<style type="text/css">
<!--
body, td, p {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #663300;
	background-image: url(http://www.pellegrina.nl/LP/Images/Papier.gif);
}
-->
</style>
</head>
<body>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['../PHP_SELF']; ?>">
   <table width="719" cellpadding="0" cellspacing="0">
      <tr>
         <td width="196"><label>Voornaam:
               <br>
               <input name="voornaam" type="text" id="voornaam"  value="<?php if (isset($_POST['voornaam'])) echo $_POST['voornaam']; ?>">
         </label></td>
         <td width="196"><label>Achternaam:
               <br>
               <input name="achternaam" type="text" id="achternaam"  value="<?php if (isset($_POST['achternaam'])) echo $_POST['achternaam']; ?>">
         </label></td>
         <td width="325"><p>
            <label>
               <input name="Taal" type="radio" value="nl" <?php 
					if (isset($_POST['Taal']) and ($_POST['Taal'] == "nl")) 
									echo 'checked'; elseif (empty($_POST['Taal'])) echo 'checked'; ?>>
               Nederlands</label>
            <label>
               <input type="radio" name="Taal" value="en"  <?php if 
					(isset($_POST['Taal']) and ($_POST['Taal'] == "en")) echo 'checked'; ?>>
               Engels</label>
            <label>
               <input type="radio" name="Taal" value="cz" <?php if 
					(isset($_POST['Taal']) and ($_POST['Taal'] == "cz")) echo 'checked'; ?>>
               Tsjechisch</label>
            <br>
         </p></td>
      </tr>

      <tr>
         <td colspan="3"><label><br>
            Email:
                <input name="email" type="text" id="email" size="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
         </label></td>
      </tr>
      <tr>
         <td colspan="3">         <label><br>
            Boodschap<br>
				<textarea name="boodschap" cols="80" rows="5" id="boodschap"><?php echo $boodschap; ?></textarea>
         </label></td>
      </tr>
   </table>
   <p>
      <input name="Verzenden" type="submit" id="Verzenden" value="Verzenden">
      <input name="Wissen" type="submit" id="Wissen" value="Wissen">
      <input name="Verzenden" type="submit" id="Verzenden" value="Bekijken">
   </p>
</form>
<table width="600" cellpadding="0" cellspacing="10">
   <tr>
      <td><p><?php echo nl2br($boodschap); ?></p>
         <hr></td>
   </tr>
   <tr>
      <td><div align="center">
         <p>Dirkjan Horringa, Merwedeplantsoen 73, 3522 JZ Utrecht, Nederland<br>
            tel (+31) 030-238 25 35 | mobiel (+31) 0619-224758<br>
         web site: <a href="http://www.horringa.net" target="_blank">www.horringa.net</a> </p>
         </div></td>
   </tr>
   <tr>
      <td><div align="center"><IMG src="http://horringa.xs4all.nl/Images/boom.bmp"><BR>
      </div></td>
   </tr>
</table>
</body>
</html>
