<pre>
<?php

require_once('../db.php');

$backupFile = $dbname . date("Y-m-d-H-i-s")  . '.sql';

$cmd = "mysqldump --opt -h $host -u $adminName -p $adminPassword $databaseName > $backupFile";
echo passthru($cmd);

?>
</pre>
