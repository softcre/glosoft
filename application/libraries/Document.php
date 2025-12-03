<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Document {

    protected $CI;

    public function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->helper('string');
        $this->CI->load->helper('file');
    }

    /**
     * Subir un documento con validación.
     *
     * @param string $input_name  Nombre del input file
     * @param string $carpeta     Subcarpeta dentro de assets/uploads/
     * @param array  $allowed     Tipos permitidos
     * @return string|false       Nombre de archivo guardado o false
     */
    public function subirDocumento($input_name, $carpeta = 'documentos_inspecciones', $allowed = []) {

        if (empty($allowed)) {
            $allowed = [
                'pdf','doc','docx','xls','xlsx','jpg','jpeg','png',
                'gif','txt','csv','zip','rar','ppt','pptx'
            ];
        }

        // Ruta final
        $upload_path = FCPATH . 'assets/uploads/' . $carpeta . '/';

        // Crear carpeta si no existe
        if (!is_dir($upload_path)) {
            if (!mkdir($upload_path, 0755, true)) {
                log_message('error', 'Document: No se pudo crear la carpeta ' . $upload_path);
                return false;
            }
        }

        // Sanitizar nombre original
        $filename = time() . '_' . random_string('alnum', 8);

        // Configuración Upload Library
        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => implode('|', $allowed),
            'max_size'      => 10240, // 10MB
            'file_name'     => $filename,
            'overwrite'     => false
        ];

        $this->CI->load->library('upload', $config, 'docs_upload');

        if (!$this->CI->docs_upload->do_upload($input_name)) {
            log_message('error', 'Document upload error: ' . $this->CI->docs_upload->display_errors());
            return false;
        }

        $data = $this->CI->docs_upload->data();
        return $data['file_name'];
    }

}

