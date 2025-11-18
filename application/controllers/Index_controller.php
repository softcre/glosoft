<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use League\OAuth2\Client\Provider\Google;


class Index_controller extends CI_Controller {
  //--------------------------------------------------------------
	public function __construct()
	{
    
		parent::__construct();
    	$this->load->library('email');

		$this->load->model(USUARIOS_MODEL, 'usuarios');
		
	}
	//--------------------------------------------------------------
	/* public function index()
	{
		if (isset($_SESSION['rol'])) {
			redirect(DASHBOARD_PATH);
		} else {
			$this->viewLogin();
		}
	} */
  //--------------------------------------------------------------
	public function index()
	{
		if (isset($_SESSION['usuario_tipo_id']) && $_SESSION['usuario_tipo_id'] == 2) {
			redirect(DASHBOARD_PATH);
		} 

    if (isset($_SESSION['usuario_tipo_id']) && $_SESSION['usuario_tipo_id'] == 3) {
			//redirect(DASHBOARD_MEDICO_PATH);
			redirect(DASHBOARD_PATH);

		} 

    if (isset($_SESSION['usuario_tipo_id']) && $_SESSION['usuario_tipo_id'] == 4) {
			//redirect(EQUIPOSA_PATH);
		}
    if (isset($_SESSION['usuario_tipo_id']) && $_SESSION['usuario_tipo_id'] == 5) {
			//redirect(DASHBOARD_PATH);
		} 
    
    $this->viewLogin();
		
	}

 //--------------------------------------------------------------
	public function login()
	{
		verificarConsulAjax();

		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');

		if ($this->form_validation->run()) {
			$user = $this->usuarios->get_user_correo($email);

			if ($user && password_verify($pass, $user->password)) {
				

        if ($user->usuario_tipo_id == 2 || $user->usuario_tipo_id == 3 || $user->usuario_tipo_id == 4 || $user->usuario_tipo_id == 5) {
          $dataUser = [
            'id'							=> $user->id_usuario,
            'usuario_tipo_id'	=> $user->usuario_tipo_id,
            'nombre'					=> $user->nombre,
            'apellido'				=> $user->apellido,
            'telefono'				=> $user->telefono,
            'foto'						=> $user->foto,
            'email'						=> $user->email,
            'login'						=> TRUE
          ];
        }

				$this->session->set_userdata($dataUser); // cargo los datos del usuario que ingresó
        
        if ($user->usuario_tipo_id == 2) {//ADMIN
          $data['url'] = base_url(DASHBOARD_PATH);
        } 
        if ($user->usuario_tipo_id == 3) {
          //$data['url'] = base_url(DASHBOARD_PATH);
          $data['url'] = base_url(DASHBOARD_PATH);
        } 
        if ($user->usuario_tipo_id == 4) {
          //$data['url'] = base_url(DASHBOARD_MEDICO_PATH);
          $data['url'] = base_url(DASHBOARD_PATH);//para que al loguear el medico qeude seleccionada la lista de jugadores
        } 
        if ($user->usuario_tipo_id == 5) {//CLUB
          $data['url'] = base_url(DASHBOARD_PATH);
        } 
       
				//$data['url'] = base_url(DASHBOARD_PATH);
				return $this->response->ok('Bienvenido ' . $this->session->nombre . '!', $data);
			}

			// falla datos ingresados no coinciden
			return $this->response->error('Ooops.. error!', 'Email y/o contraseña incorrectos');
		} else {
			// falla en validacion de datos de ingresos
			return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
		}
	} // fin de metodo validar login
  
  //--------------------------------------------------------------
  public function frmSalir()
  {
    verificarConsulAjax();
    
    $this->load->view(ADMIN_PATH . '/logout');
  }

