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
    
		<title>Your Profile</title>
	</head>
  
  <body>
    <div class="container">

    <?php require_once 'php_scripts/navbar.php' ?>     
    <br>
    
    <div class="panel panel-default">
      <div class="panel-body panel-content-color">
        <h2 class="text-center">NAME</h2>
        <!-- email address -->
        <h4 class="text-left">E-mail address:</h4>
        <p>example@yes.com</p>
        
        <!-- school information -->
        <h4 class="text-left">School:</h4>
        <p>Example University</p>
        
        <!-- bio -->
        <h4 class="text-left">Biography</h4>
        <p>FAKE NEWS</p>
        
        <!-- binder associations -->
        <h4 class="text-left">Binders:</h4>
        <ul class="list-unstyled">
          <li><a href="#">Binder1</a></li>
        </ul>
        
        <br>        
        <p class="text-left">User ID: XXXXXXX</p>
      </div>
    </div>
    
    <div class="text-center">
      <a class="btn btn-primary" href="#">Edit Profile</a>
    </div>


    </div> <!-- end document container -->
  </body>  
</html>