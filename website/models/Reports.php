<?php

class Reports {
	/* STATIC MEMBERS */
	
	//Staic Variables
	public static $tablename = "reports";
	
	//Static Methods
	public static function get_reports_by_id($id) {
		//implement
	}
	
	//(return an array of reports objects?)
	public static function get_reports_by_disabled() {
		//implement
	}
	
	public static function create_report($user_id_reporter, $user_id_reported, $message) {
		//implement
	}
	
	/* INSTANCE MEMBERS */
	
	//Instance Variables
	private $id;
	private $user_id_reported;
	private $user_id_reporter;
	private $message;
	private $createdDate;
	private $disabled;
	
	//Constructor
	public function __construct($user_id_reporter, $user_id_reported, $message) {
		//call database
		//insert the above parameters into the dabase
		//set disabled=0
		//return instance variables from database and set them
	}
	
	//Getters and Setters
	public function get_id() {
		//implement
	}
	
	private function set_id() {
		//implement
	}
	
	public function get_user_id_reported() {
		//implement
	}
	
	private function set_user_id_reported () {
		//implemented
	}
	
	public function get_user_id_reporter() {
		//implement
	}
	
	private function set_user_id_reporter() {
		//implement
	}
	
	public function get_message() {
		//implement
	}
	
	private function set_message() {
		//implement
	}
	
	public function get_disabled() {
		//implement
	}
	
	private function set_disabled() {
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