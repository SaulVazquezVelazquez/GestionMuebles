<?php
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {

    protected $ci;
    protected $dompdf;

    public function __construct() {
        $this->ci =& get_instance();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $this->dompdf = new Dompdf($options);
    }

    public function load_view($view, $data = [], $filename = 'document.pdf', $stream = true) {
        $html = $this->ci->load->view($view, $data, true);
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        if ($stream) {
            $this->dompdf->stream($filename, array("Attachment" => 0));
        } else {
            return $this->dompdf->output();
        }
    }
}
