<!DOCTYPE html>
<html>
<head>
	<title>Admin-Engi'16</title>
	<link rel="stylesheet" href="admin.css">
	<script src="admin.js"></script>
	<?php 
		session_start();
		if(!isset($_SESSION["login_status"])){
			$_SESSION["login_status"]=0;
		}
		if(!$_SESSION["login_status"]){
			$_SESSION["login_err"]="login to continue";
			echo "<script> window.location='home.php'</script>";
		}
		else {
			$conn= new mysqli("localhost","user","password");
			$sql="use engi16";
			$conn->query($sql);
			$sql="SELECT * FROM USERS WHERE id='".$_SESSION["id"]."';";
			if($result=$conn->query($sql))
				$admin=$result->fetch_assoc();
			$conn->close();
		}
	?>
</head>
<body>
<div id="top_strip">
		<form action="logout.php" method="POST">
			<input type="submit" name="logout" value=" " title='logout'>	
		</form>
		<span id="info">In case the pages didnt work properly, check<a href="info.php">this</a></span>
		<span id='login_info'><?php echo "logged in as ".$admin["name"];?></span>
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
<nav>
	<ul id="buttonlist">
		<li>
			<button onclick="showform('data_event')">Add new Events</button>
		</li>
		<li>
			<button onclick="showform('event_registrations')">Show registrations</button>
		</li>
		<li>
			<button onclick="showform('searchbox')">Search for usernames</button>
		</li>
	</ul>
</nav>
<section>
	<div id='data_event' class='input_container'>
		<input id='title' type='text' placeholder="event_name">
		<select id='type'>
			<option id='option_1' value='competition'>competition</option>
			<option id='option_2' value='workshop'>workshop</option>
			<option id='option_3' value='talk'>talk</option>
		</select>
		<input type="text" name="fee" id='fee' placeholder="fees">
		<input type="date" id="date" placeholder="choose date">
		<textarea rows='5' cols='40' id='description' placeholder="Describe Your Event"></textarea>
		<button onclick="create_event()">create</button>
	</div>
	<div class="input_container" id='event_registrations'>
		<select id='event'>
			<?php 
				$conn= new mysqli("localhost","user","password");
				$sql="use engi16";
				$conn->query($sql);
				$sql = "SELECT title FROM EVENTS";
				$res = $conn->query($sql);
				if($res->num_rows > 0){
					while($row=$res->fetch_assoc()){
						echo "<option value='".$row["title"]."'>".$row["title"]."</option>";
					}
				}
				echo "<option value='all'>All Registrations</option>";
			?>
		</select>	
		<button onclick="show_regi()">Show</button>
	</div>
	<div class="input_container" id="searchbox">
		<input type="text" placeholder="search for any username" onkeyup="search(this.value)">
	</div>
	<div id="op">
	</div>
</section>
</body>
</html>