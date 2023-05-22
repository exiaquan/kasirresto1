<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Satuan';
			$data['sub_title'] = 'Master Satuan';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Master Data</li>
        		<li class="active">Satuan</li>
			';
			$data['satuan'] = $this->crud->selectAll('satuan')->result();
			$this->template->view('masterdata/satuan/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Satuan';
			$data['sub_title'] = 'Tambah Satuan';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="">Master Data</li>
        		<li class="">Satuan</li>
        		<li class="active">Tambah Satuan</li>
			';

			$satuan = $this->crud->selectAllOrderby('satuan','id','desc')->row_array();

			$data['kode'] = 'S'.sprintf('%03d',substr($satuan['kode'],1)+1);
			$this->template->view('masterdata/satuan/tambah',$data);
		}
	}

	public function saveData(){
		$input = $this->input;
		$form = $this->form_valid;

		$form->set_rules('kode','Kode','required|is_unique[satuan.kode]');
		$form->set_rules('nama','Nama','required');

		if($form->run() == FALSE){
			echo '<script>alert("'.validation_errors().'");</script>';
			redirect('main/masterdata/satuan/tambah');
		}else{
			$data = array(
				'kode'=>$input->post('kode'),
				'nama'=>strtoupper($input->post('nama'))
			);

			$respon = $this->crud->insertDataSave('satuan',$data);

			echo '<script>alert("'.$respon['message'].'");</script>';
			redirect('main/masterdata/satuan');
		}
	}

	public function hapusData(){
		$id = $this->input->get('id');

		$this->crud->delData(array('id'=>$id),'satuan');

		echo '<script>alert("Data berhasil di hapus");</script>';
			redirect('main/masterdata/satuan');
	}

}