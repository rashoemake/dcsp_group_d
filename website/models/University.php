
<?php
class University {
	/* STATIC MEMBERS */
	
	// Static Variables
	public static $tablename = "universities";
	
	// Static Methods
	public static function create_university($name, $city, $state) {
		//TODO
	}
	
	public static function get_university_by_city($city) {
		//TODO
	}
	
	public static function get_university_by_name($name) {
		//TODO
    }
    
    public static function get_university_by_state($state) {
		//TODO
	}
	
	
	/* INSTANCE MEMBERS */
	
    // Instance Variables
    private $id
	private $name;
	private $city;
	private $state;
	private $modifiedDate;
	
	// Constructor
	public function __construct($name, $city, $state) {
		//calls setter methods for validation
	}
	
	// Getters and Setters
	public function get_id() {
		//TODO
	}
	
	private function set_id($id) {
		//TODO
	}
	
	public function get_name() {
		//TODO
	}
	
	private function set_name($name) {
		//TODOed
	}
	
	public function get_city() {
		//TODO
	}
	
	private function set_city($city) {
		//TODO
	}
	
	public function get_state() {
		//TODO
	}
	
	private function set_state($state) {
		//TODO
	}
	
	public function get_modifiedDate() {
		//TODO
	}
	
	// Instance Methods
	public function update_name($name) {
		//TODO
    }	
    
    public function update_state($state) {
		//TODO
    }	
    
    public function update_city($city) {
		//TODO
	}	
}
?>