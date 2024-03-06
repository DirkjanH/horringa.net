<?php 
	# PHP ADODB document - made with PHAkt
	# FileName="Connection_php_adodb.htm"
	# Type="ADODB"
	# HTTP="true"
	# DBTYPE="mysql"
	
	$MM_Concerten_HOSTNAME = 'localhost';
	$MM_Concerten_DATABASE = 'mysql:horrin1q_bestellen';
	$MM_Concerten_DBTYPE   = preg_replace('/:.*$/', '', $MM_Concerten_DATABASE);
	$MM_Concerten_DATABASE = preg_replace('/^[^:]*?:/', '', $MM_Concerten_DATABASE);
	$MM_Concerten_USERNAME = 'horrin1q_bestel';
	$MM_Concerten_PASSWORD = 'dirigent';
	$MM_Concerten_LOCALE = 'En';
	$MM_Concerten_MSGLOCALE = 'En';
	$MM_Concerten_CTYPE = 'P';
	$KT_locale = $MM_Concerten_MSGLOCALE;
	$KT_dlocale = $MM_Concerten_LOCALE;
	$KT_serverFormat = '%Y-%m-%d %H:%M:%S';
	$QUB_Caching = 'false';

	$KT_localFormat = $KT_serverFormat;
	
	if (!defined('CONN_DIR')) define('CONN_DIR',dirname(__FILE__));
	require_once(CONN_DIR.'/../adodb/adodb.inc.php');
	$Concerten=&KTNewConnection($MM_Concerten_DBTYPE);

	if($MM_Concerten_DBTYPE == 'access' || $MM_Concerten_DBTYPE == 'odbc'){
		if($MM_Concerten_CTYPE == 'P'){
			$Concerten->PConnect($MM_Concerten_DATABASE, $MM_Concerten_USERNAME,$MM_Concerten_PASSWORD);
		} else $Concerten->Connect($MM_Concerten_DATABASE, $MM_Concerten_USERNAME,$MM_Concerten_PASSWORD);
	} else if (($MM_Concerten_DBTYPE == 'ibase') or ($MM_Concerten_DBTYPE == 'firebird')) {
		if($MM_Concerten_CTYPE == 'P'){
			$Concerten->PConnect($MM_Concerten_HOSTNAME.':'.$MM_Concerten_DATABASE,$MM_Concerten_USERNAME,$MM_Concerten_PASSWORD);
		} else $Concerten->Connect($MM_Concerten_HOSTNAME.':'.$MM_Concerten_DATABASE,$MM_Concerten_USERNAME,$MM_Concerten_PASSWORD);
	}else {
		if($MM_Concerten_CTYPE == 'P'){
			$Concerten->PConnect($MM_Concerten_HOSTNAME,$MM_Concerten_USERNAME,$MM_Concerten_PASSWORD, $MM_Concerten_DATABASE);
		} else $Concerten->Connect($MM_Concerten_HOSTNAME,$MM_Concerten_USERNAME,$MM_Concerten_PASSWORD, $MM_Concerten_DATABASE);
   }

	if (!function_exists('updateMagicQuotes')) {
		function updateMagicQuotes($HTTP_VARS){
			if (is_array($HTTP_VARS)) {
				foreach ($HTTP_VARS as $name=>$value) {
					if (!is_array($value)) {
						$HTTP_VARS[$name] = addslashes($value);
					} else {
						foreach ($value as $name1=>$value1) {
							if (!is_array($value1)) {
								$HTTP_VARS[$name1][$value1] = addslashes($value1);
							}
						}
					}
				}
			}
			return $HTTP_VARS;
		}
		
		if (!get_magic_quotes_gpc()) {
			$_GET = updateMagicQuotes($_GET);
			$_POST = updateMagicQuotes($_POST);
			$_COOKIE = updateMagicQuotes($_COOKIE);
		}
	}
	if (!isset($_SERVER['REQUEST_URI']) && isset($_ENV['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = $_ENV['REQUEST_URI'];
	}
	if (!isset($_SERVER['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'].(isset($_SERVER['QUERY_STRING'])?"?".$_SERVER['QUERY_STRING']:"");
	}

/* Stel de character set in */
$Concerten->Execute("SET NAMES UTF8;");
?>