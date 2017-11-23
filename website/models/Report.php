<?php

class Report {
	/* STATIC MEMBERS */
	
	// Static Methods
	public static function create_report($user_id_reporter, $user_id_reported, $message) {
		$new_report = new Report();
		$new_report->set_user_id_reporter($user_id_reporter);
		$new_report->set_user_id_reported($user_id_reported);
		$new_report->set_message($message);

        // Get the mysql connection
		require("connect.php");

        // Query for the ID
        if (!($stmt = $conn->prepare("INSERT INTO `reports` (user_id_reporter, user_id_reported, message) VALUES (?, ?, ?)"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("iid", $new_report->get_user_id_reporter(), $new_report->get_user_id_reported(), $new_user->get_message());

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        return $conn->insert_id;
	}
	
	public static function get_reports_by_reported_id($reported_id) {
		// Get the mysql connection
		require("connect.php");
		
		// Query for the ID
		if (!($stmt = $conn->prepare("SELECT * FROM `reports` WHERE user_reported_id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$stmt->bind_param("i", $id);

		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}

		$row = $stmt->get_result()->fetch_assoc();
		$return_value = Report::from_assoc($row);
		return $return_value;
	}
	
	public static function get_reports_by_handled($handled) {
		// Get the mysql connection
		require("connect.php");
		
		// Query for the ID
		if (!($stmt = $conn->prepare("SELECT * FROM `reports` WHERE handled=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$stmt->bind_param("i", intval($handled));

		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}

		$result = $stmt->get_result();
		

		$row = $stmt->get_result()->fetch_assoc();
		$return_value = Report::from_assoc($row);
		return $return_value;
	}
	
	
	/* INSTANCE MEMBERS */
	
	// Instance Variables
	private $id;
	private $user_id_reported;
	private $user_id_reporter
	private $message;
	private $createdDate;
	private $handled;
	
	// Getters and Setters
	public function get_id() {
		return $this->id;
	}
	
	private function set_id($id) {
		$this->id = $id;
	}
	
	public function get_user_id_reported() {
		return $this->user_id_reported;
	}
	
	private function set_user_id_reported($user_id_reported) {
		$this->user_id_reported = $user_id_reported;
	}
	
	public function get_user_id_reporter() {
		return $this->user_id_reporter;
	}
	
	private function set_user_id_reporter($user_id_reporter) {
		$this->user_id_reporter = $user_id_reporter;
	}
	
	public function get_message() {
		return $this->message;
	}
	
	private function set_message($message) {
		$this->message = $message;
	}
	
	public function get_handled() {
		return $this->handled;
	}
	
	private function set_handled($handled) {
		$this->handled = $handled;
	}
	
	public function get_createdDate() {
		return $this->createdDate;
	}

	private function set_createdDate($createdDate) {
		$this->createdDate = $createdDate;
	}

	// Instance Methods
    public function from_assoc($assoc) {
        if (isset($assoc["id"])) {
            $this->set_id($assoc["id"]);
        }

        if (isset($assoc["user_id_reported"])) {
            $this->set_user_id_reported($assoc["user_id_reported"]);
        }

        if (isset($assoc["user_id_reporter"])) {
            $this->set_user_id_reporter($assoc["user_id_reporter"]);
        }

        if (isset($assoc["message"])) {
            $this->set_message($assoc["message"]);
        }

        if (isset($assoc["createdDate"])) {
            $this->set_createdDate($assoc["createdDate"]);
        }

        if (isset($assoc["handled"])) {
            $this->set_handled($assoc["handled"]);
        }
    }
	
	// Instance Methods
	public function update_handled($handled) {
		$this->handled = $handled;
	}	
}
?>