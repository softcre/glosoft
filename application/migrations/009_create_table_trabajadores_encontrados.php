<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_trabajadores_encontrados extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id_trabajador_encontrado' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'inspeccion_id' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'afiliacion_id' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'null' => TRUE, // puede no tener afiliación aún
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
            'documento' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'edad' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => TRUE,
            ],
            'sexo' => [
                'type' => 'ENUM("M","F")',
                'null' => TRUE,
            ],
            'categoria' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => TRUE,
                'comment' => 'Puesto u oficio declarado',
            ],
            'fecha_ingreso' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'remuneracion' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ],
            'alojado_en_predio' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => '1 = vive en el predio',
            ],
            'observaciones' => [
                'type' => 'TEXT',
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

        $this->dbforge->add_key('id_trabajador_encontrado', TRUE);
        $this->dbforge->create_table('trabajadores_encontrados');

        // Relaciones FK
        $this->db->query('ALTER TABLE trabajadores_encontrados
                          ADD CONSTRAINT FK_trabajador_inspeccion
                          FOREIGN KEY (inspeccion_id) REFERENCES inspecciones(id_inspeccion)
                          ON DELETE CASCADE');

        $this->db->query('ALTER TABLE trabajadores_encontrados
                          ADD CONSTRAINT FK_trabajador_afiliacion
                          FOREIGN KEY (afiliacion_id) REFERENCES afiliaciones(id_afiliacion)
                          ON DELETE SET NULL');
    }

    public function down() {
        $this->dbforge->drop_table('trabajadores_encontrados', TRUE);
    }
}
