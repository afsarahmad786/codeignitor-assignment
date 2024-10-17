<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Function to insert user data
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    // Function to check if email exists
    public function email_exists($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    // Other user-related functions can be added here (e.g., login, update, delete)
}
