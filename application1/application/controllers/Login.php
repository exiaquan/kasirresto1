<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		$this->session->sess_destroy();
		$this->load->view('login');
	}

	public function getLogin(){
		$form = $this->form_valid;
		$input = $this->input;

		$form->set_rules('email','<b>Email</b>','required');
		$form->set_rules('password','<b>Password</b>','required');

		if($form->run() == FALSE){
			echo '<div class="alert alert-warning">'.validation_errors().'</div>';
		}else{
			$whr = array(
				'email'=>$input->post('email'),
				'sts_aktif'=>1
			);

			$user = $this->crud->getDataWhere('users',$whr)->row_array();

			if(count($user) > 0){
				$pass = $this->sec_key->decrypt($user['pass']);
				if($input->post('password') == $pass){
					$ses_set = array(
						'id_user'=>$user['id'],
						'kode'=>$user['kode'],
						'nama'=>$user['nama'],
						'email'=>$user['email'],
						'hak_akses'=>$user['hak_akses'],
						'sts_login'=>true
					);
					$this->session->set_userdata($ses_set);
					echo '<div class="alert alert-success">Welcome '.$user['email'].'</div>';
				}else{
					echo '<div class="alert alert-warning">Password incorrect</div>';
				}
			}else{
				echo '<div class="alert alert-warning">User not found</div>';
			}
		}
	}

	public function getLogout(){
		$this->session->sess_destroy();
		redirect('Login');
	}
}
