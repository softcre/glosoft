<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audios_model extends CI_Model
{
    private $table = 'audios';
    private $pk = 'id_audio';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //----------------------------------------------------------------------
    // GET ALL (only active if using soft deletes)
    //----------------------------------------------------------------------
    public function get_all()
    {
        $this->db->from($this->table . ' a');
        $this->db->where('a.deleted_at', null);   // comment this out if not using soft delete
        return $this->db->get()->result();
    }

    //----------------------------------------------------------------------
    // GET by ID (already existed)
    //----------------------------------------------------------------------
    public function get($id_audio)
    {
        return $this->db
            ->where($this->pk, $id_audio)
            ->get($this->table)
            ->row();
    }

    //----------------------------------------------------------------------
    // GET BY INSPECCION (already existed but standardized to snake_case name)
    //----------------------------------------------------------------------
    public function get_by_inspeccion($id)
    {
        return $this->db
            ->where("inspeccion_id", $id)
            ->where("deleted_at", null)
            ->order_by("created_at", "DESC")
            ->get($this->table)
            ->result();
    }

    //----------------------------------------------------------------------
    // ALIAS (this already existed)
    //----------------------------------------------------------------------
    public function obtenerPorInspeccion($inspeccion_id)
    {
        return $this->db
            ->where("inspeccion_id", $inspeccion_id)
            ->where("deleted_at", null)
            ->order_by("id_audio", "DESC")
            ->get($this->table)
            ->result();
    }

    //----------------------------------------------------------------------
    // CREATE (already existed)
    //----------------------------------------------------------------------
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //----------------------------------------------------------------------
    // CREATE alias (already existed)
    //----------------------------------------------------------------------
    public function crear($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //----------------------------------------------------------------------
    // UPDATE
    //----------------------------------------------------------------------
    public function actualizar($id_audio, $data)
    {
        $this->db->where($this->pk, $id_audio);
        return $this->db->update($this->table, $data);
    }

    //----------------------------------------------------------------------
    // HARD DELETE (physical deletion)
    //----------------------------------------------------------------------
    public function delete($id_audio)
    {
        $this->db->where($this->pk, $id_audio);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    //----------------------------------------------------------------------
    // SOFT DELETE (recommended)
    //----------------------------------------------------------------------
    public function soft_delete($id_audio)
    {
        $this->db->where($this->pk, $id_audio);
        return $this->db->update($this->table, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }
}
