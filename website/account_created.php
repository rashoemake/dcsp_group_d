<?php
    session_start();
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

        <title>Success : Bindr</title>
    </head>
    <body>
        <!-- Begin navbar -->
        <div class="container">
            <?php require_once 'php_scripts/navbar.php' ?>
        </div>

        <br>

        <!-- Begin page content -->
        <div class="panel-group">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3 class="text-center">Your account was successfully created!</h3>
                            <br>
                            <p class="text-center">You'll be redirected to a page you can add more information about yourself in 5 seconds.</p>
                            <a href=edit-profile.php><p class="text-center">If you aren't, click here.</p></a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        setTimeout(Redirect, 5000);

        function Redirect() {
            window.location="edit-profile.php";
        }
    </script>
</html>