<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trabajadores_encontrados_model extends CI_Model
{
    private $table;
    private $tableInspecciones;
    private $tableAfiliaciones;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table = 'trabajadores_encontrados';
        $this->tableInspecciones = 'inspecciones';
        $this->tableAfiliaciones = 'afiliaciones';
    }

    // --------------------------------------------------------------
    // Obtener todos los trabajadores encontrados (con relaciones)
    public function get_all()
    {
        $this->db->select('t.*, i.fecha_inspeccion, i.lugar, a.numero_acta, a.fecha_acta');
        $this->db->from($this->table . ' t');
        $this->db->join($this->tableInspecciones . ' i', 't.inspeccion_id = i.id_inspeccion', 'left');
        $this->db->join($this->tableAfiliaciones . ' a', 't.afiliacion_id = a.id_afiliacion', 'left');
        $this->db->order_by('t.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // --------------------------------------------------------------
    // Obtener trabajadores por ID de inspección
    public function get_by_inspeccion($id_inspeccion)
    {
        $this->db->select('t.id_trabajador_encontrado, t.inspeccion_id, t.afiliacion_id, t.cargo, t.fecha_ingreso, t.remuneracion, t.alojado_en_predio, t.estado_al_inspeccionar, a.*');
        $this->db->from($this->table . ' t');
        $this->db->join($this->tableAfiliaciones . ' a', 't.afiliacion_id = a.id_afiliacion', 'left');
        $this->db->where('t.inspeccion_id', $id_inspeccion);
        $this->db->order_by('a.apellido', 'ASC');
        return $this->db->get()->result();
    }

    public function get_total_sin_afiliar_by_inspeccion($id_inspeccion)
    {
        $this->db->select('COUNT(*) total_sin_afiliar');
        $this->db->from($this->table . ' t');
        $this->db->where('t.inspeccion_id', $id_inspeccion);
        $this->db->where('t.estado_al_inspeccionar', 'NO_AFILIADO');
        return $this->db->get()->row();
    }

    public function get_by_inspeccion_afiliacion($id_inspeccion, $id_afiliacion)
    {
        $this->db->select('t.id_trabajador_encontrado, t.inspeccion_id, t.afiliacion_id, t.cargo, t.fecha_ingreso, t.remuneracion, t.alojado_en_predio, t.estado_al_inspeccionar, a.*');
        $this->db->from($this->table . ' t');
        $this->db->join($this->tableAfiliaciones . ' a', 't.afiliacion_id = a.id_afiliacion', 'left');
        $this->db->where('t.inspeccion_id', $id_inspeccion);
        $this->db->where('t.afiliacion_id', $id_afiliacion);
        $this->db->order_by('a.apellido', 'ASC');
        return $this->db->get()->row();
    }

    // --------------------------------------------------------------
    // Obtener un trabajador por ID
    public function get($id_trabajador_encontrado)
    {
        $this->db->select('t.*, i.fecha_inspeccion, i.lugar, a.numero_acta, a.fecha_acta');
        $this->db->from($this->table . ' t');
        $this->db->join($this->tableInspecciones . ' i', 't.inspeccion_id = i.id_inspeccion', 'left');
        $this->db->join($this->tableAfiliaciones . ' a', 't.afiliacion_id = a.id_afiliacion', 'left');
        $this->db->where('t.id_trabajador_encontrado', $id_trabajador_encontrado);
        return $this->db->get()->row();
    }

    // --------------------------------------------------------------
    // Crear un nuevo trabajador encontrado
    public function crear($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // --------------------------------------------------------------
    // Actualizar datos de un trabajador encontrado
    public function actualizar($id_trabajador_encontrado, $data)
    {
        $this->db->where('id_trabajador_encontrado', $id_trabajador_encontrado);
        return $this->db->update($this->table, $data);
    }

    // --------------------------------------------------------------
    // Eliminar trabajador (borrado físico o lógico, según preferencia)
    public function delete($id_trabajador_encontrado)
    {
        $this->db->where('id_trabajador_encontrado', $id_trabajador_encontrado);
        return $this->db->delete($this->table);
    }

    // --------------------------------------------------------------
    // Asignar afiliación a un trabajador
    public function asignar_afiliacion($id_trabajador_encontrado, $id_afiliacion)
    {
        $this->db->where('id_trabajador_encontrado', $id_trabajador_encontrado);
        return $this->db->update($this->table, ['afiliacion_id' => $id_afiliacion]);
    }

    // --------------------------------------------------------------
    // Buscar trabajador por DNI o documento (útil para evitar duplicados)
    public function buscar_por_documento($documento)
    {
        $this->db->from($this->table);
        $this->db->where('documento', $documento);
        return $this->db->get()->row();
    }

    // --------------------------------------------------------------
    // Contar trabajadores en una inspección
    public function contar_por_inspeccion($id_inspeccion)
    {
        $this->db->from($this->table);
        $this->db->where('inspeccion_id', $id_inspeccion);
        return $this->db->count_all_results();
    }
}
