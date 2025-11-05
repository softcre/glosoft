<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_inspecciones_estados extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_estado' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nombre_estado' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ],
            'descripcion' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'created_at datetime not null default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->dbforge->add_key('id_estado', TRUE);
        $this->dbforge->create_table('inspecciones_estados', TRUE);

       /*  // Insert default statuses
        $data = [
            ['nombre_estado' => 'INICIADO', 'descripcion' => 'Inspección iniciada'],
            ['nombre_estado' => 'INSPECCION', 'descripcion' => 'En proceso de inspección'],
            ['nombre_estado' => 'VERIFICACION', 'descripcion' => 'Verificación de hallazgos'],
            ['nombre_estado' => 'LIQUIDACION', 'descripcion' => 'En proceso de liquidación'],
            ['nombre_estado' => 'CIERRE', 'descripcion' => 'Cierre de inspección']
        ]; */
        //$this->db->insert_batch('inspecciones_estados', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('inspecciones_estados', TRUE);
    }
}
