<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Denuncias_model extends CI_Model
{
    private $table;
    private $pk;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'denuncias';
        $this->pk = 'id_denuncia';
    }

    //--------------------------------------------------------------
    public function get_all()
    {
        $this->db->from($this->table . ' d');
        $this->db->where('d.deleted_at', null);
        $this->db->order_by('d.created_at', 'DESC');
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    public function get($id_denuncia)
    {
        $this->db->from($this->table . ' d');
        $this->db->where('d.' . $this->pk, $id_denuncia);
        return $this->db->get()->row();
    }

    //--------------------------------------------------------------
    public function crear($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------
    public function actualizar($id_denuncia, $data)
    {
        $this->db->where($this->pk, $id_denuncia);
        return $this->db->update($this->table, $data);
    }

    //--------------------------------------------------------------
    public function delete($id_denuncia)
    {
        $this->db->where($this->pk, $id_denuncia);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    //--------------------------------------------------------------
    public function soft_delete($id_denuncia)
    {
        $this->db->where($this->pk, $id_denuncia);
        return $this->db->update($this->table, ['deleted_at' => date('Y-m-d')]);
    }
}
