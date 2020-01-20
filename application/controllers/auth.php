<?php
class auth extends CI_Controller{
	
	function  __construct(){
		parent::__construct();
		$this->load->model('auth_model','model');
	}
	
	function index(){
		$this->department();
	}
	
	function login($errorMsg = NULL){
		$data['judul'] = "Login Form";
		$data['error'] = $errorMsg;
		$this->load->view('login',$data);
	}
	
	function set_sess(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if($username == "" && $password == ""){
			$this->login("Username dan password harap diisi");
		}else{
			if($this->model->cek_user($username,$password)){
				$data = $this->model->get_user($username,$password);
				$user = array(
					'ID_USER' => $data->ID_USER,
					'ID_DEPARTMENT' => $data->ID_DEPARTMENT,
					'USERNAME' => $data->USERNAME,
					'NAMA' => $data->NAMA,
					'EMAIL' => $data->EMAIL,
					'HAK_AKSES' => $data->HAK_AKSES
				);
				$this->session->set_userdata($user);
				redirect('/rekap/tiket/new');
			}else{
				$this->login("Username dan password salah");
			}
		}
	}
	
	function logout(){
		$this->session->sess_destroy();
		header("location: ".base_url()."index.php/auth/login");
	}
	
	//--------------------------mobile--------------------------------------------
	/*
	function cek_login_mobile(){
		header('Access-Control-Allow-Origin: *');
		$username = $_POST['username'];
		$password = $_POST['password'];
		if($this->model->cek_user_agent($username,$password)){
			$data = $this->model->get_user_agent($username,$password);
			echo $data->USERNAME."|".$data->NAMA;
		}else{
			echo "-";
		}
	}*/
}
?>