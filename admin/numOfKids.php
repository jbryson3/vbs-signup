<?php
session_start();

if(!isset($_SESSION["username"])){
	header('Location: adminLogin.php');
}

require_once('../db.php');

$conn = mysql_connect($host, $adminName, $adminPassword) or die("Could not get connection");
mysql_select_db($databaseName);
$query = "SELECT id FROM $participantTable";
echo mysql_num_rows(mysql_query($query));
?>
