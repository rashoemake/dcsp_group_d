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
    <!-- Begin Navbar -->
    <nav class="navbar navbar-inverse">
      <div class="container">
        <ul class="nav navbar-nav">
          <li class="navbar-padding"><a href="index.html"><span class="glyphicon glyphicon-home glyph-padding"></span>Home</a></li>
          <li class="navbar-padding"><a href="about.html">About</a></li>
          <li class="navbar-padding"><a href="#">Contact</a></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
          <li><a href="#"><span class="glyphicon glyphicon-log-in glyph-padding"></span>  Login</a></li>
          <li style="padding-right: 15px;"><a href="#"><span class="glyphicon glyphicon-user glyph-padding"></span> Sign Up</a></li>          
        </ul>
      </div>
    </nav>     
    <br>
     
    <div class="container-fluid">
      <div class="row">
      
      <!-- navigation content -->
        <div class="col-sm-2" style="background-color: #9fffe0;">
          <ul class="list-unstyled">
            <li><h3><h3 class="text-center" style="border-bottom: 1px solid black;">Navigation</h3></h3></li>
            <li class="nav-padding"><a class="nav-text" href="#">Propose User to Binder</a></li>
            <li class="nav-padding"><a class="nav-text" href="edit-binder.html">Edit this Binder</a></li>
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
              <a href="home.html" class="btn btn-primary">Cancel</a>
            </div>
          </form>
        </div>
      </div> <!-- end message submission panel -->
      
    </div> <!-- end page content fluid-container -->

    </div> <!-- end document container -->
  </body>  
</html>