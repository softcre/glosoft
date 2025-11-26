<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Audio
{
    private $folder = "assets/uploads/audios/";

    public function __construct()
    {
        if (!is_dir(FCPATH . $this->folder)) {
            mkdir(FCPATH . $this->folder, 0777, true);
        }
    }

    /**
     * Guarda audio enviado como base64
     * Retorna:
     *   success: true/false
     *   file: nombre
     *   path: ruta relativa
     */
    public function save_base64($base64, $inspeccion_id)
    {
        try {
            // Limpieza de encabezado base64
            list($type, $data) = explode(';', $base64);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);

            $file_name = "audio_" . $inspeccion_id . "_" . time() . ".webm";
            $file_path = $this->folder . $file_name;

            file_put_contents(FCPATH . $file_path, $data);

            return [
                "success" => true,
                "file" => $file_name,
                "path" => $file_path
            ];
        } catch (Exception $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }
}
