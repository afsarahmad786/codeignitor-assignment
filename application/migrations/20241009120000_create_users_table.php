<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_users_table extends CI_Migration
{

    public function up()
    {
        // Check if the table exists
        if (!$this->db->table_exists('users')) {
            // If the table doesn't exist, create it
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
                    'null' => FALSE,
                    'unique' => TRUE
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => FALSE
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ],
                'phone' => [
                    'type' => 'VARCHAR',
                    'constraint' => '15',
                    'null' => TRUE
                ],
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp',
            ]);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('users');
        } else {
            echo "Table 'users' already exists, skipping creation.";
        }
    }

    public function down()
    {
        // Drop the users table if it exists
        if ($this->db->table_exists('users')) {
            $this->dbforge->drop_table('users');
        }
    }
}
