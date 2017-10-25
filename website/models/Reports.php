<?php

class Reports {
	/* STATIC MEMBERS */
	
	//Staic Variables
	public static $tablename = "reports";
	
	//Static Methods
	public static get_report_by_id($id) {
		//implement
	}
	
	//(return an array of reports objects?)
	public static get_reports_by_reporter($user_id_reporter) {
		//implement
	}
	
	//(return an array of reports objects?)
	public static get_reports_by_reported($user_id_reported) {
		//implement
	}
	
	public static create_report($user_id_reporter, $user_id_reported, $message) {
		//implement
	}
	
	/* INSTANCE MEMBERS */
	
	//Instance Variables
	private $id;
	private $user_id_reported;
	private $user_id_reporter;
	private $message;
	private $modifiedDate;
	private $disabled;
	
	//Getters and Setters
	public get_id() {
		//implement
	}
	
	private set_id() {
		//implement
	}
	
	public get_user_id_reported() {
		//implement
	}
	
	private set_user_id_reported () {
		//implemented
	}
	
	public get_user_id_reporter() {
		//implement
	}
	
	private set_user_id_reporter() {
		//implement
	}
	
	public get_message() {
		//implement
	}
	
	private set_message() {
		//implement
	}
	
	public get_disabled() {
		//implement
	}
	
	private set_disabled() {
		//implement
	}
	
	public get_modifiedDate() {
		//implement
	}
	
	//Instance Methods
	public update_disabled($disabled) {
		//implement
	}	
}
?>