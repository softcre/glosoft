<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audios_model extends CI_Model
{
    private $table = 'audios';
    private $pk = 'id_audio';

    public function get_by_inspeccion($id)
    {
        return $this->db
            ->where("inspeccion_id", $id)
            ->order_by("created_at", "DESC")
            ->get($this->table)
            ->result();
    }

    public function get($id_audio)
    {
        return $this->db
            ->where("id_audio", $id_audio)
            ->get($this->table)
            ->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function crear($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }


    public function obtenerPorInspeccion($inspeccion_id)
    {
        return $this->db
            ->where('inspeccion_id', $inspeccion_id)
            ->order_by('id_audio', 'DESC')
            ->get($this->table)
            ->result();
    }
}
