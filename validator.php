<?php 
	$conn= new mysqli("localhost","user","password");
	$sql="use engi16";
	$conn->query($sql);
	if(isset($_POST["username"])){
		$str = htmlspecialchars($_POST["username"]);
		$responseText="";
		if(empty($str)){
			$responseText="username cannot be empty";
		}
		else{
			$sql = "SELECT * FROM USERS WHERE USERNAME='".$str."';";
			if($res=$conn->query($sql)){
				if($res->num_rows > 0){
					$responseText = "username not available!";				
				}
				else $responseText = "";
			}
		}
	}else if(isset($_POST["password"])){
		$str = htmlspecialchars($_POST["password"]);
		$responseText="";
		if(strlen($str) < 8){
			$responseText="password should be atleast 8 charecters long";
		}
		else
			$responseText = "";
	}
	echo $responseText;
?>
