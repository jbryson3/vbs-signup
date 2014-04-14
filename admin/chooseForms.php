<?php
session_start();

if(!isset($_SESSION["username"])){
	header('Location: adminLogin.php');
}

require_once('../db.php');

$conn = mysql_connect($host, $adminName, $adminPassword) or die("error connecting to mysql");
mysql_select_db($databaseName);
$query = "SELECT id,firstName,lastName FROM $participantTable ORDER BY signupTime";
$result = mysql_query($query);
?>

<h1>Select Forms</h1>
<h3>Please select the individuals for which forms you'd like to be printed.</h3>
<form action="generateChildPrintouts.php" method="POST">

<?php

$i = 1;
while($row = mysql_fetch_array($result)){
	print $i . '<input class="checkb" type="checkbox" name="' . $row["id"] . '" value="true" /> ' . $row["firstName"] . " " . $row["lastName"] . "<br/>";
	$i++;
}

print "<br/><input type='submit' value='Generate Printouts' /></form>";
?>
