<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Profile';
			$data['sub_title'] = 'Silakan lengkapi profilemu';
			$data['breadcrumb'] = '
				<li><a href="#"><i class="fa fa-dashboard"></i> Main</a></li>
        		<li class="active">Profile</li>
			';
			$this->template->view('profile/index',$data);
		}
	}

	public function updateProfile(){
		$input = $this->input;
		$form = $this->form_valid;

		$whr = array(
			'id'=>$input->post('id_user')
		);

		$user = $this->crud->getDataWhere('users',$whr)->row_array();

		$email_unique = '';
		if($user['email'] != $input->post('email')){
			$email_unique = '|is_unique[users.email]';
		}

		$form->set_rules('email','<b>E-Mail</b>','required'.$email_unique);

		if($form->run() == FALSE){
			echo '<div class="alert alert-warning">'.validation_errors().'</div>';
		}else{
			$tgllahir = null;
			if($input->post('tgllahir') != null){
				$tgllahir = date('Y-m-d',strtotime($input->post('tgllahir')));
			}

			$data = array(
				'nama'=>$input->post('nama'),
				'gender'=>$input->post('gender'),
				'tgllahir'=>$tgllahir,
				'alamat'=>htmlspecialchars($input->post('alamat')),
				'email'=>$input->post('email'),
				'nohp'=>$input->post('nohp')
			);

			$respon = $this->crud->updData('users',$whr,$data);

			if($respon['code'] == 0){
				echo '<div class="alert alert-success">Profile berhasil di update</div>';
			}else{
				echo '<div class="alert alert-warning">Profile tidak ada perubahan</div>';
			}
		}

	}

	 public function updatePassword(){
	 	$form = $this->form_valid;
	 	$input = $this->input;

	 	$form->set_rules('password','<b>Password Baru</b>','required');
	 	$form->set_rules('cpassword','<b>Konfirm Password</b>','required|matches[password]');

	 	if($form->run() == FALSE){
	 		echo '<div class="alert alert-warning">'.validation_errors().'</div>';
	 	}else{
	 		$whr = array(
	 			'id'=>$input->post('id_user')
	 		);

	 		$data = array(
	 			'pass'=>$this->sec_key->encrypt($input->post('password'))
	 		);

	 		$respon = $this->crud->updData('users',$whr,$data);
	 		if($respon['code'] == 0){
	 			echo '<div class="alert alert-success">Update password berhasil</div>';
	 		}else{
	 			echo '<div class="alert alert-warning">Update password gagal</div>';
	 		}
	 	}
	 }

}