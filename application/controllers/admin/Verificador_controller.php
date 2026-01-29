<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation Optional description
 * @property CI_Input $input Optional description
 * @property Response $response Optional description
 */
class Verificador_controller extends CI_Controller
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
    $data['title'] = 'Verificador';
    $data['act'] = 'veri';
    $data['desplegado'] = 'users';
 
    $data['usuarios'] = $this->usuarios->get_all_verificadores();
    

    $this->load->view(VERIFICADORES_PATH . '/indexVerificadores', $data);
  }

  //--------------------------------------------------------------
  public function frmNueva()
  {
    verificarConsulAjax();
    //$id_evento_deportivo = $this->session->userdata('id_evento_deportivo');

    $data['title'] = 'Verificador';
    $data['act'] = 'veri';
    $data['desplegado'] = 'users';

  
     $data['usuarios'] = $this->usuarios->get_all_verificadores();

    

    $this->load->view(VERIFICADORES_PATH . '/frmNuevoVerificador', $data);
  }
  //--------------------------------------------------------------
  public function frmEditar($id_usuario)
  {
    verificarConsulAjax();
    
   
    $data['usuarios'] = $this->usuarios->get($id_usuario);
    

    $this->load->view(VERIFICADORES_PATH . '/frmEditarVerificador', $data);
  }


  //--------------------------------------------------------------
  public function frmVer($id_usuario)
  {
    verificarConsulAjax();

  
    $data['usuarios'] = $this->usuarios->get($id_usuario);



    $this->load->view(VERIFICADORES_PATH . '/frmVerVerificador', $data);
  }

  
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
    $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|trim');
    $this->form_validation->set_rules('user_pass', 'contraseña', 'required|min_length[8]|trim');
    $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[6]|trim');

    
    if ($this->form_validation->run()) :

      //check por mail duplicado
      $email = $this->input->post('user_email');
      $errorDuplicado = $this->controlDuplicado($email);
      if (!empty($errorDuplicado)) {
        return $this->response->error('Ooops.. controle!', $errorDuplicado);
      }
      $pass = $this->input->post('password');
      $url = base_url(ADMIN_PATH);
      $usuario_verificador = [
          'usuario_tipo_id' => (int)$id_tipo_usuario,
          //'medico_especialidad_id' => $this->input->post('medico_especialidad_id'),
          'nombre' => $this->input->post('nombre'),
          'apellido' => $this->input->post('apellido'),
          'telefono' => $this->input->post('telefono'),
          'foto' => 'no-user.png',
          'email' => $this->input->post('user_email'),
          'password' => password_hash($this->input->post('user_pass'), PASSWORD_DEFAULT),
          //'matricula_usuario' => $this->input->post('matricula_usuario'),
      ];

      $resp = $this->usuarios->crear($usuario_verificador); // se inserta en bd
      
      if ($resp) {
        /* se envia mail de confirmación */
        $nuevoUsuario = $this->usuarios->get($resp);// se recupera el nuevo usuario
        /* $datosDeEnvio = array(
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
			  ); */

		   // $this->email($datosDeEnvio);//se envia email de confirmacion
      /*  */
        //$id_director_salvado = $this->db->insert_id();
       // $data['url'] = base_url(ADMIN_PATH);
        $data['selector'] = 'Verificadores';
        $data['view'] = $this->getVerificadores();

        return $this->response->ok('Nuevo Usuario Verificador agregado con Existo!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo agregar el Usuario Verificador. Intente más tarde!');
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
    //$this->form_validation->set_rules('user_pass', 'contraseña', 'required|min_length[8]|trim');
    $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[6]|trim');

  
    
    
    if ($this->form_validation->run()) :
      $id_usuario = $this->input->post('idUsuario');
      $id_tipo_usuario = 4;
      $usuario_verificador = [
        'usuario_tipo_id' => (int)$id_tipo_usuario,
          //'medico_especialidad_id' => $this->input->post('medico_especialidad_id'),
          'nombre' => $this->input->post('nombre'),
          'apellido' => $this->input->post('apellido'),
          'telefono' => $this->input->post('telefono'),
          //'foto' => 'no-user.jpg',
          'email' => $this->input->post('user_email'),
          //'password' => password_hash($this->input->post('user_pass'), PASSWORD_DEFAULT),
      ];

      $resp = $this->usuarios->actualizar($id_usuario,$usuario_verificador); // se actualiza en bd

      if ($resp) {
        //$id_director_salvado = $this->db->insert_id();
       // $data['url'] = base_url(MEDICOS_ADMIN_PATH);
       $data['selector'] = 'Verificadores';
       $data['view'] = $this->getVerificadores();

        return $this->response->ok('Verificador actualizado!', $data);
      } else {

        return $this->response->error('Ooops.. error!', 'No se pudo modificar el Verificador. Intente más tarde!');
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
      return $this->response->ok('Verificador eliminado!');
    }

    return $this->response->error('Ooops.. error!', 'No se pudo eliminar el Verificador. Intente más tarde!');
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
  private function getVerificadores()
  {
       
    $data['usuarios'] = $this->usuarios->get_all_verificadores();


    return $this->load->view(VERIFICADORES_PATH . '/_tblVerificadores', $data, TRUE);
  }
  ///
  
  
//------------------------------------------------------- 
  private function controlDuplicado($email)
  {
      $errorDuplicado = null;

      // if email is null/empty skip lookup and return null (no error)
      if (empty($email)) {
          return $errorDuplicado;
      }

      // normalize
      $email = trim(strtolower($email));

      // lookup
      $resp = $this->usuarios->get_user_correo_full($email);

      if ($resp) {
          // Normalize the db email for comparison (in case DB stores mixed case or whitespace)
          $dbEmail = isset($resp->email) ? trim(strtolower($resp->email)) : '';

          // If they differ (unlikely) still treat as duplicate since query found a row
          // Check deleted_at variants: null, empty string, or MySQL zero datetime
          $deletedAt = isset($resp->deleted_at) ? $resp->deleted_at : null;
          $isDeleted = !(
              $deletedAt === null ||
              $deletedAt === '' ||
              $deletedAt === '0000-00-00' ||
              $deletedAt === '0000-00-00 00:00:00'
          );

          if ($isDeleted) {
              $errorDuplicado[$email] = 'Este correo electrónico pertenece a un usuario eliminado. Debes restaurar la cuenta o usar un correo diferente.';
          } else {
              $errorDuplicado[$email] = 'Este correo electrónico ya está asociado a otra cuenta. Por favor, utiliza una dirección de correo diferente.';
          }
      }

      return $errorDuplicado;
  }

}
