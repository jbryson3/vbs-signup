<?php
session_start();

if(!isset($_SESSION["username"])){
	header('Location: adminLogin.php');
}

require_once('../db.php');

$conn = mysql_connect($host, $adminName, $adminPassword) or die();
mysql_select_db($databaseName);
$query = "SELECT * FROM $participantTable ORDER BY signupTime";
$result = mysql_query($query);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head><title></title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.js"></script>
<script type="text/javascript" src="assets/jquery.pnotify.min.js"></script>
<link href="assets/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="assets/fancybox/jquery.fancybox-1.3.0.pack.js"></script>
<link href="assets/fancybox/jquery.fancybox-1.3.0.css" rel="stylesheet" type="text/css" />

</head><body>
<input id="addChildBtn" style="margin-bottom:5px;" type="button" value="Add Child" /><a style="display:none;" href="#fbForm" id="addChildLink"></a>

<style type="text/css">
	img{
		border:0px;
	}

	th{
		background-color:#eee;
	}

	th, td{
		white-space:nowrap;
	}

	.ui-pnotify-history-container{
		display:none;
	}

	.ui-pnotify-text, .ui-pnotify-title{
		font-size:12px;
	}

	#fancybox-outer{
		border:5px solid #333;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('#addChildBtn').click(function(){

			$('#addChildLink').click();


			$('#submitAddFB').show();
			$('#submitModifyFB').hide();
		});

		$('td').each(function(){
			if($(this).html() == '' || $(this).html() == 'NULL'){
				$(this).html('&nbsp;');
			}
		});

		$('.editButton, #addChildLink').fancybox({
			'width'	: '40%',
			'height'	: '75%',
			'autoDimensions'	: false,
			'centerOnScroll'	: true
		});

		$('#cancelFB').click(function(){
			$.fancybox.close();
		});

		$('#submitAddFB').click(function(){
			$.fancybox.close();

			data = {
				'request' : 'add',
				'firstName'	:	$('#firstName').val(),
				'lastName'	:	$('#lastName').val(),
				'address'	:	$('#address').val(),
				'aptNum'	:	$('#aptNum').val(),
				'city'	:	$('#city').val(),
				'state'	:	$('#state').val(),
				'zipCode'	:	$('#zipCode').val(),
				'homePhone'	:	$('#homePhone').val(),
				'otherPhone'	:	$('#otherPhone').val(),
				'emailAddress'	:	$('#emailAddress').val(),
				'allergiesAndMedicalInfo'	:	$('#allergiesAndMedicalInfo').val(),
				'emergencyContactName'	:	$('#emergencyContactName').val(),
				'emergencyContactPhone'	:	$('#emergencyContactPhone').val(),
				'emergencyContactRelationship'	:	$('#emergencyContactRelationship').val(),
				'primaryPickupName'	:	$('#primaryPickupName').val(),
				'primaryPickupRelationship'	:	$('#primaryPickupRelationship').val(),
				'homeChurch'	:	$('#homeChurch').val(),
				'dateOfBirth'	:	$('#dateOfBirth').val(),
				'gradeJustCompleted'	:	$('#gradeJustCompleted').val(),
				'tShirtSize'	:	$('#tShirtSize option:selected').attr('id'),
				'name'	:	$('#firstName').val() + " " + $('#lastName').val()
			};

			$.ajax({
				type: 'POST',
				data: data,
				url: 'modifyRecords.php',
				success: function(data){
					$('#comDiv').html(data);

					if($('#error').size() != 0){
						$.pnotify({
							pnotify_title: 'Ooops!',
							pnotify_text: $('#error').html(),
							pnotify_type: 'error',
							pnotify_before_open: function(pnotify){
								pnotify.effect("bounce");
							},
							pnotify_animation: {
								effect_in: "none",
								effect_out: "fade"
							}
						});
					}else if($('#success').size() != 0){
						$.pnotify({
							pnotify_title: '<div style="color:green;">Success!</div>',
							pnotify_text: $('#success').html(),
							pnotify_animation: {
								effect_in: "show",
								effect_out: "fade"
							}
						});

						//Change table data

						//$('tr:last').after('<tr><td>hi</td></tr>');
					}
				}
			});
		});

		$('#submitModifyFB').click(function(){
			$.fancybox.close();
			var id = $('#workingID').html();
			data = {
				'request' : 'modify',
				'id' : id,
				'firstName'	:	$('#firstName').val(),
				'lastName'	:	$('#lastName').val(),
				'address'	:	$('#address').val(),
				'aptNum'	:	$('#aptNum').val(),
				'city'	:	$('#city').val(),
				'state'	:	$('#state').val(),
				'zipCode'	:	$('#zipCode').val(),
				'homePhone'	:	$('#homePhone').val(),
				'otherPhone'	:	$('#otherPhone').val(),
				'emailAddress'	:	$('#emailAddress').val(),
				'allergiesAndMedicalInfo'	:	$('#allergiesAndMedicalInfo').val(),
				'emergencyContactName'	:	$('#emergencyContactName').val(),
				'emergencyContactPhone'	:	$('#emergencyContactPhone').val(),
				'emergencyContactRelationship'	:	$('#emergencyContactRelationship').val(),
				'primaryPickupName'	:	$('#primaryPickupName').val(),
				'primaryPickupRelationship'	:	$('#primaryPickupRelationship').val(),
				'homeChurch'	:	$('#homeChurch').val(),
				'dateOfBirth'	:	$('#dateOfBirth').val(),
				'gradeJustCompleted'	:	$('#gradeJustCompleted').val(),
				'tShirtSize'	:	$('#tShirtSize option:selected').attr('id'),
				'name'	:	$('#firstName').val() + " " + $('#lastName').val()
			};

			$.ajax({
				type: 'POST',
				data: data,
				url: 'modifyRecords.php',
				success: function(data){
					$('#comDiv').html(data);

					if($('#error').size() != 0){
						$.pnotify({
							pnotify_title: 'Ooops!',
							pnotify_text: $('#error').html(),
							pnotify_type: 'error',
							pnotify_before_open: function(pnotify){
								pnotify.effect("bounce");
							},
							pnotify_animation: {
								effect_in: "none",
								effect_out: "fade"
							}
						});
					}else if($('#success').size() != 0){
						$.pnotify({
							pnotify_title: '<div style="color:green;">Success!</div>',
							pnotify_text: $('#success').html(),
							pnotify_animation: {
								effect_in: "show",
								effect_out: "fade"
							}
						});

						//Change table data

						$('tr').filter('.'+id).children().filter('td:eq(2)').html($('#firstName').val());
						$('tr').filter('.'+id).children().filter('td:eq(3)').html($('#lastName').val());
						$('tr').filter('.'+id).children().filter('td:eq(4)').html($('#address').val());
						$('tr').filter('.'+id).children().filter('td:eq(5)').html($('#aptNum').val());
						$('tr').filter('.'+id).children().filter('td:eq(6)').html($('#city').val());
						$('tr').filter('.'+id).children().filter('td:eq(7)').html($('#state').val());
						$('tr').filter('.'+id).children().filter('td:eq(8)').html($('#zipCode').val());
						$('tr').filter('.'+id).children().filter('td:eq(9)').html($('#homePhone').val());
						$('tr').filter('.'+id).children().filter('td:eq(10)').html($('#otherPhone').val());
						$('tr').filter('.'+id).children().filter('td:eq(11)').html($('#emailAddress').val());
						$('tr').filter('.'+id).children().filter('td:eq(12)').html($('#allergiesAndMedicalInfo').val());
						$('tr').filter('.'+id).children().filter('td:eq(13)').html($('#emergencyContactName').val());
						$('tr').filter('.'+id).children().filter('td:eq(14)').html($('#emergencyContactPhone').val());
						$('tr').filter('.'+id).children().filter('td:eq(15)').html($('#emergencyContactRelationship').val());
						$('tr').filter('.'+id).children().filter('td:eq(16)').html($('#primaryPickupName').val());
						$('tr').filter('.'+id).children().filter('td:eq(17)').html($('#primaryPickupRelationship').val());
						$('tr').filter('.'+id).children().filter('td:eq(18)').html($('#homeChurch').val());
						$('tr').filter('.'+id).children().filter('td:eq(19)').html($('#dateOfBirth').val());
						$('tr').filter('.'+id).children().filter('td:eq(20)').html($('#gradeJustCompleted').val());
						$('tr').filter('.'+id).children().filter('td:eq(21)').html($('#tShirtSize option:selected').attr('id'));
					}
				}
			});
		});


		$('.editButton').click(function(){
			$('#submitAddFB').hide();
			$('#submitModifyFB').show();

			//Populate form
			var id = $(this).parent().attr('id');
			$('#workingID').html(id);

			if($('tr').filter('.'+id).children().filter('td:eq(2)').html() != '&nbsp;'){
				$('#firstName').val( $('tr').filter('.'+id).children().filter('td:eq(2)').html() );
			}else{$('#firstName').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(3)').html() != '&nbsp;'){
				$('#lastName').val( $('tr').filter('.'+id).children().filter('td:eq(3)').html() );
			}else{$('#lastName').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(4)').html() != '&nbsp;'){
				$('#address').val( $('tr').filter('.'+id).children().filter('td:eq(4)').html() );
			}else{$('#address').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(5)').html() != '&nbsp;'){
				$('#aptNum').val( $('tr').filter('.'+id).children().filter('td:eq(5)').html() );
			}else{$('#aptNum').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(6)').html() != '&nbsp;'){
				$('#city').val( $('tr').filter('.'+id).children().filter('td:eq(6)').html() );
			}else{$('#city').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(7)').html() != '&nbsp;'){
				$('#state').val( $('tr').filter('.'+id).children().filter('td:eq(7)').html() );
			}else{$('#state').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(8)').html() != '&nbsp;'){
				$('#zipCode').val( $('tr').filter('.'+id).children().filter('td:eq(8)').html() );
			}else{$('#zipCode').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(9)').html() != '&nbsp;'){
				$('#homePhone').val( $('tr').filter('.'+id).children().filter('td:eq(9)').html() );
			}else{$('#homePhone').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(10)').html() != '&nbsp;'){
				$('#otherPhone').val( $('tr').filter('.'+id).children().filter('td:eq(10)').html() );
			}else{$('#otherPhone').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(11)').html() != '&nbsp;'){
				$('#emailAddress').val( $('tr').filter('.'+id).children().filter('td:eq(11)').html() );
			}else{$('#emailAddress').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(12)').html() != '&nbsp;'){
				$('#allergiesAndMedicalInfo').val( $('tr').filter('.'+id).children().filter('td:eq(12)').html() );
			}else{$('#allergiesAndMedicalInfo').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(13)').html() != '&nbsp;'){
				$('#emergencyContactName').val( $('tr').filter('.'+id).children().filter('td:eq(13)').html() );
			}else{$('#emergencyContactName').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(14)').html() != '&nbsp;'){
				$('#emergencyContactPhone').val( $('tr').filter('.'+id).children().filter('td:eq(14)').html() );
			}else{$('#emergencyContactPhone').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(15)').html() != '&nbsp;'){
				$('#emergencyContactRelationship').val( $('tr').filter('.'+id).children().filter('td:eq(15)').html() );
			}else{$('#emergencyContactRelationship').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(16)').html() != '&nbsp;'){
				$('#primaryPickupName').val( $('tr').filter('.'+id).children().filter('td:eq(16)').html() );
			}else{$('#primaryPickupName').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(17)').html() != '&nbsp;'){
				$('#primaryPickupRelationship').val( $('tr').filter('.'+id).children().filter('td:eq(17)').html() );
			}else{$('#primaryPickupRelationship').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(18)').html() != '&nbsp;'){
				$('#homeChurch').val( $('tr').filter('.'+id).children().filter('td:eq(18)').html() );
			}else{$('#homeChurch').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(19)').html() != '&nbsp;'){
				$('#dateOfBirth').val( $('tr').filter('.'+id).children().filter('td:eq(19)').html() );
			}else{$('#dateOfBirth').val('');}
			if($('tr').filter('.'+id).children().filter('td:eq(20)').html() != '&nbsp;'){
				$('#gradeJustCompleted').val( $('tr').filter('.'+id).children().filter('td:eq(20)').html() );
			}else{$('#gradeJustCompleted').val('');}
			$('#tshirtselector').each($(this).attr('selected','false'));
			$('#'+$('tr').filter('.'+id).children().filter('td:eq(21)').html()).attr('selected','true');
		});

		$('.deleteButton').click(function(){
			var unique = this;
			if(confirm("Do you really want to remove " + $(unique).children().filter('div').html() + "?")){
				//delete record
				data = {
					'request' : 'delete',
					'id' : $(unique).parent().attr('id'),
					'name' : $(unique).children().filter('div').html()
				};

				$.ajax({
					type: 'POST',
					data: data,
					url: 'modifyRecords.php',
					success: function(data){
						$('#comDiv').html(data);

						if($('#error').size() != 0){
							$.pnotify({
								pnotify_title: 'Ooops!',
								pnotify_text: $('#error').html(),
								pnotify_type: 'error',
								pnotify_before_open: function(pnotify){
									pnotify.effect("bounce");
								},
								pnotify_animation: {
									effect_in: "none",
									effect_out: "fade"
								}
							});
						}else if($('#success').size() != 0){
							$.pnotify({
								pnotify_title: '<div style="color:green;">Success!</div>',
								pnotify_text: $('#success').html(),
								pnotify_animation: {
									effect_in: "show",
									effect_out: "fade"
								}
							});
							$('tr').filter('.'+$(unique).parent().attr('id')).remove();
							var i=1;
							$('.numbered').each(function(){
								$(this).html(i);
								i++;
							});
						}
					}
				});
			}
		});

	});
