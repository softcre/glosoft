<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_descripcion_to_audios extends CI_Migration
{
    public function up()
    {
        // Add required (non-nullable) field for assigned inspector
        $fields = [
            'descripcion' => [
                'type' => 'TEXT',
                'null' => TRUE,
                'after'     => 'titulo',
            ],
        ];
        $this->dbforge->add_column('audios', $fields);

        // Create foreign key constraint
        
    }

    public function down()
    {
        // Drop constraint and column
        $this->dbforge->drop_column('audios', 'descripcion');
    }
}
