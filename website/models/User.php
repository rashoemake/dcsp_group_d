<?php

class User {
    /* STATIC MEMBERS */

    // Static Variables
    public static $tablename = "users";

    // Static Methods
    public static function get_user_by_id($id) {
        // Get the mysql connection
		require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("SELECT * FROM `$tablename` WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }

        if (!($stmt->bind_param("i", $id))) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $row = $stmt->get_result()->fetch_assoc();
        $return_value = User::from_assoc($row);
        return $return_value;
    }

    public static function get_user_by_email($email) {
        // Get the mysql connection
		require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("SELECT * FROM `$tablename` WHERE emailAddress=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }

        if (!($stmt->bind_param("s", $email))) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $row = $stmt->get_result()->fetch_assoc();
        $return_value = User::from_assoc($row);
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
        if (!($stmt = $conn->prepare("INSERT INTO `$tablename` (emailAddress, name, passwordHash) VALUES (?, ?, ?)"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }

        if (!($stmt->bind_param("sss", $new_user->get_email_address(), $new_user->get_name(), $new_user->get_password_hash()))) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $return $conn->insert_id;
    }

    public static function from_assoc($assoc) {
        if (isset($assoc["id"])) {
            $id = $assoc["id"];
        }

        if (isset($assoc["name"])) {
            $name = $assoc["name"];
        }

        if (isset($assoc["emailAddress"])) {
            $email_address = $assoc["emailAddress"];
        }

        if (isset($assoc["passwordSalt"])) {
            $password_salt = $assoc["passwordSalt"];
        }

        if (isset($assoc["passwordHash"])) {
            $password_hash = $assoc["passwordHash"];
        }

        if (isset($assoc["avgRating"])) {
            $avg_rating = $assoc["avgRating"];
        }

        if (isset($assoc["numRatings"])) {
            $num_ratings = $assoc["numRatings"];
        }

        if (isset($assoc["bio"])) {
            $biography = $assoc["bio"];
        }

        if (isset($assoc["disabled"])) {
            $disabled = $assoc["disabled"];
        }

        if (isset($assoc["modifiedDate"])) {
            $modifiedDate = $assoc["modifiedDate"];
        }

        if (isset($assoc["university_id"])) {
            $university_id = $assoc["university_id"];
        }
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
    public function get_id() {
        return $this->id;
    }

    private function set_id($id) {
        $this->id = $id;
    }

    public function get_name() {
        return $this->name;
    }

    private function set_name($name) {
        $this->name = $name;
    }

    public function get_email_address() {
        return $this->email_address;
    }

    private function set_email_address($email_address) {
        $this->email_address = $email_address;
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
        $this->biography = $biography;
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


    // Instance Methods
    public function add_rating() {
        // TODO
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

    public function update_biography() {
        // TODO
    }

    public function update_disabled() {
        // TODO
    }

    public function update_email() {
        // TODO
    }

    public function update_name() {
        // TODO
    }

    public function update_password() {
        // TODO
    }

    public function update_university_id() {
        // TODO
    }
}

?>