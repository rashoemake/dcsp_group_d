<?php

class Proposal {
    /* STATIC MEMBERS */

    // Static Variables
    //public static $tablename = "proposals";

    // Static Methods
    public static function create_proposal($is_removal, $proposer_id, $proposed_id, $binder_id) {
        // TODO
        $new_proposal = new Proposal;
        $new_proposal->set_is_removal($is_removal);
        $new_proposal->set_proposer_id($proposer_id);
        $new_proposal->set_proposed_id($proposed_id);
        $new_proposal->set_binder_id($binder_id);

        //Get mysql connection
        require("connect.php");

        //
        if (!($stmt = $conn->prepare("INSERT INTO `proposals` (is_removal, proposer_id, proposed_id, binder_id, reason) VALUES (?, ?, ?, ?, ?)"))) {
            header('HTTP/1.1 500 Internal Server Error');	
        }
        $stmt->bind_param("iiiis", intval($new_proposal->get_is_removal()), $new_proposal->get_proposer_id(), $new_user->get_proposed_id(), $new_user->get_reason());

        if (!($stmt->execute())) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        return $conn->insert_id;
    }

    public static function get_proposal_by_id($id) {
        // TODO
        		// Get the mysql connection
		require("connect.php");
		
		// Query for the ID
		if (!($stmt = $conn->prepare("SELECT * FROM `proposals` WHERE id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$stmt->bind_param("i", $id);

		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}

		$row = $stmt->get_result()->fetch_assoc();
		$return_value = Proposal::from_assoc($row);
		return $return_value;
    }

    public static function get_proposal_by_binder($id) {
        // TODO
        		// Get the mysql connection
		require("connect.php");
		
		// Query for the ID
		if (!($stmt = $conn->prepare("SELECT * FROM `proposals` WHERE binder_id=?"))) {
			header('HTTP/1.1 500 Internal Server Error');	
		}
		$stmt->bind_param("i", $id);

		if (!($stmt->execute())) {
			header('HTTP/1.1 500 Internal Server Error');
		}

		$row = $stmt->get_result()->fetch_assoc();
		$return_value = Proposal::from_assoc($row);
		return $return_value;
    }


    /* INSTANCE MEMBERS */

    // Instance Variables
    private $id;
    private $reason
    private $proposer_id;
    private $proposed_id;
    private $binder_id;
    private $is_removal;
    private $modifiedDate;

    // Getters and Setters (Validation)
    public function get_reason(){
        return($this->reason);
    }

    public function set_reason($reason){
        if (is_string($reason)){
            $this->reason = $reason;
        }
        else {
            throw new ValidationException("INVALID", "reason");
        }
    }

    public function get_proposer_id() {
        // TODO
        return($this->proposer_id)
    }

    private function set_proposer_id($id) {
        // TODO
        
        if (is_numeric($id)) {
            $this->id = $id;
        } else {
            throw new ValidationException("INVALID", "proposer_id");
        }

    
    }

    public function get_proposed_id() {
        // TODO
        return($this->proposed_id);
    }

    private function set_proposed_id($id) {
        // TODO
        if (is_numeric($id)) {
            $this->proposed_id = $id;
        } else {
            throw new ValidationException("INVALID", "proposed_id");
        }
    }

    public function get_binder_id() {
        // TODO
        return($this->binder_id);
    }

    private function set_binder_id($id) {
        // TODO
        if (is_numeric($id)) {
            $this->binder_id = $id;
        } else {
            throw new ValidationException("INVALID", "binder_id");
        }
    }

    public function get_id() {
        // TODO
        return($this->id);
    }

    private function set_id($id) {
        // TODO
        if (is_numeric($id)) {
            $this->id = $id;
        } else {
            throw new ValidationException("INVALID", "id");
        }
    }

    public function get_modified_date() {
        // TODO
        return($this->modified_date);
    }

    public function get_is_removal(){
        return($this->is_removal);
    }

    public function set_is_removal($is_removal){
        if (is_bool($is_removal)){
            $this->id = $id;
        } else {
            throw new ValidationException("INVALID", "is_removal");
        }
    }
    // Instance Methods
    public function __construct($proposer_id, $proposed_id) {
        // TODO

    }

    public function get_responses() {
        // TODO
    }

    public function from_assoc($assoc) {
        if (isset($assoc["id"])) {
            $this->set_id($assoc["id"]);
        }

        if (isset($assoc["proposer_id"])) {
            $this->set_proposer_id($assoc["proposer_id"]);
        }

        if (isset($assoc["proposed_id"])) {
            $this->set_proposed_id($assoc["proposed_id"]);
        }

        if (isset($assoc["binder_id"])) {
            $this->set_binder_id($assoc["binder_id"]);
        }

        if (isset($assoc["is_removal"])) {
            $this->set_is_removal($assoc["is_removal"]);
        }

        if (isset($assoc["reason"])) {
            $this->set_reason($assoc["reason"]);
        }

        if (isset($assoc["modifiedDate"])){
            $this->set_modifiedDate($assoc["modifiedDate"]);
        }
    }
	
}

?>