<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Denuncia_controller extends CI_Controller
{

	//--------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		$this->load->model(EXPEDIENTES_MODEL, 'expedientes');
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
}
