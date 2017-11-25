<?php

require(dirname(__DIR__)."/exception/validationexception.php");

class User {
    /* STATIC MEMBERS */

    // Static Methods
    public static function get_user_by_id($id) {
        // Get the mysql connection
		require("connect.php");

        // Query for the ID
        if (!($stmt = $conn->prepare("SELECT * FROM `users` WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("i", $id);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $row = $stmt->get_result()->fetch_assoc();
        $return_value = new User();
        $return_value->from_assoc($row);
        return $return_value;
    }

    public static function get_user_by_email($email) {
        // Get the mysql connection
		require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("SELECT * FROM `users` WHERE emailAddress=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("s", $email);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $row = $stmt->get_result()->fetch_assoc();
        $return_value = new User();
        $return_value->from_assoc($row);
        return $return_value;
    }

    public static function create_user($email, $password, $name) {
        $new_user = new User();
        $new_user->set_email_address($email);
        $new_user->set_name($name);

        $new_user->set_password_hash(password_hash($password, PASSWORD_BCRYPT));

        // Get the mysql connection
		require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("INSERT INTO `users` (emailAddress, name, passwordHash) VALUES (?, ?, ?)"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("sss", $new_user->get_email_address(), $new_user->get_name(), $new_user->get_password_hash());

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        return $conn->insert_id;
    }


    /* INSTANCE MEMBERS */
    
    // Instance Variables
    private $id;
    private $name;
    private $email_address;
    private $password_hash;
    private $avg_rating;
    private $num_ratings;
    private $biography;
    private $disabled;
    private $modifiedDate;
    private $university_id;

    // Getters and Setters (Validation)
    // TODO: VALIDATION
    public function get_id() {  
        return $this->id;
    }

    private function set_id($id) {
        if (is_numeric($id)) {
            $this->id = $id;
        } else {
            throw new ValidationException("INVALID", "id");
        }
    }

    public function get_name() {
        return $this->name;
    }

    private function set_name($name) {
        if (strlen($name) > 1 && preg_match("/^([a-zA-Z ]+)$/", $name)) {
            $this->name = $name;
        } else {
            throw new ValidationException("INVALID", "name");
        }
    }

    public function get_email_address() {
        return $this->email_address;
    }

    private function set_email_address($email_address) {
        if (strlen($email_address) > 1 && filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            $this->email_address = $email_address;
        } else {
            throw new ValidationException("INVALID", "email_address");
        }       
    }

    public function get_password_hash() {
        return $this->password_hash;
    }

    private function set_password_hash($password_hash) {
        $this->password_hash = $password_hash;
    }

    public function get_avg_rating() {
        return $this->avg_rating;
    }

    private function set_avg_rating($avg_rating) {
        $this->avg_rating = $avg_rating;
    }

    public function get_num_ratings() {
        return $this->num_ratings;
    }

    private function set_num_ratings($num_ratings) {
        $this->num_ratings = $num_ratings;
    }

    public function get_biography() {
        return $this->biography;
    }

    private function set_biography($biography) {
        if (strlen($biography) > 1) {
            $this->biography = $biography;
        } else {
            throw new ValidationException("INVALID", "biography");
        }
    }

    public function get_disabled() {
        return $this->disabled;
    }

    private function set_disabled($disabled) {
        $this->disabled = $disabled;
    }

    public function get_university_id() {
        return $this->university_id;
    }

    private function set_university_id($university_id) {
        $this->university_id = $university_id;
    }

    public function get_modified_date() {
        return $this->modifiedDate;
    }

    private function set_modified_date($modifiedDate) {
        $this->modifiedDate = $modifiedDate;
    }


    // Instance Methods
    public function from_assoc($assoc) {
        if (isset($assoc["id"])) {
            $this->set_id($assoc["id"]);
        }

        if (isset($assoc["name"])) {
            $this->set_name($assoc["name"]);
        }

        if (isset($assoc["emailAddress"])) {
            $this->set_email_address($assoc["emailAddress"]);
        }

        if (isset($assoc["passwordHash"])) {
            $this->set_password_hash($assoc["passwordHash"]);
        }

        if (isset($assoc["avgRating"])) {
            $this->set_avg_rating($assoc["avgRating"]);
        }

        if (isset($assoc["numRatings"])) {
            $this->set_num_ratings($assoc["numRatings"]);
        }

        if (isset($assoc["bio"])) {
            $this->set_biography($assoc["bio"]);
        }

        if (isset($assoc["disabled"])) {
            $this->set_disabled($assoc["disabled"]);
        }

        if (isset($assoc["modifiedDate"])) {
            $this->set_modified_date($assoc["modifiedDate"]);
        }

        if (isset($assoc["university_id"])) {
            $this->set_university_id($assoc["university_id"]);
        }
    }
    
    public function add_rating($rating) {
        // Get the mysql connection
        require("connect.php");

        if ($rating < 1 | $rating > 5) {
            throw new ValidationException("INVALID", "rating");
        }
        
        $avg_rating = $this->get_avg_rating();
        $num_ratings = $this->get_num_ratings();
        $new_num_ratings = $num_ratings + 1;
        $new_avg_rating = ($avg_rating * ($num_ratings / $new_num_ratings)) + ($rating * (1 / $new_num_ratings));
        
        // Query for the ID
        if (!($stmt = $conn->prepare("UPDATE `users` SET avgRating=?, numRatings=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $id = $this->get_id();
        $stmt->bind_param("iii", $new_avg_rating, $new_num_ratings, $id);

        // Runs validation
        $this->set_avg_rating($new_avg_rating);
        $this->set_num_ratings($new_num_ratings);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        return $this->get_avg_rating();
    }

    public function get_binders() {
        // TODO
    }

    public function get_matches() {
        // TODO
    }

    public function get_proposals() {
        // TODO
    }

    public function get_university() {
        // TODO
    }

    public function update_biography($biography) {
        // Get the mysql connection
        require("connect.php");

        // Query for the ID
        if (!($stmt = $conn->prepare("UPDATE `users` SET bio=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $id = $this->get_id();
        $stmt->bind_param("si", $biography, $id);

        // Runs validation
        $this->set_biography($biography);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }

    public function update_disabled($disabled) {
        // Get the mysql connection
        require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("UPDATE `users` SET disabled=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $id = $this->get_id();
        $stmt->bind_param("bi", $disabled, $id);

        // Runs validation
        $this->set_disabled($disabled);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }

    public function update_email_address($email_address) {
        // Get the mysql connection
        require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("UPDATE `users` SET emailAddress=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $id = $this->get_id();
        $stmt->bind_param("si", $email_address, $id);

        // Runs validation
        $this->set_email_address($email_address);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }

    public function update_name($name) {
        // Get the mysql connection
        require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("UPDATE `users` SET name=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $id = $this->get_id();
        $stmt->bind_param("si", $name, $id);

        // Runs validation
        $this->set_name($name);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }

    public function update_password($password) {
        // Get the mysql connection
        require("connect.php");

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        
        // Query for the ID
        if (!($stmt = $conn->prepare("UPDATE `users` SET passwordHash=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $id = $this->get_id();
        $stmt->bind_param("si", $passwordHash, $id);

        // Runs validation
        $this->set_password_hash($passwordHash);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }

    public function update_university_id($university_id) {
        // Get the mysql connection
        require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("UPDATE `users` SET university_id=? WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $id = $this->get_id();
        $stmt->bind_param("ii", $university_id, $id);

        // Runs validation
        $this->set_university_id($university_id);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }
}

?>