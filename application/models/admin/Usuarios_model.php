<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
    private $table;
    private $tableUsuariosTipo;

    //--------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table = 'usuarios';
        $this->tableUsuariosTipo = 'usuarios_tipo';
    }

    //--------------------------------------------------------------
    public function get_all()
    {
        $this->db->from($this->table . ' u');
        $this->db->join($this->tableUsuariosTipo . ' ut', 'u.usuario_tipo_id = ut.id_tipo_usuario', 'left');
        $this->db->where('u.deleted_at', null);
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    public function get_all_inspectores()
    {
        $this->db->from($this->table . ' u');
        $this->db->join($this->tableUsuariosTipo . ' ut', 'u.usuario_tipo_id = ut.id_tipo_usuario', 'left');
        $this->db->where('u.usuario_tipo_id', 3);
        $this->db->where('u.deleted_at', null);
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    public function get_all_verificadores()
    {
        $this->db->from($this->table . ' u');
        $this->db->join($this->tableUsuariosTipo . ' ut', 'u.usuario_tipo_id = ut.id_tipo_usuario', 'left');
        $this->db->where('u.usuario_tipo_id', 4);
        $this->db->where('u.deleted_at', null);
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    public function get_all_liquidadores()
    {
        $this->db->from($this->table . ' u');
        $this->db->join($this->tableUsuariosTipo . ' ut', 'u.usuario_tipo_id = ut.id_tipo_usuario', 'left');
        $this->db->where('u.usuario_tipo_id', 5);
        $this->db->where('u.deleted_at', null);
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    public function get_all_deleted()
    {
        $this->db->from($this->table . ' u');
        $this->db->join($this->tableUsuariosTipo . ' ut', 'u.usuario_tipo_id = ut.id_tipo_usuario', 'left');
        $this->db->where('u.deleted_at IS NOT NULL', null, false);
        return $this->db->get()->result();
    }

    //--------------------------------------------------------------
    public function get($id_usuario)
    {
        $this->db->select('u.*, ut.*');
        $this->db->from($this->table . ' u');
        $this->db->join($this->tableUsuariosTipo . ' ut', 'u.usuario_tipo_id = ut.id_tipo_usuario', 'left');
        $this->db->where('u.id_usuario', $id_usuario);
        return $this->db->get()->row();
    }

    //--------------------------------------------------------------
    public function get_user_correo($correo)
    {
        $this->db->where('email', $correo);
        $this->db->where('deleted_at', null);
        return $this->db->get($this->table)->row();
    }

    //--------------------------------------------------------------
    public function get_user_correo_full($correo)
    {
        $this->db->where('email', $correo);
        return $this->db->get($this->table)->row();
    }

    //--------------------------------------------------------------
    public function get_user_correo_id($correo, $id_usuario)
    {
        $this->db->where('email', $correo);
        $this->db->where('id_usuario !=', $id_usuario);
        $this->db->where('deleted_at', null);
        return $this->db->get($this->table)->row();
    }

    //--------------------------------------------------------------
    public function crear($usuario)
    {
        $this->db->insert($this->table, $usuario);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------
    public function actualizar($id_usuario, $usuario)
    {
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update($this->table, $usuario);
    }

    //--------------------------------------------------------------
    public function delete($id_usuario)
    {
        $this->db->where('id_usuario', $id_usuario);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    /* ============================================================
     *   MÉTODOS NUEVOS PARA LOGIN CON GOOGLE
     * ============================================================ */

    //--------------------------------------------------------------
    // Busca usuario por google_id
    public function getByGoogleId($gid)
    {
        $this->db->where('google_id', $gid);
        $this->db->where('deleted_at', null);
        return $this->db->get($this->table)->row();
    }

    //--------------------------------------------------------------
    // Guarda el google_id en usuarios existentes
    public function updateGoogleId($userId, $gid)
    {
        return $this->db
            ->where('id_usuario', $userId)
            ->update($this->table, ['google_id' => $gid]);
    }
}
