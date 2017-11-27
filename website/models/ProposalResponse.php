<?php

class ProposalResponse {
	/* STATIC MEMBERS */
	
	// Static Methods
	public static function create_response($proposal_id, $user_id, $response) {
		$new_response = new Response();
		$new_response->set_proposal_id($proposal_id);
		$new_response->set_user_id($user_id);
		$new_response->set_response($response);

        // Get the mysql connection
		require("connect.php");
        
        // Query for the ID
        if (!($stmt = $conn->prepare("INSERT INTO `proposal_responses` (proposal_id, user_id, response) VALUES (?, ?, ?)"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("iii", $new_response->get_proposal_id(), $new_response->get_user_id(), intval($new_response->get_response()));

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        return $conn->insert_id;
	}
	
	public static function get_response_by_id($id) {
		// Get the mysql connection
		require("connect.php");
		
		// Query for the ID
		if (!($stmt = $conn->prepare("SELECT * FROM `proposal_responses` WHERE id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$stmt->bind_param("i", $id);

		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}

		$row = $stmt->get_result()->fetch_assoc();
		$return_value = new ProposalResponse();
		$return_value->from_assoc($row);
		return $return_value;
	}
	
	
	/* INSTANCE MEMBERS */
	
	// Instance Variables
	private $id;
	private $proposal_id;
    private $user_id;
    private $response;
    private $modifiedDate;
	
	public function from_assoc($assoc) {
		if (isset($assoc["id"])) {
            $this->set_id($assoc["id"]);
        }

        if (isset($assoc["proposal_id"])) {
            $this->set_proposal_id($assoc["proposal_id"]);
        }

        if (isset($assoc["user_id"])) {
            $this->set_user_id($assoc["user_id"]);
        }

        if (isset($assoc["response"])) {
            $this->set_response($assoc["response"]);
        }

        if (isset($assoc["modifiedDate"])) {
            $this->set_modifiedDate($assoc["modifiedDate"]);
        }
	}
	
	// Getters and Setters
	public function get_id() {
		return $this->id;
	}
	
	private function set_id($id) {
		$this->id = $id;
	}

	public function get_proposal_id() {
		return $this->proposal_id;
	}
	
	private function set_proposal_id($proposal_id) {
		$this->proposal_id = $proposal_id;
	}
	
	public function get_user_id() {
		return $this->user_id;
	}
	
	private function set_user_id($user_id) {
		$this->user_id = $user_id;
	}
	
	public function get_response() {
		return $this->response;
	}
	
	private function set_response($response) {
		$this->response = $response;
	}
	
	public function get_modifiedDate() {
		return $this->modifiedDate;
	}

	private function set_modifiedDate($modifiedDate) {
		$this->modifiedDate = $modifiedDate;
	}
	
	// Instance Methods
	public function update_response($response) {
		// Get the mysql connection
        require("connect.php");
		
		// Query for the ID
		if (!($stmt = $conn->prepare("UPDATE `proposal_responses` SET response=? WHERE id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$id = $this->get_id();
		$stmt->bind_param("ii", intval($response), $id);

		// Runs validation
		$this->set_response($response);

		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}
	}	
}
?>