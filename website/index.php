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
    
		<title>Welcome to BINDR!</title>
	</head>
  
  <!--
The elements on this page should change depending on if the user is logged in.
For example, instead of "Sign Up" and "Login", the page would present options
like "View profile" or "Start matching"
-->
       
  
	
	<body>
  <div class="container">
<?php require_once 'php_scripts/navbar.php' ?>
    
    <!-- Begin Page Content -->

      <h1 class="text-center title-text">BINDR</h1>
      <h2 class="text-center subtitle-text">Your New Study Group</h2><br>
      
      <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-2 text-center">
          <a href="login.php" class="btn btn-primary btn-lg">Login</a>
        </div>
        <div class="col-md-2 text-center">
          <a href="sign-up.php" class="btn btn-primary btn-lg">Sign Up</a>
        </div>
        <div class="col-md-4">
        </div>
      </div>
      
  </div> 
	</body>
</html>