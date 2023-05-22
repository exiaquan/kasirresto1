<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index(){
		$this->session->sess_destroy();
		$this->load->view('register');
	}

	public function saveData(){
		$input = $this->input;
		$form = $this->form_valid;
		$form->set_rules('email','<b>E-Mail</b>','required|is_unique[users.email]');
		$form->set_rules('password','<b>Password</b>','required');
		$form->set_rules('c_password','<b>Confirm Password</b>','required|matches[password]');

		if($form->run() == FALSE){
			echo '<div class="alert alert-danger">'.validation_errors().'</div>';
		}else{
			// Set nomor
			$no1 = 'U'.date('ymd');

			$sql_lastnomor = '
				SELECT *
				FROM users a
				WHERE a.kode = "U'.date('ymd').'%"
				ORDER BY a.kode DESC
			';

			$q_lastnomor = $this->crud->getDataQuery($sql_lastnomor)->row_array();

			$set_no2 = substr($q_lastnomor, 7);
			$no2 = $set_no2+1;

			$kode = $no1.sprintf('%03d',$no2);

			// Data
			$data = array(
				'kode'=>$kode,
				'email'=>$input->post('email'),
				'pass'=>$this->sec_key->encrypt($input->post('password')),
				'tglbuat'=>date('Y-m-d H:i:s'),
				'hak_akses'=>02,
				'sts_aktif'=>1
			);

			$respon = $this->crud->insertDataSave('users',$data);

			if($respon['code'] == 0){
				echo '<div class="alert alert-success">E-Mail '.$data['email'].' berhasil ditambahkan.</div>';
			}else{
				echo '<div class="alert alert-warning">'.$respon['message'].'</div>';
			}
		}
	}

}