<?php
session_start();

if(!isset($_SESSION["username"])){
	header('Location: adminLogin.php');
}
?>
<html>
<head><title>Admin Menu</title>
<script type="text/javascript" src="assets/jquery-1.3.2.min.js"></script>
</head>
<body>
<style type="text/css">
	body{
		text-align:center;
	}
	
	fieldset{
		display:inline-table;
	}
</style>
<h1 style="margin-bottom:20px;">VBS Admin Page</h1>
<h3 style="margin:0px; padding:0px;">There are <span id="numkids" style="color:red">?</span> kids currently signed up for VBS.</h3>
<p style="margin:0px 0px 20px;">(Updated in real-time)</p>
<fieldset>
<legend>Admin Options</legend>
<input type="button" onclick="window.location='generateSpreadsheet.php'" value="Generate Participant Spreadsheet" /><br />
<input type="button" onclick="window.location='chooseForms.php'" value="Print out Individual Forms" /><br />
<input type="button" onclick="" disabled=true value="Assign Kids to Groups" /><br />
<input type="button" onclick="window.location='editParticipants.php'" value="View/Edit Participants" /><br />
<p style="padding:0; margin:0; margin-top:10px; font-size:12px;">Disabled Buttons are features coming soon</p>
</fieldset>

<br/><a style="margin-top:40px; display:block;" href='logout.php?logout'>Logout</a>

<script type="text/javascript">
	$(document).ready(function(){
		window.setInterval(function(){
			$.ajax({
				url: 'numOfKids.php',
				success: function(data) {
					$('#numkids').html(data);
				}
			});
		}, 500);
	});
</script>

</body>
</html>
