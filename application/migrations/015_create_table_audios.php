<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_audios extends CI_Migration {

    public function up()
    {
        // Create base columns
        $this->dbforge->add_field([
            'id_audio' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'inspeccion_id' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'null' => FALSE
            ],
            'archivo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => TRUE
            ],
            // Date stored by controller
            'fecha' => [
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => null
            ],
            'duracion_segundos' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ],
            'usuario_id' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'null' => TRUE
            ],
            'created_at datetime not null default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' => [
                'type' => 'DATE',
                'default' => NULL,
                'null' => TRUE,
            ],
        ]);

        $this->dbforge->add_key('id_audio', TRUE);
        $this->dbforge->create_table('audios', TRUE);

       

        // Add foreign key
        $this->db->query("
            ALTER TABLE audios 
            ADD CONSTRAINT FK_audio_inspeccion 
            FOREIGN KEY (inspeccion_id) REFERENCES inspecciones(id_inspeccion)
            ON DELETE CASCADE
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('audios', TRUE);
    }
}
