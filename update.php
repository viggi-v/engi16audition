<?php 
	session_start();
	$conn= new mysqli("localhost","user","password");
	$conn->query("use engi16");
	$mobile       = htmlspecialchars($_POST["mobile"]);
	$address      = htmlspecialchars($_POST["address"]);
	$college_name = htmlspecialchars($_POST["college_name"]);

	$update_ok  =  1;
	$update_err = '';

	if(strlen($mobile) < 10 ){
		$update_ok  = 0;
		$update_err = 'invalid mobile number';
	}
	if(!preg_match("/[0-9]/",$mobile)){
		$update_ok  = 0;
		$update_err = 'invalid mobile number';
	}
	if(empty($college_name)){
		$update_ok  = 0;
		$update_err = 'college name cannot be empty';
	}
	if($update_ok){
		$sql="UPDATE users SET mobile=".$mobile.", address='".$address."', college_name='".$college_name."' WHERE id=".$_SESSION["id"];

		if($conn->query($sql)){
			echo "ok";
			$_SESSION["update_status"]="updated";
		}
		else{
			echo "the error is:".$conn->error;
		}
	}
	else {
		//$SESSION["update_err"] = $update_err;
		echo $update_err;	
	}
?>