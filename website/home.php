<?php
  session_start();

  if (!(isset($_SESSION["logged_in"]))) {
    header("Location: index.php");
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
    
		<title>Welcome to BINDR!</title>
	</head>
  
  <body>
    <div class="container">
    <?php require_once 'php_scripts/navbar.php' ?>     
    <br>
     
    <div class="container-fluid">
      <div class="row">
      
      <!-- navigation content -->
        <div class="col-sm-2" style="background-color: #9fffe0;">
          <ul class="list-unstyled">
            <li><h3><h3 class="text-center" style="border-bottom: 1px solid black;">Navigation</h3></h3></li>
            <li class="nav-padding"><a class="nav-text" href="#">Propose User to Binder</a></li>
            <li class="nav-padding"><a class="nav-text" href="edit-binder.php">Edit this Binder</a></li>
            <li class="nav-padding"><a class="nav-text" href="#message">Post a message</a></li>
            <li class="nav-padding"><a class="nav-text" href="#">Leave this Binder</a></li>
          </ul>
        </div> <!-- end col-sm-2 -->
        
      <!-- biner content -->
        <div class="col-sm-10">
          <div class="panel panel-default">
            <div class="panel-body panel-content-color">
            
              <!-- binder name -->
              <div class="text-center">
                <h2 id="binder-name">Binder Name Here</h2>
              </div><br>
              <!-- binder description -->
              
              <div class="text-left">
                <h4>Binder Description:</h4>
                <p id="binder-description"></p>
              </div><br>
              
              <!-- list of binder members -->
              <div class="text-left">
                <h4>Binder Members:</h4>
                <ul id="binder-members"></ul>
              </div><br>
              
              <!-- binder id -->
              <div class="text-left">
                <p id="binder-id">Binder ID:</p>
              </div>
            </div>
          </div> <!-- end content panel -->
        </div> <!-- end col-sm-10 -->
      </div> <!-- end row -->
      
      <!-- messages retrieved from the database -->
      <div class="panel panel-default">
        <div class="panel-body panel-content-color">
            <h2 style="border-bottom: black 2px solid;">Binder Messages</h2>
            <p>Some message</p>
            <p>Author: USER  Date: XX/XX/XXXX</p>
        </div>
      </div>
      
      <!-- begin message submission area -->
      <div class="panel panel-default">
        <div class="panel-body panel-content-color">
        
          <!-- message submission form -->
          <form id="message" method="post"> <!-- add action -->
            <div class="form-group">
              <label for="message"><h3>Enter your message below</h3></label>
              <textarea class="form-control" rows="3" id="message"></textarea><br>
              <button type="submit" class="btn btn-primary">Submit</button>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="home.php" class="btn btn-primary">Cancel</a>
            </div>
          </form>
        </div>
      </div> <!-- end message submission panel -->
      
    </div> <!-- end page content fluid-container -->

    </div> <!-- end document container -->
  </body>  
</html>