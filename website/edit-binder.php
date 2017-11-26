<?php
    $name=$name_err=$description=$description_err="";
    session_start();
    
//  if (!(isset($_SESSION["logged_in"]))) {
//    header("Location: index.php");
//  }
    
    if (isset($_GET['binder_id'])) {
      require 'models/Binder.php';
      $this_binder = Binder::get_binder_by_id($_GET['binder_id']);
      $name = $this_binder->get_name();
      $description = $this_binder->get_description();
      
      if (empty($this_binder)) {
          die('$this_binder is empty: binder must not exist');
      }
      
      if (isset($_POST['name'])) {
          $name = $_POST['name'];
          try {
              $this_binder->update_name($name);
          } catch (ValidationException $ex) {
              $name_err = $ex->get_msg();
          }
      }
      
      if (isset($_POST['description'])) {
          $description = $_POST['description'];
          try {
              $this_binder->update_description($description);
          } catch (ValidationException $ex) {
              $description_err = $ex->get_msg();
          }
      }
    } else {
        die("\$_GET['binder_id'] is not set");
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
    
    <title>Modify <?php echo $this_binder->get_name() ?></title>
    
    <style>
        .error {color:#ff0000;}
    </style>
	</head>
  
  <body>
    <div class="container">
<?php require_once 'php_scripts/navbar.php' ?>     
      <br>
    
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
              <h2 class="text-center">Edit Binder</h2>
              <form method="post" action="<?php echo "edit-binder.php?binder_id=".$this_binder->get_id() ?>">
                <div class="form-group">
                  <label for="binder-name"><h3>Binder name</h3></label>
                  <input class="form-control" type="text" name="name" id="binder-name" value="<?php echo $name ?>"> 
                  <span class="error"><?php echo $name_err ?></span>
                </div>
                <div class="form-group">
                  <label for="binder-description"><h3>Binder description</h3></label>
                  <textarea class="form-control" rows="3" name="description" id="binder-description"><?php echo $description ?></textarea>
                  <span class="error"><?php echo $description_err ?></span>
                </div>
                <button class="btn btn-primary" type="submit">Apply</button>
                &nbsp&nbsp&nbsp
                <a class="btn btn-primary" href="<?php echo "home.php?binder_id=".$this_binder->get_id() ?>">Back</a>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-2"></div>
      </div> <!-- end row -->


    
    </div> <!-- end document container -->
  </body>  
</html>