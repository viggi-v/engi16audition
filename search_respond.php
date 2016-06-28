<?php 
	$conn= new mysqli("localhost","user","password");
	$conn->query("use engi16");
	$key= $_POST["key"];
	$sql = "SELECT NAME,COLLEGE_NAME FROM USERS WHERE TYPE<>'ADMIN' AND NAME LIKE '%".$key."%';";
	$res = $conn->query($sql);
	$resp="no entry found.";
	if ( $res->num_rows >0){
		$resp="";
		while($row=$res->fetch_assoc()){
			$resp.="<div id='user'><a href='#link'>".$row["NAME"]."</a>(".$row["COLLEGE_NAME"].")</div>";
		}
	}
	echo $resp;
 ?>