  //--------------------------------------------------------------
  public function logout()
  {
    $this->session->sess_destroy();
    redirect('');
  }
  //-------------------------------------------------
  public function googleLogin()
  {
      $provider = $this->getGoogleProvider();

      $authUrl = $provider->getAuthorizationUrl([
          'scope' => ['openid', 'profile', 'email']
      ]);

      $this->session->set_userdata('oauth2state', $provider->getState());

      redirect($authUrl);
  }
  //---------------------------------------------------------
  //sin creador de usuario
  public function googleCallback()
  {
      $provider = $this->getGoogleProvider();

      if ($this->input->get('state') !== $this->session->userdata('oauth2state')) {
          $this->session->unset_userdata('oauth2state');
          show_error('Estado OAuth inválido', 400);
      }

      try {
          $token = $provider->getAccessToken('authorization_code', [
              'code' => $this->input->get('code')
          ]);

          $googleUser = $provider->getResourceOwner($token);

          // Datos básicos
          $email   = $googleUser->getEmail();
          $gid     = $googleUser->getId();
          $nombre  = $googleUser->getName();
          //$avatar  = $googleUser->getAvatar();
          $avatar = $googleUser->getAvatar() . '=s150-c';


          // Buscar usuario por email
          $user = $this->usuarios->get_user_correo($email);

          if (!$user) {
              // ❌ No crear usuario, solo mostrar error
              $this->session->set_flashdata('error', 'Este correo no está registrado en el sistema.');
              redirect(base_url()); // o viewLogin()
              return;
          }

          // Sesión normal de tu login
          $dataUser = [
              'id'             => $user->id_usuario,
              'usuario_tipo_id'=> $user->usuario_tipo_id,
              'nombre'         => $user->nombre,
              'apellido'       => $user->apellido,
              'telefono'       => $user->telefono,
              'foto'           => $user->foto,
              'email'          => $user->email,
              'login'          => TRUE
          ];

          $this->session->set_userdata($dataUser);

          // Redirección según tipo
          if ($user->usuario_tipo_id == 2) {
              redirect(DASHBOARD_PATH);
          }
          if ($user->usuario_tipo_id == 3) {
              redirect(DASHBOARD_PATH);
          }
          if ($user->usuario_tipo_id == 4) {
              redirect(DASHBOARD_PATH);
          }
          if ($user->usuario_tipo_id == 5) {
              redirect(DASHBOARD_PATH);
          }

          // fallback
          redirect(DASHBOARD_PATH);

      } catch (Exception $e) {
          show_error('Error en Google Login: ' . $e->getMessage(), 500);
      }
  }

  //---------------------------------------------------------
  //con creador de usuario
  /* public function googleCallback()
  {
      $provider = $this->getGoogleProvider();

      if ($this->input->get('state') !== $this->session->userdata('oauth2state')) {
          $this->session->unset_userdata('oauth2state');
          show_error('Estado OAuth inválido', 400);
      }

      try {
          $token = $provider->getAccessToken('authorization_code', [
              'code' => $this->input->get('code')
          ]);

          $googleUser = $provider->getResourceOwner($token);

          // Datos básicos
          $email   = $googleUser->getEmail();
          $gid     = $googleUser->getId();
          $nombre  = $googleUser->getName();
          $avatar  = $googleUser->getAvatar();

          // Buscar usuario por email
          $user = $this->usuarios->get_user_correo($email);

          if (!$user) {
              // Si no existe, lo podés registrar automáticamente o mostrar error
              // Aquí lo creo como tipo usuario 5 (club) o 4 o lo que decidas
              $dataInsert = [
                  'nombre'         => $nombre,
                  'apellido'       => '',
                  'email'          => $email,
                  'foto'           => $avatar,
                  'usuario_tipo_id'=> 5, // cambiar si querés
                  'google_id'      => $gid,
                  'password'       => '', // no necesita
              ];

              $this->db->insert('usuarios', $dataInsert);
              $user_id = $this->db->insert_id();

              $user = $this->usuarios->get_user($user_id);
          }

          // Sesión normal de tu login
          $dataUser = [
              'id'             => $user->id_usuario,
              'usuario_tipo_id'=> $user->usuario_tipo_id,
              'nombre'         => $user->nombre,
              'apellido'       => $user->apellido,
              'telefono'       => $user->telefono,
              'foto'           => $user->foto,
              'email'          => $user->email,
              'login'          => TRUE
          ];

          $this->session->set_userdata($dataUser);

          // Redirección según tipo
          if ($user->usuario_tipo_id == 2) {
              redirect(DASHBOARD_PATH);
          }
          if ($user->usuario_tipo_id == 3) {
              redirect(DASHBOARD_PATH);
          }
          if ($user->usuario_tipo_id == 4) {
              redirect(DASHBOARD_PATH);
          }
          if ($user->usuario_tipo_id == 5) {
              redirect(DASHBOARD_PATH);
          }

          // fallback
          redirect(DASHBOARD_PATH);

      } catch (Exception $e) {
          show_error('Error en Google Login: ' . $e->getMessage(), 500);
      }
  }
 */
	//--------------------------------------------------------------
	// public function login()
	// {
	// 	verificarConsulAjax();

