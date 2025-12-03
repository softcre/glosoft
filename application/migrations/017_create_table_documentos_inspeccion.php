<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_documentos_inspeccion extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id_documento' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],

            'inspeccion_id' => [
                'type' => 'BIGINT',
                'unsigned' => TRUE
            ],

            // "tipo" stores the document category (Libreta, Recibos, ART, etc.)
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => FALSE
            ],

            // original file name uploaded by the user
            'nombre_archivo' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => FALSE
            ],

            // disk path (assets/.../xxx.pdf)
            'archivo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ],

            'created_at datetime not null default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' => [
                'type' => 'DATE',
                'default' => NULL,
                'null' => TRUE,
            ],
        ]);

        $this->dbforge->add_key('id_documento', TRUE);
        $this->dbforge->add_key('inspeccion_id');

        $this->dbforge->create_table('documentos_inspeccion', TRUE);
        // Add foreign key
        $this->db->query("
            ALTER TABLE documentos_inspeccion 
            ADD CONSTRAINT FK_documento_inspeccion 
            FOREIGN KEY (inspeccion_id) REFERENCES inspecciones(id_inspeccion)
            ON DELETE CASCADE
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('documentos_inspeccion');
    }
}
