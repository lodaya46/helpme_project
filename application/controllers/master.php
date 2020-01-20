<?php
class master extends CI_Controller{
	
	function  __construct(){
		parent::__construct();
		$this->load->model('master_model','model');
	}
	
	function index(){
		$this->department();
	}
	//-------------------------department--------------------------------------------------------------
	function department(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		$config['base_url'] = base_url().'/index.php/master/department/';
		$config['per_page'] = '20';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$batas_awal			= 0;
		
		if($this->uri->segment(3) == "new"){
			//get total data
			$total_rows = $this->model->get_jml_department();
			//set array data
			$newdata = array(
				'total_rows' => $total_rows
			);
			//set session for array
			$this->session->set_userdata($newdata);
		}else if($this->uri->segment(3) != ""){
			$batas_awal = $this->uri->segment(3);
		}
		
		//pagination
		$config['total_rows'] = $this->session->userdata('total_rows');
		$this->pagination->initialize($config);
		$data['paging']		= $this->pagination->create_links();
		
		$data['jml_data']	= $this->session->userdata('total_rows');
		$data['awal']		= $batas_awal + 1;
		$data['akhir']		= $batas_awal + $config['per_page'];
		//get data from db
		$data['result']		= $this->model->get_department($batas_awal,$config['per_page']);
		$data['judul']		= 'Department';
		$data['isi'] 		= 'master/view_department';
		$this->load->view('template_table',$data);
	}
	
	function add_department(){
		if(isset($_POST['submit'])){
			$data = array(
				'NAMA_DEPARTMENT' => $_POST['nama_department'],
				'USER_INPUT' => $this->session->userdata('USERNAME')
			);
			$this->model->add_department($data);
			echo '<script language="javascript">alert("Data Berhasil Disimpan");</script>';
			echo '<script language="javascript">window.location.assign("'.base_url().'index.php/master/department/new");</script>';
		}
		$data['judul'] = 'Add Department';
		$data['isi'] = 'master/view_add_department';
		$this->load->view('template_form',$data);
	}
	
	function edit_department(){
		if(isset($_POST['submit'])){
			$id_department = $this->input->post('id_department');
			$data = array(
				'NAMA_DEPARTMENT' => $_POST['nama_department'],
				'USER_INPUT' => $this->session->userdata('USERNAME')
			);
			$this->model->update_department($data,$id_department);
			echo '<script language="javascript">alert("Data Berhasil Disimpan");</script>';
			echo '<script language="javascript">window.location.assign("'.base_url().'index.php/master/department/new");</script>';
		}
		$id_department = $this->uri->segment(3);
		$data['result'] = $this->model->edit_department($id_department);
		$data['judul'] = 'Edit Department';
		$data['isi'] = 'master/view_edit_department';
		$this->load->view('template_form',$data);
	}
	
	function delete_department(){
		$id_department =  $this->uri->segment(3);
		$this->model->delete_department($id_department);
			echo '<script language="javascript">alert("Data Berhasil Dihapus");</script>';
			echo '<script language="javascript">window.location.assign("'.base_url().'index.php/master/department");</script>';
		
	}
	//-------------------------topic--------------------------------------------------------------
	function topic(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		$config['base_url'] = base_url().'/index.php/master/topic/';
		$config['per_page'] = '20';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$batas_awal			= 0;
		//if(!this->cek_session()) redirect('auth/logout');
		if($this->uri->segment(3) == "new"){
			//get total data
			$total_rows = $this->model->get_jml_topic();
			//set array data
			$newdata = array(
				'total_rows' => $total_rows
			);
			//set session for array
			$this->session->set_userdata($newdata);
		}else if($this->uri->segment(3) != ""){
			$batas_awal = $this->uri->segment(3);
		}
		
		//pagination
		$config['total_rows'] = $this->session->userdata('total_rows');
		$this->pagination->initialize($config);
		$data['paging']		= $this->pagination->create_links();
		
		$data['jml_data']	= $this->session->userdata('total_rows');
		$data['awal']		= $batas_awal + 1;
		$data['akhir']		= $batas_awal + $config['per_page'];
		//get data from db
		$data['result']		= $this->model->get_topic($batas_awal,$config['per_page']);
		$data['judul']		= 'Topic';
		$data['isi'] 		= 'master/view_topic';
		$this->load->view('template_table',$data);
	}
	
	function add_topic(){
		if(isset($_POST['submit'])){
			$data = array(
				'ID_DEPARTMENT' => $_POST['id_department'],
				'NAMA_TOPIC' => $_POST['nama_topic'],
				'USER_INPUT' => $this->session->userdata('USERNAME')
			);
			$this->model->add_topic($data);
			echo '<script language="javascript">alert("Data Berhasil Disimpan");</script>';
			echo '<script language="javascript">window.location.assign("'.base_url().'index.php/master/topic/new");</script>';
		}
		$data['list_department']	= $this->model->get_department(0,0);	
		$data['judul'] = 'Add Topic';
		$data['isi'] = 'master/view_add_topic';
		$this->load->view('template_form',$data);
	}
	
