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
    <!-- Begin Navbar -->
		<nav class="navbar navbar-inverse">
      <div class="container">
        <ul class="nav navbar-nav">
          <li class="navbar-padding"><a href="#"><span class="glyphicon glyphicon-home glyph-padding"></span>Home</a></li>
          <li class="navbar-padding"><a href="about.php">About</a></li>
          <li class="navbar-padding"><a href="#">Contact</a></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
          <li><a href="#"><span class="glyphicon glyphicon-log-in glyph-padding"></span>Login</a></li>
          <li style="padding-right: 15px;"><a href="#"><span class="glyphicon glyphicon-user glyph-padding"></span>Sign Up</a></li>          
        </ul>
      </div>
    </nav>
    
    <!-- Begin Page Content -->

      <h1 class="text-center title-text">BINDR</h1>
      <h2 class="text-center subtitle-text">Your New Study Group</h2><br>
      
      <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-2 text-center">
          <button type="button" class="btn btn-primary btn-lg">Login</button>
        </div>
        <div class="col-md-2 text-center">
          <button type="button" class="btn btn-primary btn-lg">Sign Up</button>
        </div>
        <div class="col-md-4">
        </div>
      </div>
      
  </div> 
	</body>
</html>