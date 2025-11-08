<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Inspecciones_model $inspecciones Optional description
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
      INSPECCIONES_MODEL => 'inspecciones',
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
  public function frmNueva()
  {
    verificarConsulAjax();

    $data['inspectores'] = $this->inspectores->get_all_inspectores();

    $this->load->view('admin/inspecciones/frmNuevaInspeccion', $data);
  }

  //--------------------------------------------------------------
  public function frmEditar($id_inspeccion)
  {
    verificarConsulAjax();

    $data['inspeccion'] = $this->inspecciones->get($id_inspeccion);
    $data['inspectores'] = $this->inspectores->get_all_inspectores();


    $this->load->view('admin/inspecciones/frmEditarInspeccion', $data);
  }

  //--------------------------------------------------------------
  public function frmVer($id_inspeccion)
  {
    verificarConsulAjax();

    $data['inspeccion'] = $this->inspecciones->get($id_inspeccion);

    $this->load->view('admin/inspecciones/frmVerInspector', $data);
  }

  //--------------------------------------------------------------
  public function crear()
  {
    verificarConsulAjax();

    $this->form_validation->set_rules('numero_acta', 'Número de Acta', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('ubicacion', 'Ubicación', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('inspector_id', 'Inspector', 'required|trim');

    if ($this->form_validation->run()) :
      $inspeccion = [
        'inspector_id' => $this->input->post('inspector_id'),
        'numero_acta' => $this->input->post('numero_acta'),
        'ubicacion' => $this->input->post('ubicacion')
      ];

      $resp = $this->inspecciones->crear($inspeccion); // se inserta en bd

      if ($resp) {
        $data['selector'] = 'Inspecciones';
        $data['view'] = $this->getInspecciones();

        return $this->response->ok('Acta de inspección creada!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo crear el acta de inspección. Intente más tarde!');
      }
    endif;

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin de metodo crear
  //--------------------------------------------------------------

  //--------------------------------------------------------------
  public function actualizar()
  {
    verificarConsulAjax();


    // Set validation rules for personal fields
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('apellido', 'Apellido', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|trim');
    $this->form_validation->set_rules('user_pass', 'contraseña', 'required|min_length[8]|trim');
    $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[6]|trim');




    if ($this->form_validation->run()) :
      $id_usuario = $this->input->post('idUsuario');
      $id_tipo_usuario = 3;
      $usuario_inspector = [
        'usuario_tipo_id' => (int)$id_tipo_usuario,
        //'medico_especialidad_id' => $this->input->post('medico_especialidad_id'),
        'nombre' => $this->input->post('nombre'),
        'apellido' => $this->input->post('apellido'),
        'telefono' => $this->input->post('telefono'),
        //'foto' => 'no-user.jpg',
        'email' => $this->input->post('user_email'),
        'password' => password_hash($this->input->post('user_pass'), PASSWORD_DEFAULT),
      ];

      $resp = $this->usuarios->actualizar($id_usuario, $usuario_inspector); // se actualiza en bd

      if ($resp) {
        //$id_director_salvado = $this->db->insert_id();
        // $data['url'] = base_url(MEDICOS_ADMIN_PATH);
        $data['selector'] = 'inspectores';
        $data['view'] = $this->getInspectores();

        return $this->response->ok('Inspector actualizado!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo modificar el Inspector. Intente más tarde!');
      }
    endif;

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin de metodo actualizar

  //--------------------------------------------------------------
  public function eliminar($id_usuario)
  {
    verificarConsulAjax();

    $resp = $this->usuarios->actualizar($id_usuario, ['deleted_at' => date('Y-m-d')]);

    if ($resp) {
      return $this->response->ok('Inspector eliminado!');
    }

    return $this->response->error('Ooops.. error!', 'No se pudo eliminar el Inspector. Intente más tarde!');
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
}
