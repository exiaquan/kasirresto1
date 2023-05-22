<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Invoice';
			$data['sub_title'] = 'List Invoice';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Invoice</li>
			';
			$data['invoice'] = $this->crud->selectAllOrderby('invoice','id','asc')->result();
			$this->template->view('invoice/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Invoice';
			$data['sub_title'] = 'Buat Invoice';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Buat Invoice</li>
			';
			$this->template->view('invoice/tambah',$data);
		}
	}

	public function listProduk(){
		$sql_listkatagori = '
			SELECT DISTINCT a.katagori AS kategoriproduk
			FROM produk a
			ORDER BY a.katagori ASC
		';
		$data['listkatagori'] = $this->crud->getDataQuery($sql_listkatagori)->result();
		$data['crud'] = $this->crud;
		$this->load->view('invoice/listproduk',$data);
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('no_meja','<b class="text-uppercase">No. Meja</b>','required');
		$form->set_rules('nm_customer','<b class="text-uppercase">Nama Customer</b>','required');
		$form->set_rules('list_produk','<b class="text-uppercase">Produk</b>','required');
		$form->set_rules('sub_total','<b>Sub Total</b>','required');
		$form->set_rules('grand_total','<b>Grand Total</b>','required');
		$form->set_rules('nm_pelayan','<b>Nama Pelayan</b>','required');

		if($form->run() == FALSE){
			$respon = array(
				'code'=>1,
				'message'=>validation_errors()
			);
			//print_r($respon);
		}else{
			$invoice = array(
				'nomor'=>'INV'.date('ymdhis'),
				'no_meja'=>$input->post('no_meja'),
				'nama_customer'=>$input->post('nm_customer'),
				'sub_total'=>$input->post('sub_total'),
				'diskon_persen'=>$input->post('diskon_persen'),
				'diskon_amount'=>$input->post('diskon_amount'),
				'total_amount'=>$input->post('grand_total'),
				'input_user'=>$input->post('id_user'),
				'input_tglwaktu'=>date('Y-m-d H:i:s'),
				'tgl_invoice'=>date('Y-m-d H:i:s'),
				'nama_pelayan'=>$input->post('nm_pelayan'),
				'catatan'=>htmlspecialchars($input->post('catatan'))
			);

			$d_invoice = $input->post('list_produk');
			//print_r($invoice);
			//print_r($d_invoice);

			$respon = $this->crud->insertDataSave('invoice',$invoice);

			if($respon['code'] == 0){
				$list_produk = (array)json_decode($input->post('list_produk'),true);
				foreach($list_produk as $list => $l){
					$item = $this->crud->getDataWhere('produk',array('id'=>$l['id_produk']))->row_array();
					$d_invoice = array(
						'id_invoice'=>$respon['last_id'],
						'id_produk'=>$item['id'],
						'kode_produk'=>$item['kode'],
						'nama_produk'=>strtoupper($item['nama']),
						'satuan_produk'=>$item['satuan'],
						'jumlah'=>$l['qty_produk'],
						'harga'=>$l['harga_produk'],
						'subtotal_amount'=>$l['subtotal_produk']
					);

					$res_d_invoice = $this->crud->insertDataSave('d_invoice',$d_invoice);

					if($res_d_invoice['code'] == 0){
						$w_item = array('id'=>$item['id']);
						$d_item = array('jumlah'=>$item['jumlah']-$d_invoice['jumlah']);
						$this->crud->updData('produk',$w_item,$d_item);
					}
				}
			}
		}

		echo json_encode($respon);
	}

	public function detailData(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$id = $this->input->get('id');
			$invoice = $this->crud->getDataWhere('invoice',array('id'=>$id))->row_array();
			$d_invoice = $this->crud->getDataWhere('d_invoice',array('id_invoice'=>$id))->result();
			$data['title'] = 'Invoice '.$invoice['nomor'];
			$data['sub_title'] = 'Detail Invoice';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Detail Invoice</li>
        		<li class="active">'.$invoice['nomor'].'</li>
			';
			$data['invoice'] = $invoice;
			$data['d_invoice'] = $d_invoice;
			$this->template->view('invoice/detail',$data);
		}
	}

	public function listProdukDetail(){
		$id = $this->input->post('id_invoice');
		$sql_listkatagori = '
			SELECT DISTINCT a.katagori AS kategoriproduk
			FROM produk a
			ORDER BY a.katagori ASC
		';
		$data['listkatagori'] = $this->crud->getDataQuery($sql_listkatagori)->result();
		$data['id_invoice'] = $id;
		$data['crud'] = $this->crud;
		//$invoice = $this->crud->getDataWhere('invoice',array('id'=>$id))->row_array();
		//$data['invoice'] = $invoice;
		$this->load->view('invoice/listprodukdetail',$data);
	}

	public function saveDataDetail(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('id_invoice','<b class="text-uppercase">ID Invoice</b>','required');
		$form->set_rules('no_meja','<b class="text-uppercase">No. Meja</b>','required');
		$form->set_rules('nm_customer','<b class="text-uppercase">Nama Customer</b>','required');
		$form->set_rules('list_produk','<b class="text-uppercase">Produk</b>','required');
		$form->set_rules('sub_total','<b>Grand Total</b>','required');
		$form->set_rules('grand_total','<b>Grand Total</b>','required');
		$form->set_rules('nm_pelayan','<b>Nama Pelayan</b>','required');

		if($form->run() == FALSE){
			$respon = array(
				'code'=>1,
				'message'=>validation_errors()
			);
			//print_r($respon);
		}else{
			$w_invoice = array('id'=>$input->post('id_invoice'));
			$invoice = array(
				'nomor'=>'INV'.date('ymdhis'),
				'no_meja'=>$input->post('no_meja'),
				'nama_customer'=>$input->post('nm_customer'),
				'sub_total'=>$input->post('sub_total'),
				'diskon_persen'=>$input->post('diskon_persen'),
				'diskon_amount'=>$input->post('diskon_amount'),
				'total_amount'=>$input->post('grand_total'),
				'update_user'=>$input->post('id_user'),
				'update_tglwaktu'=>date('Y-m-d H:i:s'),
				// 'tgl_invoice'=>date('Y-m-d H:i:s'),
				'nama_pelayan'=>$input->post('nm_pelayan'),
				'catatan'=>htmlspecialchars($input->post('catatan'))
			);

			//$d_invoice = $input->post('list_produk');
			//print_r($invoice);
			//print_r($d_invoice);

			$respon = $this->crud->updData('invoice',$w_invoice,$invoice);

			if($respon['code'] == 0){
				// Kembalikan data lama dan hapus
				$dinv = $this->crud->getDataWhere('d_invoice',array('id_invoice'=>$input->post('id_invoice')))->result_array();
				foreach($dinv as $ll){
					// Cek detail invoice
					$w_d_invoice = array('id_invoice'=>$input->post('id_invoice'),'id_produk'=>$ll['id_produk']);
					$cek_d_invoice = $this->crud->getDataWhere('d_invoice',$w_d_invoice);
					if($cek_d_invoice->num_rows() > 0){
						$d_inv = $cek_d_invoice->row_array();
						// Kembalikan qty lama ke produk
						$w_produk = array('id'=>$d_inv['id_produk']);
						$produk = $this->crud->getDataWhere('produk',$w_produk)->row_array();
						$d_produk = array(
							'jumlah'=>$produk['jumlah']+$d_inv['jumlah']
						);
						$this->crud->updData('produk',$w_produk,$d_produk);
					}
				}

				// Hapus data lama
				$w_d_inv_old = array('id_invoice'=>$input->post('id_invoice'));
				$this->crud->delData($w_d_inv_old,'d_invoice');

				// Masukkan data baru
				$list_produk = (array)json_decode($input->post('list_produk'),true);

				foreach($list_produk as $list => $l){
					// Input d_invoice baru
					$item = $this->crud->getDataWhere('produk',array('id'=>$l['id_produk']))->row_array();
					$d_invoice = array(
						'id_invoice'=>$input->post('id_invoice'),
						'id_produk'=>$item['id'],
						'kode_produk'=>$item['kode'],
						'nama_produk'=>strtoupper($item['nama']),
						'satuan_produk'=>$item['satuan'],
						'jumlah'=>$l['qty_produk'],
						'harga'=>$l['harga_produk'],
						'subtotal_amount'=>$l['subtotal_produk']
					);

					$res_d_invoice = $this->crud->insertDataSave('d_invoice',$d_invoice);

					if($res_d_invoice['code'] == 0){
						$w_item = array('id'=>$item['id']);
						$d_item = array('jumlah'=>$item['jumlah']-$d_invoice['jumlah']);
						$this->crud->updData('produk',$w_item,$d_item);
					}
				}
			}else{
				$respon = array(
					'code'=>1,
					'message'=>'Tidak ada update'
				);
			}
		}

		echo json_encode($respon);
	}

	public function paymentInvoice(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$id = $this->input->get('id');
			$invoice = $this->crud->getDataWhere('invoice',array('id'=>$id))->row_array();
			$d_invoice = $this->crud->getDataWhere('d_invoice',array('id_invoice'=>$id))->result();
			$data['title'] = 'Payment Invoice '.$invoice['nomor'];
			$data['sub_title'] = 'Payment Invoice';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Detail Invoice</li>
        		<li class="active">'.$invoice['nomor'].'</li>
        		<li class="active">Payment Invoice</li>
			';
			$data['invoice'] = $invoice;
			$data['d_invoice'] = $d_invoice;
			$data['payment'] = $this->crud->selectAll('payment')->result();
			$this->template->view('invoice/payment',$data);
		}
	}

	public function paymentMethod(){
		$id = $this->input->post('id');
		$p = $this->crud->getDataWhere('payment',array('id'=>$id))->row();
		if(isset($p)){
			echo $p->method;
			echo '<br>';
			if($p->gambar != null){
				echo '<img class="thumbnail" style="width:40%;" src="'.base_url().'assets/payment/'.$p->gambar.'" />';
			}
		}
	}

	public function paymentInvoicePay(){
		$form = $this->form_valid;
		$input = $this->input;

		$form->set_rules('id_invoice','<b class="text-uppercase">ID INVOICE</b>','required');
		$form->set_rules('payment_id','<b class="text-uppercase">Payment</b>','required');
		$form->set_rules('amount','<b class="text-uppercase">Amount</b>','required|greater_than[0]');
		$form->set_rules('payment_amount','<b class="text-uppercase">Pay amount</b>','required|greater_than[0]');
		$form->set_rules('payment_status','<b class="text-uppercase">Pay status</b>','required');

		$amount = $input->post('amount');

		if($form->run() == FALSE || $input->post('payment_amount') < $amount){
			if($form->run() == FALSE){
				$respon = array(
					'code'=>1,
					'message'=>validation_errors()
				);
			}

			if($input->post('payment_amount') < $amount){
				$respon = array(
					'code'=>1,
					'message'=>'Nominal tidak valid'
				);
			}
			
		}else{
			// Payment
			$payment = $this->crud->getDataWhere('payment',array('id'=>$input->post('payment_id')))->row_array();

			$d_payment = array(
				'payment_id'=>$payment['id'],
				'payment_no'=>$payment['nomor'],
				'payment_amount'=>$input->post('payment_amount'),
				'payment_method'=>$payment['method'],
				'payment_notes'=>$payment['notes'],
				'payment_status'=>$input->post('payment_status'),
				'payment_kembalian'=>$input->post('kembalian')
			);

			$respon = $this->crud->updData('invoice',array('id'=>$input->post('id_invoice')),$d_payment);
		}

		echo json_encode($respon);
	}

	public function printInvoice(){
		$input = $this->input;
		$id = $input->get('id');

		$invoice = $this->crud->getDataWhere('invoice',array('id'=>$id))->row_array();
			$d_invoice = $this->crud->getDataWhere('d_invoice',array('id_invoice'=>$id))->result();
			$data['title'] = 'Invoice '.$invoice['nomor'];
			$data['sub_title'] = 'Invoice';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Detail Invoice</li>
        		<li class="active">'.$invoice['nomor'].'</li>
        		<li class="active">Print Invoice</li>
			';
			$data['invoice'] = $invoice;
			$data['d_invoice'] = $d_invoice;
			$data['payment'] = $this->crud->selectAll('payment')->result();
			$data['crud'] = $this->crud;
			$this->load->view('invoice/printpdf',$data);
	}

}