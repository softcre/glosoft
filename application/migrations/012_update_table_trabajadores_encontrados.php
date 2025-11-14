<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_table_trabajadores_encontrados extends CI_Migration {

    public function up()
    {
        // ----- REMOVE UNWANTED COLUMNS -----
        $columns_to_drop = [
            'apellido',
            'nombre',
            'documento',
            'edad',
            'sexo',
            'categoria',
            'fecha_ingreso',
            'remuneracion',
            'alojado_en_predio',
            'observaciones',
        ];

        foreach ($columns_to_drop as $col) {
            if ($this->db->field_exists($col, 'trabajadores_encontrados')) {
                $this->dbforge->drop_column('trabajadores_encontrados', $col);
            }
        }

        // ----- ADD estado_al_inspeccionar -----
        if (!$this->db->field_exists('estado_al_inspeccionar', 'trabajadores_encontrados')) {

            $fields = [
                'estado_al_inspeccionar' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => FALSE,
                    'default'    => 'NO_AFILIADO',
                    'comment'    => 'Estado del trabajador al momento de la inspección',
                    'after'      => 'afiliacion_id'
                ]
            ];

            $this->dbforge->add_column('trabajadores_encontrados', $fields);
        }
    }

    public function down()
    {
        // Remove the new field
        if ($this->db->field_exists('estado_al_inspeccionar', 'trabajadores_encontrados')) {
            $this->dbforge->drop_column('trabajadores_encontrados', 'estado_al_inspeccionar');
        }

        // Optional: restore dropped fields (only if you want full rollback)
        // If you want this, tell me and I'll add all definitions.
    }
}
