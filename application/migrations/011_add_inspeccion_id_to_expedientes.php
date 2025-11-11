<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_inspeccion_id_to_expedientes extends CI_Migration
{
    public function up()
    {
        // Add required (non-nullable) field for assigned inspector
        $fields = [
            'inspeccion_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => TRUE,
                'null'       => FALSE,
                'after'      => 'id_expediente',
                'comment'    => 'Inspeccion asignado al expediente'
            ],
        ];
        $this->dbforge->add_column('expedientes', $fields);

        // Create foreign key constraint
        $this->db->query('
            ALTER TABLE `expedientes`
            ADD CONSTRAINT `fk_expedientes_inspeccion`
            FOREIGN KEY (`inspeccion_id`)
            REFERENCES `inspecciones`(`id_inspeccion`)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
        ');
    }

    public function down()
    {
        // Drop constraint and column
        $this->db->query('ALTER TABLE `inspecciones` DROP FOREIGN KEY `fk_expedientes_inspeccion`');
        $this->dbforge->drop_column('expedientes', 'inspeccion_id');
    }
}
