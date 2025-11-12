<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation Optional description
 * @property CI_Input $input Optional description
 * @property Response $response Optional description
 */
class User_eliminado_controller extends CI_Controller
{
  //--------------------------------------------------------------
  public function __construct()
  {
    parent::__construct();
    verificarSesion();

		$this->load->library('email');
    $this->load->model(array(
      USUARIOS_TIPO_MODEL => 'usuarios_tipo',
      USUARIOS_MODEL => 'usuarios',
    ));
  }

  //--------------------------------------------------------------
  public function index()
  {
    //unset($_SESSION['arrEquipos']);
    //$id_evento_deportivo = $this->session->userdata('id_evento_deportivo');
    $data['title'] = 'Usuarios Eliminados';
    $data['act'] = 'elim';
    $data['desplegado'] = 'users';
 
    $data['usuarios'] = $this->usuarios->get_all_deleted();
    

    $this->load->view(USERS_ELIMINADOS_PATH . '/indexUsersEliminados', $data);
  }

  
  //--------------------------------------------------------------
  public function restaurar($id_usuario)
  {
      verificarConsulAjax();

      // set deleted_at back to NULL
      $this->db->where('id_usuario', $id_usuario);
      $resp = $this->db->update('usuarios', ['deleted_at' => null]);

      if ($resp) {
          return $this->response->ok('Usuario restaurado!');
      }

      return $this->response->error('Ooops.. error!', 'No se pudo restaurar el usuario. Intente más tarde!');
  }

  

}
