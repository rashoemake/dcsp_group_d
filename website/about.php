<?php
	session_start();
?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width = device-width, initial-scale = 1">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    
		<title>About Bindr!</title>
	</head>
	
	<body>
	  <div class="container">
    <?php require_once 'php_scripts/navbar.php' ?>
		<h3>What is Bindr?</h3>
		<p>Bindr is a social networking tool designed to help students find helpful and compatible study groups and partners. Students are presented with a series of other students at thier university and a short paragraph about the user, and may approve or deny the student they are shown. If two students mutually approve each other, a new group message called a Binder is created. Students can propose the addition of new students to these groups and the group can continue to grow into a large study group if desired.</p>

		<h3>Developers</h3>
		<ul>
			<li>Chandler Musgrove (<a href="mailto:">TODO</a>) - Backend/Database Design</li>
			<li>Corey Clayton (<a href="mailto:">TODO</a>) - Frontend/Business Logic Integration</li>
			<li>Ryan Shoemake (<a href="mailto:ras603@msstate.edu">ras603@msstate.edu</a>) - Frontend/Business Logic Integration</li>
			<li>Will Carroll (<a href="mailto:woc17@msstate.edu">woc17@msstate.edu</a>) - Backend/Database Design</li>
		</ul>
    </div>
	</body>
</html>
