<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password_reset_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Insert reset token into the table
    public function insert_token($email, $token) {
        $data = [
            'email' => $email,
            'token' => $token
        ];
        return $this->db->insert('password_resets', $data);
    }

    // Find token by email
    public function find_token($email, $token) {
        $query = $this->db->get_where('password_resets', ['email' => $email, 'token' => $token]);
        return $query->row();
    }

    // Delete the token after reset
    public function delete_token($email) {
        $this->db->delete('password_resets', ['email' => $email]);
    }
}
