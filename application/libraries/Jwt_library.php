<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Jwt_library {

    private $key;

    public function __construct() {
        $this->key = "dajdiaioaidanma"; // Change this to a strong key
    }

    // Generate a JWT token
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

    // Decode a JWT token
    public function decode_token($token) {
        try {
            return JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (Exception $e) {
            return false;
        }
    }
}
