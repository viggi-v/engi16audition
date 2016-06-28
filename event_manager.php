<?php 
	if($_POST["mode"] == "create_event"){
			$conn= new mysqli("localhost","user","password");
			$conn->query("use engi16");
			$table="events";
			$conn_res='Inserted';
			$title = $_POST["title"];
			$type = $_POST["type"];
			$fee = $_POST["fee"];
			$date = $_POST["date"];
			$desc = $_POST["description"];
			$sql = "INSERT INTO ".$table." (title,type,fee,date,description) VALUES ('".$title."','".$type."','".$fee."','".$date."','".$desc."');";
			echo $sql;
			if(!$conn->query($sql)){
				$conn_res=$conn->error.$sql;
			}
			echo $conn_res;
		}
	if($_POST["mode"] == "show_participants"){
			$conn= new mysqli("localhost","user","password");
			$conn->query("use engi16");
			$event=$_POST["event"];
			if($event=='all'){
				$sql = "SELECT event_id,title FROM events";
				$main_res= $conn->query($sql);
				$i=0;
				while($i < $main_res->num_rows){
					//selecting all the events and students
					$event_row=$main_res->fetch_assoc();

					$i++;

					$event_id=$event_row['event_id'];
					$sql = "SELECT id from registrations where event_id=".$event_id;

					$result_string="<div class='event_res'><h3>".$event_row['title']."</h3>";
					$result_string .= 'no registrations';
					$res= $conn->query($sql);

					if($res){
						if($res->num_rows > 0){
							$result_string="<div class='event_res'><h3>".$event_row['title']."</h3>";
							$result_string.="<table><tr><th>NAME</th><th>College</th><th>Mobile</th></tr>";
							while($row = $res->fetch_assoc()){
								$stud_id=$row["id"];
								$sql="SELECT NAME,college_name,MOBILE FROM USERS WHERE ID=".$stud_id;
								$stud_res=$conn->query($sql);
								$student = $stud_res->fetch_assoc();
								$result_string.="<tr>";
								foreach ($student as $key => $value) {
									$result_string.="<td>".$value."</td>";
								}
								$result_string.="</tr>";
							}
							$result_string.="</table>";
						}
					$result_string.="</div>";
					}
					echo $result_string;
				}
			}
			else{
				$sql = "SELECT event_id FROM events where title ='".$event."';";
				$res= $conn->query($sql);
				$event_id = ($res->fetch_assoc())["event_id"];
				$sql = "SELECT id from registrations where event_id=".$event_id;
				$result_string = 'no registrations';
				if($res= $conn->query($sql)){
					if($res->num_rows > 0){
						$result_string="<table><tr><th>NAME</th><th>College</th><th>Mobile</th></tr>";
						while($row = $res->fetch_assoc()){
							$stud_id=$row["id"];
							$sql="SELECT NAME,college_name,MOBILE FROM USERS WHERE ID=".$stud_id;
							$stud_res=$conn->query($sql);
							$student = $stud_res->fetch_assoc();
							$result_string.="<tr>";
							foreach ($student as $key => $value) {
								$result_string.="<td>".$value."</td>";
							}
							$result_string.="</tr>";
						}
					}
					echo $result_string."</table>";
				}
			}
	}
?>