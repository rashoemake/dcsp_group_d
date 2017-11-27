<?php

require_once(dirname(__DIR__)."/exception/validationexception.php");

class Binder {
    /* STATIC MEMBERS */

    // Static Variables
    public static $tablename = "binder";

    // Static Methods
    public static function get_binder_by_id($id) {
        // Create SQL connection
        require 'connect.php';
        
        // Query for the id
        if (!($stmt = $conn->prepare("SELECT * FROM `binder` WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $stmt->bind_param("i", $id);
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        $row = $stmt->get_result()->fetch_assoc();       
        $return_value = new Binder();
        $return_value->from_assoc($row);
        return $return_value;
    }

    public static function get_all_binder_id() {
        //Create SQL connection
        require 'connect.php';

        //Query for the id
        if (!($stmt = $conn->prepare("SELECT * FROM `binder`"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $return_value = array();
        $row = $stmt->get_result();
        
        for ($i = 0; $i < $row->num_rows; $i++) {
            $row->data_seek($i);
            $results = $row->fetch_assoc();
            $return_value[$i] = $results['id'];
        }
        return $return_value;
    }

    public static function create_binder($name) {
        $new_binder = new Binder();
        $new_binder->set_name($name);
        
        //Create SQL connection
        require 'connect.php';
        
        //Query to create binder
        if (!($stmt = $conn->prepare("INSERT INTO `binder`(name) VALUES (?)"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $stmt->bind_param('s',$new_binder->get_name());
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        echo isset($conn->error) ? $conn->error : "";
        
        return $conn->insert_id;
    }

    public static function get_recent_additions($user_id) {
        // Get the mysql connection
        require("connect.php");
        require("User.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("SELECT binder.* FROM `user_binders` INNER JOIN `binder` ON user_binders.binder_id = binder.id WHERE user_binders.user_id=? AND user_binders.modifiedDate >= DATE_SUB(NOW(), INTERVAL 1 DAY)"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("i", $user_id);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $result = $stmt->get_result();
        $return_value = array();
        if ($result->num_rows > 0) {
            foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
                $binder = new Binder();
                $binder->from_assoc($row);
                $return_value->array_push($binder);
            }
        }

        return $return_value
    }


    /* INSTANCE MEMBERS */

    // Instance Variables
    private $id;
    private $name;
    private $description;
    private $disabled;
    private $modifiedDate;

    // Getters and Setters (Validation)
    public function get_id() {
        return $this->id;
    }

    private function set_id($id) {
       if (preg_match("/^(\d+)$/", $id)) {
           $this->id = $id;
       } else {
           die("id not of valid form");
       }
    }

    public function get_name() {
        return $this->name;
    }

    private function set_name($name) {
        if (strlen($name) > 1 && (preg_match("/^([\w\d ]+)$/", $name))) {
            $this->name = $name;
        } else {
            throw new ValidationException("Name may contain only alphanumerics and spaces", "Name");
        }
    }

    public function get_description() {
        return $this->description;
    }

    private function set_description($description) {
        if (strlen($description) > 1) {
            $this->description = $description;
        } else {
            throw new ValidationException("Description must contain at least 1 character", "Description");
        }
    }

    public function get_disabled() {
        return $this->disabled;
    }

    private function set_disabled($disabled) {
        if (preg_match("/^0|1$/", $disabled)) {
            $this->disabled = $disabled;
        } else {
            die("disabled is not of a valid boolean value");
        }
    }

    public function get_modified_date() {
        return $this->modifiedDate;
    }


    // Instance Methods
    
    //Inserts user_id and binder_id tuple into user_binders table
    public function add_user($user_id) {
        require 'connect.php';
        
        /*needs to first check if the user is already in the database*/
        
        if (!($stmt = $conn->prepare("INSERT INTO `user_binders`(user_id, binder_id) VALUES(?,?)"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $stmt->bind_param('ii', $user_id, $this->get_id());
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        return $conn->insert_id;
    }
    
    //Remove user_id, binder_id tuple from user_binders table
    public function remove_user($user_id) {
        require 'connect.php';
        
        /*needs to first check if the user is already in the database*/
        
        if (!($stmt = $conn->prepare("DELETE FROM `user_binders` WHERE user_id=? AND binder_id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $stmt->bind_param('ii', $user_id, $this->get_id());
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        return $conn->insert_id;
    }

    public function update_description($description) {
        require 'connect.php';
        
        //validate first then execute update query
        $this->set_description($description);
        if (!($stmt = $conn->prepare("UPDATE `binder` SET bio=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $stmt->bind_param('si', $this->get_description(), $this->get_id());
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }

    public function update_disabled($disable) {
        require 'connect.php';
        
        //validate first then execute update query
        $this->set_disabled($disable);
        if (!($stmt = $conn->prepare("UPDATE `binder` SET disabled=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $stmt->bind_param('si', $this->get_disabled(), $this->get_id());
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }

    public function update_name($name) { 
        require 'connect.php';
        
        //validate first then execute update query
        $this->set_name($name);
        if (!($stmt = $conn->prepare("UPDATE `binder` SET name=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $stmt->bind_param('si', $this->get_name(), $this->get_id());
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }
    
    public function get_binder_membership() {
        require 'connect.php';
        
        if (!($stmt = $conn->prepare("SELECT `user_id` FROM `user_binders` WHERE binder_id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $stmt->bind_param('i', $this->get_id());
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $membership = array();
        $result_obj = $stmt->get_result();
        for ($i = 0; $i < $result_obj->num_rows; $i++) {
            $result_obj->data_seek($i);
            $result_row = $result_obj->fetch_assoc();
            $membership[$i] = $result_row['user_id'];
        }
        
        return $membership;
    }
    
    public function from_assoc($assoc) {
        if (isset($assoc['id'])) {
            $this->set_id($assoc['id']);
        }
        
        if (isset($assoc['name'])) {
            $this->set_name($assoc['name']);
        }
        
        if (isset($assoc['bio'])) {
            $this->set_description($assoc['bio']);
        }
        
        if (isset($assoc['disabled'])) {
            $this->set_disabled($assoc['disabled']);
        }
        
        if (isset($assoc['modifiedDate'])) {
            $this->modifiedDate = $assoc['modifiedDate'];
        }
    }
}

?>