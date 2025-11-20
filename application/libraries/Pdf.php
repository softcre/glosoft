<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class Pdf
{
    protected $CI;
    protected $dompdf;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->dompdf = new Dompdf();
    }

    public function load_view($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);

        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        $this->dompdf->stream("output.pdf", array("Attachment" => false));
    }
    //se usa para acta de inspección
    public function load_view_acta_inspeccion($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        $nombre = $data['nombre_acta'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("'$nombre'_UATRE.pdf", array("Attachment" => false));
    }
    //se usa para acta de afiliación
    public function load_view_acta_afiliacion($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        $nombre = $data['nombre_acta'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("'$nombre'_UATRE.pdf", array("Attachment" => false));
    }
    //se usa para ticket de creacion de club
    public function load_view_club_ticket($view, $data = array())
    {
      $nombre = $data['nombre'];
      $html = $this->CI->load->view($view, $data, TRUE);
      $this->dompdf->loadHtml($html);

      // (Optional) Setup the PDF paper size, orientation, etc.
      $this->dompdf->setPaper('A4', 'portrait');

      // Render the HTML as PDF
      $this->dompdf->render();
      //$this->dompdf->stream("output.pdf", array("Attachment" => false));
      $this->dompdf->stream("club_'$nombre'_comprobante_registro.pdf", array("Attachment" => false));

    }
    //se usa para las fichas medicas
    public function load_view_ficha_medica($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        $nombre = $data['jugador_nombre'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("'$nombre'_ficha_medica.pdf", array("Attachment" => false));
    }
    //se usa para entrada a evento/torneo
    public function load_view_ticket($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        $nombre = $data['nombre_entrada'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("'$nombre'_entrada.pdf", array("Attachment" => false));
    }
    //se usa para listado de equipo
    public function load_view_equipo($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        $nombre = $data['nombre_equipo'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("Listado_equipo_'$nombre'.pdf", array("Attachment" => false));
    }
    //se usa para las fichas de jugador
    public function load_view_jugador($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        $nombre = $data['jugador_nombre'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("'$nombre'_ficha.pdf", array("Attachment" => false));
    }
    //se usa para lista fe de un equipo
    public function load_view_listafe($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        $nombre = $data['nombre_equipo'];
        $evento = $data['nombre_evento'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("Lista_fe_equipo_'$nombre'_evento_'$evento'.pdf", array("Attachment" => false));
    }
    //se usa para detalle de acreditaciones de evento deportivo
    public function load_view_acreditacion($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        //$nombre = $data['nombre_equipo'];
        $evento = $data['nombre_evento'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("Detalle_Acreditaciones_evento_'$evento'_'.pdf", array("Attachment" => false));
    }
    //se usa para detalle de evento deportivo
    public function load_view_evento($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        //$nombre = $data['nombre_equipo'];
        $evento = $data['nombre_evento'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("Detalle_evento_'$evento'_'.pdf", array("Attachment" => false));
    }
    //se usa para lista fe de un equipo
    public function load_view_inscriptos_gamer($view, $data = array())
    {
        $html = $this->CI->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        $nombre = $data['nombre_torneo'];
        // (Optional) Setup the PDF paper size, orientation, etc.
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();
        //$this->dompdf->stream("ficha_medica.pdf", array("Attachment" => false));
        $this->dompdf->stream("Inscriptos_a_'$nombre'.pdf", array("Attachment" => false));
    }
}