	function edit_topic(){
		if(isset($_POST['submit'])){
			$id_topic = $this->input->post('id_topic');
			$data = array(
				'ID_DEPARTMENT' => $_POST['id_department'],
				'NAMA_TOPIC' => $_POST['nama_topic'],
				'USER_INPUT' => $this->session->userdata('USERNAME')
			);
			$this->model->update_topic($data,$id_topic);
			echo '<script language="javascript">alert("Data Berhasil Disimpan");</script>';
			echo '<script language="javascript">window.location.assign("'.base_url().'index.php/master/topic/new");</script>';
		}
		$id_topic = $this->uri->segment(3);
		$data['list_department']	= $this->model->get_department(0,0);	
		$data['result'] = $this->model->edit_topic($id_topic);
		$data['judul'] = 'Edit Topic';
		$data['isi'] = 'master/view_edit_topic';
		$this->load->view('template_form',$data);
	}
	
	function delete_topic(){
		$id_topic =  $this->uri->segment(3);
		$this->model->delete_topic($id_topic);
			echo '<script language="javascript">alert("Data Berhasil Dihapus");</script>';
			echo '<script language="javascript">window.location.assign("'.base_url().'index.php/master/topic");</script>';
		
	}
	//-------------------------user--------------------------------------------------------------
	function user(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		$config['base_url'] = base_url().'/index.php/master/user/';
		$config['per_page'] = '20';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$batas_awal			= 0;
		//if(!this->cek_session()) redirect('auth/logout');
		if($this->uri->segment(3) == "new"){
			//get total data
			$total_rows = $this->model->get_jml_user();
			//set array data
			$newdata = array(
				'total_rows' => $total_rows
			);
			//set session for array
			$this->session->set_userdata($newdata);
		}else if($this->uri->segment(3) != ""){
			$batas_awal = $this->uri->segment(3);
		}
		
		//pagination
		$config['total_rows'] = $this->session->userdata('total_rows');
		$this->pagination->initialize($config);
		$data['paging']		= $this->pagination->create_links();
		
		$data['jml_data']	= $this->session->userdata('total_rows');
		$data['awal']		= $batas_awal + 1;
		$data['akhir']		= $batas_awal + $config['per_page'];
		//get data from db
		$data['result']		= $this->model->get_user($batas_awal,$config['per_page']);
		$data['judul']		= 'Pengguna';
		$data['isi'] 		= 'master/view_user';
		$this->load->view('template_table',$data);
	}
	
	function add_user(){
		if(isset($_POST['submit'])){
			
			$data = array(
				'ID_DEPARTMENT' => $_POST['id_department'],
				'NAMA' => $_POST['nama'],
				'EMAIL' => $_POST['email'],
				'PHONE' => $_POST['phone'],
				'USERNAME' => $_POST['username'],
				'PASSWORD' => md5($_POST['password']),
				'STATUS' => $_POST['status'],
				'USER_INPUT' => $this->session->userdata('USERNAME'),
				'HAK_AKSES' => $_POST['hak_akses']
			);
			$this->model->add_user($data);
			echo '<script language="javascript">alert("Data Berhasil Disimpan");</script>';
			echo '<script language="javascript">window.location.assign("'.base_url().'index.php/master/user/new");</script>';
		}
		$data['list_department']	= $this->model->get_department(0,0);	
		$data['judul'] = 'Add Pengguna';
		$data['isi'] = 'master/view_add_user';
		$this->load->view('template_form',$data);
	}
	
	function edit_user(){
		if(isset($_POST['submit'])){
			$id_user = $this->input->post('id_user');
			if($_POST['password'] != "") $password = md5($_POST['password']);
			else $password = $_POST['old_password'];
			
			$data = array(
				'ID_DEPARTMENT' => $_POST['id_department'],
				'NAMA' => $_POST['nama'],
				'EMAIL' => $_POST['email'],
				'PHONE' => $_POST['phone'],
				'USERNAME' => $_POST['username'],
				'PASSWORD' => $password,
				'STATUS' => $_POST['status'],
				'USER_INPUT' => $this->session->userdata('USERNAME'),
				'HAK_AKSES' => $_POST['hak_akses']
			);
			$this->model->update_user($data,$id_user);
			echo '<script language="javascript">alert("Data Berhasil Disimpan");</script>';
			echo '<script language="javascript">window.location.assign("'.base_url().'index.php/master/user/new");</script>';
		}
		$id_user = $this->uri->segment(3);
		$data['list_department']	= $this->model->get_department(0,0);	
		$data['result'] = $this->model->edit_user($id_user);
		$data['judul'] = 'Edit Pengguna';
		$data['isi'] = 'master/view_edit_user';
		$this->load->view('template_form',$data);
	}
	
	function delete_user(){
		$id_user =  $this->uri->segment(3);
		$this->model->delete_user($id_user);
			echo '<script language="javascript">alert("Data Berhasil Dihapus");</script>';
			echo '<script language="javascript">window.location.assign("'.base_url().'index.php/master/user");</script>';
		
	}
	
	//--------------------------------------------------------tambahan---------------------------------------
	function cek_session(){
		if($this->session->userdata('USERNAME')==null) return false;
		else return true;
	}
}

?>