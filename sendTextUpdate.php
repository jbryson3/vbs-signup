<?php

require_once('db.php');

$conn = mysql_connect($host, $adminName, $adminPassword) or die("error connecting to mysql");
mysql_select_db($databaseName);
$query = "SELECT signupTime FROM $participantTable";
$result = mysql_query($query);
$totalRows = mysql_num_rows($result);
$signupsSince = 0;

$timeDifference = 60*60*24*7; //1 week
$pastTime = time() - $timeDifference;

while($row = mysql_fetch_array($result)){
	//is this time between now and difference?
	if(strtotime($row["signupTime"]) > $pastTime){
		$signupsSince += 1;
	}
}

if($signupsSince == 0){
	$textMSG = "We haven't had any kids sign up for VBS since last Sunday. Our total is still $totalRows kids.";
} elseif ($signupsSince == 1){
	$textMSG = "We've had 1 kid sign up for VBS since last Sunday. That brings our total to $totalRows kids!";
} else{
	$textMSG = "We've had $signupsSince kids sign up for VBS since last Sunday. That brings our total to $totalRows kids!";
}
if(isset($_GET["send"])){
	mail("5712140483@vtext.com","",$textMSG);
	mail("7039803250@messaging.sprintpcs.com","",$textMSG);
}

mysql_close($conn);

?>
