<!DOCTYPE html>
<html>
<head>
	<title>SignUp-Engi'16</title>
	<link rel="stylesheet" href="signup.css">
	<?php
	$conn= new mysqli("localhost","user","password");
	$sql="use engi16";
	$conn->query($sql);
	
		function uname_validate($value)
		{
			$conn= new mysqli("localhost","user","password");
			$sql="use engi16";
			$conn->query($sql);
			$sql = "SELECT * FROM USERS WHERE USERNAME='".$value."';";
			if($res=$conn->query($sql)){
				if($res->num_rows > 0){
					$responseText = 0;				
				}
				else $responseText = 1;
			}
			return $responseText;
		}
		session_start();
		$signup_err="";
		if(isset($_SESSION["login_status"])){
			if($_SESSION["login_status"]){
				if ( $_SESSION["user_type"] == "student" ){
					echo "<script> window.location='home.php'</script>";
				}
				else if( $_SESSION["user_type"] == "admin"){
					echo "<script> window.location='admin.php'</script>";
				}
			}
		}
		//$signup_err=$_SESSION["signup_err"];
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			// for validating the input
			$signup_ok = 1;
			$username = htmlspecialchars($_POST["username"]);
			$password = htmlspecialchars($_POST["password"]);
			$name 	  = htmlspecialchars($_POST["name"]);
			
			if(empty($name)){
				$signup_ok  = 0;
				$signup_err = 'username cannot be empty';
			}
			if(strlen($password) < 8){
				$signup_ok  = 0;
				$signup_err = 'password must be atleast 8 charecter long';
			}
			if(!uname_validate($username) || strlen($username) < 4){
				$signup_ok  = 0;
				$signup_err = 'invalid username'; 
			}
			if($signup_ok){
				$type = 'student';
				$sql = "INSERT INTO USERS (type,name,username,password) VALUES ('".$type."','".$name."','".$username."','".$password."');";
				if($conn->query($sql)){
					$_SESSION["signup_status"]="Signup Successful. Login to continue.";
					echo "<script> window.location='login.php';</script>";
				}
			}
			else{
				$_SESSION["signup_err"] = $signup_err;
			}
		}

	 ?>
	<script>
		function validate(key,value){
			var form= new FormData();
			form.append(key,value);
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200){
					var str=xhr.responseText;
					console.log(str);
					if(key == 'password'){
						document.getElementById('err_password').innerHTML = str;
					}
					else{
						document.getElementById('err_username').innerHTML = str;
					}
					if(   !document.getElementById('err_username').innerHTML
						&&!document.getElementById('err_password').innerHTML
						&&document.getElementById("password").value
						&&document.getElementById("username").value)
						{
							document.getElementById("submit").disabled=false;
							console.log('reenabled');
						}
					else{
						document.getElementById("submit").disabled=true;
						}
				}
			};
			xhr.open("POST","validator.php",true);
			xhr.send(form);
		}
	</script>
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
	<div id="form_container">
		<form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method="POST">
				<span id='signup_err' class="error_container"><?php if(isset($_SESSION["signup_err"]))echo $_SESSION["signup_err"];?></span>
				<input type="text" name="name" placeholder="name">
				<input type="text" name="username" id="username" onkeyup="validate('username',this.value)" placeholder="username">
					<span id="err_username" class="error_container"></span>
				<input type="password" name="password" id="password" onkeyup="validate('password',this.value)" placeholder="password">
					<span id="err_password" class="error_container"></span>
			<input id="submit" type="submit" value="I'm In!" disabled>
		</form>
	</div>
</body>
</html>