<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Denuncia_controller extends CI_Controller
{

	//--------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		$this->load->model(EXPEDIENTES_MODEL, 'expedientes');
		$this->load->model(DENUNCIAS_MODEL, 'denuncias');
	}

	//--------------------------------------------------------------
	public function index()
	{
		$data['title'] = 'Denuncias';
		$data['provincias'] = $this->expedientes->get_provincias();
		$this->load->view('admin/denuncia', $data);
	}

	//--------------------------------------------------------------
	public function getLocalidades()
	{
		$provincia_id = $this->input->post('provincia_id');
		
		if (!$provincia_id) {
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'Provincia no especificada']);
			return;
		}

		$localidades = $this->expedientes->get_localidades_by_provincia($provincia_id);
		
		header('Content-Type: application/json');
		echo json_encode(['status' => 'ok', 'message' => 'Localidades cargadas', 'data' => ['localidades' => $localidades]]);
	}

	//--------------------------------------------------------------
	public function crear()
	{
		// Form validation
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'trim');
		$this->form_validation->set_rules('contacto_alt', 'Contacto alternativo', 'trim');
		$this->form_validation->set_rules('razon_social', 'Razón Social', 'trim');
		$this->form_validation->set_rules('cuit', 'CUIT', 'trim');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

		if ($this->form_validation->run()) {
			// Handle file upload if present
			$archivo = NULL;
			if (!empty($_FILES['archivo']['name'])) {
				$filename = $this->document->subirDocumento(
					'archivo',
					'denuncias'
				);
				if ($filename) {
					$archivo = 'assets/uploads/denuncias/' . $filename;
				}
			}

			$denuncia = [
				'nombre' => $this->input->post('nombre'),
				'email' => $this->input->post('email'),
				'telefono' => $this->input->post('telefono') ? $this->input->post('telefono') : NULL,
				'contacto_alt' => $this->input->post('contacto_alt') ? $this->input->post('contacto_alt') : NULL,
				'razon_social' => $this->input->post('razon_social') ? $this->input->post('razon_social') : NULL,
				'cuit' => $this->input->post('cuit') ? $this->input->post('cuit') : NULL,
				'provincia_id' => $this->input->post('provincia_id') ? $this->input->post('provincia_id') : NULL,
				'localidad_id' => $this->input->post('localidad_id') ? $this->input->post('localidad_id') : NULL,
				'archivo' => $archivo,
				'descripcion' => $this->input->post('descripcion') ? $this->input->post('descripcion') : NULL
			];

			$id_denuncia = $this->denuncias->crear($denuncia);

			if ($id_denuncia) {
				$data['url'] = base_url(ADMIN_PATH);
				return $this->response->ok('Denuncia enviada correctamente', $data);
			} else {
				return $this->response->error('Error', 'No se pudo enviar la denuncia. Intente más tarde.');
			}
		}

		return $this->response->error('Error de validación', $this->form_validation->error_array());
	}
}
