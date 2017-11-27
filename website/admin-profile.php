<?php
	session_start();
	require_once "models/User.php";
	
	$user = User::get_user_by_id($_SESSION["id"]);
	if ($user->get_type() != "admin") {
		header("Location: profile.php");
		exit();
	}
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
    
		<title>Administrator Profile</title>
	</head>
    <body>
    <div class="container">
        <?php require_once 'php_scripts/navbar.php' ?>     
        <br>

    </body>
</html>