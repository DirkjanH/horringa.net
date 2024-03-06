<?php 
require("../phpmailer/class.phpmailer.php");

class LPmailer extends PHPMailer {

	var $Mailer = "smtp";         			// set mailer to use SMTP
	var $Host = "localhost";  				// specify main and backup server
	var $SMTPAuth = false;     				// turn on SMTP authentication
	
	var $Body =	"html";                     // set email format to HTML
	var $From = "info@pellegrina.net";
	var $FromName = "La Pellegrina";
	var $CharSet = "utf-8";
	var $Timeout = 600;
	//var $AddAttachment("/var/tmp/file.tar.gz");         // add attachments
	//var $AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name

/* The following code snippet with set the maximum execution time
 * of your script to 600 seconds (10 minutes)
 * Note: set_time_limit() does not work with safe_mode enabled
 */

}

$safeMode = ( @ini_get("safe_mode") == 'On' || @ini_get("safe_mode") === 1 ) ? TRUE : FALSE;
if ( $safeMode === FALSE ) {
  set_time_limit(600); // Sets maximum execution time to 10 minutes (600 seconds)
}

// echo "max_execution_time " . ini_get('max_execution_time') . "<br>";

?>
