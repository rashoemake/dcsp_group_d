<!DOCTYPE html>
<html>
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
			.btn-primary {
				color: #000;
			}
			.footer {
				padding: 10px;
				border-top: 2px;
			}
			.panel-body {
				padding-top: 15px;
				padding-left: 15px;
			}
			.login-label {
				display: inline-block;
				width: 90px;
			}
			.login-input {
				width: 200px;
			}
		</style>
		
		<title>Login : Bindr</title>
	</head>
	<body>
		<div class="container">
			<?php require_once 'php_scripts/navbar.php' ?>

			<br>

			<!-- Begin Page Content -->
			<div class="panel-group">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="panel panel-default login-panel-padding">
							<div class="panel-body">
								<h1 class="text-center">Welcome Back!</h1>
								<br>
									<form method="post" action="login.php">
										<div class="container">
											<div class="form-group">
												<span class="login-label">Username:</span>
												<input type="username" class="login-input" id="usr">
											</div>
											<div class="form-group">
												<span class="login-label">Password:</span>
												<input type="password" class="login-input" id="pwd">
											</div>
											<br>
										</div>
										<div class="form-group pull-right">
											<a href="index.php" class="btn btn-primary">Home</a>
											<input type="submit" value="Log In" class="btn btn-primary">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>