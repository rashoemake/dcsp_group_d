<?php  //createdatabase.php
   error_reporting(E_ALL);
  ini_set('display_errors', 1);
  //
  //requires login.php that contains host name user name password and database name for the mysql database
  require_once 'website/models/connect.php';
  $connection = $conn;

  if ($connection->connect_error) die($connection->connect_error);

function createuserstable($connection){
  $query = "CREATE TABLE IF NOT EXISTS users (
    id            INT NOT NULL AUTO_INCREMENT UNIQUE,
    name          VARCHAR(64),
    avgRating     FLOAT,
    numRatings    INT,
    emailAddress  VARCHAR(254) NOT NULL UNIQUE,
    passwordHash  VARCHAR(60) NOT NULL,
    bio           TEXT,
    disabled      BOOL,
    university_id INT,
    FOREIGN KEY fk_uni(university_id) 
    REFERENCES universities(id) 
    ON UPDATE CASCADE 
    ON DELETE RESTRICT,
    modifiedDate  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY   (id)
    
  )";
    $result = $connection->query($query); 
    if (!$result) die($connection->error);
    else echo('users table created <br>');
 }
 
function createmessagestable($connection){
  $query = "CREATE TABLE IF NOT EXISTS messages (
    id            INT NOT NULL AUTO_INCREMENT UNIQUE,
    body          TEXT,
    hidden        BOOL,
    user_id INT NOT NULL,
    FOREIGN KEY fk_sender_id(user_id)
    REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    binder_id INT,
    FOREIGN KEY fk_message_binder_id(binder_id) 
    REFERENCES binder(id)
    ON UPDATE CASCADE 
    ON DELETE RESTRICT,
    createdDate  TIMESTAMP DEFAULT 0,
    PRIMARY KEY   (id)
    
  )";
    $result = $connection->query($query); 
    if (!$result) die($connection->error);
    else echo('messages table created <br>') ;
 }
 
function createuniversitiestable($connection){
  $query = "CREATE TABLE IF NOT EXISTS universities (
    id            INT NOT NULL AUTO_INCREMENT UNIQUE,
    name          VARCHAR(64) NOT NULL,
    city          VARCHAR(64) NOT NULL,
    state         VARCHAR(64)  NOT NULL,
    modifiedDate  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY   (id)
    
  )";
  

    $result = $connection->query($query); 
    if (!$result) die($connection->error);
    else echo('universities table created <br>') ;
 } 
function createuserbinderstable($connection){
  $query = "CREATE TABLE IF NOT EXISTS user_binders (
    user_id INT AUTO_INCREMENT,
    FOREIGN KEY fk_user_id(user_id) 
    REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    binder_id INT,
    FOREIGN KEY fk_binder_id(binder_id)
    REFERENCES binder(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    modifiedDate  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY   (user_id, binder_id)
    
  )";
  
  
    $result = $connection->query($query); 
    if (!$result) die($connection->error);
    else echo('user_binders table created <br>') ;
 }
 
function createbindertable($connection){
  $query = "CREATE TABLE IF NOT EXISTS binder (
    id            INT NOT NULL AUTO_INCREMENT UNIQUE,
    name          VARCHAR(64),
    bio           TEXT,
    disabled      BOOL,
    modifiedDate  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY   (id)
    
  )";
  
    
    $result = $connection->query($query); 
    if (!$result) die($connection->error);
    else echo('binder table created <br>') ;
 }
 
  
function creatematchestable($connection){
  $query = "CREATE TABLE IF NOT EXISTS matches (
    id            INT NOT NULL AUTO_INCREMENT UNIQUE,
    user1_approve BOOL,
    user2_approve BOOL,
    user1_id INT,
    FOREIGN KEY fk_user1_id(user1_id) 
    REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    user2_id INT,
    FOREIGN KEY fk_user2_id(user2_id) 
    REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    modifiedDate  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY   (id)
    
  )";
  

    $result = $connection->query($query); 
    if (!$result) die($connection->error);
    else echo('matches table created <br>') ;
 }
function createreportstable($connection){
  $query = "CREATE TABLE IF NOT EXISTS reports (
    id                INT NOT NULL AUTO_INCREMENT UNIQUE,
    message           TEXT,
    handled           BOOL,
    user_id_reporter INT,
    FOREIGN KEY fk_user_id_reporter(user_id_reporter)
    REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    user_id_reported INT,
    FOREIGN KEY fk_user_id_reported(user_id_reported)
    REFERENCES users(id) 
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    createdDate       TIMESTAMP DEFAULT 0,
    PRIMARY KEY   (id)
    
  )";
  
  
    $result = $connection->query($query); 
    if (!$result) die($connection->error);
    else echo('reports table created <br>') ;
 }
 
  
function createproposalstable($connection){
  $query = "CREATE TABLE IF NOT EXISTS proposals (
    id           INT NOT NULL AUTO_INCREMENT UNIQUE,
    reason       TEXT,
    is_removal   BOOL,
    proposer_id  INT,
    FOREIGN KEY fk_proposer_id(proposer_id)  
    REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    proposed_id INT,
    FOREIGN KEY fk_proposed_id(proposed_id)  
    REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    binder_id INT,
    FOREIGN KEY fk_proposal_binder_id(binder_id)
    REFERENCES binder(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    modifiedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY   (id)
    
  )";
  
  
    $result = $connection->query($query); 
    if (!$result) die($connection->error);
    else echo('proposals table created <br>') ;
 }
 
   
function createproposalresponsestable($connection){
  $query = "CREATE TABLE IF NOT EXISTS proposal_responses (
    id           INT NOT NULL AUTO_INCREMENT UNIQUE,
    response     BOOL,
    proposal_id INT,
    FOREIGN KEY fk_proposal_id(proposal_id)  
    REFERENCES proposals(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    user_id INT,
    FOREIGN KEY fk_responding_user_id(user_id)
    REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    modifiedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY   (id)
    
  )";
  
 
    $result = $connection->query($query); 
    if (!$result) die($connection->error);
    else echo('proposalresponses table created <br>') ;
 } 
 
 
 createuniversitiestable($connection); //works
 createuserstable($connection);        //works
 createbindertable($connection);       //works
 createuserbinderstable($connection);   //works
 createmessagestable($connection);      //works

 creatematchestable($connection);  //works
 createreportstable($connection);  //works
 createproposalstable($connection);  //works
 createproposalresponsestable($connection);  //works
 
?>
