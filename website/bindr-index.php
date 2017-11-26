<?php
    session_start();
    require_once "models/User.php";

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
    
    <title>Binders : Bindr</title>
</html>
<body>
    <div class="container">
        <?php require_once 'php_scripts/navbar.php'?>
        <br>

        <div class="panel-group">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php
                        foreach ($user_binders as $binder) {
                            $tmp=Binder::get_binder_by_id($id);
                            echo '<div class="panel panel-default"><div class="panel-body"><h3><li><a href="home.php?binder_id='.$tmp->get_id().'">Binder1</a>'.$tmp->get_name().'</li></h3></div></div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>