<?php
$school_name=$school_city=$school_state=$school_err="";
$account_err="";
	session_start();
	require_once "models/User.php";
        require_once 'models/University.php';
        require_once 'models/Binder.php';
	
	$user = User::get_user_by_id($_SESSION["id"]);
	if ($user->get_type() != "admin") {
		header("Location: profile.php");
		exit();
	}
        
        if (isset($_POST['school-name']) && isset($_POST['school-city']) && isset($_POST['school-state'])) {
            $school_name = $_POST['school-name'];
            $school_city = $_POST['school-city'];
            $school_state = $_POST['school-state'];
            
            try {
                $university = University::create_university($school_name, $school_city, $school_state);
                $school_name=$school_city=$school_state="";
            } catch (ValidationException $ex) {
                $school_err = $ex->get_msg();
            }
            
        } else if (isset($_POST['school-name']) || isset($_POST['school-city']) || isset($_POST['school-state'])) {
            if (isset($_POST['school-name'])) { $school_name = $_POST['school-name']; }
            if (isset($_POST['school-city'])) { $school_name = $_POST['school-city']; }
            if (isset($_POST['school-state'])) { $school_name = $_POST['school-state']; }
            $school_err = "All fields required";
        }
        
        if (isset($_POST['account_action']) && isset($_POST['user_id'])) {
            $user = User::get_user_by_id($_POST['user_id']);
            if ($_POST['account_action']=='disable') {
                $user->update_disabled(1);
            } else {
                $user->update_disabled(0);
            }                  
        }
        
        if (isset($_POST['binder_action']) && isset($_POST['binder_id'])) {
            $binder = Binder::get_binder_by_id($_POST['binder_id']);
            if ($_POST['binder_action']=='disable') {
                $binder->update_disabled(1);
            } else {
                $binder->update_disabled(0);
            }                  
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
            th, td {
                padding: 10px;
                text-align: center;
                font-size: 20px;
            }
            table {
                border-collapse: collapse;
            }
            table, td, th {
                border: 1px solid black;
            }
        </style>
               
	</head>
    <body>
    <div class="container">
        <?php require_once 'php_scripts/navbar.php' ?>     
        <br>
        <h3 class="text-center">Administration Page</h3>
        <div class="row">
            <div class="col-sm-4">
                <h3>Add School</h3>
                <form method="post" action="admin-profile.php">

                    <h4 class="field-label">Name</h4>
                    <input type="text" name="school-name" id="school-name" class="info-input" value="<?php echo $school_name ?>">
                    <br>
                    <h4 class="field-label">City</h4>
                    <input type="text" name="school-city" id="school-city" class="info-input" value="<?php echo $school_city ?>">
                    <br>
                    <h4 class="field-label">State</h4>
                    <input type="text" name="school-state" id="school-state" class="info-input" value="<?php echo $school_state ?>">
                    <br>            
                    <input type="submit" value="Submit">
                    <input type="reset" value="Reset"><span class="error-message"><?php echo $school_err ?></span>
                </form>                

                <h3>Enable/Disable Account</h3>
                <form method="post" action="admin-profile.php">
                    <h4 class="field-label">User ID</h4>
                    <input type="numbert" name="user_id" id="user_id"><span class="error-message"><?php echo $account_err ?></span>
                    <br>
                    Disable&nbsp;<input type="radio" name="account_action" value="disable" checked="checked">&nbsp;
                    Enable&nbsp;<input type="radio" name="account_action" value="enable">
                    <br>
                    <input type="submit" value="Submit">
                </form>

                <h3>Enable/Disable Binder</h3>
                <form method="post" action="admin-profile.php">
                    <h4 class="field-label">Binder ID</h4>
                    <input type="number" name="binder_id" id="binder_id"><span class="error-message"><?php echo $account_err ?></span>
                    <br>
                    Disable&nbsp;<input type="radio" name="binder_action" value="disable" checked="checked">&nbsp;
                    Enable&nbsp;<input type="radio" name="binder_action" value="enable">
                    <br>
                    <input type="submit" value="Submit">
                </form>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h3>School List</h3>
                <table>
                    <tr><th>ID</th><th>School Name</th></tr>
                   <?php
                        $university_ids = University::get_all_university();
                        foreach($university_ids as $school) {
                            $school = University::get_university_by_id($school);
                            echo "<tr><td>".$school->get_id()."</td><td>".$school->get_name()."</td></tr>";
                        }
                   ?>
                </table>
            </div>
        </div>
    </div>
    </body>
</html>