</script>
<div>
<table border=1 cellpadding=2 cellspacing=0>
<thead>
<tr>
<th>Edit/Delete</th>
<th>&nbsp;#&nbsp;</th>
<th>First Name</th>
<th>Last Name</th>
<th>Address</th>
<th>Apt Num</th>
<th>City</th>
<th>State</th>
<th>Zip Code</th>
<th>Home Phone</th>
<th>Other Phone</th>
<th>Email Address</th>
<th>Allergies/Medical Info</th>
<th>Emergency Contact Name</th>
<th>Emergency Contact Phone</th>
<th>Emergency Contact Relationship</th>
<th>Adult Pickup Name</th>
<th>Adult Pickup Relationship</th>
<th>Home Church</th>
<th>Date of Birth</th>
<th>Grade Just Completed</th>
<th>T-Shirt Size</th>
</tr>
</thead>

<tbody>
<?php
$i=1;
while($row = mysql_fetch_array($result)){
	print "<tr class='".$row["id"]."'>";
	print "<td style='text-align:center; background-color:#eee;'><span id='".$row["id"]."'><a class='editButton' style='cursor:pointer;' href='#fbForm' title='Edit ".$row["firstName"]." ".$row["lastName"]."' ><img src='assets/pencil.png' /></a>&nbsp;&nbsp;<a style='cursor:pointer;' class='deleteButton' title='Delete ".$row["firstName"]." ".$row["lastName"]."'><div style='display:none'>".$row["firstName"]." ".$row["lastName"]."</div><img src='assets/cancel.png' /></a></span></td>";
	print "<td class='numbered'>".$i."</td>"; $i++;
	print "<td>".$row["firstName"]."</td>";
	print "<td>".$row["lastName"]."</td>";
	print "<td>".$row["address"]."</td>";
	print "<td>".$row["aptNum"]."</td>";
	print "<td>".$row["city"]."</td>";
	print "<td>".$row["state"]."</td>";
	print "<td>".$row["zipCode"]."</td>";
	print "<td>".$row["homePhone"]."</td>";
	print "<td>".$row["otherPhone"]."</td>";
	print "<td>".$row["emailAddress"]."</td>";
	print "<td>".$row["allergiesAndMedicalInfo"]."</td>";
	print "<td>".$row["emergencyContactName"]."</td>";
	print "<td>".$row["emergencyContactPhone"]."</td>";
	print "<td>".$row["emergencyContactRelationship"]."</td>";
	print "<td>".$row["primaryPickupName"]."</td>";
	print "<td>".$row["primaryPickupRelationship"]."</td>";
	print "<td>".$row["homeChurch"]."</td>";
	print "<td>".$row["dateOfBirth"]."</td>";
	print "<td>".$row["gradeJustCompleted"]."</td>";
	print "<td>".$row["tShirtSize"]."</td>";
	print "</tr>";
}

