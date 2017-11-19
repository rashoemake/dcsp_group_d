<?php

class Message {
    /* STATIC MEMBERS */

    // Static Variables
    public static $tablename = "messages";

    // Static Methods
    
    //returns an associative array of error messages
    public static function create_message($body, $user_id, $binder_id) {
        $error_list = array();
        
        //validate inputs
        try {
            $tmp = new Message($body, $user_id, $binder_id);
        } catch (Message_body_exception $ex) {
            $error_list['body_err'] = $ex->errorMessage();
            return $error_list;
        }
                
        //create DB connection
        require_once 'connect.php';
        
        if (!($stmt = $conn->prepare("INSERT INTO `$tablename` VALUES(?,?,?)"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        if (!($stmt->bind_param('sii', $body, $user_id, $binder_id))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        return $error_list;
    }

    public static function get_message_by_id($message_id) {
        //create DB connection
        require_once 'connect.php';
        
        if(!($stmt = $conn->prepare("SELECT * FROM `$tablename` WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        if (!($stmt->bind_param('i', $message_id))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        //only one row should be returned
        $row = $stmt->get_result()->fetch_assoc();
        $return_value = new Message($row['body'], $row['user_id'], $row['binder_id']);
        $return_value->match_row($row); //set other attributes        
        $stmt->close(); $conn->close();
        
        return $return_value;
    }
    
    public static function get_message_by_binder_id($binder_id) {
        //create DB connection
        require_once 'connect.php';
        
        if(!($stmt = $conn->prepare("SELECT * FROM `$tablename` WHERE binder_id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        if (!($stmt->bind_param('i', $binder_id))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        //multiple rows my be returned
        $return_value = array();
        $result = $stmt->get_result();
        
        //for each results row in the result object
        for ($j = 0; $j < $result->num_rows; $j++) {
            $result->data_seek($j);  //specify the results row
            $row = $result->fetch_assoc();  //get an associative array of the row
            $return_value[$j] = new Message($row['body'], $row['user_id'], $row['binder_id']);
            $return_value[$j]->match_row($row);
        }        
         $stmt->close(); $conn->close();
        
        return $return_value;
    }
    

    /* INSTANCE MEMBERS */

    // Instance Variables
    private $id;
    private $body;
    private $hidden;
    private $createdDate;
    private $user_id;
    private $binder_id;

    // Getters and Setters (Validation)
    public function get_id() {
        return $this->id;
    }
    
    private function set_id($id) {
        if (preg_match("/^\d+$/", $id)) {
            $this->id = $id;
        } else {
            die("id not of valid form");
        }
    }     

    public function get_body() {
        return $this->body;
    }

    private function set_body($body) {
        if (strlen($body) < 1) {
            throw new Message_body_exception();
        } else {
            $this->body = $body;
        }        
    }

    public function get_hidden() {
        return $this->hidden;
    }

    private function set_hidden($hidden) {
        if (preg_match("/^0|1|true|false|TRUE|FALSE$/", $hidden)) {
            $this->hidden = $hidden;
        } else {
            die("hidden is not of a valid boolean value");
        }
    }

    public function get_createdDate() {
        return $this->createdDate;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    private function set_user_id($user_id) {
        if (preg_match("/^\d+$/", $user_id)) {
            $this->user_id = $user_id;
        } else {
            die("user_id not of valid form");
        }
    }

    public function get_binder_id() {
        return $this->binder_id;
    }

    private function set_binder_id($binder_id) {
        if (preg_match("/^\d+$/", $binder_id)) {
            $this->binder_id = $binder_id;
        } else {
            die("binder_id not of valid form");
        }
    }       

    // Instance Methods
    public function __construct($body, $user_id, $binder_id) {
        $this->set_body($body);
        $this->set_user_id($user_id);
        $this->set_binder_id($binder_id);
    }
    
    //helper method to fill out all attributes at object creation
    public function match_row($row) {
        $this->id = $row['id'];
        $this->createdDate = $row['createdDate'];
        $this->hidden = $row['hidden'];
    }

    public function update_hide_message($hidden) {
        //validate hidden
        $this->set_hidden($hidden);
        
        /*
        //create DB connection
        require_once 'connect.php';
        
        if (!($stmt = $conn->prepare("UPDATE ? SET hidden=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        if (!($stmt->bind_param('ssi', self::$tablename, $hidden, $this->id))) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        
        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        $stmt->close(); $conn->close();
         * 
         */
    }
}

//custom exception for body validation errors
class Message_body_exception extends Exception {
    public function errorMessage() {
        $msg = "Message body must have at least one character";
        return $msg;
    }
}
?>