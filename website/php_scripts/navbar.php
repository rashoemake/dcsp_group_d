<?php
    if(isset($_SESSION["logged_in"])) {
        $home_context='<li class="navbar-padding"><a href="bindr-index.php"><span class="glyphicon glyphicon-th-list glyph-padding"></span>Binders</a></li>';
      
        $context='<li><a href="matching.php"><span class="glyphicon glyphicon-thumbs-up glyph-padding"></span>Start Matching</a></li>';
        $context.='<li><a href="profile.php"><span class="glyphicon glyphicon-user glyph-padding"></span>Profile</a></li>';
        $context.='<li style="padding-right: 15px;"><a href="php_scripts/logout.php"><span class="glyphicon glyphicon-log-out glyph-padding"></span>Logout</a></li>';

    } else {
        $home_context='<li class="navbar-padding"><a href="index.php"><span class="glyphicon glyphicon-home glyph-padding"></span>Home</a></li>';
      
        $context='<li><a href="login.php"><span class="glyphicon glyphicon-log-in glyph-padding"></span>Login</a></li>'."\n";
        $context.='<li style="padding-right: 15px;"><a href="sign-up.php"><span class="glyphicon glyphicon-user glyph-padding"></span>Sign Up</a></li>';
    }
?>

<!-- Begin Navbar -->
		<nav class="navbar navbar-inverse">
      <div class="container">
        <ul class="nav navbar-nav">
          <?php echo $home_context ?>
          <li class="navbar-padding"><a href="about.php">About</a></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
          <?php echo $context ?>      
        </ul>
      </div>
    </nav>