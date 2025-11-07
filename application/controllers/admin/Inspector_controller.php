<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation Optional description
 * @property CI_Input $input Optional description
 * @property Response $response Optional description
 */
class Inspector_controller extends CI_Controller
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
    $data['title'] = 'Inspector';
    $data['act'] = 'insp';
    $data['desplegado'] = 'users';
 
    $data['usuarios'] = $this->usuarios->get_all_inspectores();
    

    $this->load->view(INSPECTORES_PATH . '/indexInspectores', $data);
  }

  //--------------------------------------------------------------
  public function frmNueva()
  {
    verificarConsulAjax();
    //$id_evento_deportivo = $this->session->userdata('id_evento_deportivo');

    $data['title'] = 'AdminGamerSport';
    $data['act'] = 'admigs';
    //$data['desplegado'] = 'gestion';
    $data['desplegado'] = 'gestionAdmin';

  
     $data['usuarios'] = $this->usuarios->get_all_adminGamer();

    

    $this->load->view(ADMIN_GAMERSPORT_PATH . '/frmNuevoAdminGamerSport', $data);
  }
  //--------------------------------------------------------------
  public function frmEditar($id_usuario)
  {
    verificarConsulAjax();
    
   
    $data['usuarios'] = $this->usuarios->get($id_usuario);
    

    $this->load->view(ADMIN_GAMERSPORT_PATH . '/frmEditarAdminGamerSport', $data);
  }


  //--------------------------------------------------------------
  public function frmVer($id_usuario)
  {
    verificarConsulAjax();

  
    $data['usuarios'] = $this->usuarios->get($id_usuario);



    $this->load->view(ADMIN_GAMERSPORT_PATH . '/frmVerAdminGamerSport', $data);
  }

  
  //--------------------------------------------------------------
  
  //--------------------------------------------------------------

//nueva vista de permisos
  


  //--------------------------------------------------------------



