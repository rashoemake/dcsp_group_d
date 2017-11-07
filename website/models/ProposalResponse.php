<?php

class ProposalResponse {
	/* STATIC MEMBERS */
	
	// Static Variables
	public static $tablename = "proposalresponses";
	
	// Static Methods
	public static function create_response($user_id_reporter, $user_id_reported, $message) {
		//TODO
	}
	
	public static function get_response_by_id($proposal_id, $user_id) {
		//TODO
	}
	
	
	/* INSTANCE MEMBERS */
	
	// Instance Variables
	private $proposal_id;
    private $user_id;
    private $response;
    private $modifiedDate;
	
	// Constructor
	public function __construct($proposal_id, $user_id) {
		//calls setter methods for validation
	}
	
	// Getters and Setters
	public function get_proposal_id() {
		//TODO
	}
	
	private function set_proposal_id($proposal_id) {
		//TODO
	}
	
	public function get_user_id() {
		//TODO
	}
	
	private function set_user_id($user_id) {
		//TODO
	}
	
	public function get_response() {
		//TODO
	}
	
	private function set_response($response) {
		//TODO
	}
	
	public function get_modifiedDate() {
		//TODO
	}
	
	// Instance Methods
	public function update_response($response) {
		//TODO
	}	
}
?>