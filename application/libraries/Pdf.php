<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf
{
    /**
     * PDF filename
     * @var String
     */
    public $filename;
    public function __construct()
    {
        parent::__construct();
        $this->filename = "laporan.pdf";
        $this->atch = array("Attachment" => FALSE);
    }
    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */
    protected function ci()
    {
        return get_instance();
    }
    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access    public
     * @param    string    $view The view to load
     * @param    array    $data The view data
     * @return    void
     */
    public function load_view($view, $coba = array())
    {

        $options = new Options();
        $options->set('enable_html5_parser', true);
        $options->set('isRemoteEnabled', TRUE);
        ini_set('max_execution_time', 3000);

        ini_set('max_input_time', 3000);
        $dompdf = new Dompdf($options);
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($contxt);
        // $dompdf->set_option('isHtml5ParserEnabled', true);
        $html = $this->ci()->load->view($view, $coba, TRUE);
        $dompdf->load_html($html);
        // $dompdf->set_paper(array(0, 0, 792, 1512), 'landscape');
        // Render the PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        // $dompdf->stream($this->filename, array("Attachment" => FALSE));
        $dompdf->stream($this->filename, $this->atch);
    }

    public function custom($view, $size, $orientasi, $coba = array())
    {

        $options = new Options();
        $options->set('enable_html5_parser', true);
        $options->set('isRemoteEnabled', TRUE);
        ini_set('max_execution_time', 3000);

        ini_set('max_input_time', 3000);
        $dompdf = new Dompdf($options);
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($contxt);
        // $dompdf->set_option('isHtml5ParserEnabled', true);
        $html = $this->ci()->load->view($view, $coba, TRUE);
        $dompdf->load_html($html);
        $dompdf->set_paper($size, $orientasi);
        // Render the PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        // $dompdf->stream($this->filename, array("Attachment" => FALSE));
        $dompdf->stream($this->filename, $this->atch);
    }

    public function detail($coba = array())
    {
        $options = new Options();
        $options->set('enable_html5_parser', true);
        $options->set('isRemoteEnabled', TRUE);
        ini_set('max_execution_time', 3000);

        ini_set('max_input_time', 3000);
        $dompdf = new Dompdf($options);
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($contxt);
        $msg = $this->ci()->load->view('admin/penyewaan/invoice_pdf', $coba, true);
        // $html = mb_convert_encoding('HTML-ENTITIES', 'UTF-8');
        $dompdf->load_html($msg);
        $paper_orientation = 'Potrait';
        $dompdf->set_paper($paper_orientation);

        // Render the HTML as PDF
        $dompdf->render();
        return $dompdf->output();
    }
}
