<?php 
	session_start();
	$conn= new mysqli("localhost","user","password");
	$sql="use engi16";
	$conn->query($sql);
	$sql= "INSERT INTO REGISTRATIONS VALUES(".$_POST["event_id"].",".$_SESSION['id'].");";
	if($conn->query($sql)){
		echo "registration successful";
	}
	else echo $conn->error;
?>