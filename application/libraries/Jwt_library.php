<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Import the JWT class from Firebase
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Jwt_library {

    private $key;

    public function __construct() {
        // Use a strong key for encryption
        $this->key = "dajdiaioaidanma";
    }

    // Function to generate a JWT token
    public function generate_token($data) {
        $payload = [
            'iss' => "localhost", 
            'aud' => "localhost",
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + (60 * 60), // Token expires in 1 hour
            'data' => $data
        ];

        return JWT::encode($payload, $this->key, 'HS256');
    }

    // Function to decode a JWT token
    public function decode_token($token) {
        try {
            return JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (Exception $e) {
            return false;
        }
    }
}
