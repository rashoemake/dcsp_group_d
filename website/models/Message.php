<?php

class Message {
    /* STATIC MEMBERS */

    // Static Variables
    public static $tablename = "messages";

    // Static Methods
    public static function create_message($body, $user_id, $binder_id) {
        // TODO
    }

    public static function get_message_by_id($message_id) {
        // TODO
    }

    /* INSTANCE MEMBERS */

    // Instance Variables
    private $id;
    private $body;
    private $hidden;
    private $modifiedDate;
    private $user_id;
    private $binder_id;

    // Getters and Setters (Validation)
    public function get_id() {
        // TODO
    }

    private function set_id($id) {
        // TODO
    }

    public function get_body() {
        // TODO
    }

    private function set_body($body) {
        // TODO
    }

    public function get_hidden() {
        // TODO
    }

    private function set_hidden($hidden) {
        // TODO
    }

    public function get_modifiedDate() {
        // TODO
    }

    public function get_user_id() {
        // TODO
    }

    private function set_user_id($user_id) {
        // TODO
    }

    public function get_binder_id() {
        // TODO
    }

    private function set_binder_id($binder_id) {
        // TODO
    }


    // Instance Methods
    public function __construct($body, $user_id, $binder_id) {
        // TODO
    }

    public function update_hide_message($hidden) {
        // TODO
    }
}

?>