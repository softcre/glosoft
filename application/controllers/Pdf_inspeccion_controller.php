<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once "vendor/autoload.php";


//use PHPMailer\PHPMailer\PHPMailer;

class Pdf_inspeccion_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->library('email');
        $this->load->model(array(
          INSPECCIONES_MODEL => 'inspecciones',
          TRABAJADORES_ENCONTRADOS_MODEL => 'empleados',
          USUARIOS_MODEL => 'inspectores'
        ));
    }



    public function index_original_funciona($id_entrada)
    {
      $data['title'] = 'Acta de Inspeccion';
      $data['act'] = 'entrada';
      $data['desplegado'] = 'entra';
      //$data['torneos'] = $this->torneos->get_all();
      $data['entrada'] = $this->entradas->get($id_entrada);
      
        $data['title'] = 'My PDF';
        $pdf = new Pdf();
        $pdf->load_view('anonimo/entradas/pdf_test', $data);
        //$this->pdf->load_view('anonimo/entradas/pdf_entrada', $data);
        //$this->pdf->load_view('anonimo/entradas/pdf_test', $data);
        return $pdf->download('Ticket.pdf');
    }


    public function pdf_ver($id_inspeccion)
    {
        $data['title'] = 'acta de Inspección';
        $data['act'] = 'acta';
        $data['desplegado'] = 'exp';
        //$data['torneos'] = $this->torneos->get_all();
        $data['inspeccion'] = $this->inspecciones->get($id_inspeccion);
        $inspeccion = $this->inspecciones->get($id_inspeccion);
        $data['nombre_acta'] = 'Acta_inspeccion_num_'.$inspeccion->id_inspeccion;
        
        $data['title'] = 'My PDF';
        $pdf = new Pdf();
        //$pdf->setPaper([0, 0, 300.98, 300.85], 'landscape');
        //$pdf->load_view('anonimo/entradas/pdf_entrada_ticket', $data)->setPaper(array(0,0,'300','300'),'landscape');
        $pdf->load_view_acta_inspeccion('admin/inspecciones/pdf_acta_inspeccion_plantilla', $data)->setPaper('ticket', 'landscape');
        // Instead of triggering a download, we will output the PDF content to the browser.
        $pdfContent = $pdf->output();
        
        // Set the appropriate headers to display the PDF in the browser.
        header('Content-Type: application/pdf');
        header('Content-Length: ' . strlen($pdfContent));
        header('Content-Disposition: inline; filename="Ticket.pdf"');
        
        // Output the PDF content.
        echo $pdfContent;
        
        // Exit the script to prevent any additional output.
        exit;
    }

   

   

    public function generate_pdf($id_entrada)
    {
        $data['title'] = 'My PDF';
        $data['torneo'] = 'This is the content of my PDF';
        $data['entrada'] = $this->entradas->get(id_entrada);
        
        //$this->pdf->load_view('anonimo/entradas/pdf_entrada', $data);
        $this->pdf->load_view('anonimo/entradas/pdf_test', $data);
    }

    

   
    
}
