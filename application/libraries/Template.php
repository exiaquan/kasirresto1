<?php
class Template{
	protected $ci;

	function __construct(){
		$this->ci=&get_instance();
	}

	function isAjax(){
		$input=$this->ci->input;
		return ($input->server('HTTP_X_REQUESTED_WITH')&&($input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
	}

	function view($template,$data=null){
		$load=$this->ci->load;
		$data['crud'] = $this->ci->crud;
		if(!$this->isAjax()){
			$data['head']=$load->view('template/head',$data,true);
			$data['header']=$load->view('template/header',$data,true);
			$data['aside']=$load->view('template/aside',$data,true);
			$data['content']=$load->view($template,$data,true);
			$data['footer']=$load->view('template/footer',$data,true);
			$load->view('template/main',$data);
		}else{
			$load->view($template,$data);
		}
	}
}
?>