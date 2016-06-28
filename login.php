<!DOCTYPE html>
<html>
<head>
	<title>Engi'16-login</title>
	<link rel="stylesheet" href="login.css">
	<?php
	session_start();
	$login_err="";
	if(isset($_SESSION["login_status"])){
		if(isset($_SESSION["login_err"])){
			$login_err =$_SESSION["login_err"];
			$_SESSION["login_err"]="";

		}
		else $login_err="";
		if($_SESSION["login_status"]){
			if ( $_SESSION["user_type"] == "student" ){
				echo "<script> window.location='home.php'</script>";
			}
			else if( $_SESSION["user_type"] == "admin"){
				echo "<script> window.location='admin.php'</script>";
			}
		}
	}
	else{
		$_SESSION["login_status"] = 0;
	}
	?>
</head>
<body>
<span id="info">In case the pages didnt work properly, check<a href="info.php">this</a></span>
	<div id='title_container'>
		<span id="01">E</span>
		<span id="02">N</span>
		<span id="03">G</span>
		<span id="04">I</span>
		<span id="07">'</span>
		<span id="05">1</span>
		<span id="06">6</span>
	</div>
	<form action='<?php echo "login_auth.php";?>' method="POST">
			<div id='input_box'>
				<span id='login_err' class="error_container"><?php echo $login_err ?></span>
				<input type="text" name="username" placeholder="username">
				<input type="password" name="password" placeholder="password">
				<input type="submit" value="LOGIN">
				<a href="signup.php">Never have been here? Sign Up!</a>
			</div>
	</form>
</body>
</html>