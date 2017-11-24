<?php
	session_start();
	include_once "models/User.php";

	if (isset($_SESSION["logged_in"])) {
        if ($_SESSION["logged_in"] == true) {
            header("Location: home.php");
            exit();
        }
    }

	if ((isset($_POST["email"])) && (isset($_POST["password"]))) {
		if ($_POST["email"] != "") {
			if ($_POST["password"] != "") {
				$user = User::get_user_by_email($_POST["email"]);
				if ($user != Null) {
					$apw = password_hash($_POST["password"], PASSWORD_BCRYPT);
					if ($apw == $user->get_password_hash()) {
						$_SESSION["logged_in"] = true;
						$_SESSION["account"] = $user.get_id();
						header("Location: home.php");
						exit();
					}
				}
			}
			else {
				$no_password = true;
			}
		}
		else{
			$no_email = true;
			if ($_POST["password"] == "") {
				$no_password = true;
			}
		}
	}
?>
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
			.error-message {
                color: #ff0000;
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
												<span class="login-label">email:</span>
												<input type="test" name="email" placeholder="Email" class="login-input" value="<?php if (isset($_POST["email"])) { $entered_email = $_POST["email"]; echo "$entered_email";}?>">
											</div>
											<?php
												if (isset($no_email)) {
													echo '<p class="error-message">Enter your email.</p>';
												}
											?>
											<div class="form-group">
												<span class="login-label">Password:</span>
												<input type="password" name="password" placeholder="Password" class="login-input">
											</div>
											<?php
												if (isset($no_password)) {
													echo '<p class="error-message">Enter your password.</p>';
												}
											?>
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