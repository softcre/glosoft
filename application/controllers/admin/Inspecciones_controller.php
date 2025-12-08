<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Afiliaciones_model $afiliaciones Optional description
 * @property Audios_model $audios Optional description
 * @property Documentos_model $documentos Optional description
 * @property Empleadores_model $empleadores Optional description
 * @property Expedientes_model $expedientes Optional description
 * @property Inspecciones_model $inspecciones Optional description
 * @property Trabajadores_encontrados_model $trabajadores Optional description
 * @property Usuarios_model $inspectores Optional description
 * @property CI_Form_validation $form_validation Optional description
 * @property CI_Input $input Optional description
 * @property CI_Session $session Optional description
 * @property Imagen $imagen Optional description
 * @property Response $response Optional description
 */
class Inspecciones_controller extends CI_Controller
{
  //--------------------------------------------------------------
  public function __construct()
  {
    parent::__construct();
    verificarSesion();
    $this->load->library('Audio');
    $this->load->library('Document');
    $this->load->model(array(
      AFILIACIONES_MODEL => 'afiliaciones',
      EMPLEADORES_MODEL => 'empleadores',
      EXPEDIENTES_MODEL => 'expedientes',
      INSPECCIONES_MODEL => 'inspecciones',
      TRABAJADORES_ENCONTRADOS_MODEL => 'trabajadores',
      AUDIOS_MODEL => 'audios',
      USUARIOS_MODEL => 'inspectores',
      DOCUMENTOS_MODEL => 'documentos',
    ));
  }

  //--------------------------------------------------------------
  public function index()
  {
    $data['title'] = 'Inspecciones';
    $data['act'] = 'acta';
    $data['desplegado'] = 'exp';

    if (permisoInspector()) {
      $id_inspector = $_SESSION['id'];
      $data['inspecciones'] = $this->inspecciones->get_by_inspector($id_inspector);
    } else {
      $data['inspecciones'] = $this->inspecciones->get_all();
    }

    $this->load->view('admin/inspecciones/indexInspecciones', $data);
  }


  //--------------------------------------------------------------
  public function frmEditar($id_inspeccion, $id_expediente)
  {
    $data['title'] = 'Inspecciones';
    $data['act'] = 'edi_insp';
    $data['desplegado'] = 'exp';

    $data['id_expediente'] = $id_expediente;
    $data['inspeccion_id'] = $id_inspeccion;
    $data['inspeccion'] = $this->inspecciones->get($id_inspeccion);
    $data['trabajadores'] = $this->trabajadores->get_by_inspeccion($id_inspeccion);
    $data['audios'] = $this->audios->get_by_inspeccion($id_inspeccion);
    $data['documentos'] = $this->documentos->get_by_inspeccion($id_inspeccion);



    $this->load->view('admin/inspecciones/indexEditarInspeccion', $data);
  }

  //--------------------------------------------------------------
  public function frmVer($id_inspeccion, $id_expediente)
  {
    verificarConsulAjax();

    $data['id_expediente'] = $id_expediente;
    $inspeccion = $this->inspecciones->get($id_inspeccion);
    $data['inspeccion'] = $inspeccion;
    $data['empleador'] = $this->empleadores->get($inspeccion->empleador_id);
    $data['trabajadores'] = $this->trabajadores->get_by_inspeccion($id_inspeccion);
    $resultado = $this->trabajadores->get_total_sin_afiliar_by_inspeccion($id_inspeccion);
    $data['total_personal_sin_afiliar'] = $resultado->total_sin_afiliar;

    $this->load->view('admin/inspecciones/frmVerInspeccion', $data);
  }

  //--------------------------------------------------------------
  public function changeEstado()
  {
    verificarConsulAjax();

    $id_expediente = $this->input->post('id_expediente');
    $expediente = $this->expedientes->get($id_expediente);
    if ($expediente) {
      $estado_inpeccion = $this->input->post('estado_inpeccion');
      $this->expedientes->actualizar($id_expediente, array('estado_id' => $estado_inpeccion));
      $expedienteActualiado = $this->expedientes->get($id_expediente);

      $data['selector'] = 'Inspecciones';
      $data['view'] = $this->getInspecciones();
      return $this->response->ok("Inpección pasó a estado " . $expedienteActualiado->nombre_estado, $data);
    } else {
      return $this->response->error('Ooops.. error!', "Error al obtener los datos de la inspección");
    }
  }

