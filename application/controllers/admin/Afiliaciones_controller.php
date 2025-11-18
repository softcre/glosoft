<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Afiliaciones_model $afiliaciones Optional description
 * @property Inspecciones_model $inspecciones Optional description
 * @property Usuarios_model $inspectores Optional description
 * @property CI_Form_validation $form_validation Optional description
 * @property CI_Input $input Optional description
 * @property CI_Session $session Optional description
 * @property Imagen $imagen Optional description
 * @property Response $response Optional description
 */
class Afiliaciones_controller extends CI_Controller
{
  //--------------------------------------------------------------
  public function __construct()
  {
    parent::__construct();
    verificarSesion();

    $this->load->model(array(
      EXPEDIENTES_MODEL => 'afiliaciones',
      INSPECCIONES_MODEL => 'inspecciones',
      USUARIOS_MODEL => 'inspectores'
    ));
  }

  //--------------------------------------------------------------
  public function index()
  {
    $data['title'] = 'Afiliaciones';
    $data['act'] = 'afi';
    $data['desplegado'] = '';

    $data['afiliaciones'] = $this->afiliaciones->get_all();


    $this->load->view('admin/afiliaciones/indexAfiliaciones', $data);
  }

  //--------------------------------------------------------------
  public function frmNuevo()
  {
    verificarConsulAjax();

    $data['inspectores'] = $this->inspectores->get_all_inspectores();

    $this->load->view('admin/afiliaciones/frmNuevaAfiliacion', $data);
  }

  //--------------------------------------------------------------
  public function frmEditar($id_afiliacion)
  {
    verificarConsulAjax();

    $data['afiliacion'] = $this->afiliaciones->get($id_afiliacion);
    $data['inspectores'] = $this->inspectores->get_all_inspectores();


    $this->load->view('admin/afiliaciones/frmEditarAfiliacion', $data);
  }

  //--------------------------------------------------------------
  public function frmVer($id_afiliacion)
  {
    verificarConsulAjax();

    $data['afiliacion'] = $this->afiliaciones->get($id_afiliacion);

    $this->load->view('admin/afiliaciones/frmVerAfiliacion', $data);
  }

  //--------------------------------------------------------------
  public function crear()
  {
    verificarConsulAjax();

    $this->form_validation->set_rules('ubicacion', 'Ubicación', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('inspector_id', 'Inspector', 'required|trim');

    if ($this->form_validation->run()) :
      //crea la inspeccion
      $inspeccion = [
        'ubicacion' => $this->input->post('ubicacion')
      ];
      $inspeccion_id = $this->inspecciones->crear($inspeccion);
      if (!$inspeccion_id) {
        return $this->response->error('Ooops.. error!', 'No se pudo crear el afiliacion. Intente más tarde!');
      }

      $afiliacion = [
        'inspeccion_id' => $inspeccion_id,
        'fecha_afiliacion' => fechaHoraHoy('Y-m-d'),
        'ubicacion' => $this->input->post('ubicacion'),
        'inspector_id' => $this->input->post('inspector_id')
      ];

      $expendiente_id = $this->afiliaciones->crear($afiliacion); // se inserta en bd

      if ($expendiente_id) {
        $data['selector'] = 'Afiliaciones';
        $data['view'] = $this->getAfiliaciones();

        return $this->response->ok('Afiliacione creado!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo crear el afiliacion. Intente más tarde!');
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
      $id_afiliacion = $this->input->post('id_afiliacion');
      $afiliacion = [
        'ubicacion' => $this->input->post('ubicacion'),
        'inspector_id' => $this->input->post('inspector_id')
      ];

      $resp = $this->afiliaciones->actualizar($id_afiliacion, $afiliacion); // se actualiza en bd

      if ($resp) {
        $data['selector'] = 'Afiliaciones';
        $data['view'] = $this->getAfiliaciones();

        return $this->response->ok('Afiliacione actualizado!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo modificar el afiliacion. Intente más tarde!');
      }
    endif;

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin de metodo actualizar

  // --------------------------------------------------------------
  public function eliminar($id_afiliacion)
  {
    verificarConsulAjax();

    $resp = $this->afiliaciones->actualizar($id_afiliacion, ['deleted_at' => date('Y-m-d')]);

    if ($resp) {
      return $this->response->ok('Afiliacion eliminado!');
    }

    return $this->response->error('Ooops.. error!', 'No se pudo eliminar el afiliacion. Intente más tarde!');
  }

  /**
   * 
   * FUNCIONES PRIVADAS
   * 
   */

  //--------------------------------------------------------------
  private function getAfiliaciones()
  {
    $data['afiliaciones'] = $this->afiliaciones->get_all();
    return $this->load->view('admin/afiliaciones/_tblAfiliaciones', $data, TRUE);
  }
}
