<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_provincias extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id_provincia' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'categoria' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
                'comment' => 'Categoria Georef (provincia, ciudad autonoma, etc)'
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
            ],
            'iso_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => TRUE,
            ],
        ]);

        $this->dbforge->add_key('id_provincia', TRUE);
        $this->dbforge->create_table('provincias', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('provincias', TRUE);
    }
}
