<?php
date_default_timezone_set( 'Europe/Amsterdam' );
setlocale( LC_ALL, 'nl_NL@euro', 'nl_NL', 'du', 'NL' );

try {
	$db = new PDO( 'mysql:host=localhost;dbname=horringa_db;charset=utf8mb4', 'horringa_db', '12dirig.' );
//	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//	$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
} 
	catch ( PDOException $e ) {
		echo "Error: {$e}<br>";
}

function select_query( $query, $i = 2 ) {
	global $db;
	foreach ( $db->query( $query, PDO::FETCH_ASSOC ) as $row ) {
		$result[] = $row;
	}
	// echo'$i = '.$i.'<br>';
	if ($i == 1 and is_array($result) and count($result) == 1) {
		$result = $result[0];
	}
	return ( $result );
}

function print_all($p) {
	echo '<pre><p>';
	print_r($p);
	echo '</p></pre>';
}

function exec_query($query) {
	global $db;
	// print_all($query);
	try {
		$db->exec($query);
	} 
	catch ( PDOException $e ) {
		echo "Error: {$e}<br>";
	}
}

function quote($value) {
	global $db;
	//d($value);
	return $db->quote($value);
}


?>