<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KatagoriBarang extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Kategori';
			$data['sub_title'] = 'Master Kategori';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Master Data</li>
        		<li class="active">Kategori</li>
			';
			$data['satuan'] = $this->crud->selectAll('katagoribarang')->result();
			$this->template->view('masterdata/katagori/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Kategori';
			$data['sub_title'] = 'Tambah Kategori';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="">Master Data</li>
        		<li class="">Kategori</li>
        		<li class="active">Tambah Kategori</li>
			';

			$satuan = $this->crud->selectAllOrderby('katagoribarang','id','desc')->row_array();

			$data['kode'] = 'K'.sprintf('%03d',substr($satuan['kode'],1)+1);
			$this->template->view('masterdata/katagori/tambah',$data);
		}
	}

	public function saveData(){
		$input = $this->input;
		$form = $this->form_valid;

		$form->set_rules('kode','Kode','required|is_unique[satuan.kode]');
		$form->set_rules('nama','Nama','required');

		if($form->run() == FALSE){
			echo '<script>alert("'.validation_errors().'");</script>';
			redirect('main/masterdata/katagoribarang/tambah');
		}else{
			$data = array(
				'kode'=>$input->post('kode'),
				'nama'=>strtoupper($input->post('nama'))
			);

			$respon = $this->crud->insertDataSave('katagoribarang',$data);

			echo '<script>alert("'.$respon['message'].'");</script>';
			redirect('main/masterdata/katagoribarang');
		}
	}

	public function hapusData(){
		$id = $this->input->get('id');

		$this->crud->delData(array('id'=>$id),'katagoribarang');

		echo '<script>alert("Data berhasil di hapus");</script>';
			redirect('main/masterdata/katagoribarang');
	}

}