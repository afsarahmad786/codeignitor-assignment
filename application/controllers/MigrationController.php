<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MigrationController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the migration library
        $this->load->library('migration');
    }

    // This method will run the latest migration
    public function migrate() {
        if ($this->migration->latest() === FALSE) {
            // Show error if migration fails
            show_error($this->migration->error_string());
        } else {
            echo "Migrations applied successfully.";
        }
    }

    // Optionally, you can create a method to roll back all migrations
    public function rollback() {
        if ($this->migration->version(0) === FALSE) {
            // Show error if rollback fails
            show_error($this->migration->error_string());
        } else {
            echo "Migrations rolled back successfully.";
        }
    }

}
