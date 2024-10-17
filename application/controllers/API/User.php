<?php


class User extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function user($id) {
        echo "Welcome to user =>> ".$id;
    }

}
