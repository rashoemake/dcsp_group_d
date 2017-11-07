<?php

class Binder {
    /* STATIC MEMBERS */

    // Static Variables
    public static $tablename = "binders";

    // Static Methods
    public static function get_binder_by_id($id) {
        // TODO
    }

    public static function create_binder($name) {
        // TODO
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
        // TODO
    }

    private function set_id($id) {
        // TODO
    }

    public function get_name() {
        // TODO
    }

    private set_name($name) {
        // TODO
    }

    public function get_description() {
        // TODO
    }

    private function set_description($description) {
        // TODO
    }

    public function get_disabled() {
        // TODO
    }

    private function set_disabled($disabled) {
        // TODO
    }

    public function get_modified_date() {
        // TODO
    }


    // Instance Methods
    public function add_user($user_id) {
        // TODO
    }

    public function remove_user($user_id) {
        // TODO
    }

    public function update_description($description) {
        // TODO
    }

    public function update_disabled($disable) {
        // TODO
    }

    public function update_name($name) { 
        // TODO
    }
}

?>