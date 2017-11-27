
<?php

require_once(dirname(__DIR__)."/exception/validationexception.php");

class University {
	/* STATIC MEMBERS */
	
	// Static Variables
	public static $tablename = "universities";
	
	// Static Methods

	public static function get_university_by_city($city) {
		//TODO
		require("connect.php");

        // Query for the City
        if (!($stmt = $conn->prepare("SELECT * FROM `universities` WHERE id=?"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("s", $city);

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $row = $stmt->get_result()->fetch_assoc();
        $return_value = University::from_assoc($row);
        return $return_value;
	}
	
	public static function get_university_by_name($name) {
		//TODO
		require("connect.php");
		
		// Query for the City
		if (!($stmt = $conn->prepare("SELECT * FROM `universities` WHERE id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$stmt->bind_param("s", $name);

		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}

		$row = $stmt->get_result()->fetch_assoc();
		$return_value = University::from_assoc($row);
		return $return_value;
    }
    
    public static function get_university_by_state($state) {
		//TODO
		require("connect.php");
		
		// Query for the City
		if (!($stmt = $conn->prepare("SELECT * FROM `universities` WHERE id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$stmt->bind_param("s", $state);

		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}
	
		$row = $stmt->get_result()->fetch_assoc();
		$return_value = University::from_assoc($row);
		return $return_value;
	}
	
  	public static function create_university($name, $city, $state) {
		//TODO
		//create object
		$new_university = new $University;
		$new_university->set_name($name);
		$new_university->set_city($city);
		$new_university->set_state($state);
		
		//get sql connection
		require("connect.php");

		//Query for creating new row in university table
		$stmt->bind_param("sss", $new_university->get_name(), $new_university->get_city(), $new_university->get_state());

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        return $conn->insert_id; 
	}
	
	
	/* INSTANCE MEMBERS */
	
    // Instance Variables
    private $id;
	private $name;
	private $city;
	private $state;
	private $modifiedDate;
	
	// Constructor
	public function __construct($name, $city, $state) {
		//calls setter methods for validation
	}
	
	// Getters and Setters
	// TODO Validation: 
	public function get_id() {
		return($this->id);
	}
	
	private function set_id($id) {
		$this->id = $id;
	}
	
	public function get_name() {
		return($this->name);
	}
	
	private function set_name($name) {
		$this->name = $name;
	}
	
	public function get_city() {
		return($this->city);
	}
	
	private function set_city($city) {
		$this->city = $city;
	}
	
	public function get_state() {
		return($this->state);
	}
	
	private function set_state($state) {
		$this->state = $state;
	}
	
	public function get_modifiedDate() {
		return($this->modifiedDate);
	}
	
	// Instance Methods
	public function update_name($name) {
        // Get the mysql connection
        require("connect.php");
		
		// Query using id to set name
		if (!($stmt = $conn->prepare("UPDATE `universities` SET name=? WHERE id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$id = $this->get_id();
		$stmt->bind_param("si", $name, $id);

		// Runs validation
		$this->set_name($name);
		
		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}
    }	
    
    public function update_state($state) {
        // Get the mysql connection
        require("connect.php");
		
		// Query using id to set state
		if (!($stmt = $conn->prepare("UPDATE `universities` SET state=? WHERE id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$id = $this->get_id();
		$stmt->bind_param("si", $state, $id);

		// Runs validation
		$this->set_name($name);
		
		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}
    }	
    
    public function update_city($city) {
		// Get the mysql connection
		require("connect.php");
		
		// Query using id to set name
		if (!($stmt = $conn->prepare("UPDATE `universities` SET city=? WHERE id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$id = $this->get_id();
		$stmt->bind_param("si", $city, $id);

		// Runs validation
		$this->set_name($name);
		
		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}
	}
	
	public function from_assoc($assoc) {
        if (isset($assoc["id"])) {
            $this->set_id($assoc["id"]);
        }

        if (isset($assoc["name"])) {
            $this->set_name($assoc["name"]);
        }

        if (isset($assoc["city"])) {
            $this->set_city($assoc["city"]);
        }

        if (isset($assoc["state"])) {
            $this->set_state($assoc["state"]);
        }

        if (isset($assoc["modifiedDate"])) {
            $this->set_modified_date($assoc["modifiedDate"]);
		}
	}

}
?>