<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_localidades_raw extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'categoria' => ['type' => 'VARCHAR', 'constraint' => 50],
            'centroide_lat' => ['type' => 'VARCHAR', 'constraint' => 50],
            'centroide_lon' => ['type' => 'VARCHAR', 'constraint' => 50],
            'departamento_id' => ['type' => 'VARCHAR', 'constraint' => 50],
            'departamento_nombre' => ['type' => 'VARCHAR', 'constraint' => 150],
            'fuente' => ['type' => 'VARCHAR', 'constraint' => 50],
            'gobierno_local_id' => ['type' => 'VARCHAR', 'constraint' => 50],
            'gobierno_local_nombre' => ['type' => 'VARCHAR', 'constraint' => 150],
            'id' => ['type' => 'VARCHAR', 'constraint' => 50],
            'localidad_censal_id' => ['type' => 'VARCHAR', 'constraint' => 50],
            'localidad_censal_nombre' => ['type' => 'VARCHAR', 'constraint' => 150],
            'nombre' => ['type' => 'VARCHAR', 'constraint' => 150],
            'provincia_id' => ['type' => 'VARCHAR', 'constraint' => 50],
            'provincia_nombre' => ['type' => 'VARCHAR', 'constraint' => 150],
        ]);

        $this->dbforge->create_table('localidades_raw', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('localidades_raw', TRUE);
    }
}
