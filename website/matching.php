<?php
    session_start();
    require_once "models/User.php";
    require_once "models/Match.php";
    require_once "models/University.php";

    if (!(isset($_SESSION["logged_in"]))) {
        header("Location: index.php");
        exit();
    }

    if (isset($_POST["decision"])) {
        if ($_POST["decision"] != Null) {
            Match::create_match($_SESSION["id"], $_POST["decision"]);
            
        }
        else {

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
            .big-ol-frown {
                font-size: 102px;
            }
            .button-text {
                font-size: 24px;
            }
        </style>

        <title>Matching : Bindr</title>
    </head>
    <body>
    <div class="container">
        <?php require_once 'php_scripts/navbar.php'?>
        <br>

        <div class="panel-group">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body panel-content-color">
                            <?php
                                $match = Match::suggest_user($_SESSION["id"]);
                                if ($match != Null) {
                                    $school = University::get_university_by_id($match->get_university_id());
                                    echo '<h1 class="text-center">'.$match->get_name().'</h1><br>';
                                    echo '<h3 class="text-center">School: '.$school->get_name().'<h3></li>';
                                    echo '<h3 class="text-center">Bio: '.$match->get_biography().'</h3></li><br>';
                                }
                                else {
                                    echo '<h1 class="text-center big-ol-frown">:(</h1><br>';
                                    echo '<h2 class="text-center">No matches found... Try again later.</h2>';
                                }
                            ?>
                            <form method="post" action="matching.php">
                                <input type="submit" value="<?php $match->get_id() ?>" name="decision" class="btn btn-primary pull-left col-md-3 button-text">
                                <input type="submit" value="<?php Null ?>" name="decision" class="btn btn-primary pull-right col-md-3 button-text">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </body>