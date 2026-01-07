<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_localidades extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id_localidad' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'categoria' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
                'comment' => 'Categoria Georef de la localidad'
            ],
            'provincia_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE,
            ],
            'latitud' => [
                'type' => 'DECIMAL',
                'constraint' => '10,6',
                'null' => TRUE,
            ],
            'longitud' => [
                'type' => 'DECIMAL',
                'constraint' => '10,6',
                'null' => TRUE,
            ],
        ]);

        $this->dbforge->add_key('id_localidad', TRUE);
        $this->dbforge->add_key('provincia_id');
        $this->dbforge->create_table('localidades', TRUE);

        $this->db->query(
            'ALTER TABLE localidades
             ADD CONSTRAINT FK_localidad_provincia
             FOREIGN KEY (provincia_id)
             REFERENCES provincias(id_provincia)
             ON UPDATE CASCADE
             ON DELETE RESTRICT'
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('localidades', TRUE);
    }
}
