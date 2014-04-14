<?php
session_start();

if(!isset($_SESSION["username"])){
	header('Location: adminLogin.php');
}

require_once('../db.php');

$conn = mysql_connect($host, $adminName, $adminPassword) or die("error connecting to mysql");
mysql_select_db($databaseName);
$query = "SELECT id,kidID,signupTime FROM $participantTable ORDER BY signupTime";
$result = mysql_query($query);

$stmt = "UPDATE $participantTable SET kidID = CASE id ";
$newID = 1;
$isOrdered = 1;
while($row = mysql_fetch_array($result)){
	if($row["kidID"] != $newID){
		$stmt .= "WHEN ".$row["id"]." THEN $newID ";
		$isOrdered=0;
	}
	$newID++;
}
$stmt .= "END";
if(!$isOrdered) mysql_query($stmt) or die("error ordering kids: " . mysql_error());

?>