//---------------------------------------------------------------------------------
//--------------------------------------------------------------
 
    
//--------------------------------------------------------------


  //--------------------------------------------------------------
  public function crear()
  {
    verificarConsulAjax();

    $id_tipo_usuario = $this->input->post('idTipoUsuario');
    // Set validation rules for personal fields
    //$this->form_validation->set_rules('dni_personal', 'DNI', 'trim|required|min_length[7]|max_length[10]');
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('apellido', 'Apellido', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
    $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[8]|trim');
    $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[6]|trim');

    
    if ($this->form_validation->run()) :

      //check por mail duplicado
      $email = $this->input->post('email');
      $errorDuplicado = $this->controlDuplicado($email);
      if (!empty($errorDuplicado)) {
        return $this->response->error('Ooops.. controle!', $errorDuplicado);
      }
      $pass = $this->input->post('password');
      $url = base_url(ADMIN_PATH);
      $usuario_gamer = [
          'usuario_tipo_id' => (int)$id_tipo_usuario,
          //'medico_especialidad_id' => $this->input->post('medico_especialidad_id'),
          'nombre' => $this->input->post('nombre'),
          'apellido' => $this->input->post('apellido'),
          'telefono' => $this->input->post('telefono'),
          'foto' => 'no-user.jpg',
          'email' => $this->input->post('email'),
          'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
          //'matricula_usuario' => $this->input->post('matricula_usuario'),
      ];

      $resp = $this->usuarios->crear($usuario_gamer); // se inserta en bd
      
      if ($resp) {
        /* se envia mail de confirmación */
        $nuevoUsuario = $this->usuarios->get($resp);// se recupera el nuevo usuario
        $datosDeEnvio = array(
				'de'      => 'server.email@tresolqa.com',
				'titulo'  => $nuevoUsuario->nombre.' Bienvenido/a a TresolQA! ',
				'para'    => $nuevoUsuario->email,
				'asunto'  => "Comprobante de registro y datos de acceso a TresolQA",
				'mensaje' => "<hr><br>Nombre: ".$nuevoUsuario->nombre."<br>Apellido: ".$nuevoUsuario->apellido.
				"<br>Teléfono: ".$nuevoUsuario->telefono."<br>Domicilio: ".$nuevoUsuario->domicilio."<br><hr><u>Información de inicio de sesión</u>"."<br>Email: ".$nuevoUsuario->email."<br>Contraseña: ".$pass."<br><hr>"."<footer class='text-center mt-5'>
					  <span> 
						<a 
						  target='_blank' 
						  rel='noopener noreferrer' 
						  style='display: block; text-align: left; text-decoration: none; cursor: pointer;' 
						  href='". $url ."'
						>
						  Inicie Sesión Aquí
						</a> 
					  </span>
					</footer>",
			  );

		    $this->email($datosDeEnvio);//se envia email de confirmacion
      /*  */
        //$id_director_salvado = $this->db->insert_id();
       // $data['url'] = base_url(ADMIN_PATH);
        $data['selector'] = 'AdminGamerSport';
        $data['view'] = $this->getAdminGamerSport();

        return $this->response->ok('Nuevo Usuario Administrador agregado con Existo!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo agregar el Usuario Administrador. Intente más tarde!');
      }
    endif;

    return $this->response->error('Ooops.. controle!', $this->form_validation->error_array());
  } // fin de metodo crear
  //--------------------------------------------------------------
  // Callback function to validate the 'personal_id' field
  public function validate_personal_id($id_personal,$id_evento_deportivo) {
      if ($id_personal === '0') {
          $this->form_validation->set_message('validate_personal_id', 'Ingrese un personal válido.');
          return false;
      }

      // Check if the selected $personal_id already exists in your table personal_eventos associated with $id_evento_deportivo
      $personalExist = $this->personal_eventos->get_by_personal_evento($id_personal,$id_evento_deportivo);

      if ($personalExist) {
          $this->form_validation->set_message('validate_personal_id', 'El Personal ya se encuentra afectado al evento.');
          return false;
      }

      return true;
  }
  //--------------------------------------------------------------
  public function actualizar()
  {
    verificarConsulAjax();

    
    // Set validation rules for personal fields
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('apellido', 'Apellido', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
    $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[8]|trim');
    $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[6]|trim');

  
    
    
    if ($this->form_validation->run()) :
      $id_usuario = $this->input->post('idUsuario');
      $id_tipo_usuario = 6;
      $usuario_gamer = [
        'usuario_tipo_id' => (int)$id_tipo_usuario,
          //'medico_especialidad_id' => $this->input->post('medico_especialidad_id'),
          'nombre' => $this->input->post('nombre'),
          'apellido' => $this->input->post('apellido'),
          'telefono' => $this->input->post('telefono'),
          //'foto' => 'no-user.jpg',
          'email' => $this->input->post('email'),
          'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      ];

      $resp = $this->usuarios->actualizar($id_usuario,$usuario_gamer); // se actualiza en bd

      if ($resp) {
        //$id_director_salvado = $this->db->insert_id();
       // $data['url'] = base_url(MEDICOS_ADMIN_PATH);
       $data['selector'] = 'AdminGamerSport';
       $data['view'] = $this->getAdminGamerSport();

        return $this->response->ok('Administrador actualizado!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo modificar el Administrador. Intente más tarde!');
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
      return $this->response->ok('Administrador eliminado!');
    }

    return $this->response->error('Ooops.. error!', 'No se pudo eliminar el Administrador. Intente más tarde!');
  }

  //--------------------------------------------------------------
  

  /**
   * 
   * FUNCIONES PRIVADAS
   * 
   */
  private function email($datosEnvio){
    //$CI = &get_instance();

    $config = array(
      'protocol'  => 'smtp',
      'smtp_host' => 'smtp.hostinger.com',
      'smtp_user' => 'server.email@tresolqa.com',
      'smtp_pass' => 'Tresolqa-89',
      'smtp_port' => '465',
      'smtp_timeout' => '7',
      'smtp_crypto' => 'ssl',
      'charset'   => 'utf-8',
      'mailtype'  => 'html',
      'validate'  => TRUE,
      'wordwrap'  => TRUE,
    );

    $this->email->initialize($config);

    $this->email->from($datosEnvio['de'], $datosEnvio['titulo']);
    $this->email->to($datosEnvio['para']);
    $this->email->subject($datosEnvio['asunto']);
    $this->email->message($datosEnvio['mensaje']);
    $this->email->set_newline("\r\n");

    return $this->email->send();
  }
  //--------------------------------------------------------------
  private function getAdminGamerSport()
  {
       
    $data['usuarios'] = $this->usuarios->get_all_adminGamer();


    return $this->load->view(ADMIN_GAMERSPORT_PATH . '/_tblAdminGamerSport', $data, TRUE);
  }
  ///
  
  
  private function controlDuplicado($email)
  {
      $errorDuplicado = null;
      $resp = $this->usuarios->get_user_correo($email);
      if ($resp) {
          $errorDuplicado[$email] = 'Este correo electrónico ya está asociado a otra cuenta. Por favor, utiliza una dirección de correo diferente.';
      } 
      return $errorDuplicado;
  }

}
