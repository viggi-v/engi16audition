<?php
		session_start();
		function get_update_status($str){
			$conn= new mysqli("localhost","user","password");
			$conn->query("use engi16");
				
			$sql="SELECT * FROM users where (type='student' AND id=".$str."); ";
			$stud_res = $conn->query($sql);
			$stud     = $stud_res->fetch_assoc();
			if(!isset($stud["college_name"]) || empty($stud["college_name"])){
				return "not_updated";
			}
			else return "updated";
		}
		if(isset($_SESSION["login_status"])){
			if(!$_SESSION["login_status"]){
				echo "<script>window.location='login.php';</script>";
			}
		}
		else $_SESSION["login_status"]=0;
		$login_err="";
		$login_ok=1;

//THIS IS THE SOURCE CODE OF login_auth.php

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			
			$username=htmlspecialchars($_POST["username"]);
			$password=htmlspecialchars($_POST["password"]);
			
			if(empty($username)||(empty($password))){
				$login_err="username/password cannot be empty!";
				$login_ok=0;	
			}
			
			else{
				
				$conn= new mysqli("localhost","user","password");
				//The above user and password are the credentials for the database, has nothing to do with the login of the user at the front of the computer :)
				$conn->query("use engi16");
				
				$sql="SELECT * FROM users where (type='student' AND username='".$username."'); ";
				
				if(!$res=$conn->query($sql)){//in case query didnt work.
					$echores=var_dump($res);
					echo "<script>console.log('query:".$sql." and result:".$echores."');</script>";
					echo "<script>console.log('Error:".$conn->error."')</script>";
				}
				//if query worked
				else {

					if($res->num_rows > 0){//ie if an entry is found in the table of students
						$row=$res->fetch_assoc();
						if($row["password"]!=$password){
							$login_ok=0;
							$login_err="invalid password";
						}
						else{
							$_SESSION["login_status"]  = 1;
							$_SESSION["login_err"]     = "";
							$_SESSION["user_type"]     = "student";
							$_SESSION["id"]            = $row["id"];
							$_SESSION["update_status"] = get_update_status($_SESSION["id"]);
						}
					}
					else{
						//this means that no entry found in students table.
						// check for admins
						$sql="SELECT * FROM users where (type='admin' AND username ='".$username."'); ";
						if(!$res=$conn->query($sql)){
							$echores=var_dump($res);
							echo "<script>console.log('query:".$sql." and result:".$echores."');</script>";
							echo "<script>console.log('Error:".$conn->error."')</script>";
						}
						else {
							if($res->num_rows > 0){
								$row=$res->fetch_assoc();
								if($row["password"]!=$password){
									$login_ok=0;
									$login_err="invalid password";
								}
								else{
									$_SESSION["login_status"]= 1;
									$_SESSION["login_err"]   = "";
									$_SESSION["user_type"]   = "admin";
									$_SESSION["id"]          = $row["id"];
								}
							}
							else{
								$login_err = "invalid username";
								$login_ok = 0;
							}
						}
				$conn->close();
				}
			}
		}	
	}
		// redirecting based on result
		if(!$login_ok){
			$_SESSION["login_status"]=0;
			$_SESSION["login_err"]=$login_err;
			echo "<script>window.location='login.php';</script>";
		}
		else{//final redirect
			if($_SESSION["user_type"]=="teacher"){
				echo "<script> window.location='home.php';</script>";
			}
			else{
				echo "<script> window.location='admin.php';</script>";
			}
		}
	?>