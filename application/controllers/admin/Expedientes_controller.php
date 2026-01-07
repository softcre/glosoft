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

    $data['expedientes_en_progreso'] = $this->expedientes->get_en_progreso();
    $data['expedientes_cerrados'] = $this->expedientes->get_cerrados();

    $this->load->view('admin/expedientes/indexExpedientes', $data);
  }

  //--------------------------------------------------------------
  public function frmNuevo()
  {
    verificarConsulAjax();

    $data['inspectores'] = $this->inspectores->get_all_inspectores();
    $data['provincias'] = $this->expedientes->get_provincias();

    $this->load->view('admin/expedientes/frmNuevoExpediente', $data);
  }

  //--------------------------------------------------------------
  public function frmEditar($id_expediente)
  {
    verificarConsulAjax();

    $data['expediente'] = $this->expedientes->get($id_expediente);
    $data['inspectores'] = $this->inspectores->get_all_inspectores();
    $data['provincias'] = $this->expedientes->get_provincias();
    
    // Load localidades if provincia is selected
    if ($data['expediente']->provincia_id) {
      $data['localidades'] = $this->expedientes->get_localidades_by_provincia($data['expediente']->provincia_id);
    }

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
      //crea la inspeccion
      $inspeccion = [
        'ubicacion' => $this->input->post('ubicacion')
      ];
      $inspeccion_id = $this->inspecciones->crear($inspeccion);
      if (!$inspeccion_id) {
        return $this->response->error('Ooops.. error!', 'No se pudo crear el expediente. Intente más tarde!');
      }

      $expediente = [
        'inspeccion_id' => $inspeccion_id,
        'fecha_expediente' => fechaHoraHoy('Y-m-d'),
        'ubicacion' => $this->input->post('ubicacion'),
        'inspector_id' => $this->input->post('inspector_id'),
        'provincia_id' => $this->input->post('provincia_id') ? $this->input->post('provincia_id') : NULL,
        'localidad_id' => $this->input->post('localidad_id') ? $this->input->post('localidad_id') : NULL
      ];

      $expendiente_id = $this->expedientes->crear($expediente); // se inserta en bd

      if ($expendiente_id) {
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
        'inspector_id' => $this->input->post('inspector_id'),
        'provincia_id' => $this->input->post('provincia_id') ? $this->input->post('provincia_id') : NULL,
        'localidad_id' => $this->input->post('localidad_id') ? $this->input->post('localidad_id') : NULL
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

  //--------------------------------------------------------------
  public function getLocalidades()
  {
    verificarConsulAjax();

    $provincia_id = $this->input->post('provincia_id');
    
    if (!$provincia_id) {
      return $this->response->error('Error', 'Provincia no especificada');
    }

    $localidades = $this->expedientes->get_localidades_by_provincia($provincia_id);
    
    return $this->response->ok('Localidades cargadas', ['localidades' => $localidades]);
  }

  /**
   * 
   * FUNCIONES PRIVADAS
   * 
   */

  //--------------------------------------------------------------
  private function getExpedientes()
  {
    $data['expedientes_en_progreso'] = $this->expedientes->get_en_progreso();
    $data['expedientes_cerrados'] = $this->expedientes->get_cerrados();
    
    // Return the full tabs structure
    $html = '<!-- Nav tabs -->';
    $html .= '<ul class="nav nav-tabs mb-3" id="expedientesTabs" role="tablist" style="border-bottom: 2px solid #dee2e6;">';
    $html .= '<li class="nav-item" role="presentation">';
    $html .= '<button class="nav-link active" id="en-progreso-tab" data-bs-toggle="tab" data-bs-target="#en-progreso" type="button" role="tab" aria-controls="en-progreso" aria-selected="true" style="background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; border-bottom: none; font-weight: 500;">Expedientes en Progreso</button>';
    $html .= '</li>';
    $html .= '<li class="nav-item" role="presentation">';
    $html .= '<button class="nav-link" id="cerrados-tab" data-bs-toggle="tab" data-bs-target="#cerrados" type="button" role="tab" aria-controls="cerrados" aria-selected="false" style="background-color: #f8f9fa; color: #495057; border: 1px solid #dee2e6; border-bottom: none;">Expedientes Cerrados</button>';
    $html .= '</li>';
    $html .= '</ul>';
    
    $html .= '<!-- Tab panes -->';
    $html .= '<div class="tab-content" id="expedientesTabContent">';
    
    // Tab 1: En Progreso
    $html .= '<div class="tab-pane fade show active" id="en-progreso" role="tabpanel" aria-labelledby="en-progreso-tab">';
    $tab_data['expedientes'] = $data['expedientes_en_progreso'];
    $tab_data['table_id'] = 'tblExpedientesEnProgreso';
    $html .= $this->load->view('admin/expedientes/_tblExpedientes', $tab_data, TRUE);
    $html .= '</div>';
    
    // Tab 2: Cerrados
    $html .= '<div class="tab-pane fade" id="cerrados" role="tabpanel" aria-labelledby="cerrados-tab">';
    $tab_data['expedientes'] = $data['expedientes_cerrados'];
    $tab_data['table_id'] = 'tblExpedientesCerrados';
    $html .= $this->load->view('admin/expedientes/_tblExpedientes', $tab_data, TRUE);
    $html .= '</div>';
    
    $html .= '</div>';
    
    return $html;
  }
}
