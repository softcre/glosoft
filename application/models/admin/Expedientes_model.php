<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expedientes_model extends CI_Model
{
    private $table;
    private $tableEstados;
    private $tableUsuarios;
    private $tableProvincias;
    private $tableLocalidades;

    //--------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table = 'expedientes';
        $this->tableEstados = 'expedientes_estados';
        $this->tableUsuarios = 'usuarios';
        $this->tableProvincias = 'provincias';
        $this->tableLocalidades = 'localidades';
    }

    //--------------------------------------------------------------
    // List all expedientes
    public function get_all()
    {
        $this->db->select('
            e.*,
            es.nombre_estado,
            es.descripcion as estado_descripcion,
            u.nombre as inspector_nombre,
            u.apellido as inspector_apellido,
            p.nombre as provincia_nombre,
            l.nombre as localidad_nombre
        ');
        $this->db->from($this->table . ' e');
        $this->db->join($this->tableEstados . ' es', 'e.estado_id = es.id_estado', 'left');
        $this->db->join($this->tableUsuarios . ' u', 'e.inspector_id = u.id_usuario', 'left');
        $this->db->join($this->tableProvincias . ' p', 'e.provincia_id = p.id_provincia', 'left');
        $this->db->join($this->tableLocalidades . ' l', 'e.localidad_id = l.id_localidad', 'left');
        $this->db->where('e.deleted_at', null);
        $this->db->order_by('e.created_at', 'DESC');
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    // Get expediente by ID
    public function get($id_expediente)
    {
        $this->db->select('
            e.*,
            es.nombre_estado,
            es.descripcion as estado_descripcion,
            u.nombre as inspector_nombre,
            u.apellido as inspector_apellido,
            p.nombre as provincia_nombre,
            l.nombre as localidad_nombre
        ');
        $this->db->from($this->table . ' e');
        $this->db->join($this->tableEstados . ' es', 'e.estado_id = es.id_estado', 'left');
        $this->db->join($this->tableUsuarios . ' u', 'e.inspector_id = u.id_usuario', 'left');
        $this->db->join($this->tableProvincias . ' p', 'e.provincia_id = p.id_provincia', 'left');
        $this->db->join($this->tableLocalidades . ' l', 'e.localidad_id = l.id_localidad', 'left');
        $this->db->where('e.id_expediente', $id_expediente);
        $this->db->where('e.deleted_at', null);
        return $this->db->get()->row();
    }

    //--------------------------------------------------------------
    // Get expedientes by inspector
    public function get_by_inspector($inspector_id)
    {
        $this->db->select('
            e.*,
            es.nombre_estado,
            u.nombre as inspector_nombre,
            u.apellido as inspector_apellido,
            p.nombre as provincia_nombre,
            l.nombre as localidad_nombre
        ');
        $this->db->from($this->table . ' e');
        $this->db->join($this->tableEstados . ' es', 'e.estado_id = es.id_estado', 'left');
        $this->db->join($this->tableUsuarios . ' u', 'e.inspector_id = u.id_usuario', 'left');
        $this->db->join($this->tableProvincias . ' p', 'e.provincia_id = p.id_provincia', 'left');
        $this->db->join($this->tableLocalidades . ' l', 'e.localidad_id = l.id_localidad', 'left');
        $this->db->where('e.inspector_id', $inspector_id);
        $this->db->where('e.deleted_at', null);
        $this->db->order_by('e.created_at', 'DESC');
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    // Get expedientes by state
    public function get_by_estado($estado_id)
    {
        $this->db->select('
            e.*,
            es.nombre_estado,
            u.nombre as inspector_nombre,
            u.apellido as inspector_apellido,
            p.nombre as provincia_nombre,
            l.nombre as localidad_nombre
        ');
        $this->db->from($this->table . ' e');
        $this->db->join($this->tableEstados . ' es', 'e.estado_id = es.id_estado', 'left');
        $this->db->join($this->tableUsuarios . ' u', 'e.inspector_id = u.id_usuario', 'left');
        $this->db->join($this->tableProvincias . ' p', 'e.provincia_id = p.id_provincia', 'left');
        $this->db->join($this->tableLocalidades . ' l', 'e.localidad_id = l.id_localidad', 'left');
        $this->db->where('e.estado_id', $estado_id);
        $this->db->where('e.deleted_at', null);
        $this->db->order_by('e.created_at', 'DESC');
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    // Create expediente
    public function crear($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------
    // Update expediente
    public function actualizar($id_expediente, $data)
    {
        $this->db->where('id_expediente', $id_expediente);
        return $this->db->update($this->table, $data);
    }

    //--------------------------------------------------------------
    // Delete expediente (soft or hard delete)
    public function delete($id_expediente, $soft = true)
    {
        if ($soft) {
            $this->db->where('id_expediente', $id_expediente);
            return $this->db->update($this->table, ['deleted_at' => date('Y-m-d H:i:s')]);
        } else {
            $this->db->where('id_expediente', $id_expediente);
            $this->db->delete($this->table);
            return $this->db->affected_rows();
        }
    }

    //--------------------------------------------------------------
    // Change status by ID
    public function cambiar_estado($id_expediente, $estado_id)
    {
        $this->db->where('id_expediente', $id_expediente);
        return $this->db->update($this->table, [
            'estado_id' => $estado_id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    //--------------------------------------------------------------
    // Change status by state name
    public function cambiar_estado_nombre($id_expediente, $nombre_estado)
    {
        $estado = $this->db
            ->select('id_estado')
            ->where('UPPER(nombre_estado)', strtoupper($nombre_estado))
            ->get($this->tableEstados)
            ->row();

        if (!$estado) return false;

        return $this->cambiar_estado($id_expediente, $estado->id_estado);
    }

    //--------------------------------------------------------------
    // List all states
    public function get_estados()
    {
        return $this->db
            ->select('id_estado, nombre_estado, descripcion')
            ->order_by('id_estado', 'ASC')
            ->get($this->tableEstados)
            ->result();
    }

    //--------------------------------------------------------------
    // Search expedientes by location or observations
    public function buscar($keyword)
    {
        $this->db->select('
            e.*,
            es.nombre_estado,
            u.nombre as inspector_nombre,
            u.apellido as inspector_apellido,
            p.nombre as provincia_nombre,
            l.nombre as localidad_nombre
        ');
        $this->db->from($this->table . ' e');
        $this->db->join($this->tableEstados . ' es', 'e.estado_id = es.id_estado', 'left');
        $this->db->join($this->tableUsuarios . ' u', 'e.inspector_id = u.id_usuario', 'left');
        $this->db->join($this->tableProvincias . ' p', 'e.provincia_id = p.id_provincia', 'left');
        $this->db->join($this->tableLocalidades . ' l', 'e.localidad_id = l.id_localidad', 'left');
        $this->db->group_start();
        $this->db->like('e.ubicacion', $keyword);
        $this->db->or_like('e.observaciones', $keyword);
        $this->db->group_end();
        $this->db->where('e.deleted_at', null);
        $this->db->order_by('e.created_at', 'DESC');
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    // Get expedientes en progreso (excluding CIERRE status)
    public function get_en_progreso()
    {
        $this->db->select('
            e.*,
            es.nombre_estado,
            es.descripcion as estado_descripcion,
            u.nombre as inspector_nombre,
            u.apellido as inspector_apellido,
            p.nombre as provincia_nombre,
            l.nombre as localidad_nombre
        ');
        $this->db->from($this->table . ' e');
        $this->db->join($this->tableEstados . ' es', 'e.estado_id = es.id_estado', 'left');
        $this->db->join($this->tableUsuarios . ' u', 'e.inspector_id = u.id_usuario', 'left');
        $this->db->join($this->tableProvincias . ' p', 'e.provincia_id = p.id_provincia', 'left');
        $this->db->join($this->tableLocalidades . ' l', 'e.localidad_id = l.id_localidad', 'left');
        $this->db->where('e.deleted_at', null);
        $this->db->where('UPPER(es.nombre_estado) !=', 'CIERRE');
        $this->db->order_by('e.created_at', 'DESC');
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    // Get expedientes cerrados (only CIERRE status)
    public function get_cerrados()
    {
        $this->db->select('
            e.*,
            es.nombre_estado,
            es.descripcion as estado_descripcion,
            u.nombre as inspector_nombre,
            u.apellido as inspector_apellido,
            p.nombre as provincia_nombre,
            l.nombre as localidad_nombre
        ');
        $this->db->from($this->table . ' e');
        $this->db->join($this->tableEstados . ' es', 'e.estado_id = es.id_estado', 'left');
        $this->db->join($this->tableUsuarios . ' u', 'e.inspector_id = u.id_usuario', 'left');
        $this->db->join($this->tableProvincias . ' p', 'e.provincia_id = p.id_provincia', 'left');
        $this->db->join($this->tableLocalidades . ' l', 'e.localidad_id = l.id_localidad', 'left');
        $this->db->where('e.deleted_at', null);
        $this->db->where('UPPER(es.nombre_estado)', 'CIERRE');
        $this->db->order_by('e.created_at', 'DESC');
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    // Get all provincias
    public function get_provincias()
    {
        $this->db->select('id_provincia, nombre');
        $this->db->from($this->tableProvincias);
        $this->db->order_by('nombre', 'ASC');
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    // Get localidades by provincia_id
    public function get_localidades_by_provincia($provincia_id)
    {
        $this->db->select('id_localidad, nombre');
        $this->db->from($this->tableLocalidades);
        $this->db->where('provincia_id', $provincia_id);
        $this->db->order_by('nombre', 'ASC');
        return $this->db->get()->result();
    }
}
