<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_inspecciones extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id_inspeccion' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'numero_acta' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => TRUE,
                'null' => FALSE,
            ],
            'fecha_inspeccion' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'empleador_id' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'establecimiento_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => TRUE,
            ],
            'ubicacion' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'superficie_ha' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ],
            'actividad_principal' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => TRUE,
            ],
            'cantidad_personal_perm' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'cantidad_personal_trans' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'observaciones' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'inspector_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ],
            'inspector_firma' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'estado_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
                'default' => 1 // INICIADO
            ],
            'created_at datetime not null default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->dbforge->add_key('id_inspeccion', TRUE);
        $this->dbforge->create_table('inspecciones');

        $this->db->query('ALTER TABLE inspecciones 
                          ADD CONSTRAINT FK_inspeccion_empleador 
                          FOREIGN KEY (empleador_id) REFERENCES empleadores(id_empleador)');
        $this->db->query('ALTER TABLE inspecciones 
                          ADD CONSTRAINT FK_inspeccion_estado 
                          FOREIGN KEY (estado_id) REFERENCES inspecciones_estados(id_estado)');
    }

    public function down() {
        $this->dbforge->drop_table('inspecciones', TRUE);
    }
}
