<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_permanente_to_table_trabajadores_encontrados extends CI_Migration {

    public function up()
    {

        // ----- ADD permanente -----
        if (!$this->db->field_exists('permanente', 'trabajadores_encontrados')) {

            $fields = [
                'permanente' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 2,
                    'null'       => FALSE,
                    'default'    => 'SI',
                    'comment'    => 'Estado de Permanencia del trabajador al momento de la inspección',
                    'after'      => 'afiliacion_id'
                ]
            ];

            $this->dbforge->add_column('trabajadores_encontrados', $fields);
        }
    }

    public function down()
    {
        // Remove the new field
        if ($this->db->field_exists('permanente', 'trabajadores_encontrados')) {
            $this->dbforge->drop_column('trabajadores_encontrados', 'permanente');
        }

        // Optional: restore dropped fields (only if you want full rollback)
        // If you want this, tell me and I'll add all definitions.
    }
}
