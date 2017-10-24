<?php

class User {
    /* STATIC MEMBERS */

    // Static Variables
    public static $tablename = "users";

    // Static Methods
    public static get_user_by_id(id) {
        // TODO
    }

    public static get_user_by_email(email) {
        // TODO
    }

    public static create_user(email, password, name) {
        // TODO
    }


    /* INSTANCE MEMBERS */
    
    // Instance Variables
    private $id;
    private $name;
    private $email_address;
    private $password_salt;
    private $password_hash;
    private $avg_rating;
    private $num_ratings;
    private $biography;
    private $disabled;
    private $modifiedDate;

    // Getters and Setters (Validation)
    public get_id() {
        // TODO
    }

    private set_id() {
        // TODO
    }

    public get_name() {
        // TODO
    }

    private set_name() {
        // TODO
    }

    public get_email_address() {
        // TODO
    }

    private set_email_address() {
        // TODO
    }

    public get_password_salt() {
        // TODO
    }

    private set_password_salt() {
        // TODO
    }

    public get_password_hash() {
        // TODO
    }

    private set_password_hash() {
        // TODO
    }

    public get_avg_rating() {
        // TODO
    }

    private set_avg_rating() {
        // TODO
    }

    public get_num_ratings() {
        // TODO
    }

    private set_num_ratings() {
        // TODO
    }

    public get_biography() {
        // TODO
    }

    private set_biography() {
        // TODO
    }

    public get_disabled() {
        // TODO
    }

    private set_disabled() {
        // TODO
    }

    public get_modified_date() {
        // TODO
    }


    // Instance Methods
    public add_rating() {
        // TODO
    }

    public get_binders() {
        // TODO
    }

    public get_matches() {
        // TODO
    }

    public get_proposals() {
        // TODO
    }

    public get_university() {
        // TODO
    }

    public update_biography() {
        // TODO
    }

    public update_disabled() {
        // TODO
    }

    public update_email() {
        // TODO
    }

    public update_name() {
        // TODO
    }

    public update_password() {
        // TODO
    }

    public update_university_id() {
        // TODO
    }
}

?>