<?php
    session_start();

    if (isset($_SESSION["logged_in"])) {
        require_once 'models/User.php';
        $this_user = User::get_user_by_id($_SESSION["id"]);
        if ($_SESSION["type"] == "admin") {
            header('Location: admin-profile.php');
            exit();
        }
        $user_name = $this_user->get_name();
        $user_email = $this_user->get_email_address();
        $user_school = $this_user->get_university();
        $user_bio = $this_user->get_biography();
        $user_binders = $this_user->get_binders();
    } else {
        header('Location: index.php');
        exit();
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
    
		<title>Your Profile</title>
	</head>
  
  <body>
    <div class="container">

    <?php require_once 'php_scripts/navbar.php' ?>     
    <br>
    
    <div class="panel panel-default">
      <div class="panel-body panel-content-color">
        <h2 class="text-center"><?php echo $user_name ?></h2>
        <!-- email address -->
        <h4 class="text-left">E-mail address:</h4>
        <p><?php echo $user_email ?></p>
        
        <!-- school information -->
        <h4 class="text-left">School:</h4>
        <p><?php echo $user_school ?></p>
        
        <!-- bio -->
        <h4 class="text-left">Biography:</h4>
        <p><?php echo $user_bio ?></p>
        
        <!-- binder associations -->
        <h4 class="text-left">Binders:</h4>
        <ul class="list-unstyled">
        <?php   
        require_once 'models/Binder.php';
            foreach($user_binders as $binder) {
                $tmp=Binder::get_binder_by_id($binder);
                echo '<li><a href="home.php?binder_id='.$tmp->get_id().'">'.$tmp->get_name().'</a></li>';
            }
        ?>
        </ul>
        
        <br>        
        <p class="text-left">User ID: <?php echo $_SESSION['id'] ?></p>
      </div>
    </div>
    
    <div class="text-center">
        <a class="btn btn-primary" href="edit-profile.php">Edit Profile</a>
    </div>


    </div> <!-- end document container -->
  </body>  
</html>