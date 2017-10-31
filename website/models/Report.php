<?php

class Report {
	/* STATIC MEMBERS */
	
	// Static Variables
	public static $tablename = "reports";
	
	// Static Methods
	public static function create_report($user_id_reporter, $user_id_reported, $message) {
		//TODO
	}
	
	public static function get_reports_by_reported_id($reported_id) {
		//TODO
	}
	
	public static function get_reports_by_handled($handled) {
		//TODO
	}
	
	
	/* INSTANCE MEMBERS */
	
	// Instance Variables
	private $id;
	private $user_id_reported;
	private $user_id_reporter
	private $message;
	private $createdDate;
	private $handled;
	
	// Constructor
	public function __construct($user_id_reporter, $user_id_reported, $message) {
		//calls setter methods for validation
	}
	
	// Getters and Setters
	public function get_id() {
		//TODO
	}
	
	private function set_id($id) {
		//TODO
	}
	
	public function get_user_id_reported() {
		//TODO
	}
	
	private function set_user_id_reported ($user_id_reported) {
		//TODOed
	}
	
	public function get_user_id_reporter() {
		//TODO
	}
	
	private function set_user_id_reporter($user_id_reporter) {
		//TODO
	}
	
	public function get_message() {
		//TODO
	}
	
	private function set_message($message) {
		//TODO
	}
	
	public function get_handled() {
		//TODO
	}
	
	private function set_handled($handled) {
		//TODO
	}
	
	public function get_modifiedDate() {
		//TODO
	}
	
	// Instance Methods
	public function update_handled($handled) {
		//TODO
	}	
}
?>