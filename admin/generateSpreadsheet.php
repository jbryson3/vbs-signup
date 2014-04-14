<?php
session_start();

if(!isset($_SESSION["username"])){
	header('Location: adminLogin.php');
}

/** PHPExcel */
require_once 'Classes/PHPExcel.php';

require_once('../db.php');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator($_SESSION['username'])
							 ->setLastModifiedBy($_SESSION['username'])
							 ->setTitle("VBS 2014 Participant Roster")
							 ->setSubject("VBS 2014 Participant Roster")
							 ->setDescription("Roster of information for the kids participating in VBS 2014.")
							 ->setKeywords("VBS");

$conn = mysql_connect($host, $adminName, $adminPassword) or die("error connecting to mysql");
mysql_select_db($databaseName);
$query = "SELECT * FROM $participantTable ORDER BY signupTime";
$result = mysql_query($query);
$totalKids = mysql_num_rows($result);

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'First Name')
            ->setCellValue('B1', 'Last Name')
            ->setCellValue('C1', 'Address')
            ->setCellValue('D1', 'Home Phone')
			->setCellValue('E1', 'Other Phone')
			->setCellValue('F1', 'Email Address')
			->setCellValue('G1', 'Allergies and Medical Info')
			->setCellValue('H1', 'Emergency Contact Info')
			->setCellValue('I1', 'Pickup Info')
			->setCellValue('J1', 'Home Church')
			->setCellValue('K1', 'Date of Birth')
			->setCellValue('L1', 'Grade Just Completed')
			->setCellValue('M1', 'T-Shirt Size')
			->setCellValue('N1', 'Signup Time')
			->setCellValue('O1', 'Group');
$i=2;
while($row = mysql_fetch_array($result)){
	$row["aptNum"] = preg_replace('/\s/', '', $row["aptNum"]);
	$apt = (($row["aptNum"] == '') || ($row["aptNum"] == 'NULL') || !$row["aptNum"]) ? "" : "Apt# " . $row["aptNum"];
	$address = $row["address"] ." " . $apt . " " . $row["city"] . ", " . $row["state"] . " " . $row["zipCode"];
	$emergencyContact = $row["emergencyContactName"] . " (" . $row["emergencyContactRelationship"] . ") - " . $row["emergencyContactPhone"];
	$pickupContact = $row["primaryPickupName"] . " (" . $row["primaryPickupRelationship"] .")";
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

	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $row["firstName"])
            ->setCellValue('B'.$i, $row["lastName"])
            ->setCellValue('C'.$i, $address)
            ->setCellValue('D'.$i, $row["homePhone"])
			->setCellValue('E'.$i, $row["otherPhone"])
			->setCellValue('F'.$i, $row["emailAddress"])
			->setCellValue('G'.$i, $row["allergiesAndMedicalInfo"])
			->setCellValue('H'.$i, $emergencyContact)
			->setCellValue('I'.$i, $pickupContact)
			->setCellValue('J'.$i, $row["homeChurch"])
			->setCellValue('K'.$i, $row["dateOfBirth"])
			->setCellValue('L'.$i, $row["gradeJustCompleted"])
			->setCellValue('M'.$i, $tshirtSize)
			->setCellValue('N'.$i, $row["signupTime"]);
	$i++;
}

$boldCondition = new PHPExcel_Style_Conditional();
$boldCondition->getStyle()->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
$allRows = "A2:O" . ($totalKids+1);
//$objPHPExcel->getActiveSheet()->getStyle($allRows)->getAlignment()->setWrapText(true);
//$objPHPExcel->getActiveSheet()->getStyle('H5')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(42);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(32);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(21);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(18);



// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client�s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="VBS2014_ParticipantRoster-'.$totalKids.'Kids.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>
