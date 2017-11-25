<?php
    session_start();
    include_once "models/User.php";

    if (isset($_SESSION["logged_in"])) {
        if ($_SESSION["logged_in"] == true) {
            header("Location: home.php");
            exit();
        }
    }

    if ((isset($_POST["name"])) && (isset($_POST["email"])) && (isset($_POST["password"]))) {
        if ($_POST["name"] != "") {
            if ($_POST["email"] != "") {
                if ($_POST["password"] != "") {
                    if ($_POST["c_password"] != "") {
                        if ($_POST["password"] == $_POST["c_password"]) {
                            try {
                                User::create_user($_POST["email"], $_POST["password"], $_POST["name"]);
                                $user = User::get_user_by_email($_POST["email"]);
                                $_SESSION["logged_in"] = true;
                                $_SESSION["id"] = $user->get_id();
                                header("Location: account_created.php");
                                exit();
                            }
                            catch (Exception $except) {
                                if ($except->get_subj() == "email_address") {
                                    $invalid_email = true;
                                }
                                elseif ($except->get_subj() == "name") {
                                    $invalid_name = true;
                                }
                                else {
                                    $invalid_strange = true;
                                }
                            }
                        }
                        else {
                            $no_match = true;
                        }
                    }
                    else {
                        $no_c_password = true;
                    }
                }
                else {
                    $no_password = true;
                    if ($_POST["c_password"] == "") {
                        $no_c_password = true;
                    }
                }
            }
            else {
                $no_email = true;
                if ($_POST["password"] == "") {
                    $no_password = true;
                }
                if ($_POST["c_password"] == "") {
                    $no_c_password = true;
                }
            }
        }
        else {
            $no_name = true;
            if ($_POST["email"] == "") {
                $no_email = true;
            }
            if ($_POST["password"] == "") {
                $no_password = true;
            }
            if ($_POST["c_password"] == "") {
                $no_c_password = true;
            }
        }
    }
?>
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
            .error-message {
                color: #ff0000;
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
							<li class="navbar-padding"><a href="index.php"><span class="glyphicon glyphicon-home glyph-padding"></span>Home</a></li>
						<li class="navbar-padding"><a href="about.php">About</a></li>
						<li class="navbar-padding"><a href="contact.php">Contact</a></li>
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
                                    <form method="post" action="sign-up.php">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <!--Name-->
                                                        <div class="form-group col-sm-offset-1">
                                                            <span class="field-label">Name:</span>
                                                            <input type="text" name="name" placeholder="Your Full Name" class="info-input" value="<?php if (isset($_POST["name"])) { $entered_name = $_POST["name"]; echo "$entered_name";}?>">
                                                        </div>
                                                        <?php
                                                            if (isset($no_name)) {
                                                                echo '<p class="error-message col-sm-offset-1">A name is required.</p>';
                                                            }
                                                            if (isset($invalid_name)) {
                                                                echo '<p class="error-message col-sm-offset-1">Invalid name.</p>';
                                                            }
                                                        ?>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <!--Email-->
                                                        <div class="form-group col-sm-offset-1">
                                                            <span class="field-label">Email:</span>
                                                            <input type="text" name="email" placeholder="Your Email Address" class="info-input" value="<?php if (isset($_POST["email"])) { $entered_email = $_POST["email"]; echo "$entered_email";}?>">
                                                        </div>
                                                        <?php
                                                            if (isset($no_email)) {
                                                                echo '<p class="error-message col-sm-offset-1">An email address is required.</p>';
                                                            }
                                                            if (isset($invalid_email)) {
                                                                echo '<p class="error-message col-sm-offset-1">Invalid email address.</p>';
                                                            }
                                                        ?>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <!--Password-->
                                                        <div class="form-group col-sm-offset-1">
                                                            <span class="field-label">Password:</span>
                                                            <input type="password" name="password" placeholder="Create a Password" class="info-input">
                                                        </div>
                                                        <?php
                                                            if (isset($no_password)) {
                                                                echo '<p class="error-message col-sm-offset-1">A password is required.</p>';
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="row">
                                                        <!--Confirm Password-->
                                                        <div class="form-group col-sm-offset-1">
                                                            <span class="field-label"> </span>
                                                            <input type="password" name="c_password" placeholder="Confirm Password" class="info-input">
                                                        </div>
                                                        <?php
                                                            if (isset($no_c_password)) {
                                                                echo '<p class="error-message col-sm-offset-1">You must confirm your password.</p>';
                                                            }
                                                            if (isset($no_match)) {
                                                                echo '<p class="error-message col-sm-offset-1">Passwords don\'t match.</p>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <p>Welcome to Bindr! Before you can start finding study partners, you need an account! A couple of things to consider:</p>
                                                    <p>- We highly recommend using your real name.</p>
                                                    <p>- Use an email you have access to.</p>
                                                    <p>- Passwords must be n characters and are case sensitive.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group text-center">
                                                        <a href="index.php" class="btn btn-primary">Home</a>
                                                        <input type="submit" value="Create Account" class="btn btn-primary">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>