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


    // Fetch user by email
    public function get_user_by_email($email) {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->row(); // Return the user object if found, or null if not found
    }

    // Update password for the user
    public function update_password($email, $password) {
        $this->db->where('email', $email);
        $this->db->update('users', ['password' => $password]);
    }

    public function get_user($user_id) {
        return $this->db->where('id', $user_id)->get('users')->row();
    }
    
      // Example method for updating user data
      public function update_user($user_id, $data) {
        // Use Active Record class to update user details
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);  // 'users' is the table name
    }
    // Other user-related functions can be added here (e.g., login, update, delete)
}
