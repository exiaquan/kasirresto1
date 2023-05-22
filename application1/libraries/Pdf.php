<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once(APPPATH.'third_party/tcpdf_min/tcpdf.php');
class Pdf
{ 
	var $dompdf = '';

	function __construct(){
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		
		$pdf = new DOMPDF();
		$CI =& get_instance();
		$CI->dompdf = $pdf;
		$this->dompdf = $pdf;
	}

	function exportToPdf($arr){

		$this->dompdf->set_paper($arr['paper'], $arr['orientation']);
	    
	    // Convert to PDF
	    $this->dompdf->load_html($arr['html']);
	    // $this->dompdf->load_Html_File(base_url().'application/view/index.html');
	    $this->dompdf->render();

	    //utk menampilkan preview pdf
	    $this->dompdf->stream($arr['doc_title'].".pdf",array('Attachment'=>0));
	}

	// function exportToPdf($arr){
	// 	$pdf = new Pdf($arr['orientation'], 'mm', $arr['paper'], true, 'UTF-8', false);
	// 	$pdf->SetTitle($arr['doc_title']);
	//     $pdf->SetHeaderMargin(10);
	//     $pdf->SetTopMargin(5);
	//     $pdf->setFooterMargin(10);
	//     $pdf->SetAutoPageBreak(true);
	//     $pdf->SetAuthor('MDAPPS');
	//    	$pdf->SetDisplayMode('real', 'default');
	//     $pdf->AddPage($arr['orientation']);
	//     //$pdf->Write(5, 'CodeIgniter TCPDF Integration');
	//     ob_start();
	//     $pdf->writeHTML($arr['html'], true, false, true, false, '');
	//     ob_end_clean();
	//     $pdf->Output($arr['doc_title'].'.pdf', 'I');
	// }
}