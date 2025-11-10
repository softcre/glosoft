<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Load_expediente_estado_values extends CI_Migration {

    public function up() {
        // Inspection state values to insert
        $estados = [
           // ['nombre_estado' => 'INICIADO',     'descripcion' => 'Inspección iniciada'],
            ['nombre_estado' => 'INSPECCION',   'descripcion' => 'En proceso de inspección'],
            ['nombre_estado' => 'VERIFICACION', 'descripcion' => 'En proceso de verificación'],
            ['nombre_estado' => 'LIQUIDACION',  'descripcion' => 'En proceso de liquidación'],
            ['nombre_estado' => 'CIERRE',       'descripcion' => 'Proceso de inspección cerrado']
        ];

        // Insert each state into the table
        foreach ($estados as $estado) {
            $this->db->insert('expedientes_estados', $estado);
        }

        echo 'Expediente state values loaded successfully.' . PHP_EOL;
    }

    public function down() {
        // State names to delete
        $estado_nombres = [
            //'INICIADO',
            'INSPECCION',
            'VERIFICACION',
            'LIQUIDACION',
            'CIERRE'
        ];

        foreach ($estado_nombres as $nombre) {
            $this->db->where('nombre_estado', $nombre);
            $this->db->delete('expedientes_estados');
        }

        echo 'Expediente state values removed successfully.' . PHP_EOL;
    }

}
