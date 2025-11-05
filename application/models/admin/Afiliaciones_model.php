<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Afiliaciones_model extends CI_Model
{
    private $table;
    private $tableEmpleadores;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'afiliaciones';
        $this->tableEmpleadores = 'empleadores';
    }

    //--------------------------------------------------------------
    public function get_all()
    {
        $this->db->from($this->table . ' a');
        $this->db->join($this->tableEmpleadores . ' e', 'a.empleador_id = e.id_empleador', 'left');
        $this->db->where('a.deleted_at', null);
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    public function get($id_afiliacion)
    {
        $this->db->select('a.*, e.razon_social, e.cuit');
        $this->db->from($this->table . ' a');
        $this->db->join($this->tableEmpleadores . ' e', 'a.empleador_id = e.id_empleador', 'left');
        $this->db->where('a.id_afiliacion', $id_afiliacion);
        return $this->db->get()->row();
    }

    //--------------------------------------------------------------
    public function get_by_cuil($cuil)
    {
        $this->db->where('cuil', $cuil);
        $this->db->where('deleted_at', null);
        return $this->db->get($this->table)->row();
    }

    //--------------------------------------------------------------
    public function crear($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------
    public function actualizar($id_afiliacion, $data)
    {
        $this->db->where('id_afiliacion', $id_afiliacion);
        return $this->db->update($this->table, $data);
    }

    //--------------------------------------------------------------
    public function delete($id_afiliacion)
    {
        $this->db->where('id_afiliacion', $id_afiliacion);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
