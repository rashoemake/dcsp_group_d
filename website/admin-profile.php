<?php
$school_name=$school_city=$school_state=$school_err="";
	session_start();
	require_once "models/User.php";
        require_once 'models/University.php';
	
//	$user = User::get_user_by_id($_SESSION["id"]);
//	if ($user->get_type() != "admin") {
//		header("Location: profile.php");
//		exit();
//	}
        
        if (isset($_POST['school-name']) && isset($_POST['school-city']) && isset($_POST['school-state'])) {
            $school_name = $_POST['school-name'];
            $school_city = $_POST['school-city'];
            $school_state = $_POST['school-state'];
            
            try {
                $university = University::create_university($school_name, $school_city, $school_state);
            } catch (ValidationException $ex) {
                $school_err = $ex->get_msg();
            }
        } else {
            if (isset($_POST['school-name'])) { $school_name = $_POST['school-name']; }
            if (isset($_POST['school-city'])) { $school_name = $_POST['school-city']; }
            if (isset($_POST['school-state'])) { $school_name = $_POST['school-state']; }
            $school_err = "All fields required";
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
    
		<title>Administrator Profile</title>
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
               
	</head>
    <body>
    <div class="container">
        <?php require_once 'php_scripts/navbar.php' ?>     
        <br>
        <h3 class="text-center">Administration Page</h3>
        <h3>Add School</h3>
        <form method="post" action="admin-profile.php">
            
            <h4 class="field-label">Name</h4>
            <input type="text" name="school-name" id="school-name" class="info-input" value="<?php echo $school_name ?>">
            
            <h4 class="field-label">City</h4>
            <input type="text" name="school-city" id="school-city" class="info-input" value="<?php echo $school_city ?>">

            <h4 class="field-label">State</h4>
            <input type="text" name="school-state" id="school-state" class="info-input" value="<?php echo $school_state ?>">
            <span class="error"><?php echo $school_err ?></span><br>
           
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </form>

    </body>
</html>