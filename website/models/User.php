<?php

class User {
    /* STATIC MEMBERS */

    // Static Variables
    public static $tablename = "users";

    // Static Methods
    public static function get_user_by_id(id) {
        // TODO
    }

    public static function get_user_by_email(email) {
        // TODO
    }

    public static function create_user(email, password, name) {
        // TODO
    }


    /* INSTANCE MEMBERS */
    
    // Instance Variables
    private $id;
    private $name;
    private $email_address;
    private $password_salt;
    private $password_hash;
    private $avg_rating;
    private $num_ratings;
    private $biography;
    private $disabled;
    private $modifiedDate;

    // Getters and Setters (Validation)
    public function get_id() {
        // TODO
    }

    private function set_id() {
        // TODO
    }

    public function get_name() {
        // TODO
    }

    private function set_name() {
        // TODO
    }

    public function get_email_address() {
        // TODO
    }

    private function set_email_address() {
        // TODO
    }

    public function get_password_salt() {
        // TODO
    }

    private function set_password_salt() {
        // TODO
    }

    public function get_password_hash() {
        // TODO
    }

    private function set_password_hash() {
        // TODO
    }

    public function get_avg_rating() {
        // TODO
    }

    private function set_avg_rating() {
        // TODO
    }

    public function get_num_ratings() {
        // TODO
    }

    private function set_num_ratings() {
        // TODO
    }

    public function get_biography() {
        // TODO
    }

    private function set_biography() {
        // TODO
    }

    public function get_disabled() {
        // TODO
    }

    private function set_disabled() {
        // TODO
    }

    public function get_modified_date() {
        // TODO
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