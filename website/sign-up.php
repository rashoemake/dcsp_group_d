<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
            
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="css/custom.css">

        <style>
            .field-label {
                display: inline-block;
                width: 90px;
                font-size: 18px;
            }
            .info-input {
                width: 150px;
            }
        </style>

        <title>Sign Up : Bindr</title>
    </head>
    <body>
        <div class="container">
            <!--Begin Navbar-->
            <nav class="navbar navbar-inverse">
				<div class="container">
					<ul class="nav navbar-nav">
							<li class="navbar-padding"><a href="index.html"><span class="glyphicon glyphicon-home glyph-padding"></span>Home</a></li>
						<li class="navbar-padding"><a href="about.html">About</a></li>
						<li class="navbar-padding"><a href="#">Contact</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li style="padding-right: 15px;"><a href="login.php"><span class="glyphicon glyphicon-log-in glyph-padding"></span> Login</a></li>
       				</ul>
				</div>
			</nav>

            <br>

            <!--Begin Page Content-->
            <div class="panel-group">
                <div class="row">
                    <div class="col-md-7 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h1 class="text-center">Create Your Account</h1><br><br>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <!--Name-->
                                                    <div class="form-group col-sm-offset-1">
                                                        <span class="field-label">Name:</span>
                                                        <input type="text" placeholder="Your Full Name" class="info-input">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <!--Email-->
                                                    <div class="form-group col-sm-offset-1">
                                                        <span class="field-label">Email:</span>
                                                        <input type="text" placeholder="Your Email Address" class="info-input">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <!--Password-->
                                                    <div class="form-group col-sm-offset-1">
                                                        <span class="field-label">Password:</span>
                                                        <input type="text" placeholder="Create a Password" class="info-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Quisque vitae neque amet nibh porta facilisis. Maecenas quis metus pulvinar nisi imperdiet commodo. Fusce faucibus nisi eu faucibus facilisis. Duis auctor iaculis dui eu ornare. Praesent vitae faucibus diam, nec vulputate est. Nullam ac sapien massa.</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group text-center">
                                                    <a href="index.php" class="btn btn-primary">Home</a>
                                                    <button type="submit" class="btn btn-primary">Create Account</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>