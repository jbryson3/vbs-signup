<?php
include 'config.php';
include 'opendb.php';
require_once('../db.php');

$conn = mysql_connect($host, $adminName, $adminPassword) or die("oh no");
mysql_select_db($databaseName);

$backupFile = 'backup.sql';
$query      = "SELECT * INTO OUTFILE '$backupFile' FROM $participantTable";
$result = mysql_query($query);
if(!$result){
print "error: " .mysql_error();
}
include 'closedb.php';
?>
