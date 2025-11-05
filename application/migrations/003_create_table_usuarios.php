<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_usuarios extends CI_Migration {

    public function up() {
        // Table structure
        $this->dbforge->add_field([
            'id_usuario' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'usuario_tipo_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE,
            ],
            'apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE,
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => TRUE,
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => TRUE,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->dbforge->add_key('id_usuario', TRUE);
        

        // Create the table
        $this->dbforge->create_table('usuarios');

        // Add foreign key using raw SQL
        $sql = "ALTER TABLE usuarios ADD CONSTRAINT FK_usuario_tipo_id FOREIGN KEY (usuario_tipo_id) REFERENCES usuarios_tipo(id_tipo_usuario)";
        $this->db->query($sql);

        echo 'Usuarios table migration created successfully.';
    }

    public function down() {
        // Drop the table
        $this->dbforge->drop_table('usuarios', TRUE);

        echo 'Usuarios table migration removed successfully.';
    }

}
