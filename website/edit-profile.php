<?php
  session_start();
  require_once "models/User.php";
  require_once "models/University.php";

  if (!(isset($_SESSION["logged_in"]))) {
    header("Location: index.php");
    exit();
  }

  if ((isset($_POST["user-name"])) && (isset($_POST["user-email"])) && (isset($_POST["user-school"])) && (isset($_POST["user-bio"]))) {
    $user = User::get_user_by_id($_SESSION["id"]);
    // Update Name
    if (($_POST["user-name"] != $user->get_name()) && ($_POST["user-name"] != "") && ($_POST["user-name"] != Null)) {
      try {
        $user->update_name($_POST["user-name"]);
        $name_changed = true;
      }
      catch (Exception $n_except) {
        $invalid_name = true;
      }
    }
    // Update Email
    if (($_POST["user-email"] != $user->get_email_address()) && ($_POST["user-email"] != "") && ($_POST["user-email"] != Null)) {
      try {
        $user->update_email_address($_POST["user-email"]);
        $email_changed = true;
      }
      catch (Exception $e_except) {
        $invalid_email = true;
      }
    }
    // Update School
    if (($_POST["user-school"] != Null) && ($_POST["user-school"] != "")) {
      $school_id = $user->get_university_id();
      if (($school_id != Null) && ($school_id != "")) {
        $new_school = University::get_university_by_name($_POST["user-school"]);
        if ($new_school != Null) {
          if ($_POST["user-school"] != $school->get_name()) {
          try {
              $user->update_university_id($new_school->get_id());
              $school_changed = true;
            }
            catch (Exception $s_except) {
              $invalid_school = true;
            }
          }
        }
        else {
          $invalid_school = true;
        }
      }
      else {
        $new_school = University::get_university_by_name($_POST["user-school"]);
        if ($new_school != Null) {
          try {
            $user->update_unversity_id($new_school->get_id());
            $school_changed = true;
          }
          catch (Exception $s_except) {
            $invalid_school = true;
          }
        }
        else {
          $invalid_school = true;
        }
      }
    }
    // Update Bio
    if ($_POST["user-bio"] != $user->get_biography()) {
      try {
        if ($_POST["user-bio"] == Null) {
          $user->update_biography("");
        }
        else {
          $user->update_biography($_POST["user-bio"]);
        }
        $bio_changed = true;
      }
      catch (Exception $b_exception) {
        $invalid_bio = true;
      }
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
    
		<title>Modify Your Profile</title>
	</head>

  <style>
    .error-message {
      color: #ff0000;
    }
    .success-message {
      color: #008000;
    }
  </style>
  
  <body>
    <div class="container">

<?php require_once 'php_scripts/navbar.php' ?>
    
<!--
The default values for the form fields below should be drawn from
the values in the database, allowing the user to correct simple
errors
-->

      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-body panel-content-color">
              <h3 class="text-center">Edit your Profile</h3>
              <form method="post" action="edit-profile.php">
                <div class="form-group">
                  <label for="user-name"><h4>Name</h4></label>
                  <input class="form-control" type="text" name="user-name" id="user-name" placeholder="Name" value="<?php if (isset($_SESSION["id"])) { $user = User::get_user_by_id($_SESSION["id"]); if (($user->get_name() != Null) && ($user->get_name() != "")) { echo $user->get_name(); }}?>">     
                </div>
                <?php
                  if (isset($invalid_name)) {
                    echo '<p class="error-message">Invalid name.</p>';
                  }
                  if (isset($name_changed)) {
                    echo '<p class="success-message">Name changed successfully!</p>';
                  }
                ?>
                <div class="form-group">
                  <label for="user-email"><h4>E-mail</h4></label>
                  <input class="form-control" type="text" name="user-email" id="user-email" placeholder="E-mail" value="<?php if (isset($_SESSION["id"])) { $user = User::get_user_by_id($_SESSION["id"]); if (($user->get_email_address() != Null) && ($user->get_email_address() != "")) { echo $user->get_email_address(); }}?>">     
                </div>
                <?php
                  if (isset($invalid_email)) {
                    echo '<p class="error-message">Invalid e-mail address.</p>';
                  }
                  if (isset($email_changed)) {
                    echo '<p class="success-message">E-mail changed successfully!</p>';
                  }
                ?>
                <div class="form-group">
                  <label for="user-school"><h4>School</h4></label>
                  <input class="form-control" type="text" name="user-school" id="user-school" placeholder="School" value="<?php if (isset($_SESSION["id"])) { $user = User::get_user_by_id($_SESSION["id"]); if (($user->get_university_id() != Null) && ($user->get_university_id() != "")) { echo $user->get_university_id(); }}?>">
                </div>
                <?php
                  if (isset($invalid_school)) {
                    echo '<p class="error-message">Invalid school.</p>';
                  }
                  if (isset($school_changed)) {
                    echo '<p class="success-message">School changed successfully!</p>';
                  }
                ?>
                <div class="form-group">
                  <label for="binder-description"><h4>Biography</h4></label>
                  <textarea class="form-control" rows="3" name="user-bio" id="user-bio" placeholder="Write a short biography so other can get to know you!" placeholder="Bio"><?php if (isset($_SESSION["id"])) { $user = User::get_user_by_id($_SESSION["id"]); if (($user->get_biography() != Null) && ($user->get_biography() != "")) { echo $user->get_biography(); }}?></textarea>
                </div>
                <?php
                  if (isset($invalid_bio)) {
                    echo '<p class="error-message">Invalid biography.</p>';
                  }
                  if (isset($bio_changed)) {
                    echo '<p class="success-message">Biography changed successfully!</p>';
                  }
                ?>
                <button class="btn btn-primary" type="submit">Apply</button>
                &nbsp&nbsp&nbsp
                <a class="btn btn-primary" href="home.php">Cancel</a>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-2"></div>
      </div> <!-- end row -->


    
    </div> <!-- end document container -->
  </body>  
</html>