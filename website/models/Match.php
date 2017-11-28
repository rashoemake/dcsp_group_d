<?php

class Match {
    /* STATIC MEMBERS */

    // Static Methods
    public static function create_match($user1_id, $user2_id) {
        $new_match = new Match();
        $new_match->set_user1_id($user1_id);
        $new_match->set_user2_id($user2_id);

        // Get the mysql connection
		require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("INSERT INTO `matches` (user1_id, user2_id) VALUES (?, ?)"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("ii", $user1_id, $user2_id);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        return $conn->insert_id;
    }

    public static function get_unanswered_match($user_id) {
        // Return any Users that have already matched $user_id
        // Get the mysql connection
        require("connect.php");
        require_once("User.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("SELECT matches.* FROM matches INNER JOIN users ON matches.user1_id = users.id WHERE matches.user2_id=? AND matches.user1_approve=1 AND matches.user2_approve IS NULL LIMIT 1"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("i", $user_id);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $return_value = new Match();
            $return_value->from_assoc($result->fetch_assoc());
            return $return_value;
        }
    }

    public static function suggest_user($user_id) {
        require("connect.php");
        require("User.php");

        $query = "SELECT *
                  FROM `users`
                  WHERE university_id IN (
                      SELECT university_id
                      FROM `users`
                      WHERE id=?)
                  AND id NOT IN (
                      SELECT user1_id 
                      FROM `matches` 
                      WHERE user1_id=? OR user2_id=? 
  
                      UNION 
                      
                      SELECT user2_id 
                      FROM `matches` 
                      WHERE user1_id=? OR user2_id=?) 
                  LIMIT 1";


        // Returns a random user from the same University as $user_id
        if (!($stmt = $conn->prepare($query))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("iiii", $user_id, $user_id, $user_id, $user_id);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $return_value = new User();
            $return_value->from_assoc($result->fetch_assoc());
            return $return_value;
        }

        return NULL;
    }


    /* INSTANCE MEMBERS */

    // Instance Variables
    private $user1_id;
    private $user2_id;
    private $user1_approved;
    private $user2_approved;
    private $modifiedDate;

    // Getters and Setters (Validation)
    public function get_id() {
        return $this->id;
    }

    private function set_id($id) {
        $this->id = $id;
    }

    public function get_user1_id() {
        return $this->user1_id;
    }

    private function set_user1_id($id) {
        $this->user1_id = $id;
    }

    public function get_user2_id() {
        return $this->user2_id;
    }

    private function set_user2_id($id) {
        $this->user2_id = $id;
    }

    public function get_user1_approved() {
        return $this->user1_approved;
    }

    private function set_user1_approved($approved) {
        $this->user1_approved = $approved;
    }

    public function get_user2_approved() {
        return $this->user2_approved;
    }

    private function set_user2_approved($approved) {
        $this->user2_approved = $approved;
    }

    public function get_modified_date() {
        return $this->modifiedDate;
    }


    // Instance Methods
    public function from_assoc($assoc) {
        if (isset($assoc["id"])) {
            $this->set_id($assoc["id"]);
        }

        if (isset($assoc["user1_id"])) {
            $this->set_user1_id($assoc["user1_id"]);
        }
        
        if (isset($assoc["user2_id"])) {
            $this->set_user2_id($assoc["user2_id"]);
        }

        if (isset($assoc["user1_approved"])) {
            $this->set_user1_approved($assoc["user1_approve"]);
        }

        if (isset($assoc["user2_approved"])) {
            $this->set_user2_approved($assoc["user2_approve"]);
        }

        if (isset($assoc["modifiedDate"])) {
            $this->set_modified_date($assoc["modifiedDate"]);
        }
    }


    public function update_user1_approved($approved) {
        // Get the mysql connection
        require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("UPDATE `matches` SET user1_approve=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $id = $this->get_id();
        $stmt->bind_param("ii", intval($approved), $id);

        // Runs validation
        $this->set_user1_approved($approved);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }

    public function update_user2_approved($approved) {
        // Get the mysql connection
        require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("UPDATE `matches` SET user2_approve=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $id = $this->get_id();
        $stmt->bind_param("ii", intval($approved), $id);

        // Runs validation
        $this->set_user2_approved($approved);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }
}

?>