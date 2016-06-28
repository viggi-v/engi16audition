<!DOCTYPE html>
<html>
	<head>
		<title>Home-Engi'16</title>
		<link rel="stylesheet" href="home.css">
		<script src="home.js"></script>
		<?php 
			session_start();
			$update_err = "";
			if(isset($_SESSION["update_err"])){
								$update_err = $_SESSION["update_err"];
								$_SESSION["update_err"] = "";
							}

			if(!isset($_SESSION["login_status"])){
				$_SESSION["login_status"]=0;
			}
			if(!$_SESSION["login_status"]){
				$_SESSION["login_err"]="login to continue";
				echo "<script> window.location='login.php'</script>";
			}
			else {
				$conn= new mysqli("localhost","user","password");
				$sql="use engi16";
				$conn->query($sql);
				$sql="SELECT * FROM USERS WHERE id='".$_SESSION["id"]."';";
				$result=$conn->query($sql);
				$student=$result->fetch_assoc();
				$conn->close();
			}
		?>
	</head>
	<body>
		<div id="top_strip">
			<form action="logout.php" method="POST">
				<input type="submit" name="logout" value =" " title="logout">	
			</form>
			<span id="info">In case the pages didnt work properly, check<a href="info.php">this</a></span>
			<span id='login_info'><?php echo "logged in as ".$student["name"];?></span>
		</div>
		<header>
				<div id='title_container'>
					<span id="01">E</span>
					<span id="02">N</span>
					<span id="03">G</span>
					<span id="04">I</span>
					<span id="07">'</span>
					<span id="05">1</span>
					<span id="06">6</span>
				</div>
		</header>
		<div id="content_area">
			<nav>	
				<ul>	
					<li>
						<button onclick="showinput()">Profile</button>
					</li>
					<li>	
						<button onclick="show_reg()">Register for event</button>
					</li>
					<li>	
						<a href="schedule.php">Schedule</a>
					</li>
					<li>	
						<button onclick="generateid()">Generate EngiCard</button>
					</li>
				</ul>
			</nav>
			<section>
				<div id="input_panel">
						<span id='update_err' class="error_container">
							<?php 
								echo $update_err;					
							?>
						</span>
						<input id="mobile" type="text" placeholder='mobile' value = "<?php if(isset($student['mobile']))if($student['mobile'])echo $student['mobile'] ;?>">
						<input type="text" id="college_name" placeholder='college' value = "<?php if(isset($student['college_name']))echo $student['college_name'] ;?>">
						<textarea rows="5" cols="50" id="address" placeholder="address" ><?php if(isset($student['address']))echo $student['address'] ;?></textarea>
						<button onclick="update()">Update</button>
				</div>
				<div id="op">
					<span id="register_err" class="error_container">
						<?php
							if($_SESSION["update_status"]!="updated")
								echo "profile must be updated to register!";
						?>	
					</span>
					<div id="workshops">
						<?php
							echo "<h1>WorkShops</h1>";
							$conn= new mysqli("localhost","user","password");
							$sql="use engi16";
							$conn->query($sql);
							$sql="SELECT * FROM EVENTS where type='workshop'";
							$res=$conn->query($sql);
							if($res->num_rows > 0){
								while($row=$res->fetch_assoc()){
									echo "<div class='event'>";
									echo "<h2>".$row['title']."</h2>";
									echo "<h3>".$row['description']."</h3>";
									echo "<h4>Date:".$row['date']."</h4>";
									if($row['fee'])
										echo "<h4>Fee:".$row['fee']."</h4>";
									else echo "<h4>Free Entry</h4>";
									$reg_ok=1;
									$sql = "SELECT * FROM REGISTRATIONS WHERE ID=".$_SESSION["id"]." AND EVENT_ID=".$row["event_id"];
									$event_res=$conn->query($sql);
									$event_res_temp=$event_res->fetch_assoc();
									if($event_res_temp){
										echo "<button class='disabled' name='".$row['event_id']."'id='".$row['event_id']."' title='you have already registered for the event' disabled>registered</button>";
									}
									else if($_SESSION["update_status"]=="not_updated"){
										echo "<button class='disabled' name='".$row['event_id']."'id='".$row['event_id']."'title='update your profile to register' disabled>cannot register</button>";
									}
									else
										echo "<button name='".$row['event_id']."'id='".$row['event_id']."' onclick='register(this.name)'>Register</button>";
									echo "</div>";
								}
							}
						?>
					</div>

					<div id="competitions">
						<?php
							echo "<h1>competitions</h1>";
							$conn= new mysqli("localhost","user","password");
							$sql="use engi16";
							$conn->query($sql);
							$sql="SELECT * FROM EVENTS where type='competition'";
							$res=$conn->query($sql);
							if($res->num_rows > 0){
								while($row=$res->fetch_assoc()){
									echo "<div class='event'>";
									echo "<h2>".$row['title']."</h2>";
									echo "<h3>".$row['description']."</h3>";
									echo "<h4>Date:".$row['date']."</h4>";
									if($row['fee'])
										echo "<h4>Fee:".$row['fee']."</h4>";
									else echo "<h4>Free Entry</h4>";
									$sql = "SELECT * FROM REGISTRATIONS WHERE ID=".$_SESSION["id"]." AND EVENT_ID=".$row["event_id"];
									$event_res=$conn->query($sql);
									$event_res_temp=$event_res->fetch_assoc();
									if($event_res_temp){
										echo "<button class='disabled' name='".$row['event_id']."'id='".$row['event_id']."' title='you have already registered for the event' disabled>registered</button>";
									}
									else if($_SESSION["update_status"]=="not_updated"){
										echo "<button class='disabled' name='".$row['event_id']."'id='".$row['event_id']."'title='update your profile to register' disabled>cannot register</button>";
									}
									else
									echo "<button name='".$row['event_id']."'id='".$row['event_id']."' onclick='register(this.name)'>Register</button>";
									echo "</div>";
								}
							}
						?>
					</div>
					<div id="talks">
						<?php
							echo "<h1>Talks</h1>";
							$conn= new mysqli("localhost","user","password");
							$sql="use engi16";
							$conn->query($sql);
							$sql="SELECT * FROM EVENTS where type='talk'";
							$res=$conn->query($sql);
							if($res->num_rows > 0){
								while($row=$res->fetch_assoc()){
									echo "<div class='event'>";
									echo "<h2>".$row['title']."</h2>";
									echo "<h3>".$row['description']."</h3>";
									echo "<h4>Date:".$row['date']."</h4>";
									if($row['fee'])
										echo "<h4>Fee:".$row['fee']."</h4>";
									else echo "<h4>Free Entry</h4>";
									$sql = "SELECT * FROM REGISTRATIONS WHERE ID=".$_SESSION["id"]." AND EVENT_ID=".$row["event_id"];
									$event_res=$conn->query($sql);
									$event_res_temp=$event_res->fetch_assoc();
									if($event_res_temp){
										echo "<button class='disabled' name='".$row['event_id']."'id='".$row['event_id']."' title='you have already registered for the event' disabled>registered</button>";
									}
									else if($_SESSION["update_status"]=="not_updated"){
										echo "<button class='disabled' name='".$row['event_id']."'id='".$row['event_id']."'title='update your profile to register' disabled>cannot register</button>";
									}
									else
										echo "<button name='".$row['event_id']."'id='".$row['event_id']."' onclick='register(this.name)'>Register</button>";
									echo "</div>";
								}
								}
							?>
					</div>
				</div>	
			</section>
		</div>
	</body>
</html>