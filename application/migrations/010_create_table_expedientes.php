<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_expedientes extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id_expediente' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'inspector_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => TRUE,
                'null'       => FALSE,
                'after'      => 'id_inspeccion',
                'comment'    => 'Inspector asignado al expediente'
            ],
            'fecha_expediente' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'ubicacion' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
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
            'deleted_at' => [
                'type' => 'DATE',
                'default' => NULL,
                'null' => TRUE,
            ],
        ]);

        $this->dbforge->add_key('id_expediente', TRUE);
        $this->dbforge->create_table('expedientes');

        $this->db->query('
            ALTER TABLE `expedientes`
            ADD CONSTRAINT `fk_expedientes_inspector`
            FOREIGN KEY (`inspector_id`)
            REFERENCES `usuarios`(`id_usuario`)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
        ');

        $this->db->query('ALTER TABLE expedientes 
                        ADD CONSTRAINT FK_expediente_estado 
                        FOREIGN KEY (estado_id) REFERENCES expedientes_estados(id_estado)');
       

    }

    public function down() {
        $this->dbforge->drop_table('expedientes', TRUE);
    }
}
