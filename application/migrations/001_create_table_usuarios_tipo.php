<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_usuarios_tipo extends CI_Migration {

    public function up() {
        // Table structure
        $this->dbforge->add_field([
            'id_tipo_usuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'tipo_usuario' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => TRUE,
            ],
            'created_at 
                datetime 
                not null 
                default current_timestamp',
            'updated_at 
                datetime 
                default current_timestamp 
                on update current_timestamp',
            'deleted_at' => [
                'type' => 'DATE',
                'default' => NULL,
                'null' => TRUE,
            ],
        ]);

        // Primary key
        $this->dbforge->add_key('id_tipo_usuario', TRUE);

        // Create the table
        $this->dbforge->create_table('usuarios_tipo');

        echo 'Usuarios tipo table migration created successfully.';
    }

    public function down() {
        // Drop the table
        $this->dbforge->drop_table('usuarios_tipo', TRUE);

        echo 'Usuarios tipo table migration removed successfully.';
    }

}
