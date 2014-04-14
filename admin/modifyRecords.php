<?php
session_start();

if(!isset($_SESSION["username"])){
	header('Location: adminLogin.php');
}

require_once('../db.php');

$conn = mysql_connect($host, $adminName, $adminPassword) or die("oh no");
mysql_select_db($databaseName);

if(($_POST["request"] == 'delete') && isset($_POST["id"])){
	$query = "DELETE FROM $participantTable WHERE id=".$_POST["id"];
	//BACKUP DATABASE HERE
	if(!mysql_query($query)){
		print "<div id='error'>Sorry, Couldn't delete " . $_POST["name"] . " from Database!</div>";
	} else{
		print "<div id='success'>".$_POST["name"]." has been deleted from the database.</div>";
	}

}

if( (($_POST["request"] == 'modify') && isset($_POST["id"])) || ($_POST["request"] == 'add') ){

	try{
	$dbh = new PDO("mysql:host=$host;dbname=$databaseName", "$adminName", $adminPassword);
	} catch (PDOException $e) {
		die("<div id='error'>Couldn't Connect to DB!</div>");
	}

	if($_POST["request"]=='modify'){
		$sql = "UPDATE $participantTable SET firstName=:firstName, lastname=:lastName, address=:address, aptNum=:aptNum, city=:city, state=:state, zipCode=:zipCode, homePhone=:homePhone, otherPhone=:otherPhone, emailAddress=:emailAddress, allergiesAndMedicalInfo=:allergiesAndMedicalInfo, emergencyContactName=:emergencyContactName, emergencyContactPhone=:emergencyContactPhone, emergencyContactRelationship=:emergencyContactRelationship, primaryPickupName=:primaryPickupName, primaryPickupRelationship=:primaryPickupRelationship, homeChurch=:homeChurch, dateOfBirth=:dateOfBirth, gradeJustCompleted=:gradeJustCompleted, tShirtSize=:tShirtSize WHERE id=".$_POST["id"];
		$successMSG = $_POST["name"]."'s record has been modified successfully!";
		$errorMSG = "Sorry, Couldn't modify " . $_POST["name"] . "'s record.";
	} else {
		$sql = "INSERT INTO $participantTable (firstName, lastname, address, aptNum, city, state, zipCode, homePhone, otherPhone, emailAddress, allergiesAndMedicalInfo, emergencyContactName, emergencyContactPhone, emergencyContactRelationship, primaryPickupName, primaryPickupRelationship, homeChurch, dateOfBirth, gradeJustCompleted, tShirtSize) VALUES (:firstName, :lastname, :address, :aptNum, :city, :state, :zipCode, :homePhone, :otherPhone, :emailAddress, :allergiesAndMedicalInfo, :emergencyContactName, :emergencyContactPhone, :emergencyContactRelationship, :primaryPickupName, :primaryPickupRelationship, :homeChurch, :dateOfBirth, :gradeJustCompleted, :tShirtSize)";
		$successMSG = $_POST["name"]."'s record has been added successfully!";
		$errorMSG = "Sorry, Couldn't add " . $_POST["name"] . ".";
	}
	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(':firstName', $_POST["firstName"]);
	$stmt->bindParam(':lastName', $_POST["lastName"]);
	$stmt->bindParam(':address', $_POST["address"]);
	$stmt->bindParam(':aptNum', $_POST["aptNum"]);
	$stmt->bindParam(':city', $_POST["city"]);
	$stmt->bindParam(':state', $_POST["state"]);
	$stmt->bindParam(':zipCode', $_POST["zipCode"]);
	$stmt->bindParam(':homePhone', $_POST["homePhone"]);
	$stmt->bindParam(':otherPhone', $_POST["otherPhone"]);
	$stmt->bindParam(':emailAddress', $_POST["emailAddress"]);
	$stmt->bindParam(':allergiesAndMedicalInfo', $_POST["allergiesAndMedicalInfo"]);
	$stmt->bindParam(':emergencyContactName', $_POST["emergencyContactName"]);
	$stmt->bindParam(':emergencyContactPhone', $_POST["emergencyContactPhone"]);
	$stmt->bindParam(':emergencyContactRelationship', $_POST["emergencyContactRelationship"]);
	$stmt->bindParam(':primaryPickupName', $_POST["primaryPickupName"]);
	$stmt->bindParam(':primaryPickupRelationship', $_POST["primaryPickupRelationship"]);
	$stmt->bindParam(':homeChurch', $_POST["homeChurch"]);
	$stmt->bindParam(':dateOfBirth', $_POST["dateOfBirth"]);
	$stmt->bindParam(':gradeJustCompleted', $_POST["gradeJustCompleted"]);
	$stmt->bindParam(':tShirtSize', $_POST["tShirtSize"]);

	//BACKUP DATABASE HERE
	if(!$stmt->execute()){
		print "<div id='error'>$errorMSG</div>";
	} else{
		print "<div id='success'>$successMSG</div>";
	}
}

mysql_close($conn);
$dbh = null;
?>
