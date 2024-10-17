<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Password_reset_model');
        $this->load->library(['form_validation', 'email', 'session']);
        $this->load->helper('url');
    }

    // Forgot Password Form
    public function forgot_password() {
        $this->load->view('auth/forgot_password');
    }

    // Handle Forgot Password Request
    public function send_reset_link() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Please provide a valid email.');
            redirect('auth/forgot_password');
        }

        $email = $this->input->post('email');
        $user = $this->User_model->get_user_by_email($email);

        if (!$user) {
            $this->session->set_flashdata('error', 'Email not found.');
            redirect('auth/forgot_password');
        }

        // Generate reset token
        $token = bin2hex(random_bytes(32));
        $this->Password_reset_model->insert_token($email, $token);

        // Send reset email
        $reset_link = base_url("auth/reset_password/$token?email=$email");
        $this->_send_email($email, $reset_link);

        $this->session->set_flashdata('success', 'Password reset link has been sent to your email.');
        redirect('auth/forgot_password');
    }

    // Reset Password Form
    public function reset_password($token) {
        $email = $this->input->get('email');
        $token_data = $this->Password_reset_model->find_token($email, $token);

        if (!$token_data) {
            $this->session->set_flashdata('error', 'Invalid or expired token.');
            redirect('auth/forgot_password');
        }

        $data['token'] = $token;
        $data['email'] = $email;
        $this->load->view('auth/reset_password', $data);
    }

    // Handle Password Reset
    public function update_password() {
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');        
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Passwords do not match.');
            redirect('auth/reset_password');
        }

        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        
        // Update user password
        $this->User_model->update_password($email, $password);
        
        // Delete the token
        $this->Password_reset_model->delete_token($email);

        $this->session->set_flashdata('success', 'Password updated successfully.');
        redirect('login');
    }

    // Send reset email function
    private function _send_email($to, $reset_link) {
        // Email configuration
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'mohammadafsar415@gmail.com', // Your Gmail address
            'smtp_pass' => 'cddzcbxoeyigxbor', // Your Gmail App Password
            'smtp_crypto' => 'tls', // Use TLS for Gmail
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'newline' => "\r\n" // Important for proper formatting
        );
    
        // Load and initialize the email library
        $this->load->library('email');
        $this->email->initialize($config); // Initialize with the config
    
        // Set email parameters
        $this->email->from('mohammadafsar415@gmail.com', 'Your App'); // Ensure the sender email is correct
        $this->email->to($to); // Recipient's email
        $this->email->subject('Password Reset Request');
        $this->email->message("Click on the following link to reset your password: <a href='$reset_link'>$reset_link</a>");
    
        // Send email and check for success or failure
        if ($this->email->send()) {
            log_message('info', 'Password reset email sent to ' . $to);
            return true;
        } else {
            log_message('error', 'Failed to send password reset email: ' . $this->email->print_debugger());
            return false;
        }
    }
    
    
    public function test_email() {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'mohammadafsar415@gmail.com', // Your Gmail address
            'smtp_pass' => 'cddzcbxoeyigxbor', // Your Gmail App Password (ensure it's correct)
            'smtp_crypto' => 'tls', // Use 'tls' for Gmail
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'newline' => "\r\n" // Important for proper mail formatting
        );
    
        // Load the email library and initialize the config
        $this->load->library('email');
        $this->email->initialize($config); // Use initialize to apply the config
    
        // Set up email parameters
        $this->email->from('mohammadafsar415@gmail.com', 'Test Email');
        $this->email->to('mohammadafsar415@gmail.com'); // You can use a different test email
        $this->email->subject('Test Email');
        $this->email->message('This is a test email.');
    
        // Send email and check the result
        if ($this->email->send()) {
            echo "Test email sent!";
        } else {
            // Show the error if email sending fails
            echo "Failed to send test email.";
            echo $this->email->print_debugger();
        }
    }
    

    public function find_token($email, $token) {
        $query = $this->db->get_where('password_resets', ['email' => $email, 'token' => $token]);
        $result = $query->row();
    
        // Check if token is older than 30 minutes
        if ($result && (strtotime($result->created_at) + 1800) > time()) {
            return $result;
        }
        return null;
    }
    
}
