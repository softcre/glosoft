<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_google_id_to_usuarios extends CI_Migration
{
    public function up()
    {
        $fields = [
            'google_id' => [
                // 1. **CORRECCIÓN:** Se añade la longitud al VARCHAR (ej: 255)
                'type'      => 'VARCHAR',
                'constraint'=> 255, // Se usa 'constraint' para definir la longitud
                
                // 2. **CORRECCIÓN:** Se elimina 'unsigned' ya que no aplica a VARCHAR
                // 'unsigned' => TRUE, // Se elimina esta línea
                
                'null'      => TRUE,
                'after'     => 'usuario_tipo_id',
                'comment'   => 'id para login con google auth2'
            ],
        ];
        $this->dbforge->add_column('usuarios', $fields);

    }

    public function down()
    {
        $this->dbforge->drop_column('usuarios', 'google_id');
    }
}