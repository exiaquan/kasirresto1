<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Payment';
			$data['sub_title'] = 'List Payment';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
				<li class="active">Master data</li>
        		<li class="active">Payment</li>
			';
			$data['payment'] = $this->crud->selectAllOrderby('payment','id','asc')->result();
			$this->template->view('masterdata/payment/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Payment';
			$data['sub_title'] = 'Tambah Payment';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
				<li class="active">Master data</li>
        		<li class="active">Tambah Payment</li>
			';
			$this->template->view('masterdata/payment/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form valid
		$form->set_rules('method','<b>Method</b>','required');
		$form->set_rules('notes','<b>Notes</b>','required');

		if($form->run() == FALSE){
			echo '<div class="alert alert-warning">'.validation_errors().'</div>';
		}else{
			// Set nomor payment
			$nomor = 'P'.date('ymd');
			$cek_nomor = $this->crud->getDataWhere('payment',array('nomor LIKE '=>$nomor.'%'))->row_array();
			
			if(count($cek_nomor) > 0){
				$no = substr($cek_nomor['nomor'],7);
				$set_nomor = $nomor.sprintf('%03d',$no+1);
			}else{
				$set_nomor = $nomor.sprintf('%03d',1);
			}
			

			// Upload file
			$config['upload_path'] = './assets/payment/';
	        $config['allowed_types'] = 'gif|jpg|jpeg|png';
	        $config['file_name'] = strtoupper($set_nomor);
	        $config['max_size'] = 10000;
	        $config['overwrite'] = true;

	        $this->load->library('upload', $config);

	        $file = NULL;
	        if($this->upload->do_upload('gambar')){
	        	$file = $this->upload->data('file_name');
	        }

			$data = array(
				'nomor'=>$set_nomor,
				'notes'=>htmlspecialchars($input->post('notes')),
				'method'=>strtoupper($input->post('method')),
				'gambar'=>$file
			);

			$respon = $this->crud->insertDataSave('payment',$data);

			if($respon['code'] == 0){
				echo '<div class="alert alert-success"><i class="fa fa-check"></i> Data berhasil tersimpan</div>';
			}else{
				echo '<div class="alert alert-warning"><i class="fa fa-exclamation"></i> '.$respon['message'].'</div>';
			}
		}
	}

	public function hapusData(){
		$id = $this->input->post('id');
		$this->crud->delData(array('id'=>$id),'payment');
	}

	public function test(){
		$nomor = 'P'.date('ymd');
		$cek_nomor = $this->crud->getDataWhere('payment',array('nomor LIKE '=>$nomor.'%'))->row_array();
		
		if(count($cek_nomor) > 0){
			$no = substr($cek_nomor['nomor'],7);
			$set_nomor = $nomor.sprintf('%03d',$no+1);
		}else{
			$set_nomor = $nomor.sprintf('%03d',1);
		}
		echo $set_nomor;
	}

}