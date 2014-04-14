<?php
session_start();

if(isset($_SESSION['username'])){//authenticated user
	header("Location: menu.php");
}
?>
<html>
<head><title>Admin Login Page</title></head>
<body>
<?php 
	$passwords = array("pbryson29" 	=>  "a745d8007daf0f1cb201bed21734a68e779a4875",
						"fmpdlh"	=>	"d6a449461c10fc42e78054753cd8eba392f73c32",
						"jbryson3"	=>	"b81b5dbeb213a471651c1ff6bd4c648cb21dc85e");
						
	if(sha1($_POST['password'].substr($_POST['username'],-3)) == $passwords[$_POST['username']]){
			$_SESSION['username'] = $_POST['username'];
			print <<<ENDOFTEXT
				<script type="text/javascript">
					window.location='menu.php';
				</script>
ENDOFTEXT;
	} else{
	
	if(isset($_POST['username'])){
		echo "<div style='color:red;'>Username/Password combination isn't correct.</div></br/>";
	}
		
	echo <<<ENDOFTEXT
	<h1>VBS Admin Login Page</h1>
	<form action="adminLogin.php" method="POST">
		Username: <input type="text" name="username" /><br/>
		Password: <input type="password" name="password" /><br/>
		<input type="submit" value="Login" />
	</form>
	
	<style type="text/css">
		html{
			text-align:center;
		}
	</style>
ENDOFTEXT;

} 
?>
</body>
</html>