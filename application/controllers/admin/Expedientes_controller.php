<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Expedientes_model $expedientes Optional description
 * @property Inspecciones_model $inspecciones Optional description
 * @property Usuarios_model $inspectores Optional description
 * @property CI_Form_validation $form_validation Optional description
 * @property CI_Input $input Optional description
 * @property CI_Session $session Optional description
 * @property Imagen $imagen Optional description
 * @property Response $response Optional description
 */
class Expedientes_controller extends CI_Controller
{
  //--------------------------------------------------------------
  public function __construct()
  {
    parent::__construct();
    verificarSesion();

    $this->load->model(array(
      EXPEDIENTES_MODEL => 'expedientes',
      INSPECCIONES_MODEL => 'inspecciones',
      USUARIOS_MODEL => 'inspectores'
    ));
  }

  //--------------------------------------------------------------
  public function index()
  {
    $data['title'] = 'Expedientes';
    $data['act'] = 'expe';
    $data['desplegado'] = 'exp';

    $data['expedientes'] = $this->expedientes->get_all();


    $this->load->view('admin/expedientes/indexExpedientes', $data);
  }

  //--------------------------------------------------------------
  public function frmNuevo()
  {
    verificarConsulAjax();

    $data['inspectores'] = $this->inspectores->get_all_inspectores();

    $this->load->view('admin/expedientes/frmNuevoExpediente', $data);
  }

  //--------------------------------------------------------------
  public function frmEditar($id_expediente)
  {
    verificarConsulAjax();

    $data['expediente'] = $this->expedientes->get($id_expediente);
    $data['inspectores'] = $this->inspectores->get_all_inspectores();


    $this->load->view('admin/expedientes/frmEditarExpediente', $data);
  }

  //--------------------------------------------------------------
  public function frmVer($id_expediente)
  {
    verificarConsulAjax();

    $data['expediente'] = $this->expedientes->get($id_expediente);

    $this->load->view('admin/expedientes/frmVerExpediente', $data);
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

      $expendiente_id = $this->expedientes->crear($expediente); // se inserta en bd

      if ($expendiente_id) {
        //crea la inspeccion
        $inspeccion = [
          'ubicacion' => $this->input->post('ubicacion')
        ];
        $this->inspecciones->crear($inspeccion);

        $data['selector'] = 'Expedientes';
        $data['view'] = $this->getExpedientes();

        return $this->response->ok('Expediente creado!', $data);
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

      $resp = $this->expedientes->actualizar($id_expediente, $expediente); // se actualiza en bd

      if ($resp) {
        $data['selector'] = 'Expedientes';
        $data['view'] = $this->getExpedientes();

        return $this->response->ok('Expediente actualizado!', $data);
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

    $resp = $this->expedientes->actualizar($id_expediente, ['deleted_at' => date('Y-m-d')]);

    if ($resp) {
      return $this->response->ok('Expediente eliminado!');
    }

    return $this->response->error('Ooops.. error!', 'No se pudo eliminar el expediente. Intente más tarde!');
  }

  /**
   * 
   * FUNCIONES PRIVADAS
   * 
   */

  //--------------------------------------------------------------
  private function getExpedientes()
  {
    $data['expedientes'] = $this->expedientes->get_all();
    return $this->load->view('admin/expedientes/_tblExpedientes', $data, TRUE);
  }
}
