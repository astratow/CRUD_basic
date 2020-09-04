<?php

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'records2';
$port = '3308';

$mysqli = new mysqli($server, $user, NULL, $db, $port);

mysqli_report(MYSQLI_REPORT_ERROR);

?>
