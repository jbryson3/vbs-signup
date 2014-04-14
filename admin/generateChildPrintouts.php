<?php
session_start();

if(!isset($_SESSION["username"])){
	header('Location: adminLogin.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title></title>
		<link type="text/css" rel="stylesheet" media="print" href="print.css" />
	</head>
	<body>

	<style type="text/css">
		td{
			width:50%;
			vertical-align:middle;
			padding-right:5px;
			padding-left:5px;
			white-space:nowrap;
		}

		fieldset{
			width:100%;
			margin-left:auto;
			margin-right:auto;
		}

		textarea{
			overflow:hidden;
		}

		legend{
			font-weight:bold;
		}

		.showPrint{
			display:block;

		}


		h1, h2, h3, h4{
			margin:0px auto;
			font-weight:normal;
			text-align:left;
			margin-bottom: 20px;
		}

		html{
			padding:0px;
			margin-top:0px;
			padding-right:20px;
		}

		ul{
			list-style:none inside none;
			padding:0px;
			margin:0px;
		}

		li{
			float:left;
			padding:6px;
		}

		input, textarea{
			border:1px solid black;
			font-size:14px;
		}

		textarea{
			overflow:hidden !important;
		}

		tr td:first-child{
			width:35%;
		}

		#last td:first-child{
			width:1%;
		}

		.LB{
			page-break-after:always;
		}


	</style>
	<h2 class="hidePrint" style="font-weight:bold; background-color:black; color:red;">Go to "File" > "Print Preview" to see how it's going to look when printed (much better than it does here).</h2>
<?php

require_once('../db.php');

$conn = mysql_connect($host, $adminName, $adminPassword) or die("error connecting to mysql");
mysql_select_db($databaseName);
$query = "SELECT * FROM $participantTable WHERE ";
foreach($_POST as $key => $val){
	$query .= "id=" . $key . " OR ";
}
$query .= "0 ORDER BY signupTime";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$id = $row["id"];
$firstName = $row["firstName"];
$lastName = $row["lastName"];
$address = $row["address"];
$aptNum = $row["aptNum"];
$city = $row["city"];
$state = $row["state"];
$zipCode = $row["zipCode"];
$homePhone = $row["homePhone"];
$otherPhone = $row["otherPhone"];
$emailAddress = $row["emailAddress"];
$allergiesAndMedicalInfo = $row["allergiesAndMedicalInfo"];
$emergencyContactName = $row["emergencyContactName"];
$emergencyContactPhone = $row["emergencyContactPhone"];
$emergencyContactRelationship = $row["emergencyContactRelationship"];
$primaryPickupName = $row["primaryPickupName"];
$primaryPickupRelationship = $row["primaryPickupRelationship"];
$homeChurch = $row["homeChurch"];
$dateOfBirth = $row["dateOfBirth"];
$gradeJustCompleted = $row["gradeJustCompleted"];
$tShirtSize = $row["tShirtSize"];
$signupTime = $row["signupTime"];
$tshirtSize = $row["tShirtSize"];
switch($tshirtSize){
	case "toddler2T":
		$tshirtSize="Toddler: 2T";
		break;
	case "toddler3T":
		$tshirtSize="Toddler: 3T";
		break;
	case "toddler4T":
		$tshirtSize="Toddler: 4T";
		break;
	case "youthS":
		$tshirtSize="Youth: Small";
		break;
	case "youthM":
		$tshirtSize="Youth: Medium";
		break;
	case "youthL":
		$tshirtSize="Youth: Large";
		break;
	case "youthXL":
		$tshirtSize="Youth: Extra Large";
		break;
	case "adultS":
		$tshirtSize="Adult: Small";
		break;
	case "adultM":
		$tshirtSize="Adult: Medium";
		break;
	case "adultL":
		$tshirtSize="Adult: Large";
		break;
	default:
		$tshirtSize="None";
		break;
}
print <<<ENDOFTEXT
	<p><h1 style="float:left;">$lastName, $firstName</h1></p>
	<h4 style="float:right;">VBS 2014 - Westwood Baptist Church</h4>
	<br style="clear:both" />
			<fieldset>
				<legend>Personal Information</legend>
				<table style="width:100%"><tr><td>
					<div style="text-align:right;" id="firstName">First Name:</div></td><td><input type="text" name="firstName" style="width:100%" value="$firstName"/>
						</td></tr><tr><td>
					<div style="text-align:right;" id="lastName">Last Name:</div></td><td><input type="text" name="lastName" style="width:100%" value="$lastName"/>
				</td></tr></table>
			</fieldset>

			<fieldset>
				<legend>Address & Phone</legend>
				<table style="width:100%"><tr><td>
					<div style="text-align:right;" id="address">Address:</div></td><td><input type="text" name="address" style="width:100%" value="$address"/>
						</td></tr><tr><td>
					<div style="text-align:right;" id="aptNum">Apt #:</div></td><td><input type="text" name="aptNum" style="width:100%" value="$aptNum"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="city">City:</div></td><td><input type="text" name="city" style="width:100%" value="$city"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="state">State:</div></td><td><input type="text" name="state" style="width:100%" value="$state"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="zipCode">Zip/Postal Code:</div></td><td><input type="text" name="zipCode" style="width:100%" value="$zipCode"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="homePhone">Home Phone:</div></td><td><input type="text" name="homePhone" style="width:100%" value="$homePhone"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="otherPhone">Other Phone:</div></td><td><input type="text" name="otherPhone" style="width:100%" value="$otherPhone"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="emailAddress">Email Address:</div></td><td><input type="text" name="emailAddress" style="width:100%" value="$emailAddress"/>

				</td></tr></table>
			</fieldset>

			<fieldset>
				<legend>Emergency & Guardian Information</legend>
				<table style="width:100%"><tr><td>
					<div style="text-align:right;" id="allergiesAndMedicalInfo">Allergies & Medical Information:</div></td><td></td>
						</td></tr><tr><td colspan=2><textarea name="allergiesAndMedicalInfo" style="width:100%; height:60px;" >$allergiesAndMedicalInfo</textarea></td>
						</tr><tr><td>
					<div style="text-align:right;" id="emergencyContactName">Emergency Contact Name:</div></td><td><input type="text" name="emergencyContactName" style="width:100%" value="$emergencyContactName"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="emergencyContactPhone">Emergency Contact Phone:</div></td><td><input type="text" name="emergencyContactPhone" style="width:100%" value="$emergencyContactPhone"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="emergencyContactRelationship">Emergency Contact Relationship:</div></td><td><input type="text" name="emergencyContactRelationship" style="width:100%" value="$emergencyContactRelationship"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="primaryPickupName">Adult who will pick-up child:</div></td><td><input type="text" name="primaryPickupName" style="width:100%" value="$primaryPickupName"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="primaryPickupRelationship">Relationship to child:</div></td><td><input type="text" name="primaryPickupRelationship" style="width:100%" value="$primaryPickupRelationship"/>
				</td></tr></table>
			</fieldset>

			<fieldset id="last">
				<legend>Additional Information</legend>
				<table style="width:100%"><tr><td>
					<div style="text-align:right;" id="homeChurch">Home Church:</div></td><td><input type="text" name="homeChurch" style="width:100%" value="$homeChurch"/>
						</td></tr><tr><td>
					<div style="text-align:right;" id="dateOfBirth">Date of Birth:</div></td><td><input type="text" name="dateOfBirth" style="width:100%" value="$dateOfBirth"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="gradeJustCompleted">Grade Just Completed:</div></td><td><input type="text" name="gradeJustCompleted" style="width:100%" value="$gradeJustCompleted"/>
					</td></tr><tr><td>
					<div style="text-align:right;" id="tShirtSize">Child's T-Shirt Size:</div></td><td><input type="text" style="width:100%" value="$tshirtSize" />


				</td></tr></table>

			</fieldset>
			<div class="LB"></div>
ENDOFTEXT;
}
?>
	</body>
</html>
