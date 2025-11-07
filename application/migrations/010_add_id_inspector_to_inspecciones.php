<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_id_inspector_to_inspecciones extends CI_Migration
{
    public function up()
    {
        // Add required (non-nullable) field for assigned inspector
        $fields = [
            'inspector_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => TRUE,
                'null'       => FALSE,
                'after'      => 'id_inspeccion',
                'comment'    => 'Inspector asignado a la inspección'
            ],
        ];
        $this->dbforge->add_column('inspecciones', $fields);

        // Create foreign key constraint
        $this->db->query('
            ALTER TABLE `inspecciones`
            ADD CONSTRAINT `fk_inspecciones_inspector`
            FOREIGN KEY (`inspector_id`)
            REFERENCES `usuarios`(`id_usuario`)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
        ');
    }

    public function down()
    {
        // Drop constraint and column
        $this->db->query('ALTER TABLE `inspecciones` DROP FOREIGN KEY `fk_inspecciones_inspector`');
        $this->dbforge->drop_column('inspecciones', 'inspector_id');
    }
}
