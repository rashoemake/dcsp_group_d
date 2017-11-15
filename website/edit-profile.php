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
    
		<title>Modify a Binder</title>
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
    
<!--
The default values for the form fields below should be drawn from
the values in the database, allowing the user to correct simple
errors
-->

      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-body panel-content-color">
              <h2 class="text-center">Edit your Profile</h2>
              <form>
                <div class="form-group">
                  <label for="user-name"><h3>User name</h3></label>
                  <input class="form-control" type="text" name="user-name" id="user-name" value="User name">     
                </div>
                <div class="form-group">
                  <label for="user-email"><h3>E-mail</h3></label>
                  <input class="form-control" type="text" name="user-email" id="user-email" value="User email">     
                </div>
                <div class="form-group">
                  <label for="user-school"><h3>School</h3></label>
                  <input class="form-control" type="text" name="user-school" id="user-school" value="School name">     
                </div>
                <div class="form-group">
                  <label for="binder-description"><h3>Biography</h3></label>
                  <textarea class="form-control" rows="3" name="user-bio" id="user-bio">User biography</textarea>
                </div>
                <button class="btn btn-primary" type="submit">Apply</button>
                &nbsp&nbsp&nbsp
                <a class="btn btn-primary" href="home.html">Cancel</a>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-2"></div>
      </div> <!-- end row -->


    
    </div> <!-- end document container -->
  </body>  
</html>