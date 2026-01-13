<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_denuncias extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id_denuncia' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE,
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => TRUE,
            ],
            'contacto_alt' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'razon_social' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => TRUE,
            ],
            'cuit' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => TRUE,
            ],
            'provincia_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'localidad_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'archivo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'descripcion' => [
                'type' => 'TEXT',
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

        $this->dbforge->add_key('id_denuncia', TRUE);
        $this->dbforge->create_table('denuncias');

        // Add foreign keys
        $this->db->query('
            ALTER TABLE `denuncias`
            ADD CONSTRAINT `fk_denuncias_provincia`
            FOREIGN KEY (`provincia_id`)
            REFERENCES `provincias`(`id_provincia`)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
        ');

        $this->db->query('
            ALTER TABLE `denuncias`
            ADD CONSTRAINT `fk_denuncias_localidad`
            FOREIGN KEY (`localidad_id`)
            REFERENCES `localidades`(`id_localidad`)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
        ');
    }

    public function down() {
        $this->dbforge->drop_table('denuncias', TRUE);
    }
}
