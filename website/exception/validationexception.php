<?php

class ValidationException extends Exception {
    private $msg;
    private $subj;

    public function __construct($msg, $subj) {
        $this->msg = $msg;
        $this->subj = $subj;
    }

    public function get_msg() {
        return $this->msg;
    }

    public function get_subj() {
        return $this->subj;
    }
}

?>