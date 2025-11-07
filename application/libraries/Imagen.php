<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Imagen
{
  /**
   * Genera la URL pública de una imagen subida.
   *
   * Si el archivo no existe o está vacío, devuelve una imagen por defecto.
   *
   * @param string $archivo Nombre del archivo (ej. 'imagen1.jpg')
   * @param string $carpeta Subcarpeta donde se encuentra (ej. 'usuarios')
   * @param string $por_defecto Imagen por defecto si el archivo no existe
   * 
   * @return string URL pública accesible
   */
  public function obtener_url($archivo, $tipo = 'usuarios', $por_defecto = IMG_DEFAULT_USUARIOS)
  {
    // $ruta = FCPATH . "assets/uploads/{$tipo}/{$archivo}";
    $ruta = UPLOADS . "/{$tipo}/{$archivo}";

    if (!file_exists($ruta) || empty($archivo)) {
      $ruta = UPLOADS . "/{$tipo}/{$por_defecto}";
      return base_url($ruta);
    }

    return base_url($ruta);
  }

  /**
   * Obtiene la url del archivo indicado
   * @param string $folder Nombre de la carpeta donde se encuenta archivo
   * @param string $file Nombre archivo
   */
  function getUrlImg($folder, $file) {
    $filename = 'assets/uploads/' . $folder . '/' . $file;
    
    if (file_exists($filename)) {
      return base_url($filename);
    } else {
      return false;
    }
  }

  /**
   * Sube una imagen
   * @param string $nombre Nombre del input de donde se recibe el archivo
   * @param string $carpeta Nombre de la carpeta donde se subira la imagen
   * @param string $imgDefault Nombre de imagen por defecto, en caso de que no haya nada
   */
  function subirImagen($nombre, $carpeta, $imgDefault, $num = '')
  {
    $CI = &get_instance();
    $tipos  = array('image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'imagen/x-png');
    $destino = 'assets/uploads/' . $carpeta . '/';

    if (isset($_FILES[$nombre]['name'])) {
      $mime  =  get_mime_by_extension($_FILES[$nombre]['name']); //obtiene la extension del file

      if (in_array($mime,  $tipos)) {
        //cargar configuración 
        $config['upload_path'] = $destino;
        $config['allowed_types'] = 'bmp|jpeg|jpg|png';
        $config['file_name'] = date('dmY') . '_' . time() . $num;

        $CI->upload->initialize($config); // Se inicializa la config

        // subir el archivo al directorio 
        if ($CI->upload->do_upload($nombre)) {
          $imgSubida = $CI->upload->data();
          return $imgSubida['orig_name'];
          //return $destino . $imgSubida['orig_name'];
        }
      }
    }
    return $imgDefault;
    //return $destino . $imgDefault;
  }
  //Funcion subir imagen que crea nombres unicos para no duplicar nombres por subir muy rapido archivos
 /*  function subirImagen($nombre, $carpeta, $imgDefault, $num = '')
  {
    $CI = &get_instance();
    $tipos  = array('image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'imagen/x-png');
    $destino = 'assets/img/' . $carpeta . '/';

    if (isset($_FILES[$nombre]['name'])) {
        $mime  =  get_mime_by_extension($_FILES[$nombre]['name']); //obtiene la extension del file

        if (in_array($mime,  $tipos)) {
            //cargar configuración 
            $config['upload_path'] = $destino;
            $config['allowed_types'] = 'bmp|jpeg|jpg|png';

            // Generate a unique filename using the timestamp
            $unique_filename = time() . '_' . $_FILES[$nombre]['name'];
            $config['file_name'] = $unique_filename . $num;

            $CI->upload->initialize($config); // Se inicializa la config

            // subir el archivo al directorio 
            if ($CI->upload->do_upload($nombre)) {
                $imgSubida = $CI->upload->data();
                return $imgSubida['orig_name'];
                //return $destino . $imgSubida['orig_name'];
            }
        }
    }
    return $imgDefault;
    //return $destino . $imgDefault;
  } */

  // /**
  //  * Sube un comprobante
  //  * @param string $nombre Nombre del input de donde se recibe el archivo
  //  * @param string $carpeta Nombre de la carpeta donde se subira el comprobante
  //  */
  // function subirComprobante($nombre, $carpeta)
  // {
  //   $CI = &get_instance();
  //   //$tipos  = array('image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'imagen/x-png');
  //   $destino = 'assets/ventas/' . $carpeta . '/';

  //   if (isset($_FILES[$nombre]['name'])) {
  //     //$mime  =  get_mime_by_extension($_FILES[$nombre]['name']); //obtiene la extension del file

  //     //if (in_array($mime,  $tipos)) {
  //     //cargar configuración 
  //     $config['upload_path'] = $destino;
  //     $config['allowed_types'] = '*';
  //     $config['file_name'] = date('dmY') . '_' . time();

  //     $CI->upload->initialize($config); // Se inicializa la config

  //     // subir el archivo al directorio 
  //     if ($CI->upload->do_upload($nombre)) {
  //       $imgSubida = $CI->upload->data();
  //       return $destino . $imgSubida['orig_name'];
  //     }
  //     //}
  //   }
  // }

  /**
   * Get URL for an image or PDF file
   * @param string $folder Folder where the file is located
   * @param string $file File name
   * @return string|bool URL of the file if it exists, otherwise false
  */
  function getUrlFile($folder, $file) {
      $filename = 'assets/files/' . $folder . '/' . $file;
      
      if (file_exists($filename)) {
          return base_url($filename);
      } else {
          return false;
      }
  }
  /**
   * Sube un archivo (imagen, PDF, DOC, DOCX, etc.)
   * @param string $nombre Nombre del input de donde se recibe el archivo
   * @param string $carpeta Nombre de la carpeta donde se subirá el archivo
   * @param string $archivoDefault Nombre de archivo por defecto, en caso de que no haya nada
   * @param string $num Número opcional para evitar colisiones de nombres de archivo
   */
  function subirArchivo($nombre, $carpeta, $archivoDefault, $num = '')
  {
      $CI = &get_instance();
      $tiposPermitidos = array('image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'imagen/x-png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
      $destino = 'assets/img/' . $carpeta . '/'; // Directorio para los archivos

      if (isset($_FILES[$nombre]['name'])) {
          $mime = get_mime_by_extension($_FILES[$nombre]['name']); // Obtiene la extensión del archivo
           //$mime = $_FILES[$nombre]['type']; // Get the MIME type

          if (in_array($mime, $tiposPermitidos)) {
              // Es un archivo permitido, procesar
              $config['upload_path'] = $destino;
              $config['allowed_types'] = 'pdf|doc|docx|bmp|jpeg|jpg|png';
              $config['file_name'] = date('dmY') . '_' . time() . $num;

              $CI->upload->initialize($config);

              if ($CI->upload->do_upload($nombre)) {
                  $archivoSubido = $CI->upload->data();
                  return $archivoSubido['orig_name'];
              }
          }
      }

      return $archivoDefault;
  }
  /**
   * Sube un archivo (jpg)
   * @param string $nombre Nombre del input de donde se recibe el archivo
   * @param string $carpeta Nombre de la carpeta donde se subirá el archivo
   * @param string $archivoDefault Nombre de archivo por defecto, en caso de que no haya nada
   * @param string $num Número opcional para evitar colisiones de nombres de archivo
   */
  function subirArchivo2($nombre, $carpeta, $archivoDefault, $num = '')
  {
      $CI = &get_instance();
      $tiposPermitidos = array('image/jpeg', 'image/pjpeg', 'image/jpg'); // Only allow JPEG files
      $destino = 'assets/img/' . $carpeta . '/'; // Directorio para los archivos

      if (isset($_FILES[$nombre]['name'])) {
          $mime = get_mime_by_extension($_FILES[$nombre]['name']); // Obtiene la extensión del archivo

          if (in_array($mime, $tiposPermitidos)) {
              // Es un archivo permitido, procesar
              $config['upload_path'] = $destino;
              $config['allowed_types'] = 'jpg';
              $config['file_name'] = date('dmY') . '_' . time() . $num;

              $CI->load->library('upload');
              $CI->upload->initialize($config);

              if ($CI->upload->do_upload($nombre)) {
                  $archivoSubido = $CI->upload->data();
                  return $archivoSubido['orig_name'];
              }
          }
      }

      return $archivoDefault;
  }

}

