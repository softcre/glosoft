<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_controller extends CI_Controller {

	//--------------------------------------------------------------
	public function index()
	{
		if (isset($_SESSION['rol'])) {
			redirect(DASHBOARD_PATH);
		} else {
			$this->viewLogin();
		}
	}


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
}
