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

    if ((isset($_POST["decision"])) && (isset($_POST["match_id"]))) {
        if ($_POST["decision"] == "Yes") {
            $pre_existing = Match::get_unanswered_match($_SESSION["id"]);
            if ($pre_existing == Null) {
                $match_id = Match::create_match($_SESSION["id"], $_POST["match_id"]);
                $match = Match::get_match_by_id($match_id);
                $match->update_user1_approved(true);
                $match_made = true;
            }
            else {
                if ($pre_existing->get_user1_id() == $_POST["match_id"]) {
                    $pre_existing->update_user2_approved(true);
                    $user1 = User::get_user_by_id($_POST["match_id"]);
                    $user2 = User::get_user_by_id($_SESSION["id"]);
                    $binder_id = Binder::create_binder("New Binder");
                    $binder = Binder::get_binder_by_id($binder_id);
                    $binder->update_disabled(0);
                    $binder->add_user($_POST["match_id"]);
                    $binder->add_user($_SESSION["id"]);
                    $binder_created = true;
                }
                else {
                    $match_id = Match::create_match($_SESSION["id"], $_POST["match_id"]);
                    $match = Match::get_match_by_id($match_id);
                    $match->update_user1_approved(true);
                    $match_made = true;
                }
            }
        }
        else {
            $match_id = Match::create_match($_SESSION["id"], $_POST["match_id"]);
            $match = Match::get_match_by_id($match_id);
            $match->update_user1_approved(false);
            header("Location: matching.php");
            exit();
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
                                if (!(isset($binder_created))) {
                                    if (!(isset($match_made))) {
                                        $unanswered_match = Match::get_unanswered_match($_SESSION["id"]);
                                        if ($unanswered_match == Null) {
                                            $sug_match = Match::suggest_user($_SESSION["id"]);
                                        }
                                        else {
                                            $sug_match_id = $unanswered_match->get_user1_id();
                                            $sug_match = User::get_user_by_id("$sug_match_id");
                                        }
                                        if ($sug_match != Null) {
                                            $school = University::get_university_by_id($sug_match->get_university_id());
                                            echo '<a href="profile.php?user_id='.$sug_match->get_id().'&show_suggest='.true.'"><h1 class="text-center">'.$sug_match->get_name().'</h1></a><br>';
                                            echo '<h3 class="text-center">School: '.$school->get_name().'<h3></li>';
                                            echo '<h3 class="text-center">Bio: '.$sug_match->get_biography().'</h3></li><br>';
                                        }
                                        else {
                                            echo '<h1 class="text-center big-ol-frown">:(</h1><br>';
                                            echo '<h2 class="text-center">No matches found... Try again later.</h2><br>';
                                        }
                                    }
                                    else {
                                        $match_user = User::get_user_by_id($_POST["match_id"]);
                                        $school = University::get_university_by_id($match_user->get_university_id());
                                        echo '<h1 class="text-center">'.$match_user->get_name().'</h1><br>';
                                        echo '<h3 class="text-center">School: '.$school->get_name().'<h3></li>';
                                        echo '<h3 class="text-center">Bio: '.$match_user->get_biography().'</h3></li><br>';
                                    }
                                }
                            ?>
                            <form method="post" action="matching.php">
                                <?php
                                    if (isset($sug_match)) {
                                        if ($sug_match != Null) {
                                            if (!(isset($match_made)) && !(isset($binder_created))) {
                                                echo '<input type="hidden" name="match_id" value="'.$sug_match->get_id().'">';
                                                echo '<input type="submit" value="Yes" name="decision" class="btn btn-primary pull-left col-md-3 button-text">';
                                                echo '<input type="submit" value="No" name="decision" class="btn btn-primary pull-right col-md-3 button-text">';
                                            }
                                            else {
                                                echo '<h4 class="text-center">You decided to start a Binder with this user!</h4>';
                                                echo '<a href="matching.php" value="Continue" class="btn btn-primary pull-left col-md-3 button-text">Continue</a>';
                                                echo '<a href="bindr-index.php" value="Home" class="btn btn-primary pull-right col-md-3 button-text">Home</a>';
                                            }
                                        }
                                    }
                                    elseif (isset($match_user)) {
                                        echo '<h4 class="text-center">You decided to start a Binder with this user!</h4>';
                                        echo '<a href="matching.php" value="Continue" class="btn btn-primary pull-left col-md-3 button-text">Continue</a>';
                                        echo '<a href="bindr-index.php" value="Home" class="btn btn-primary pull-right col-md-3 button-text">Home</a>';
                                    }
                                    else {
                                        if (isset($binder_created)) {
                                            echo '<h4 class="text-center">'.$user2->get_name().' matched you too!</h4>';
                                            echo '<h4 class="text-center">Binder '.$binder->get_name().' was created!</h4>';
                                            echo '<form method="get"><a href="edit-binder.php?binder_id='.$binder->get_id().'" value="Set Info" class="btn btn-primary pull-right col-md-3 button-text">Set Info</a>';
                                        }
                                        else {
                                            echo '<a href="bindr-index.php" value="Home" class="btn btn-primary col-md-4 col-md-offset-4 button-text">Home</a>';
                                        }
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </body>