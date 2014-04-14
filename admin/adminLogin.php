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
	$passwords = array("admin" => "3c37bbd301db9c11366b41e7d30ff72f732e659a"); // Admin01

	/**
	* Uncomment this line to add a password.  Go to this page and enter in desired password,
	* copy/paste that hash into the $passwords array and then recomment this line.
	*/
	//echo sha1($_POST['password'].substr($_POST['username'],-3));

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
