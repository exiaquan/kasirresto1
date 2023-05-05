<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function reportInv(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Invoice';
			$data['sub_title'] = 'List Invoice';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Report</li>
			';
			$data['thnInv'] = $this->crud->thnInv()->result();
			$this->template->view('report/index',$data);
		}
	}

	public function reportInvTemp(){
		$thn = $this->input->post('tahun');
		$data['yr'] = $thn;
		$data['crud'] = $this->crud;
		$this->load->view('report/temp',$data);
	}

}