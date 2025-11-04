<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{

	//--------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		// verificarSesionAdmin();
	}

	//--------------------------------------------------------------
	public function index()
	{
		$data['title'] = 'Inicio';
		$data['act'] = 'dash';
		$data['desplegado'] = '';
    
		$this->load->view('admin/dashboard/indexDashboard', $data);
	}
}