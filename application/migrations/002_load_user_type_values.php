<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Load_user_type_values extends CI_Migration {

    public function up() {
        // User type values to insert
        $user_types = [
            'SUPERADMIN',
            'ADMIN',
            'INSPECTOR',
            'VERIFICADOR',
            'LIQUIDADOR'
        ];

        // Insert each user type
        foreach ($user_types as $type) {
            $data = [
                'tipo_usuario' => $type
            ];
            
            $this->db->insert('usuarios_tipo', $data);
        }

        echo 'User type values loaded successfully.' . PHP_EOL;
    }

    public function down() {
        // Remove all inserted user types
        $user_types = [
            'SUPERADMIN',
            'ADMIN',
            'INSPECTOR',
            'VERIFICADOR',
            'LIQUIDADOR'
        ];

        foreach ($user_types as $type) {
            $this->db->where('tipo_usuario', $type);
            $this->db->delete('usuarios_tipo');
        }

        echo 'User type values removed successfully.' . PHP_EOL;
    }

}
