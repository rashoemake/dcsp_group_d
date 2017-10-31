<?php

class Reports {
	/* STATIC MEMBERS */
	
	//Staic Variables
	public static $tablename = "reports";
	
	//Static Methods
	public static function create_report($user_id_reporter, $user_id_reported, $message) {
		//implement
	}
	
	public static function get_reports_by_reported_id($reported_id) {
		//implement
	}
	
	public static function get_reports_by_disabled($disabled) {
		//implement
	}
	
	
	/* INSTANCE MEMBERS */
	
	//Instance Variables
	private $id;
	private $user_id_reported;
	private $user_id_reporter
	private $message;
	private $createdDate;
	private $disabled;
	
	//Constructor
	public function __construct($user_id_reporter, $user_id_reported, $message) {
		//calls setter methods for validation
	}
	
	//Getters and Setters
	public function get_id() {
		//implement
	}
	
	private function set_id($id) {
		//implement
	}
	
	public function get_user_id_reported() {
		//implement
	}
	
	private function set_user_id_reported ($user_id_reported) {
		//implemented
	}
	
	public function get_user_id_reporter() {
		//implement
	}
	
	private function set_user_id_reporter($user_id_reporter) {
		//implement
	}
	
	public function get_message() {
		//implement
	}
	
	private function set_message($message) {
		//implement
	}
	
	public function get_disabled() {
		//implement
	}
	
	private function set_disabled($disabled) {
		//implement
	}
	
	public function get_modifiedDate() {
		//implement
	}
	
	//Instance Methods
	public function update_disabled($disabled) {
		//implement
	}	
}
?>