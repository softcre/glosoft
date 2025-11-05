<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empleadores_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'empleadores';
    }

    //--------------------------------------------------------------
    public function get_all()
    {
        $this->db->from($this->table . ' e');
        $this->db->where('e.deleted_at', null);
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    public function get($id_empleador)
    {
        $this->db->from($this->table . ' e');
        $this->db->where('e.id_empleador', $id_empleador);
        return $this->db->get()->row();
    }

    //--------------------------------------------------------------
    public function get_by_cuit($cuit)
    {
        $this->db->from($this->table . ' e');
        $this->db->where('e.cuit', $cuit);
        $this->db->where('e.deleted_at', null);
        return $this->db->get()->row();
    }

    //--------------------------------------------------------------
    public function crear($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------
    public function actualizar($id_empleador, $data)
    {
        $this->db->where('id_empleador', $id_empleador);
        return $this->db->update($this->table, $data);
    }

    //--------------------------------------------------------------
    public function delete($id_empleador)
    {
        $this->db->where('id_empleador', $id_empleador);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
