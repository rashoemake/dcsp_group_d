<?php

class Proposal {
    /* STATIC MEMBERS */

    // Static Variables
    public static $tablename = "proposals";

    // Static Methods
    public static function create_proposal($is_removal, $proposer_id, $proposed_id, $binder_id) {
        // TODO
    }

    public static function get_proposal_by_id($id) {
        // TODO
    }


    /* INSTANCE MEMBERS */

    // Instance Variables
    private $user1_id;
    private $user2_id;
    private $user1_approved;
    private $user2_approved;
    private $modifiedDate;

    // Getters and Setters (Validation)
    public function get_user1_id() {
        // TODO
    }

    private function set_user1_id($id) {
        // TODO
    }

    public function get_user2_id() {
        // TODO
    }

    private function set_user2_id($id) {
        // TODO
    }

    public function get_user1_approved() {
        // TODO
    }

    private function set_user1_approved($approved) {
        // TODO
    }

    public function get_user2_approved() {
        // TODO
    }

    private function set_user2_approved($approved) {
        // TODO
    }

    public function get_modified_date() {
        // TODO
    }


    // Instance Methods
    public function __construct($user1_id, $user2_id) {
        // TODO
    }

    public function update_user1_approved($approved) {
        // TODO
    }

    public function update_user2_approved($approved) {
        // TODO
    }

    public function get_responses() {
        // TODO
    }
}

?>