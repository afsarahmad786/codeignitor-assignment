<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation', 'session', 'jwt_library']);
        $this->load->helper('url');  // Load URL helper here
    }

    // Load the registration form
    public function index() {
        $this->load->view('register'); // Load the registration view
    }

    // Handle user registration
    public function register() {
        // Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() === FALSE) {
            // If validation fails, reload the form with validation errors
            $this->load->view('register');
        } else {
            // Hash the password
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

            // Prepare user data
            $data = [
                'email' => $this->input->post('email'),
                'password' => $password
            ];

            // Insert user into the database
            if ($this->User_model->insert_user($data)) {
                $this->session->set_flashdata('success', 'User registered successfully.');
                redirect('/login');  // Redirect to login page after successful registration
            } else {
                $this->session->set_flashdata('error', 'Failed to register user.');
                redirect('/register');
            }
        }
    }

    // Load the login form
    public function login_view() {
        $this->load->view('login');
    }

    // Handle user login
    public function login() {
        // Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Reload the login form with validation errors
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Check if user exists
            $user = $this->User_model->email_exists($email);

            if ($user && password_verify($password, $user->password)) {
                // Generate JWT token for the user
                $token_data = ['email' => $email];
                $token = $this->jwt_library->generate_token($token_data);

                // Display the token (for testing purposes)
                $this->session->set_flashdata('success', 'Login successful. JWT Token generated.');
                redirect('/dashboard');
            
            } else {
                // Wrong credentials
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('/login');
            }
        }
    }
    public function dashboard() {
        $this->load->view('dashboard');
    
    }
}
