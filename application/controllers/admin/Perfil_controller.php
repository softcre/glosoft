<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Usuarios_model $usuarios Optional description
 * @property CI_Form_validation $form_validation Optional description
 * @property CI_Input $input Optional description
 * @property CI_Session $session Optional description
 * @property Imagen $imagen Optional description
 * @property Response $response Optional description
 */
class Perfil_controller extends CI_Controller
{
  //--------------------------------------------------------------
  public function __construct()
  {
    parent::__construct();
    //verificarSesionAdmin();
    verificarSesion();
    
    $this->load->model(USUARIOS_MODEL, 'usuarios');
  }

  //--------------------------------------------------------------
  public function frmEditarPerfil()
  {
    $data['title'] = 'Perfil';
    $data['act'] = '';
    $data['desplegado'] = '';
    $this->load->view(PERFIL_PATH . '/editarPerfil', $data);
  }

  //--------------------------------------------------------------
  public function frmEditarContrasena()
  {
    verificarConsulAjax();
    $this->load->view(PERFIL_PATH . '/frmEditarContrasena');
  }

  //--------------------------------------------------------------
  public function actualizarPerfil()
  {
    verificarConsulAjax();

    $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim');

    if ($this->form_validation->run()) {
      $user = [
        'nombre'      => $this->input->post('nombre'),
        'apellido'    => $this->input->post('apellido'),
        'telefono'    => $this->input->post('telefono'),
        'email'       => $this->input->post('email'),
        'updated_at'  => fechaHoraHoy()
      ];

      if (!empty($_FILES['file']['name'])) {
        $user['foto'] = $this->imagen->subirImagen('file', 'usuarios', 'no-user.png');
      }

      $resp = $this->usuarios->actualizar($this->session->id, $user); // se hace un update en bd

      if ($resp) {
				$data['url'] = base_url(ADMIN_PATH);
        return $this->response->ok('Perfil actualizado!', $data);

      } else {
        return $this->response->error('Ooops.. error!', 'No se pudo actualizar el perfil de usuario. Intente más tarde!');
      }
    }

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin de metodo editar

  //--------------------------------------------------------------
  public function actualizarContrasena()
  {
    verificarConsulAjax();

    $this->form_validation->set_rules('pass_actual', 'Contraseña actual', 'required|trim');
    $this->form_validation->set_rules('pass_nueva', 'Contraseña nueva', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('pass_conf', 'Repita contraseña nueva', 'required|trim|min_length[3]|matches[pass_nueva]');

    if ($this->form_validation->run()) : //Si la validación es correcta
      $pass_actual = $this->input->post('pass_actual');
      $user = $this->usuarios->get($this->session->id);

      if (password_verify($pass_actual, $user->password)) {
        $pass_nueva = password_hash($this->input->post('pass_nueva'), PASSWORD_DEFAULT);

        $dataUser = [
          'password' => $pass_nueva,
          'updated_at' => fechaHoraHoy()
        ];
        $resp = $this->usuarios->actualizar($user->id_usuario, $dataUser); // se hace un update en bd

        if ($resp) {
          return $this->response->ok('Contraseña actualizado!');

        } else {
          return $this->response->error('Ooops.. error!', 'No se pudo actualizar realizar el cambio de contraseña. Intente más tarde!');
        }

      } else {
        return $this->response->error('Ooops.. error!', 'La contraseña actual es incorrecta.');
      }
    endif;

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin metodo actualizarContrasena
}
