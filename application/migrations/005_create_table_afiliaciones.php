<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_afiliaciones extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id_afiliacion' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
            ],
            'nacionalidad' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => TRUE,
            ],
            'estado_civil' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE,
            ],
            'sexo' => [
                'type' => 'ENUM("M","F")',
                'null' => TRUE,
            ],
            'fecha_nacimiento' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'tipo_doc' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => TRUE,
            ],
            'nro_doc' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'cuil' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => TRUE,
            ],
            'domicilio' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'localidad' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ],
            'provincia' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ],
            'oficio' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ],
            'actividad' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => TRUE,
            ],
            'empleador_id' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'recibo_sueldo_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'fecha_solicitud' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'firma_solicitante' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'created_at datetime not null default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' => [
                'type' => 'DATE',
                'default' => NULL,
                'null' => TRUE,
            ],
        ]);

        $this->dbforge->add_key('id_afiliacion', TRUE);
        $this->dbforge->create_table('afiliaciones');

        $this->db->query('ALTER TABLE afiliaciones 
                          ADD CONSTRAINT FK_afiliacion_empleador 
                          FOREIGN KEY (empleador_id) REFERENCES empleadores(id_empleador)');
    }

    public function down() {
        $this->dbforge->drop_table('afiliaciones', TRUE);
    }
}
