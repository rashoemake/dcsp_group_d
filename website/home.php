<?php
  $message=$message_err="";
  session_start();
  require_once 'models/Proposal.php';

  if (!(isset($_SESSION["logged_in"]))) {
      header("Location: index.php");
    }
     
  if (isset($_GET['binder_id'])) {
      require 'models/Binder.php';
      $this_binder = Binder::get_binder_by_id($_GET['binder_id']);
      
      if (empty($this_binder)) {
          die('$this_binder is empty: binder must not exist');
      }
      $members = $this_binder->get_binder_membership(); //used later in two places
      
    if (isset($_POST['leave_binder']) && $_POST['leave_binder']=='true') {
      $this_binder->remove_user($_SESSION['id']);
      header("Location: bindr-index.php");
      exit();
  }
      
   if (isset($_POST['message'])) {
      require_once 'models/Message.php';
      try {
          $message=$_POST['message'];
          Message::create_message($message, $_SESSION['id'], $this_binder->get_id());
      } catch (ValidationException $ex) {
          $message_err = $ex->get_msg();
      }
  }
  
    if (isset($_POST['proposed_id'])) {
        Proposal::create_proposal(0, $_SESSION['id'], $_POST['proposed_id'], $this_binder->get_id(), $_POST['proposed_reason']);
    }
      
  } else {
      die('$_GET[binder_id] is not set');
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
    
    <title><?php echo $this_binder->get_name() ?></title>
    
    <style>
        .error {color:#ff0000;}
        .message {
            border-style: solid;
            border-width: 1px;
            padding: 5px;
        }
    </style>
    <script>
        function clearField(ident)
        {
            document.getElementById(ident).innerHTML = ""
        }
    </script>
	</head>
  
  <body>      
    <div class="container">
    <?php require_once 'php_scripts/navbar.php' ?>     
    <br>
    
    
    <?php
        if ($this_binder->get_disabled()==true) {
            echo "<h3>The Binder \"". $this_binder->get_name() ."\" is disabled</h3>";
            exit();
        }
        
        if (!(in_array($_SESSION['id'], $members))) {
            echo "<h3>You are not a member of \"". $this_binder->get_name() ."\"</h3>";
            exit();
        }
      ?>
     
    <div class="container-fluid">
      <div class="row">
      
      <!-- navigation content -->
        <div class="col-sm-2" style="background-color: #9fffe0;">
          <ul class="list-unstyled">
            <li><h4 class="text-center" style="border-bottom: 1px solid black;">Navigation</h4></li>
            <li class="nav-padding"><a class="nav-text" href="#" data-toggle="modal" data-target="#proposal_modal">Propose User to Binder</a></li>
            <li class="nav-padding"><a class="nav-text" href="<?php echo "edit-binder.php?binder_id=".$this_binder->get_id() ?>">Edit this Binder</a></li>
            <li class="nav-padding"><a class="nav-text" href="#message">Post a message</a></li>
            <li class="nav-padding"><a class="nav-text" href="#" data-toggle="modal" data-target="#leave_modal">Leave this Binder</a></li>
          </ul>
        </div> <!-- end col-sm-2 -->
        
      <!-- biner content -->
        <div class="col-sm-10">
          <div class="panel panel-default">
            <div class="panel-body panel-content-color">
            
              <!-- binder name -->
              <div class="text-center">
                <h3 id="binder-name"><?php echo $this_binder->get_name() ?></h3>
              </div><br>
              <!-- binder description -->
              
              <div class="text-left">
                <h4>Binder Description:</h4>
                <p id="binder-description"><?php echo $this_binder->get_description() ?></p>
              </div><br>
              
              <!-- list of binder members -->
              <div class="text-left">
                <h4>Binder Members:</h4>
                <ul id="binder-members">
                    <?php                        
                        //echo "<pre>" . print_r($members) . "</pre>";
                        foreach($members as $user_id) {
                            echo '<li><a href="profile.php?user_id='.$user_id .'">'. match_user_id($user_id).'</a></li>';
                        }
                    ?>
                </ul>
              </div><br>
              
              <!-- binder id -->
              <div class="text-left">
                  <p id="binder-id">Binder ID: <?php echo $this_binder->get_id() ?></p>
              </div>
            </div>
          </div> <!-- end content panel -->
        </div> <!-- end col-sm-10 -->
      </div> <!-- end row -->
      
      <!-- binder proposals -->
      <div class="panel panel-default">
          <div class="panel-body panel-content-color">
              <h3>Proposals</h3>
              <?php
                $binder_proposals = Proposal::get_proposal_by_binder($this_binder->get_id());
                if (!(empty($binder_proposals))) {
                    foreach($binder_proposals as $proposal) {
                        echo '<p>'.match_user_id($proposal->get_proposer_id()).' has proposed: &nbsp;&nbsp;&nbsp;'
                                .'<a href="profile.php?user_id='.$proposal->get_proposed_id().'">'.match_user_id($proposal->get_proposed_id()).'</a></p>';
                        echo '<p>Reason:<br>'.$proposal->get_reason().'</p>';
                        if (!(isset($_GET["already_voted"]))) {
                            echo "<a class='btn btn-primary btn-xs' href='php_scripts/voting.php?action=approve&proposed_id=".$proposal->get_proposed_id()."&proposal_id=".$proposal->get_id()."&binder_id=".$this_binder->get_id()."'>Approve!</a>&nbsp;&nbsp;&nbsp;";
                            echo "<a class='btn btn-danger btn-xs' href='php_scripts/voting.php?action=reject&proposed_id=".$proposal->get_proposed_id()."&proposal_id=".$proposal->get_id()."&binder_id=".$this_binder->get_id()."'>Reject!</a>";
                        }
                        else {
                            if ($_GET["already_voted"] == false) {
                                if ($_GET["user_added"] == true) {
                                    if ($_GET["final_decision"] == true) {
                                        echo "<p>Your vote was decisive. Proposal approved!</p>";
                                    }
                                    else {
                                        echo "<p>Vote cast.</p>";
                                    }
                                }
                                if ($_GET["user_added"] == false) {
                                    if ($_GET["final_decision"] == true) {
                                        echo "<p>Your vote was decisive. Proposal denied.</p>";
                                    }
                                    else {
                                        echo "<p>Vote cast.</p>";
                                    }
                                }
                            }
                            else {
                                echo "<p>You've already voted!</p>";
                            }
                        }
                    }
                } else {
                    echo "<h4>No pending proposals! Use the button below to start one.</h4>";
                }
              ?>
              <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#proposal_modal">Propose User to Binder</a>
          </div>
      </div>
      
      <!-- messages retrieved from the database -->
      <div class="panel panel-default">
        <div class="panel-body panel-content-color">
            <h3>Messages</h3>
            <?php
                require_once 'models/Message.php';
                $message_arr = Message::get_message_by_binder_id($this_binder->get_id());
                foreach($message_arr as $mssg) {
                    echo '<div class="message">';
                    echo "<p>" . $mssg->get_body() . "</p>";
                    echo "<p>Author: " . match_user_id($mssg->get_user_id()) . "  Date: " . $mssg->get_createdDate();
                    echo "</div><br>";
                }
            ?>           
        </div>
      </div>
      
      <!-- begin message submission area -->
      <div class="panel panel-default">
        <div class="panel-body panel-content-color">
        
          <!-- message submission form -->
          <form id="message-form" method="post" action="<?php echo "home.php?binder_id=".$this_binder->get_id() ?>">
            <div class="form-group">
                <label for="message"><h3>Enter your message below</h3></label>
                <span class="error"><?php echo $message_err ?></span>
              <textarea class="form-control" rows="3" id="message" name="message"><?php echo $message ?></textarea><br>
              <input type="submit" class="btn btn-primary" value="Submit">
              &nbsp;&nbsp;&nbsp;&nbsp;
              <input type="reset" class="btn btn-primary" value="Reset" onclick="clearField('message')">
            </div>
          </form>
        </div>
      </div> <!-- end message submission panel -->
      
      <!-- Leave Binder modal -->
      <div id="leave_modal" class="modal fade" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Leave this Binder?</h4>
                  </div>
                  <div class="modal-body">
                      <p>Do you really want to leave <?php echo $this_binder->get_name() ?>?</p>
                  </div>
                  <div class="modal-footer">
                      <form method="post" action="home.php?binder_id=<?php echo $this_binder->get_id() ?>">
                          <input type="hidden" name="leave_binder" value="true">
                          <input type="submit" class="btn btn-danger pull-left" value="Leave">
                      </form>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
      
      <!-- Propose User modal -->
      <div id="proposal_modal" class="modal fade" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Propose a User!</h4>
                  </div>
                  <div class="modal-body">                      
                      <form method="post" action="home.php?binder_id=<?php echo $this_binder->get_id() ?>">
                          <h5>Enter the ID of the User you'd like to propose:</h5>
                          <input type="number" name="proposed_id">
                          <br>
                          <h5>And reason for proposal:</h5>
                          <textarea name="proposed_reason" rows="3" style="width:100%;"></textarea>                                                                      
                  </div>
                  <div class="modal-footer">
                      <input type="submit" value="Submit" class="btn btn-primary">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </form> 
                  </div>
              </div>
          </div>
      </div>
      
    </div> <!-- end page content fluid-container -->

    </div> <!-- end document container -->
  </body>  
</html>

<?php

//returns the name of a user with the given id
function match_user_id($user_id) {
    require_once 'models/User.php';
    
    $user = User::get_user_by_id($user_id);
    return $user->get_name();
}