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
        if ($_POST["decision"] == "Yes") {
            Match::create_match($_SESSION["id"], $_POST["match_id"]);
            $match_made = true;
        }
        else {
            $match_made = false;
            $_POST["match_id"] = Null;
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
                                if (!(isset($match_made)) || ($match_made == false)) {
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
                                }
                                else {
                                    $match = User::get_user_by_id($_POST["match_id"]);
                                    $school = University::get_university_by_id($match->get_university_id());
                                    echo '<h1 class="text-center">'.$match->get_name().'</h1><br>';
                                    echo '<h3 class="text-center">School: '.$school->get_name().'<h3></li>';
                                    echo '<h3 class="text-center">Bio: '.$match->get_biography().'</h3></li><br>';
                                }
                            ?>
                            <form method="post" action="matching.php">
                                <?php
                                    if (!(isset($match_made)) || ($match_made == false)) {
                                        echo '<input type="hidden" name="match_id" value="'.$match->get_id().'">';
                                        echo '<input type="submit" value="Yes" name="decision" class="btn btn-primary pull-left col-md-3 button-text">';
                                        echo '<input type="submit" value="No" name="decision" class="btn btn-primary pull-right col-md-3 button-text">';
                                    }
                                    else {
                                        echo '<h4 class="text-center">You decided to start a Binder with this user!</h4>';
                                        echo '<input type="submit" value="Continue" name="decision" class="btn btn-primary pull-left col-md-3 button-text">';
                                        echo '<a href="bindr-index.php" value="Home" class="btn btn-primary pull-right col-md-3 button-text">Home</a>';
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </body>