  //--------------------------------------------------------------
  public function searchEmpleador()
  {
    verificarConsulAjax();

    $cuit = $this->input->post('cuit');
    $empleador = $this->empleadores->get_by_cuit($cuit);
    if ($empleador) {
      $dataView['empleador'] = $empleador;
    } else {
      $dataView['cuit'] = $cuit;
    }

    $data['view'] = $this->load->view('admin/inspecciones/frmEmpleador', $dataView, true);
    return $this->response->ok('Revision empleador!', $data);
  }

  //--------------------------------------------------------------
  public function saveEmpleador()
  {
    verificarConsulAjax();

    $reglas_empleador = array(
      array('field' => 'cuit', 'label' => 'CUIT', 'rules' => 'trim|required|numeric|exact_length[11]'),
      array('field' => 'razon_social', 'label' => 'Razón Social', 'rules' => 'trim|required|max_length[150]'),
      array('field' => 'responsable_nombre', 'label' => 'Responsable a cargo', 'rules' => 'trim|required|max_length[100]'),
      array('field' => 'telefono', 'label' => 'Teléfono', 'rules' => 'trim|required|max_length[20]'),
      array('field' => 'domicilio', 'label' => 'Domicilio', 'rules' => 'trim|required|max_length[150]'),
      // Campos opcionales
      // array('field' => 'localidad', 'label' => 'Localidad', 'rules' => 'trim|max_length[100]'),
      // array('field' => 'provincia', 'label' => 'Provincia', 'rules' => 'trim|max_length[100]'),
      // array('field' => 'actividad', 'label' => 'Actividad', 'rules' => 'trim|max_length[100]')
    );
    $this->form_validation->set_rules($reglas_empleador);

    if ($this->form_validation->run()) :
      $data_post = $this->input->post();

      // Datos para la tabla empleadores
      $empleador = array(
        'cuit'               => $data_post['cuit'],
        'razon_social'       => $data_post['razon_social'],
        'responsable_nombre' => $data_post['responsable_nombre'],
        'telefono'           => $data_post['telefono'],
        'domicilio'          => $data_post['domicilio'],
        'localidad'          => $data_post['localidad'],
        'provincia'          => $data_post['provincia'],
        'actividad'          => $data_post['actividad']
      );

      $id_empleador = $data_post['id_empleador'];
      if ($id_empleador) {
        // Actualiza registro de empleador
        $this->empleadores->actualizar($id_empleador, $empleador);
        $msj = "Empleador actualizado correctamente";
      } else {
        // Guarda registro de empleador
        $empleador['fecha_alta'] = fechaHoraHoy('Y-m-d');
        $id_empleador = $this->empleadores->crear($empleador);
        $msj = "Empleado registrado correctamente";
      }

      $data['isFormEmpleadorInspeccion'] = 'true';
      $data['empleador'] = $this->empleadores->get($id_empleador);
      return $this->response->ok($msj, $data);
    endif;

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin de metodo saveEmpleador

  //--------------------------------------------------------------
  public function searchAfiliacion()
  {
    verificarConsulAjax();

    $inspeccion_id = $this->input->post('inspeccion_id');
    // $inspeccion = $this->inspecciones->get($inspeccion_id);
    // if (!$inspeccion->empleador_id) {
    //   return $this->response->error('Ooops.. controle!', 'Debe ingresar un empleador');
    // }

    $dni = $this->input->post('dni');
    $afiliacion = $this->afiliaciones->get_by_dni($dni);
    $dataView['inspeccion_id'] = $inspeccion_id;
    $dataView['isAfiliado'] = false;
    $data['msj'] = 'No se encuentra afiliado el trabajador con dni: ' . $dni;
    $dataView['dni'] = $dni;

    if ($afiliacion) {
      $dataView['afiliacion'] = $afiliacion;
      $dataView['trabajador'] = $this->trabajadores->get_by_inspeccion_afiliacion($inspeccion_id, $afiliacion->id_afiliacion);
      $dataView['isAfiliado'] = true;
    }

    $data['view'] = $this->load->view('admin/inspecciones/frmAfiliacionTrabajador', $dataView, true);
    return $this->response->ok('Revision!', $data);
  }

  //--------------------------------------------------------------
  public function saveAfiliacionTrabajador()
  {
    verificarConsulAjax();

    $dni = $this->input->post('nro_doc');
    $afiliacion_existente = $this->afiliaciones->get_by_dni($dni);
    // Reglas para Datos de Empleo (Obligatorias siempre)
    $reglas_empleo = array(
      array('field' => 'fecha_ingreso', 'label' => 'Fecha de Ingreso', 'rules' => 'required|callback_validar_fecha'),
      array('field' => 'cargo', 'label' => 'Cargo y/o tareas', 'rules' => 'trim|required|max_length[100]'),
      array('field' => 'remuneracion', 'label' => 'Último Sueldo', 'rules' => 'trim|required|numeric|greater_than[0]'),
      array('field' => 'alojado_en_predio', 'label' => 'Vive en establecimiento', 'rules' => 'required|in_list[0,1]')
    );

    // Reglas para Datos Personales (Opcionales, solo si no existe el afiliado)
    $reglas_personales = array(
      array('field' => 'apellido', 'label' => 'Apellido', 'rules' => 'trim|required|max_length[100]'),
      array('field' => 'nombre', 'label' => 'Nombre', 'rules' => 'trim|required|max_length[100]'),
      array('field' => 'tipo_doc', 'label' => 'Tipo de documento', 'rules' => 'required|in_list[DNI,PAS,LC,LE]'),
      array('field' => 'nro_doc', 'label' => 'Número de documento', 'rules' => 'trim|required|integer|max_length[15]|is_unique[afiliaciones.nro_doc]'),
      array('field' => 'cuil', 'label' => 'CUIL', 'rules' => 'trim|regex_match[/^[0-9]{2}-[0-9]{8}-[0-9]{1}$/]|max_length[14]'),
      array('field' => 'fecha_nacimiento', 'label' => 'Fecha de Nacimiento', 'rules' => 'required|callback_validar_fecha'),
      array('field' => 'actividad', 'label' => 'Actividad', 'rules' => 'trim|required|max_length[100]'),
      array('field' => 'nacionalidad', 'label' => 'Nacionalidad', 'rules' => 'trim|max_length[100]')
    );

    // Aplico las reglas condicionalmente
    if (!$afiliacion_existente) {
      // DNI NO EXISTE: Valido TODO (Personales + Empleo)
      $reglas_completas = array_merge($reglas_personales, $reglas_empleo);
      $this->form_validation->set_rules($reglas_completas);
    } else {
      // DNI EXISTE: Valido solo Datos de Empleo
      $this->form_validation->set_rules($reglas_empleo);
    }

    if ($this->form_validation->run()) :
      $data_post = $this->input->post();

      // Datos para la tabla trabajadores_encontrados
      $trabajador = array(
        'fecha_ingreso'     => $data_post['fecha_ingreso'],
        'cargo'             => $data_post['cargo'],
        'remuneracion'      => $data_post['remuneracion'],
        'alojado_en_predio' => $data_post['alojado_en_predio'],
        'inspeccion_id'     => $data_post['inspeccion_id']
      );

      // Datos para la tabla afiliaciones - solo si es nuevo o se actualiza si se creo en esta inspeccion
      if (!$afiliacion_existente || $data_post['estado_al_inspeccionar'] == 'NO_AFILIADO') {
        $afiliacion = array(
          'apellido'          => $data_post['apellido'],
          'nombre'            => $data_post['nombre'],
          'tipo_doc'          => $data_post['tipo_doc'],
          'nro_doc'           => $data_post['nro_doc'],
          'cuil'              => $data_post['cuil'],
          'fecha_nacimiento'  => $data_post['fecha_nacimiento'],
          'actividad'         => $data_post['actividad'],
          'nacionalidad'      => $data_post['nacionalidad'],
          'fecha_solicitud'   => fechaHoraHoy('Y-m-d')
        );
      }

      if (!$afiliacion_existente) {
        // Guardar nueva afiliacion
        $afiliacion_id = $this->afiliaciones->crear($afiliacion);

        $trabajador['afiliacion_id'] = $afiliacion_id;
        $trabajador['estado_al_inspeccionar'] = 'NO_AFILIADO';
        // Guarda registro de trabajador_encontrado
        $this->trabajadores->crear($trabajador);
        $msj = "Afiliación realizada correctamente";
      } else {
        // Actualizar datos de empleo del afiliado existente
        if ($data_post['estado_al_inspeccionar'] == 'NO_AFILIADO') {
          $this->afiliaciones->actualizar($afiliacion_existente->id_afiliacion, $afiliacion);
        }

        if ($data_post['trabajador_encontrado_id']) {
          // Actualiza registro de trabajador_encontrado
          $this->trabajadores->actualizar($data_post['trabajador_encontrado_id'], $trabajador);
          $msj = "Datos del trabajador actualizados";
        } else {
          // Guarda registro de trabajador_encontrado
          $trabajador['afiliacion_id'] = $afiliacion_existente->id_afiliacion;
          $trabajador['estado_al_inspeccionar'] = 'AFILIADO';
          $this->trabajadores->crear($trabajador);
          $msj = "Datos del trabajador registrados";
        }
      }

      $data['selector'] = 'Trabajadores';
      $data['view'] = $this->getTrabajadores($data_post['inspeccion_id']);

      return $this->response->ok($msj, $data);
    endif;

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin de metodo saveAfiliacionTrabajador

  //--------------------------------------------------------------
  public function actualizar()
  {
    verificarConsulAjax();

    $reglas_inspeccion = array(
      array('field' => 'empleador_id', 'label' => 'ID del Empleador', 'rules' => 'required|integer|greater_than[0]', 'errors' => array('required' => 'Debe asociar un Empleador válido para completar la verificación.')),
      array('field' => 'establecimiento_nombre', 'label' => 'Nombre del establecimiento', 'rules' => 'trim|required|max_length[150]'),
      array('field' => 'actividad_principal', 'label' => 'Actividad principal', 'rules' => 'trim|required|max_length[150]'),
      array('field' => 'ubicacion', 'label' => 'Ubicación', 'rules' => 'trim|required|max_length[200]'),
      array('field' => 'superficie_ha', 'label' => 'Superficie (ha)', 'rules' => 'trim|required|numeric|greater_than_equal_to[0]'),
      array('field' => 'validacion_trabajadores', 'label' => 'Trabajadores', 'rules' => 'callback_validar_trabajadores_cargados', 'errors' => array('validar_trabajadores_cargados' => 'Debe haber al menos un trabajador registrado en el Establecimiento.')),
      array('field' => 'cantidad_personal_perm', 'label' => 'Cantidad personal permanentes', 'rules' => 'trim|required|integer|greater_than_equal_to[0]'),
      array('field' => 'cantidad_personal_trans', 'label' => 'Cantidad personal transitorios', 'rules' => 'trim|required|integer|greater_than_equal_to[0]'),
    );

    // Obtener los datos del formulario
    $data_post = $this->input->post();

    // Identifico botón presionado
    $es_guardado_verificador = FALSE;
    if ($data_post['submit_action'] == 'btnGuardarVerificar') {
      $es_guardado_verificador = TRUE;
    }

    // $es_guardado_borrador = isset($data_post['btnGuardarBorrador']);
    // $es_guardado_verificador = isset($data_post['btnGuardarVerificar']);
    $validacion_exitosa = TRUE;

    // Si se presiona 'Guardar Verificador', se ejecuta la validación.
    if ($es_guardado_verificador) {
      $validacion_exitosa = FALSE;
      $this->form_validation->set_rules($reglas_inspeccion);

      if ($this->form_validation->run() === TRUE) {
        $validacion_exitosa = TRUE;
      }
    }

    if ($validacion_exitosa) :
      $id_inspeccion = $data_post['id_inspeccion'];
      $inspeccion = array(
        'empleador_id'           => ($data_post['empleador_id']) ? $data_post['empleador_id'] : null,
        'fecha_inspeccion'       => fechaHoraHoy('Y-m-d'),
        'establecimiento_nombre' => $data_post['establecimiento_nombre'],
        'actividad_principal'    => $data_post['actividad_principal'],
        'ubicacion'              => $data_post['ubicacion'],
        'superficie_ha'          => $data_post['superficie_ha'],
        'cantidad_personal_perm' => $data_post['cantidad_personal_perm'],
        'cantidad_personal_trans' => $data_post['cantidad_personal_trans'],
        'observaciones'          => $data_post['observaciones']
      );

      $resp = $this->inspecciones->actualizar($id_inspeccion, $inspeccion); // se actualiza en bd

      if ($resp) {
        if ($es_guardado_verificador) {
          // Actualizacion de expediente
          $expediente['estado_id'] = 2; // 2=>VERIFICACION
          $this->expedientes->actualizar($data_post['id_expediente'], $expediente); // 2=>VERIFICACION
        }

        $data['url'] = base_url(INSPECCIONES_PATH);

        return $this->response->ok('Inspeccion actualizada!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo actualizar la inspección. Intente más tarde!');
      }
    endif;

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin de metodo actualizar

  // --------------------------------------------------------------
  public function eliminar($id_expediente)
  {
    verificarConsulAjax();

    $resp = $this->inspecciones->actualizar($id_expediente, ['deleted_at' => date('Y-m-d')]);

    if ($resp) {
      return $this->response->ok('Inspeccion eliminado!');
    }

    return $this->response->error('Ooops.. error!', 'No se pudo eliminar el expediente. Intente más tarde!');
  }

  /**
   * 
   * FUNCIONES PRIVADAS
   * 
   */

  //--------------------------------------------------------------
  private function getInspecciones()
  {
    $data['inspecciones'] = $this->inspecciones->get_all();
    $data['filtro'] = 'hechas';
    $data['tbl'] = '2';
    return $this->load->view('admin/inspecciones/_tblInspecciones', $data, TRUE);
  }

  //--------------------------------------------------------------
  private function getTrabajadores($inspeccion_id)
  {
    $data['trabajadores'] = $this->trabajadores->get_by_inspeccion($inspeccion_id);
    return $this->load->view('admin/inspecciones/_tblTrabajadores', $data, TRUE);
  }

  /**
   * Valida que la fecha tenga el formato YYYY-MM-DD y sea una fecha real.
   * Se puede adaptar para comprobar rangos de fecha (ej: no puede ser futuro).
   */
  public function validar_fecha($str)
  {
    // Comprueba el formato YYYY-MM-DD
    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $str)) {
      $this->form_validation->set_message('validar_fecha', 'El campo {field} debe tener un formato de fecha válido (YYYY-MM-DD).');
      return FALSE;
    }

    // Comprueba si la fecha es real (ej: no 30 de febrero)
    list($year, $month, $day) = explode('-', $str);
    if (!checkdate($month, $day, $year)) {
      $this->form_validation->set_message('validar_fecha', 'El campo {field} contiene una fecha que no es válida (ej: 30 de febrero).');
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Verifica si hay al menos un trabajador cargado para el Establecimiento actual.
   * @return bool
   */
  public function validar_trabajadores_cargados($str)
  {
    $id_inspeccion = $this->input->post('id_inspeccion');

    $cantidad_trabajadores = $this->trabajadores->get_by_inspeccion($id_inspeccion);

    if (count($cantidad_trabajadores) >= 1) {
      return TRUE; // Hay al menos uno
    } else {
      // No hay trabajadores, se muestra message de error de set_rules
      return FALSE;
    }
  }
  //--------------------------------------------------------------
  // Guarda audio enviado como base64
  //--------------------------------------------------------------
  public function guardarAudio()
  {
    verificarConsulAjax();


    $inspeccion_id = $this->input->post("inspeccion_id");
    $audio_base64  = $this->input->post("audio");
    $titulo  = $this->input->post("titulo");

    if (!$inspeccion_id || !$audio_base64) {
      return $this->response->error("Faltan datos requeridos", []);
    }

    // Delegamos el guardado a la librería Audio
    $result = $this->audio->save_base64($audio_base64, $inspeccion_id);

    if (!$result["success"]) {
      return $this->response->error("Error al guardar el archivo", $result["message"]);
    }

    // Registramos en base de datos
    $data_insert = [
      "inspeccion_id" => $inspeccion_id,
      "titulo"     => $result["file"],
      "archivo"     => $result["path"],
      "descripcion"     => $titulo,
      "created_at"    => date("Y-m-d H:i:s")
    ];

    $this->audios->crear($data_insert);

    return $this->response->ok("Audio guardado", []);
  }



  //--------------------------------------------------------------
  // Retorna HTML con el listado de audios pertenecientes a la inspección
  //--------------------------------------------------------------
  public function getAudios($inspeccion_id)
  {
    verificarConsulAjax();

    $data["audios"] = $this->audios->get_by_inspeccion($inspeccion_id);
    $this->load->view("admin/inspecciones/_tblAudios", $data);
  }



  //--------------------------------------------------------------
  // Permite descargar un audio
  //--------------------------------------------------------------
  public function descargarAudio($id_audio)
  {
    $audio = $this->audios->get($id_audio);
    if (!$audio) show_404();

    $path = FCPATH . $audio->archivo;

    if (!file_exists($path)) {
      echo "Archivo no encontrado";
      return;
    }

    $this->load->helper('download');
    force_download($path, null);
  }



  //--------------------------------------------------------------
  // Elimina un audio
  //--------------------------------------------------------------
  public function eliminarAudio($id_audio)
  {
    verificarConsulAjax();

    $resp = $this->audios->actualizar($id_audio, ['deleted_at' => date('Y-m-d')]);

    if ($resp) {
      return $this->response->ok('Audio eliminado!');
    }

    return $this->response->error('Ooops.. error!', 'No se pudo eliminar el Audio. Intente más tarde!');
  }

  //-----------lista de audios de la inspeccion

  public function listarAudios($id_inspeccion)
  {

    $data['audios'] = $this->audios->getByInspeccion($id_inspeccion);
    $this->load->view('admin/inspecciones/_tblAudios', $data);
  }

  /* documentos */

  //--------------------------------------------------------------
  // GUARDAR DOCUMENTO
  //--------------------------------------------------------------
  public function guardarDocumento()
  {
    verificarConsulAjax();

    $inspeccion_id = $this->input->post("inspeccion_id");
    $tipo_doc      = $this->input->post("tipo_doc");

    // Archivo viene por input type="file"
    if (!$inspeccion_id || !$tipo_doc || empty($_FILES["documento"]["name"])) {
      return $this->response->error("Faltan datos requeridos", []);
    }

    // Cargar librería Docs
    //$this->load->library("Docs_lib");

    // Guardado físico del archivo
    $filename = $this->document->subirDocumento(
      "documento",               // input file name
      "documentos_inspecciones"  // folder
    );

    if (!$filename) {
      return $this->response->error("Error al guardar el archivo", []);
    }

    // Registrar en base de datos
    $data_insert = [
      "inspeccion_id" => $inspeccion_id,
      "tipo"          => $tipo_doc,
      "archivo"       => $filename,
      "created_at"    => date("Y-m-d H:i:s")
    ];

    $this->documentos->crear($data_insert);

    return $this->response->ok("Documento guardado", []);
  }




  //--------------------------------------------------------------
  // LISTAR DOCUMENTOS (DEVUELVE LA TABLA COMPLETA HTML)
  //--------------------------------------------------------------
  public function listarDocumentos($inspeccion_id)
  {
    verificarConsulAjax();

    $documentos = $this->documentos->get_by_inspeccion($inspeccion_id);

    $data['view'] = $this->load->view(
      INSPECCIONES_PATH . '/_tblDocumentos',
      ['documentos' => $documentos],
      true
    );

    return $this->response->ok("OK", $data);
  }




  //--------------------------------------------------------------
  // DEVOLVER LISTA JSON PARA OTROS USOS (no HTML)
  //--------------------------------------------------------------
  public function getDocumentos($inspeccion_id)
  {
    verificarConsulAjax();

    $data["documentos"] = $this->documentos->get_by_inspeccion($inspeccion_id);

    // Return HTML partial
    $this->load->view('admin/inspecciones/_tblDocumentos', $data);
  }




  //--------------------------------------------------------------
  // ELIMINAR DOCUMENTO
  //--------------------------------------------------------------
  public function eliminarDocumento($id_documento)
  {
    verificarConsulAjax();

    // Marca borrado suave igual que audios
    $resp = $this->documentos->actualizar(
      $id_documento,
      ['deleted_at' => date('Y-m-d')]
    );

    if ($resp) {
      return $this->response->ok('Documento eliminado!');
    }

    return $this->response->error(
      'Ooops.. error!',
      'No se pudo eliminar el documento. Intente más tarde!'
    );
  }



  //--------------------------------------------------------------
  // PRIVATE: Obtener lista de documentos
  //--------------------------------------------------------------
  private function getDocumentosList($inspeccion_id)
  {
    return $this->db
      ->where('inspeccion_id', $inspeccion_id)
      ->where('deleted_at IS NULL', null, false)
      ->order_by('created_at', 'DESC')
      ->get('documentos_inspeccion')
      ->result();
  }
}
