<?php
    session_start();
    require_once "models/University.php";
    require_once "models/Proposal.php";

    $foreign_view=false;
    if (isset($_GET['user_id'])) {
        if ($_GET['user_id']!=$_SESSION['id']) {
            $foreign_view=true;
        }
    }
    
    if (isset($_POST["suggest_binder"])) {
        $proposal_id = Proposal::create_proposal(false, $_SESSION["id"], $_GET["user_id"], $_POST["suggest_binder"]);
        $proposal_created = true;
    }

    if (isset($_SESSION["logged_in"])) {
        require_once 'models/User.php';
        
        if ($foreign_view) {
            $this_user = User::get_user_by_id($_GET["user_id"]);
        } else {
            $this_user = User::get_user_by_id($_SESSION["id"]);
        }
        
        if ($_SESSION["type"] == "admin") {
            header('Location: admin-profile.php');
            exit();
        }
        $user_name = $this_user->get_name();
        $user_email = $this_user->get_email_address();
        $user_school_id = $this_user->get_university_id();
        $user_school = University::get_university_by_id($user_school_id);
        $user_bio = $this_user->get_biography();
        $user_binders = $this_user->get_binders();
        $user_id = $this_user->get_id();
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
        <p><?php echo $user_school->get_name() ?></p>
        
        <!-- bio -->
        <h4 class="text-left">Biography:</h4>
        <p><?php echo $user_bio ?></p>
        
        <?php 
        if ($foreign_view) {
            echo '<h4 class="text-left">Binders:</h4>';
            echo '<ul class="list-unstyled">';

            require_once 'models/Binder.php';
                foreach($user_binders as $binder) {
                    $tmp=Binder::get_binder_by_id($binder);
                    echo '<li><a href="home.php?binder_id='.$tmp->get_id().'">'.$tmp->get_name().'</a></li>';

               }          
            echo '</ul>';  
        } else {}        
        ?>
        
        <br>        
        <p class="text-left">User ID: <?php echo $user_id ?></p>
        <br>
        <?php
            if (isset($_GET["show_suggest"])) {
                if (!(isset($proposal_created))) {
                    echo '<form method="post" action="profile.php?user_id='.$user_id.'&show_suggest='.true.'">';
                    echo '<select class="form-control" name="suggest_binder" id="suggest_binder">';
                    $self_user = User::get_user_by_id($_SESSION["id"]);
                    $self_user_binders = $self_user->get_binders();
                    if (!(empty($self_user_binders))) {
                        foreach ($self_user_binders as $binder_id) {
                            $binder = Binder::get_binder_by_id($binder_id);
                            echo '<option value="'.$binder->get_id().'">'.$binder->get_name().'</option>';
                        }
                        echo '</select><br>';
                        echo '<button class="btn btn-primary" type="submit">Suggest</button>';
                    }
                    else {
                        echo '<option value="'.Null.'">None</option>';
                        echo '</select><br>';
                        echo '<button class="btn btn-primary" type="submint" disabled>Suggest</button>';
                    }
                    echo '</form>';
                }
                else {
                    echo '<h4>Your proposal was successful.';
                }
            }
        ?>
      </div>
    </div>
    
    <?php 
    if ($foreign_view) {
        echo "";
    } else {
        echo<<<_END
        <div class="text-center">
        <a class="btn btn-primary" href="edit-profile.php">Edit Profile</a>
        </div>
_END;
    }
    ?>
    
    

    </div> <!-- end document container -->
  </body>  
</html>