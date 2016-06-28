<!DOCTYPE html>
<html>
	<head>
		<title>Instructions</title>
		<link rel="stylesheet" href="info.css">
	</head>
	<body>
		<div class="container">
			<div id="title">
				<h1>
					BackStage of <span>ENGI'16</span>
				</h1>
			</div>
			<section>
				<p>
					I have tried my best to make the page and code to describe themselves, still these maybe noted:
				</p>
				<ul>
					<li>
						sample username=viggy, password=password
					</li>
					<li>
						I have used the db with a username as "user" and password as "password"
					</li>
					<li>
						The database name is engi16
					</li>
					<li>
						The default admin name is admin01 with a password as "password" 
					</li>
					<li>
						More Admins can be added only with phpMyAdmin.
					</li>
					<li>
						The session variables at this stage:
						<ul>
							<?php
								session_start();
								foreach ($_SESSION as $key => $value) {
												echo "<li>".$key."=".$value."</li>";
											}			
							?>
						</ul>
					</li>
					<li>
						neither of the users have registered for events. so login from a user and register for the events
					</li>
					<li>
						the button createEngiId doesnt work but that is intended to make an id card with the schedule of that person's events and a qr code with full profile details.
						since it was not asked in the question i kept it for the end:(.
					</li>
				</ul>
			</section>
			
		</div>
		<footer>
			<span id="email">vighneshvelayudhan@gmail.com</span><br>
			<span id="credit">Submitted By Vighnesh Velayudhan</span> 
		</footer>
	</body>
</html>