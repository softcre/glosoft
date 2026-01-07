<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_provincia_localidad_nullable_fk_to_expedientes extends CI_Migration
{
    public function up()
    {
        // 1. Agregar columnas (permitiendo NULL)
        $fields = [
            'provincia_id' => [
                'type'     => 'INT',
                'unsigned' => TRUE,
                'null'     => TRUE,
                'after'    => 'inspeccion_id',
                'comment'  => 'Provincia del expediente'
            ],
            'localidad_id' => [
                'type'     => 'INT',
                'unsigned' => TRUE,
                'null'     => TRUE,
                'after'    => 'provincia_id',
                'comment'  => 'Localidad del expediente'
            ],
        ];

        $this->dbforge->add_column('expedientes', $fields);

        // 2. FK provincia (NULL permitido)
        $this->db->query('
            ALTER TABLE `expedientes`
            ADD CONSTRAINT `fk_expedientes_provincia`
            FOREIGN KEY (`provincia_id`)
            REFERENCES `provincias`(`id_provincia`)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
        ');

        // 3. FK localidad (NULL permitido)
        $this->db->query('
            ALTER TABLE `expedientes`
            ADD CONSTRAINT `fk_expedientes_localidad`
            FOREIGN KEY (`localidad_id`)
            REFERENCES `localidades`(`id_localidad`)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
        ');
    }

    public function down()
    {
        // Eliminar FKs
        $this->db->query('
            ALTER TABLE `expedientes`
            DROP FOREIGN KEY `fk_expedientes_localidad`
        ');
        $this->db->query('
            ALTER TABLE `expedientes`
            DROP FOREIGN KEY `fk_expedientes_provincia`
        ');

        // Eliminar columnas
        $this->dbforge->drop_column('expedientes', 'localidad_id');
        $this->dbforge->drop_column('expedientes', 'provincia_id');
    }
}
