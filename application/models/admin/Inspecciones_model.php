<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inspecciones_model extends CI_Model
{
    private $table;
    private $tableEstados;
    private $tableExpedientes;
    private $tableEmpleadores;
    private $tableUsuarios; // if inspectors are users

    //--------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table = 'inspecciones';
        $this->tableExpedientes = 'expedientes';
        $this->tableEstados = 'expedientes_estados';
        $this->tableEmpleadores = 'empleadores';
        $this->tableUsuarios = 'usuarios'; // optional, only if you link inspectors to usuarios
    }

    //--------------------------------------------------------------
    // List all inspections
    public function get_all()
    {
        //$this->db->select('i.*, e.nombre_estado, e.descripcion as estado_descripcion, u.nombre as inspector_nombre, u.apellido as inspector_apellido');
        $this->db->select('i.*, exp.inspector_id, exp.estado_id, e.nombre_estado');
        $this->db->from($this->table . ' i');
        $this->db->join($this->tableExpedientes . ' exp', 'exp.inspeccion_id = i.id_inspeccion');
        $this->db->join($this->tableEstados . ' e', 'e.id_estado = exp.estado_id', 'left');
        //$this->db->join($this->tableUsuarios . ' u', 'i.inspector_id = u.id_usuario', 'left');
        // $this->db->where('i.deleted_at', null);
        $this->db->where('exp.deleted_at', null);
        $this->db->order_by('i.created_at', 'DESC');
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    // Get single inspection by ID
    public function get($id_inspeccion)
    {
        //$this->db->select('i.*, e.nombre_estado, e.descripcion as estado_descripcion, u.nombre as inspector_nombre, u.apellido as inspector_apellido');
        $this->db->select('i.*, e.razon_social, e.cuit, e.domicilio, e.responsable_nombre');
        $this->db->from($this->table . ' i');
        $this->db->join($this->tableEmpleadores . ' e', 'e.id_empleador = i.empleador_id', 'left');
        //$this->db->join($this->tableEstados . ' e', 'i.estado_id = e.id_estado', 'left');
        //$this->db->join($this->tableUsuarios . ' u', 'i.inspector_id = u.id_usuario', 'left');
        $this->db->where('i.id_inspeccion', $id_inspeccion);
        // $this->db->where('i.deleted_at', null);
        return $this->db->get()->row();
    }

    //--------------------------------------------------------------
    // Get inspections filtered by state
    /* public function get_by_estado($estado_id)
    {
        $this->db->select('i.*, e.nombre_estado, u.nombre as inspector_nombre, u.apellido as inspector_apellido');
        $this->db->from($this->table . ' i');
        $this->db->join($this->tableEstados . ' e', 'i.estado_id = e.id_estado', 'left');
        $this->db->join($this->tableUsuarios . ' u', 'i.inspector_id = u.id_usuario', 'left');
        $this->db->where('i.estado_id', $estado_id);
        $this->db->where('i.deleted_at', null);
        $this->db->order_by('i.created_at', 'DESC');
        return $this->db->get()->result();
    } */

    //--------------------------------------------------------------
    // Create inspection
    public function crear($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------
    // Update inspection
    public function actualizar($id_inspeccion, $data)
    {
        $this->db->where('id_inspeccion', $id_inspeccion);
        return $this->db->update($this->table, $data);
    }

    //--------------------------------------------------------------
    // Delete inspection (soft or hard delete)
    public function delete($id_inspeccion, $soft = true)
    {
        if ($soft) {
            $this->db->where('id_inspeccion', $id_inspeccion);
            return $this->db->update($this->table, ['deleted_at' => date('Y-m-d H:i:s')]);
        } else {
            $this->db->where('id_inspeccion', $id_inspeccion);
            $this->db->delete($this->table);
            return $this->db->affected_rows();
        }
    }

    //--------------------------------------------------------------
    // Change status by ID
    /* public function cambiar_estado($id_inspeccion, $estado_id)
    {
        $this->db->where('id_inspeccion', $id_inspeccion);
        return $this->db->update($this->table, [
            'estado_id' => $estado_id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    } */

    //--------------------------------------------------------------
    // Change status by status name
    /* public function cambiar_estado_nombre($id_inspeccion, $nombre_estado)
    {
        $estado = $this->db
            ->select('id_estado')
            ->where('UPPER(nombre_estado)', strtoupper($nombre_estado))
            ->get($this->tableEstados)
            ->row();

        if (!$estado) return false;

        return $this->cambiar_estado($id_inspeccion, $estado->id_estado);
    } */

    //--------------------------------------------------------------
    // List available statuses
   /*  public function get_estados()
    {
        return $this->db
            ->select('id_estado, nombre_estado, descripcion')
            ->order_by('id_estado', 'ASC')
            ->get($this->tableEstados)
            ->result();
    }
 */
}
