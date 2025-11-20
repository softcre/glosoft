<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Afiliaciones_model $afiliaciones Optional description
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

    $this->load->model(array(
      AFILIACIONES_MODEL => 'afiliaciones',
      INSPECCIONES_MODEL => 'inspecciones',
      TRABAJADORES_ENCONTRADOS_MODEL => 'trabajadores',
      USUARIOS_MODEL => 'inspectores'
    ));
  }

  //--------------------------------------------------------------
  public function index()
  {
    $data['title'] = 'Inspecciones';
    $data['act'] = 'acta';
    $data['desplegado'] = 'exp';

    $data['inspecciones'] = $this->inspecciones->get_all();


    $this->load->view('admin/inspecciones/indexInspecciones', $data);
  }

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
  // public function frmNuevaAfiliacion($inspeccion_id)
  // {
  //   verificarConsulAjax();

  //   $data['inspeccion_id'] = $inspeccion_id;

  //   $this->load->view('admin/inspecciones/frmNuevaAfiliacion', $data);
  // }

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
  } // fin de metodo crear

  //--------------------------------------------------------------
  public function frmEditar($id_inspeccion)
  {
    $data['title'] = 'Inspecciones';
    $data['act'] = 'edi_insp';
    $data['desplegado'] = 'exp';

    $data['inspeccion'] = $this->inspecciones->get($id_inspeccion);
    $data['trabajadores'] = $this->trabajadores->get_by_inspeccion($id_inspeccion);


    $this->load->view('admin/inspecciones/indexEditarInspeccion', $data);
  }

  //--------------------------------------------------------------
  public function frmVer($id_expediente)
  {
    verificarConsulAjax();

    $data['expediente'] = $this->inspecciones->get($id_expediente);

    $this->load->view('admin/inspecciones/frmVerInspeccion', $data);
  }

  //--------------------------------------------------------------
  public function crear()
  {
    verificarConsulAjax();

    $this->form_validation->set_rules('ubicacion', 'Ubicación', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('inspector_id', 'Inspector', 'required|trim');

    if ($this->form_validation->run()) :
      $expediente = [
        'fecha_expediente' => fechaHoraHoy('Y-m-d'),
        'ubicacion' => $this->input->post('ubicacion'),
        'inspector_id' => $this->input->post('inspector_id')
      ];

      $expendiente_id = $this->inspecciones->crear($expediente); // se inserta en bd

      if ($expendiente_id) {
        //crea la inspeccion
        $inspeccion = [
          'ubicacion' => $this->input->post('ubicacion')
        ];
        $this->inspecciones->crear($inspeccion);

        $data['selector'] = 'Inspecciones';
        $data['view'] = $this->getInspecciones();

        return $this->response->ok('Inspeccion creado!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo crear el expediente. Intente más tarde!');
      }
    endif;

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin de metodo crear
  //--------------------------------------------------------------

  //--------------------------------------------------------------
  public function actualizar()
  {
    verificarConsulAjax();

    $this->form_validation->set_rules('ubicacion', 'Ubicación', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('inspector_id', 'Inspector', 'required|trim');

    if ($this->form_validation->run()) :
      $id_expediente = $this->input->post('id_expediente');
      $expediente = [
        'ubicacion' => $this->input->post('ubicacion'),
        'inspector_id' => $this->input->post('inspector_id')
      ];

      $resp = $this->inspecciones->actualizar($id_expediente, $expediente); // se actualiza en bd

      if ($resp) {
        $data['selector'] = 'Inspecciones';
        $data['view'] = $this->getInspecciones();

        return $this->response->ok('Inspeccion actualizado!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo modificar el expediente. Intente más tarde!');
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
}
