<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_add_cargo_and_restore_fields extends CI_Migration {

    public function up()
    {
        // ----- ADD cargo -----
        if (!$this->db->field_exists('cargo', 'trabajadores_encontrados')) {

            $fields = [
                'cargo' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => TRUE,
                    'after'      => 'afiliacion_id'
                ]
            ];

            $this->dbforge->add_column('trabajadores_encontrados', $fields);
        }

        // ----- RESTORE fecha_ingreso -----
        if (!$this->db->field_exists('fecha_ingreso', 'trabajadores_encontrados')) {

            $fields = [
                'fecha_ingreso' => [
                    'type'       => 'DATE',
                    'null'       => TRUE,
                    'after'      => 'cargo'
                ]
            ];

            $this->dbforge->add_column('trabajadores_encontrados', $fields);
        }

        // ----- RESTORE remuneracion -----
        if (!$this->db->field_exists('remuneracion', 'trabajadores_encontrados')) {

            $fields = [
                'remuneracion' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '10,2',
                    'null'       => TRUE,
                    'after'      => 'fecha_ingreso'
                ]
            ];

            $this->dbforge->add_column('trabajadores_encontrados', $fields);
        }

        // ----- RESTORE alojado_en_predio -----
        if (!$this->db->field_exists('alojado_en_predio', 'trabajadores_encontrados')) {

            $fields = [
                'alojado_en_predio' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'null'       => TRUE,
                    'default'    => NULL,
                    'after'      => 'remuneracion'
                ]
            ];

            $this->dbforge->add_column('trabajadores_encontrados', $fields);
        }

        // ----- RESTORE observaciones -----
        if (!$this->db->field_exists('observaciones', 'trabajadores_encontrados')) {

            $fields = [
                'observaciones' => [
                    'type' => 'TEXT',
                    'null' => TRUE,
                    'after' => 'alojado_en_predio'
                ]
            ];

            $this->dbforge->add_column('trabajadores_encontrados', $fields);
        }
    }

    public function down()
    {
        // Drop fields in reverse order (safe rollback)
        $drop_columns = [
            'observaciones',
            'alojado_en_predio',
            'remuneracion',
            'fecha_ingreso',
            'cargo'
        ];

        foreach ($drop_columns as $col) {
            if ($this->db->field_exists($col, 'trabajadores_encontrados')) {
                $this->dbforge->drop_column('trabajadores_encontrados', $col);
            }
        }
    }
}
