<?php 
date_default_timezone_set('Europe/Amsterdam');
setlocale(LC_ALL, 'nl_NL@euro', 'nl_NL', 'du', 'NL');

$db = new PDO('mysql:host=localhost;dbname=horringa_db;charset=utf8mb4', 'horringa_db', '12dirig.');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>