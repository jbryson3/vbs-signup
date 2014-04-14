<?php

require_once('db.php');

try{
	$dbh = new PDO("mysql:host=$host;dbname=$databaseName", "$adminName", $adminPassword);
} catch (PDOException $e) {
	die("Couldn't Connect to DB!: " . $e->getMessage() . "<br />");
}

//Bring in post values
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$aptNum = $_POST['aptNum'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipCode = $_POST['zipCode'];
$homePhone = $_POST['homePhone'];
$otherPhone = $_POST['otherPhone'];
$emailAddress = $_POST['emailAddress'];
$allergiesAndMedicalInfo = $_POST['allergiesAndMedicalInfo'];
$emergencyContactName = $_POST['emergencyContactName'];
$emergencyContactPhone = $_POST['emergencyContactPhone'];
$emergencyContactRelationship = $_POST['emergencyContactRelationship'];
$primaryPickupName = $_POST['primaryPickupName'];
$primaryPickupRelationship = $_POST['primaryPickupRelationship'];
$homeChurch = $_POST['homeChurch'];
$dateOfBirth = $_POST['dateOfBirth'];
$gradeJustCompleted = $_POST['gradeJustCompleted'];
$tShirtSize = $_POST['tShirtSize'];

if(!$firstName || !$lastName || !$address || !$city || !$state || !$zipCode || !$homePhone || !$emergencyContactName || !$emergencyContactPhone || !$emergencyContactRelationship || !$primaryPickupName || !$primaryPickupRelationship || !$dateOfBirth) {
	$required = !$firstName ? $required . "First Name is Required<br/>" : $required;
	$required = !$lastName ? $required . "Last Name is Required<br/>" : $required;
	$required = !$address ? $required . "Address is Required<br/>" : $required;
	$required = !$city ? $required . "City is Required<br/>" : $required;
	$required = !$state ? $required . "State is Required<br/>" : $required;
	$required = !$zipCode ? $required . "Zip Code is Required<br/>" : $required;
	$required = !$homePhone ? $required . "Home Phone is Required<br/>" : $required;
	$required = !$emergencyContactName ? $required . "Emergency Contact Name is Required<br/>" : $required;
	$required = !$emergencyContactPhone ? $required . "Emergency Contact Phone is Required<br/>" : $required;
	$required = !$emergencyContactRelationship ? $required . "Emergency Contact Relationship is Required<br/>" : $required;
	$required = !$primaryPickupName ? $required . "Primary Pickup Name is Required<br/>" : $required;
	$required = !$primaryPickupRelationship ? $required . "Primary Pickup Relationship is Required<br/>" : $required;
	$required = !$dateOfBirth ? $required . "Date of Birth is Required<br/>" : $required;
	$required = $required . "<br/>Go back and fill in these fields.";
	//$required = "?".substr($required, 1);
	die($required);
}

//check for duplicates
$stmt = $dbh->prepare("SELECT * FROM $participantTable WHERE firstName = :firstName AND lastName = :lastName");
$stmt->bindParam(':firstName', $firstName);
$stmt->bindParam(':lastName', $lastName);

if(!$stmt->execute()){
	die("Sign-up Failed - Go back and try again.");
}

if(count($stmt->fetchAll()) > 0){
	die(htmlspecialchars($_POST['firstName']) . " " . htmlspecialchars($_POST['lastName']) ." is already signed-up!");
}

$stmt = $dbh->prepare("SELECT * FROM $participantTable");
if(!$stmt->execute()){
	die("Sign-up Failed - Go back and try again.");
}
$totalRecords = count($stmt->fetchAll());
$totalRecords += 1;

$stmt = $dbh->prepare("INSERT INTO $participantTable (kidID, firstName, lastName, address, aptNum, city, state, zipCode, homePhone, otherPhone, emailAddress, allergiesAndMedicalInfo, emergencyContactName, emergencyContactPhone, emergencyContactRelationship, primaryPickupName, primaryPickupRelationship, homeChurch, dateOfBirth, gradeJustCompleted, tShirtSize, signupTime)
					VALUES (:kidID, :firstName, :lastName, :address, :aptNum, :city, :state, :zipCode, :homePhone, :otherPhone, :emailAddress, :allergiesAndMedicalInfo, :emergencyContactName, :emergencyContactPhone, :emergencyContactRelationship, :primaryPickupName, :primaryPickupRelationship, :homeChurch, :dateOfBirth, :gradeJustCompleted, :tShirtSize, :signupTime)");
$stmt->bindParam(':kidID', $totalRecords);
$stmt->bindParam(':firstName', $firstName);
$stmt->bindParam(':lastName', $lastName);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':aptNum', $aptNum);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':state', $state);
$stmt->bindParam(':zipCode', $zipCode);
$stmt->bindParam(':homePhone', $homePhone);
$stmt->bindParam(':otherPhone', $otherPhone);
$stmt->bindParam(':emailAddress', $emailAddress);
$stmt->bindParam(':allergiesAndMedicalInfo', $allergiesAndMedicalInfo);
$stmt->bindParam(':emergencyContactName', $emergencyContactName);
$stmt->bindParam(':emergencyContactPhone', $emergencyContactPhone);
$stmt->bindParam(':emergencyContactRelationship', $emergencyContactRelationship);
$stmt->bindParam(':primaryPickupName', $primaryPickupName);
$stmt->bindParam(':primaryPickupRelationship', $primaryPickupRelationship);
$stmt->bindParam(':homeChurch', $homeChurch);
$stmt->bindParam(':dateOfBirth', $dateOfBirth);
$stmt->bindParam(':gradeJustCompleted', $gradeJustCompleted);
$stmt->bindParam(':tShirtSize', $tShirtSize);
$stmt->bindParam(':signupTime', date("Y-m-d H:i:s",time()));


if(!$stmt->execute()){
	die("Sign-up Failed - Go back and try again.");
}

echo htmlspecialchars($_POST['firstName']) . " " . htmlspecialchars($_POST['lastName']) . " is signed up for VBS! We look forward to having them with us.<br/>";
echo "<a href='participantForm.html'>Add Another Child</a>";

$dbh = null;

?>
