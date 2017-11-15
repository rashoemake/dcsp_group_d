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

	public static function get_university_by_id($id) {
		// Get the mysql connection
		require("connect.php");

		// Query for the ID
		if (!($stmt = $conn->prepare("SELECT * FROM `universities` WHERE id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}

		if (!($stmt->bind_param("i", $id)) {
			header('HTTP/1.1 500 Internal Server Error');
		}

		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}

		$row = $stmt->get_result()->fetch_assoc();
		$return_value = new University($row["name"], $row["city"], $row["state"]);
		$return_value.match_row($row);
		return $return_value;
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

	// Database Helper
	public function match_row($row) {
		// Updates the current object to match an associative row from the database
		$this->id = $row["id"];
		$this->name = $row["name"];
		$this->city = $row["city"];
		$this->state = $row["state"];
		$this->modifiedDate = $row["modifiedDate"];
	}
	
	// Getters and Setters
	public function get_id() {
		return $this->id;
	}
	
	private function set_id($id) {
		$this->id = $id;
	}
	
	public function get_name() {
		return $this->name;
	}
	
	private function set_name($name) {
		$this->name = $name;
	}
	
	public function get_city() {
		return $this->city;
	}
	
	private function set_city($city) {
		$this->city = $city;
	}
	
	public function get_state() {
		return $this->state;
	}
	
	private function set_state($state) {
		$this->state = $state;	}
	
	public function get_modifiedDate() {
		return $this->modifiedDate;
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