<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Produk';
			$data['sub_title'] = 'List produk';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Produk</li>
			';
			$data['produk'] = $this->crud->selectAllOrderby('produk','id','asc')->result();
			$this->template->view('produk/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Produk';
			$data['sub_title'] = 'Tambah produk';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Tambah Produk</li>
			';
			$data['satuan'] = $this->crud->selectAllOrderby('satuan','nama','asc')->result();
			$data['kategori'] = $this->crud->selectAllOrderby('katagoribarang','nama','asc')->result();
			$this->template->view('produk/tambah',$data);
		}
	}

	public function saveData(){
		$input = $this->input;
		$form = $this->form_valid;

		// Form validation
		$form->set_rules('kode_produk','<b>Kode Produk</b>','required|max_length[10]|is_unique[produk.kode]');
		$form->set_rules('nama_produk','<b>Nama Produk</b>','required');
		$form->set_rules('jumlah','<b>Jumlah</b>','required');
		$form->set_rules('harga','<b>Harga</b>','required');
		$form->set_rules('nama_produk','<b>Nama Produk</b>','required');
		$form->set_rules('kategori_produk','<b>Kategori Produk</b>','required');

		// Checking form
		if($form->run() == FALSE){
			echo '<div class="alert alert-warning">'.validation_errors().'</div>';
		}else{
			// Upload
			$config['upload_path'] = './assets/foto_produk/';
	        $config['allowed_types'] = 'gif|jpg|jpeg|png';
	        $config['file_name'] = strtoupper($input->post('kode_produk'));
	        $config['max_size'] = 10000;
	        $config['overwrite'] = true;

	        $this->load->library('upload', $config);

	        $file = NULL;
	        if($this->upload->do_upload('foto_produk')){
	            $file = $this->upload->data('file_name');
	        }

	        // Simpan
	        $data = array(
	        	'kode'=>$input->post('kode_produk'),
	        	'nama'=>$input->post('nama_produk'),
	        	'satuan'=>$input->post('satuan_produk'),
	        	'matauang'=>$input->post('mata_uang'),
	        	'jumlah'=>$input->post('jumlah'),
	        	'harga'=>$input->post('harga'),
	        	'katagori'=>$input->post('kategori_produk'),
	        	'foto_produk'=>$file
	        );

	        $respon = $this->crud->insertDataSave('produk',$data);

	        if($respon['code'] == 0){
	        	echo '<div class="alert alert-success"><i class="fa fa-check"></i> Data <b>'.$data['kode'].' '.$data['nama'].'</b> berhasil tersimpan</div>';
	        }else{
	        	echo '<div class="alert alert-warning">Data <b>'.$data['kode'].' '.$data['nama'].'</b> tidak berhasil tersimpan, silakan coba lagi</div>';
	        }
		}
	}

	public function detail(){
		$id = $this->input->get('id');

		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Produk';
			$data['sub_title'] = 'Update produk';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Update Produk</li>
			';
			$data['produk'] = $this->crud->getDataWhere('produk',array('id'=>$id))->row_array();
			$data['satuan'] = $this->crud->selectAllOrderby('satuan','nama','asc')->result();
			$data['kategori'] = $this->crud->selectAllOrderby('katagoribarang','nama','asc')->result();
			$this->template->view('produk/update',$data);
		}
	}

	public function updateData(){
		$input = $this->input;
		$form = $this->form_valid;

		$whr = array('id'=>$input->post('id_produk'));

		$produk_old = $this->crud->getDataWhere('produk',$whr)->row_array();

		// Form validation
		if($input->post('kode_produk') == $produk_old['kode']){
			$form->set_rules('kode_produk','<b>Kode Produk</b>','required|max_length[10]');
		}else{
			$form->set_rules('kode_produk','<b>Kode Produk</b>','required|max_length[10]|is_unique[produk.kode]');
		}
		$form->set_rules('nama_produk','<b>Nama Produk</b>','required');
		$form->set_rules('jumlah','<b>Jumlah</b>','required');
		$form->set_rules('harga','<b>Harga</b>','required');
		$form->set_rules('nama_produk','<b>Nama Produk</b>','required');
		$form->set_rules('kategori_produk','<b>Kategori Produk</b>','required');

		// Checking form
		if($form->run() == FALSE){
			echo '<div class="alert alert-warning">'.validation_errors().'</div>';
		}else{
			// Upload
			$config['upload_path'] = './assets/foto_produk/';
	        $config['allowed_types'] = 'gif|jpg|jpeg|png';
	        $config['file_name'] = strtoupper($input->post('kode_produk'));
	        $config['max_size'] = 10000;
	        $config['overwrite'] = true;

	        $this->load->library('upload', $config);

	        $file = $produk_old['foto_produk'];
	        if($this->upload->do_upload('foto_produk')){
	            $file = $this->upload->data('file_name');
	        }

	        // Simpan
	        $data = array(
	        	'kode'=>$input->post('kode_produk'),
	        	'nama'=>$input->post('nama_produk'),
	        	'satuan'=>$input->post('satuan_produk'),
	        	'matauang'=>$input->post('mata_uang'),
	        	'jumlah'=>$input->post('jumlah'),
	        	'harga'=>$input->post('harga'),
	        	'katagori'=>$input->post('kategori_produk'),
	        	'foto_produk'=>$file
	        );

	        $respon = $this->crud->updData('produk',$whr,$data);

	        if($respon['code'] == 0){
	        	echo '<div class="alert alert-success"><i class="fa fa-check"></i> Data <b>'.$data['kode'].' '.$data['nama'].'</b> berhasil di update</div>';
	        }else{
	        	echo '<div class="alert alert-warning">Data <b>'.$data['kode'].' '.$data['nama'].'</b> tidak ada update</div>';
	        }
		}
	}

	public function hapusData(){
		$input = $this->input;

		$id_produk = $input->post('id_produk');
		$whr = array('id'=>$id_produk);
		$produk = $this->crud->getDataWhere('produk',$whr)->row_array();

		// Hapus file foto
		$filepath = './assets/foto_produk/'.$produk['foto_produk'];
		if(is_file($filepath)){
			unlink($filepath);
		}

		// Hapus table
		$this->crud->delData($whr,'produk');

		echo '<div class="alert alert-success">Data berhasil di hapus</div>';
	}
}