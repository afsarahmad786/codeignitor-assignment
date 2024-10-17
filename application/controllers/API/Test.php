<?php


class Test extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        echo "Welcome to CodeIgniter 3.1.8 with PHP 7.4!";
    }

}