	// 	$email = $this->input->post('email');
	// 	$pass = $this->input->post('pass');

	// 	$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
	// 	$this->form_validation->set_rules('pass', 'Contraseña', 'required');

	// 	if ($this->form_validation->run()) {
	// 		$user = $this->usuarios->get_user_correo($email);

	// 		if ($user && password_verify($pass, $user->password)) {
	// 			$permiso = $this->permisos->get_permiso($user->id_usuario);
	// 			if (!$permiso)
	// 				return $this->response->error('Ooops.. error!', 'Usuario sin permisos');

	// 			$rol = array(
	// 				'id_rol' => $permiso->usuario_tipo_id,
	// 				'name' => $permiso->tipo_usuario,
	// 				'ua_id' => $permiso->unidad_academica_id,
	// 				'nombre_ua' => $permiso->nombre_ua,
	// 				'carreras' => $this->accesosCarreras($permiso->carrera_id)
	// 			);
	// 			$dataUser = [
	// 				'id'				=> $user->id_usuario,
	// 				// 'usuario_tipo_id'	=> $user->usuario_tipo_id,
	// 				'nombre'		=> $user->nombre,
	// 				'apellido'	=> $user->apellido,
	// 				'telefono'	=> $user->telefono,
	// 				'foto'			=> $user->foto,
	// 				'email'			=> $user->email,
	// 				'rol'				=> $rol,
	// 				'login'			=> TRUE
	// 			];
	// 			$this->session->set_userdata($dataUser); // cargo los datos del usuario que ingresó

	// 			if ($rol['name'] === 'ROOT')
	// 				$data['url'] = base_url(USUARIOS_PATH);
	// 			else
	// 				$data['url'] = base_url(DISENIO_CURRICULAR_PATH);
	// 			// $data['url'] = base_url(OBSERVACIONES_PATH);
	// 			return $this->response->ok('Bienvenido ' . $this->session->nombre . '!', $data);
	// 		}

	// 		// falla datos ingresados no coinciden
	// 		return $this->response->error('Ooops.. error!', 'Email y/o contraseña incorrectos');
	// 	} else {
	// 		// falla en validacion de datos de ingresos
	// 		return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
	// 	}
	// } // fin de metodo validar login

	/**
	 * FUNCIONES PRIVADAS
	 */
	//--------------------------------------------------------------
	private function viewLogin()
	{
		$data['title'] = 'Acceso';
		$this->load->view('admin/login', $data);
	}
  //--------------------------------------------------------
  private function getGoogleProvider()
  {
      $this->config->load('googlelogin'); // carga config/googlelogin.php

      return new Google([
          'clientId'     => $this->config->item('google_client_id'),
          'clientSecret' => $this->config->item('google_client_secret'),
          'redirectUri'  => $this->config->item('google_redirect_uri')
      ]);
  }
}
