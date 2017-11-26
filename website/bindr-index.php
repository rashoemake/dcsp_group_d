<?php
    session_start();
    require_once "models/User.php";
    require_once "models/Binder.php";

    if (!(isset($_SESSION["logged_in"]))) {
        header("Location: index.php");
        exit();
    }

    $user = User::get_user_by_id($_SESSION["id"]);
    $user_binders = $user->get_binders();
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
            .big-text {
                font-size: 56px;
                font-style: italic;
            }
        </style>
    
    <title>Binders : Bindr</title>
</html>
<body>
    <div class="container">
        <?php require_once 'php_scripts/navbar.php'?>
        <br>

        <div class="panel-group">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <?php
                        if (sizeof($user_binders) != 0) {
                            foreach ($user_binders as $binder) {
                                $tmp=Binder::get_binder_by_id($binder);
                                $name = $tmp->get_name();
                                $description = $tmp->get_description();
                                echo '<div class="panel panel-default"><div class="panel-body"><h2><a href="home.php?binder_id='.$tmp->get_id().'">'.$name.'</a></h2><h4>'.$description.'</h4></div></div><br>';
                            }
                        }
                        else {
                            echo '<h1 class="text-center big-text">*tumbleweed*</h1><br><h2 class="text-center">You\'re not in any Binders yet!</h2><h3 class="text-center">Start matching to find some!</h3>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>