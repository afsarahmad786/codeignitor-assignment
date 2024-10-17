<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_password_resets_table extends CI_Migration {

    public function up() {
        if (!$this->db->table_exists('password_resets')) {
            $this->dbforge->add_field([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => FALSE
                ],
                'token' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => FALSE
                ],
                'created_at datetime default current_timestamp',
            ]);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('password_resets');
        } else {
            echo "Table 'password_resets' already exists, skipping creation.";
        }
    }

    public function down() {
        if ($this->db->table_exists('password_resets')) {
            $this->dbforge->drop_table('password_resets');
        }
    }
}