?>
</tbody>
</table>
</div>
<div id="comDiv" style="display:none"></div>
<div id="workingID" style="display:none"></div>
<div style="display:none;"><div id="fbForm">

<style type="text/css">
		td{
			width:50%;
			vertical-align:middle;
			padding-right:5px;
			padding-left:5px;
			white-space:nowrap;
		}

		fieldset{
			margin-left:auto;
			margin-right:auto;
			width:90%
		}

		textarea{
			overflow:auto;
		}

		legend{
			font-weight:bold;
		}

		.showPrint{
			display:none;

		}

		.hidePrint{
			display:inline;
		}

		h1, h2, h3, h4{
			margin:0px auto;
			font-weight:normal;
			text-align:center;
		}

		html{
			padding:0px;
			margin-top:0px;
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

	</style>

			<fieldset>
				<legend>Personal Information</legend>
				<table style="width:100%"><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> First Name:</div></td><td><input type="text" id="firstName" name="firstName" style="width:100%" maxlength="30"/>
						</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Last Name:</div></td><td><input type="text" id="lastName" name="lastName" style="width:100%" maxlength="30"/>
				</td></tr></table>
			</fieldset>

			<fieldset>
				<legend>Address & Phone</legend>
				<table style="width:100%"><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Address:</div></td><td><input type="text" id="address" name="address" style="width:100%" maxlength="40"/>
						</td></tr><tr><td>
					<div style="text-align:right;">Apt #:</div></td><td><input type="text" id="aptNum" name="aptNum" style="width:100%" maxlength="6" />
					</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> City:</div></td><td><input type="text" id="city" name="city" style="width:100%" maxlength="30"/>
					</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> State:</div></td><td><input type="text" id="state" name="state" style="width:100%" maxlength="20"/>
					</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Zip/Postal Code:</div></td><td><input type="text" id="zipCode" name="zipCode" style="width:100%" maxlength="10"/>
					</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Home Phone:</div></td><td><input type="text" id="homePhone" name="homePhone" style="width:100%" maxlength="12"/>
					</td></tr><tr><td>
					<div style="text-align:right;">Other Phone:</div></td><td><input type="text" id="otherPhone" name="otherPhone" style="width:100%" maxlength="12"/>
					</td></tr><tr><td>
					<div style="text-align:right;">Email Address:</div></td><td><input type="text" id="emailAddress" name="emailAddress" style="width:100%" maxlength="35"/>

				</td></tr></table>
			</fieldset>

			<fieldset>
				<legend>Emergency & Guardian Information</legend>
				<table style="width:100%"><tr><td>
					<div style="text-align:right;">Allergies & Medical Information:</div></td><td></td>
						</td></tr><tr><td colspan=2><textarea id="allergiesAndMedicalInfo" name="allergiesAndMedicalInfo" style="width:100%; height:60px;"></textarea></td>
						</tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Emergency Contact Name:</div></td><td><input type="text" id="emergencyContactName" name="emergencyContactName" style="width:100%" maxlength="50"/>
					</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Emergency Contact Phone:</div></td><td><input type="text" id="emergencyContactPhone" name="emergencyContactPhone" style="width:100%" maxlength="12"/>
					</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Emergency Contact Relationship:</div></td><td><input type="text" id="emergencyContactRelationship" name="emergencyContactRelationship" style="width:100%" maxlength="40"/>
					</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Adult who will pick-up child:</div></td><td><input type="text" id="primaryPickupName" name="primaryPickupName" style="width:100%" maxlength="50"/>
					</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Relationship to child:</div></td><td><input type="text" id="primaryPickupRelationship" name="primaryPickupRelationship" style="width:100%" maxlength="50"/>
				</td></tr></table>
			</fieldset>

			<fieldset id="last">
				<legend>Additional Information</legend>
				<table style="width:100%"><tr><td>
					<div style="text-align:right;" >Home Church:</div></td><td><input type="text" id="homeChurch" name="homeChurch" style="width:100%" maxlength="50"/>
						</td></tr><tr><td>
					<div style="text-align:right;"><span class="hidePrint">*</span> Date of Birth:</div></td><td><input type="text" id="dateOfBirth" name="dateOfBirth" style="width:100%" maxlength="20"/>
					</td></tr><tr><td>
					<div style="text-align:right;">Grade Just Completed:</div></td><td><input type="text" id="gradeJustCompleted" name="gradeJustCompleted" style="width:100%" maxlength="40"/>
					</td></tr><tr><td>
					<div style="text-align:right;">Child's T-Shirt Size<span class="hidePrint">:</span><span class="showPrint"> (circle one)</span></div></td><td>

						<span class="hidePrint">
							<select id="tShirtSize" name="tShirtSize">
								<option class="tshirtselector" id="none" value="none" selected="true">Click Here to Select Size</option>
								<option class="tshirtselector" id="toddler2T" value="toddler2T">Toddler 2T</option>
								<option class="tshirtselector" id="toddler3T" value="toddler3T">Toddler 3T</option>
								<option class="tshirtselector" id="toddler4T" value="toddler4T">Toddler 4T</option>
								<option class="tshirtselector" id="youthS" value="youthS">Youth S (Size 6-8)</option>
								<option class="tshirtselector" id="youthM" value="youthM">Youth M (Size 10-12)</option>
								<option class="tshirtselector" id="youthL" value="youthL">Youth L (Size 14-16)</option>
								<option class="tshirtselector" id="youthXL" value="youthXL">Youth XL (Size 18-20)</option>
								<option class="tshirtselector" id="adultS" value="adultS">Adult S</option>
								<option class="tshirtselector" id="adultM" value="adultM">Adult M</option>
								<option class="tshirtselector" id="adultL" value="adultL">Adult L</option>
							</select>
						</span>
				</td></tr></table>

			</fieldset>
			<fieldset style="border:none;">
				<div style="text-align:center;"><input type="button" id="submitAddFB" value="Add Child"></input><input type="button" id="submitModifyFB" value="Save Changes"></input><input type="button" id="cancelFB" value="Cancel"/></div>
			</fieldset>


</div></div>
</body></html>
