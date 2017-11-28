<?php
    session_start();
    require_once "models/User.php";
    require_once "models/Match.php";
    require_once "models/University.php";
    require_once "models/Binder.php";

    if (!(isset($_SESSION["logged_in"]))) {
        header("Location: index.php");
        exit();
    }

    if (isset($_POST["decision"])) {
        if ($_POST["decision"] == "Yes") {
            $match_made = true;
            $pre_existing = Match::get_unanswered_match($_SESSION["id"]);
            if ($pre_existing != Null) {
                if ($pre_existing->get_user1_id() == $_POST["match_id"]) {
                    $new_binder = Binder::create_binder("".$_POST["match_id"]." ; ".$_SESSION["id"]."");
                    $new_binder->add_user(User::get_user_by_id($_SESSION["id"]));
                    $new_binder->add_user(User::get_user_by_id($_POST["match_id"]));
                    header("Location: edit-binder.php");
                    exit();
                }
                else {
                    $match_id = Match::create_match($_SESSION["id"], $_POST["match_id"]);
                    $match = Match::get_match_by_id($match_id);
                    $match->update_user1_approved(true);
                }
            }
            else {
                $match_id = Match::create_match($_SESSION["id"], $_POST["match_id"]);
                $match = Match::get_match_by_id($match_id);
                $match->update_user1_approved(true);
            }
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
                                        echo '<h2 class="text-center">No matches found... Try again later.</h2><br>';
                                    }
                                }
                                else {
                                    $match = User::get_user_by_id($_POST["match_id"]);
                                    $school = University::get_university_by_id($match->get_university_id());
                                    echo '<h1 class="text-center">'.$match->get_name().'</h1><br>';
                                    echo '<h3 class="text-center">School: '.$school->get_name().'<h3></li>';
                                    echo '<h3 class="text-center">Bio: '.$match->get_biography().'</h3></li><br><br>';
                                }
                            ?>
                            <form method="post" action="matching.php">
                                <?php
                                    if (!($match == Null)) {
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
                                    }
                                    else {
                                        echo '<a href="bindr-index.php" value="Home" class="btn btn-primary col-md-4 col-md-offset-4 button-text">Home</a>';
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </body>