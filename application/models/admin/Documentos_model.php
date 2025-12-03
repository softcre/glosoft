<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos_model extends CI_Model
{
    private $table = 'documentos_inspeccion';
    private $pk    = 'id_documento';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // --------------------------------------------------------------
    // GET ALL 
    // --------------------------------------------------------------
    public function get_all()
    {
        return $this->db
            ->from($this->table . ' d')
            ->where('d.deleted_at', null)
            ->order_by('d.created_at', 'DESC')
            ->get()
            ->result();
    }

    // --------------------------------------------------------------
    // GET BY ID
    // --------------------------------------------------------------
    public function get($id_documento)
    {
        return $this->db
            ->where($this->pk, $id_documento)
            ->get($this->table)
            ->row();
    }

    // --------------------------------------------------------------
    // GET BY INSPECCION 
    // --------------------------------------------------------------
    public function get_by_inspeccion($inspeccion_id)
    {
        return $this->db
            ->where('inspeccion_id', $inspeccion_id)
            ->where('deleted_at', null)
            ->order_by('created_at', 'DESC')
            ->get($this->table)
            ->result();
    }

    // Alias (standardizing naming)
    public function obtenerPorInspeccion($inspeccion_id)
    {
        return $this->get_by_inspeccion($inspeccion_id);
    }

    // --------------------------------------------------------------
    // CREATE
    // --------------------------------------------------------------
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Alias (for UX symmetry with audios->crear)
    public function crear($data)
    {
        return $this->save($data);
    }

    // --------------------------------------------------------------
    // UPDATE
    // --------------------------------------------------------------
    public function actualizar($id_documento, $data)
    {
        return $this->db
            ->where($this->pk, $id_documento)
            ->update($this->table, $data);
    }

    // --------------------------------------------------------------
    // HARD DELETE 
    // --------------------------------------------------------------
    public function delete($id_documento)
    {
        $this->db->where($this->pk, $id_documento);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    // --------------------------------------------------------------
    // SOFT DELETE 
    // --------------------------------------------------------------
    public function soft_delete($id_documento)
    {
        return $this->db
            ->where($this->pk, $id_documento)
            ->update($this->table, [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
    }
}
