<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_empleadores extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id_empleador' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'razon_social' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE,
            ],
            'cuit' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => TRUE,
                'unique' => TRUE,
            ],
            'responsable_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => TRUE,
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => TRUE,
            ],
            'domicilio' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'localidad' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ],
            'provincia' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ],
            'actividad' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => TRUE,
            ],
            'fecha_alta' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'created_at datetime not null default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' => [
                'type' => 'DATE',
                'default' => NULL,
                'null' => TRUE,
            ],
        ]);

        $this->dbforge->add_key('id_empleador', TRUE);
        $this->dbforge->create_table('empleadores');
    }

    public function down() {
        $this->dbforge->drop_table('empleadores', TRUE);
    }
}
