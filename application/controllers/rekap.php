<?php
class rekap extends CI_Controller{
	
	function  __construct(){
		parent::__construct();
		$this->load->model('rekap_model','model');
	}
	
	/*
	public function __destruct() {  
    $this->db->close();  
}  
	
	*/
	
	function index(){
		$this->tiket();
	}
	//----------------------------------------------------tiket---------------------------------------------
	function tiket(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		$config['base_url'] = base_url().'/index.php/rekap/tiket/';
		$config['per_page'] = '20';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$batas_awal			= 0;
		//if(!this->cek_session()) redirect('auth/logout');
		if($this->uri->segment(3) == "new"){
			//get total data
			$total_rows = $this->model->get_jml_tiket();
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
		$data['result']		= $this->model->get_tiket($batas_awal,$config['per_page']);
		$data['judul']		= 'Tiket';
		$data['isi'] 		= 'rekap/view_tiket';
		$this->load->view('template_table',$data);
	}
	
	function rincian_tiket(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		$nomor_tiket = $this->uri->segment(3);
		//get data from db
		
		$data['list_agent']		= $this->model->get_agent();
		$data['list_response']	= $this->model->get_response($nomor_tiket);
		$data['result']		= $this->model->get_rincian_tiket($nomor_tiket);
		$data['judul']		= 'Rincian Tiket';
		$data['isi'] 		= 'rekap/view_rincian_tiket';
		$this->load->view('template_form',$data);
	}
	
	
	function assign_tiket(){
		if(!$this->cek_session()) redirect('auth/logout');

		$user_agent = explode("|",$_POST['user_agent']);
		$nama_agent = $user_agent[0];
		$email_agent = $user_agent[1];
		
		$nomor_tiket = $_POST['nomor_tiket'];
		$response = $this->model->get_tiket_by_nomor_tiket($nomor_tiket);
		$tiket = array();
		
		if($response->TGL_RESPONSE == "" or $response->USER_AGENT != $nama_agent){
			$tiket = array(
				'USER_AGENT' => $nama_agent,
				'USER_RESPONSE' => $this->session->userdata('NAMA'),
				'TGL_RESPONSE' => date('Y-m-d H:i:s')
			);
		}
		$data_response = array(
			'NOMOR_TIKET' =>$nomor_tiket,
			'USER_FROM' =>$this->session->userdata('NAMA'),
			'USER_TO' =>$nama_agent,
			'PESAN' =>$_POST['pesan'],
			'USER_INPUT' =>$this->session->userdata('USERNAME')
		);
		
		if($_POST['status_tiket'] == '1'){
			$tiket['USER_CLOSED'] = $this->session->userdata('NAMA');
			$tiket['TGL_CLOSED'] = date('Y-m-d H:i:s');
			$data_response['PESAN'] = 'Tiket closed';
		}else{
			$tiket['USER_CLOSED'] = "";
			$tiket['TGL_CLOSED'] = "";

			$this->send_mail('Tiket '.$data_response['NOMOR_TIKET'],"Masalah anda akan ditangani oleh ".$nama_agent.". Terima kasih telah menunggu",$response->EMAIL,'','');
		}
		
		$tiket['PENYELESAIAN'] = $_POST['penyelesaian'];
		
		//$this->form_validation->set_rules('valid_email_field', 'Email Field', 'required|valid_email');
		
		$this->model->assign_tiket($tiket,$nomor_tiket);
		$this->model->reply_tiket($data_response);
		

		//agent lur
		$this->send_mail('Tiket '.$data_response['NOMOR_TIKET'],$data_response['PESAN'],$email_agent,'','');
		
		echo '<script language="javascript">alert("Data Berhasil Disimpan");</script>';
		//KIRIM Tiket
		echo '<script language="javascript">window.location.assign("'.base_url().'index.php/rekap/rincian_tiket/'.$nomor_tiket.'");</script>';
	}
	
	function reply_tiket(){
		if(!$this->cek_session()) redirect('auth/logout');

		$email = $_POST['email_to'];
		$data_response = array(
			'NOMOR_TIKET' =>$_POST['nomor_tiket'],
			'USER_FROM' =>$this->session->userdata('NAMA'),
			'USER_TO' =>$_POST['user_to'],
			'PESAN' =>$_POST['pesan'],
			'USER_INPUT' =>$this->session->userdata('USERNAME')
		);
		//print_r($data_response);
		$this->model->reply_tiket($data_response);
		
		$this->send_mail('Tiket '.$data_response['NOMOR_TIKET'],$data_response['PESAN'],$email,'','');
		
		echo '<script language="javascript">alert("Data Berhasil Disimpan");</script>';
		echo '<script language="javascript">window.location.assign("'.base_url().'index.php/rekap/rincian_tiket/'.$_POST['nomor_tiket'].'");</script>';
	}
	
	//----------------------------------------------------tiket open---------------------------------------------
	function tiket_open(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		$config['base_url'] = base_url().'/index.php/rekap/tiket_open/';
		$config['per_page'] = '20';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$batas_awal			= 0;
		//if(!this->cek_session()) redirect('auth/logout');
		if($this->uri->segment(3) == "new"){
			//get total data
			$total_rows = $this->model->get_jml_tiket_open();
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
		$data['result']		= $this->model->get_tiket_open($batas_awal,$config['per_page']);
		$data['judul']		= 'Tiket Open';
		$data['isi'] 		= 'rekap/view_tiket';
		$this->load->view('template_table',$data);
	}
	
	//----------------------------------------------------tiket progress---------------------------------------------
	function tiket_progress(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		$config['base_url'] = base_url().'/index.php/rekap/tiket_progress/';
		$config['per_page'] = '20';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$batas_awal			= 0;
		//if(!this->cek_session()) redirect('auth/logout');
		if($this->uri->segment(3) == "new"){
			//get total data
			$total_rows = $this->model->get_jml_tiket_progress();
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
		$data['result']		= $this->model->get_tiket_progress($batas_awal,$config['per_page']);
		$data['judul']		= 'Tiket Progress';
		$data['isi'] 		= 'rekap/view_tiket';
		$this->load->view('template_table',$data);
	}
	
	//----------------------------------------------------tiket close---------------------------------------------
	function tiket_close(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		$config['base_url'] = base_url().'/index.php/rekap/tiket_close/';
		$config['per_page'] = '20';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$batas_awal			= 0;
		//if(!this->cek_session()) redirect('auth/logout');
		if($this->uri->segment(3) == "new"){
			//get total data
			$total_rows = $this->model->get_jml_tiket_close();
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
		$data['result']		= $this->model->get_tiket_close($batas_awal,$config['per_page']);
		$data['judul']		= 'Tiket Close';
		$data['isi'] 		= 'rekap/view_tiket_close';
		$this->load->view('template_table',$data);
	}
	//--------------------------------------------------------time tiket---------------------------------------
	function time_tiket(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		$config['base_url'] = base_url().'/index.php/rekap/time_tiket/';
		$config['per_page'] = '20';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$batas_awal			= 0;
		//if(!this->cek_session()) redirect('auth/logout');
		if($this->uri->segment(3) == "new"){
			$tgl_awal = "0";
			$tgl_akhir = "0";
			$status = "0";
			if($_POST){
				if($_POST['tgl_awal'] != "") $tgl_awal = $_POST['tgl_awal'];
				if($_POST['tgl_akhir'] != "") $tgl_akhir = $_POST['tgl_akhir'];
				if($_POST['status'] != "") $status = $_POST['status'];
			}
			//get total data
			$total_rows = $this->model->get_jml_time_tiket($tgl_awal,$tgl_akhir,$status);
			//set array data
			$newdata = array(
				'total_rows' => $total_rows,
				'tgl_awal' => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'status' => $status
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
		$data['tgl_awal']	= $this->session->userdata('tgl_awal');
		$data['tgl_akhir']	= $this->session->userdata('tgl_akhir');
		$data['status']		= $this->session->userdata('status');
		$data['result']		= $this->model->get_time_tiket($this->session->userdata('tgl_awal'),
																	$this->session->userdata('tgl_akhir'),
																	$this->session->userdata('status'),
																	$batas_awal,$config['per_page']);
		$data['judul']		= 'Recovery Time';
		$data['isi'] 		= 'rekap/view_time_tiket';
		$this->load->view('template_table',$data);
	}
	
	function excel_time_tiket(){
		$this->load->library('to_excel_pi');
		
		$tgl_awal		=$this->session->userdata('tgl_awal');
		$tgl_akhir		=  $this->session->userdata('tgl_akhir');
		$status			= $this->session->userdata('status');
		$jml_data			= $this->session->userdata('total_rows');
		$this->to_excel_pi->to_excel($this->model->get_time_rincian_tiket($tgl_awal,
																	$tgl_akhir,
																	$status,
																	0,$jml_data), 'Rekap Recovery Helpme');

		
	}
	//--------------------------------------------------------mobile---------------------------------------
	function add_tiket(){
		header('Access-Control-Allow-Origin: *');
		$data_tiket = array(
			'NOMOR_TIKET' => $_POST['nomor_tiket'],
			'ID_DEPARTMENT' => $_POST['id_department'],
			'ID_TOPIC' => $_POST['id_topic'],
			'EMAIL' => $_POST['email'],
			'NAMA' => $_POST['nama'],
			'MASALAH' => $_POST['masalah'],
			'RINCIAN' => $_POST['rincian'],
			'TGL_CREATED' => $_POST['tgl_created'],
			'USER_INPUT' => $_POST['user_input'],
		);
		$this->model->add_tiket($data_tiket);
		
		$data_response = array(
			'NOMOR_TIKET' =>$_POST['nomor_tiket'],
			'USER_FROM' =>$_POST['nama'],
			'USER_TO' =>'Helpme',
			'PESAN' => 'Open Tiket',
			'USER_INPUT' =>$_POST['nama']
		);
		$this->model->reply_tiket($data_response);
		
		$this->send_mail("Open Tiket","Tiket sudah dibuat. Harap tunggu, tim kami sedang memilih agent untuk menemui anda",$data_tiket['EMAIL'],'','');
	}
	
	function close_tiket(){
		if(!$this->cek_session()) redirect('auth/logout');
		
		header('Access-Control-Allow-Origin: *');
		$nomor_tiket = $_POST['nomor_tiket'];
		
		$data_tiket = array(
			'NOMOR_TIKET' => $_POST['nomor_tiket'],
			'USER_CLOSED' => $_POST['user_closed'],
			'TGL_CLOSED' => date('Y-m-d H:i:s'),
		);
		$this->model->close_tiket($data_tiket,$nomor_tiket);
		
		$data_response = array(
			'NOMOR_TIKET' =>$_POST['nomor_tiket'],
			'USER_FROM' =>$_POST['user_closed'],
			'USER_TO' =>'Helpme',
			'PESAN' => 'Close Tiket',
			'USER_INPUT' =>$_POST['user_closed']
		);
		$this->model->reply_tiket($data_response);
		
	}
	//--------------------------------------------------------tambahan---------------------------------------
	function cek_session(){
		if($this->session->userdata('USERNAME')==null) return false;
		else return true;
	}
	
	function kirim(){
		$this->send_mail2("Open Tiket","Tiket sudah dibuat. Harap tunggu, tim kami sedang memilih agent untuk menemui anda",'ajifitrah123@gmail.com','','');
	}
	
	/*function send_mail($subjek,$message,$penerima,$cc,$bcc){
	//function send_mail($subjek,$message,$penerima,$cc,$bcc){
		$config = array();
		$config['charset'] = 'iso-8859-1';
		$config['useragent'] = 'Codeigniter';
		$config['protocol']= 'smtp';
		//$config['_smtp_auth'] = true;
		$config['mailtype']= 'html';
		$config['smtp_host']= "10.1.2.65";
		//$config['smtp_host']= 'smtp.gmail.com';
		$config['smtp_port']= "25";
		//$config['smtp_port']= 465;
		$config['smtp_timeout']= '5';
		$config['smtp_user']= "pusat\divsti.jkt1";
		//$config['smtp_user']= 'lembah.tidar008@gmail.com';
		$config['smtp_pass']= "P@ssw0rd!1";
		//$config['smtp_pass']= '';
		//$config['smtp_keepalive']= false;
		$config['crlf']="\r\n"; 
		$config['newline']="\r\n"; 
		$config['wordwrap'] = TRUE;
		$config['validation'] = TRUE;
		$this->email->initialize($config);
		
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline('\r\n');
		$this->email->clear(); 
		
		$this->email->from('lembah.tidar008@Gmail.com','DIVSTI - Jakarta 1');
		$this->email->to($penerima);
		$this->email->cc($cc);
		$this->email->bcc($bcc);
		$this->email->subject($subjek);
		
		$message = str_replace("\n","<br>",$message);
		$this->email->message($message);
		$this->email->send();
		//show_error($this->email->print_debugger());
	}
	*/

	function send_mail($subjek,$message,$penerima,$cc,$bcc){
		require_once(APPPATH.'libraries/mail/class.phpmailer.php');
		require_once(APPPATH.'libraries/mail/class.smtp.php');
		
		$mail 				= new PHPMailer();
		$mail->SMTPDebug 	= 3;
		$mail->Host     	= "10.1.2.65";
		$mail->port     	= "25";
		$mail->Mailer   	= "smtp";
		$mail->SMTPAuth 	= false; 

		$mail->Username   	= "pusat\helpme"; 
		$mail->Password   	= "Jakarta@321 ";  
		
		$mail->From       	= "Helpme@pln.co.id";
		$mail->FromName   	= "Helpme - DIVSTI JKT 1";
		$mail->Subject    	= $subjek;
		$mail->AltBody    	= "This is the body when user views in plain text format"; 
		$mail->WordWrap   	= 50; // set word wrap
		
		$message 			= str_replace("\n","<br>",$message);
		$mail->MsgHTML($message);
		$mail->AddAddress($penerima);

		$mail->IsHTML(true); 

		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  echo "Message has been sent";
		}
	}

	function send_gmail($subjek,$message,$penerima,$cc,$bcc){
	//function send_mail($subjek,$message,$penerima,$cc,$bcc){
		$config = array();
		$config['protocol']= "smtp";
		$config['charset'] = 'utf-8';
		$config['mailtype']= "html";
		$config['smtp_host']= 'ssl://smtp.gmail.com';
		$config['smtp_port']= 465;
		$config['smtp_user']= "developerpln123@gmail.com";
		$config['smtp_pass']= "developerpln@123";
		// $config['smtp_crypto'] = 'tls'; 
		$config['crlf']="\r\n"; 
		$config['newline']="\r\n"; 
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		
		$this->load->library('email');
		$this->email->initialize($config);
		/* $this->email->set_newline('\r\n');
		$this->email->clear(); */
		
		$this->email->from('developerpln123@gmail.com','DIVSTI - Jakarta 1');
		$this->email->to($penerima);
		$this->email->cc($cc);
		$this->email->bcc($bcc);
		$this->email->subject($subjek);
		
		$message = str_replace("\n","<br>",$message);
		$this->email->message($message);
		$this->email->send();
		show_error($this->email->print_debugger());
	}
	
	function teskat(){
		require_once(APPPATH.'libraries/mail/class.phpmailer.php');
		require_once(APPPATH.'libraries/mail/class.smtp.php');
		
		
		$asal 				= "Manajemen Disjaya JKT 1"; //nama pengirim
		$tujuan 			= "lodaya46@gmail.com"; //email tujuan
		$subject 			= "tes manajemen disjaayaaa"; //subjek email
		$isi 				= "manajemen disjaayaaa"; //isi email
		
		$mail 				= new PHPMailer();
		$mail->SMTPDebug 	= 3;
		$mail->Host     	= "10.1.2.65";
		$mail->port     	= "25";
		$mail->Mailer   	= "smtp";
		$mail->SMTPAuth 	= false; 

		$mail->Username   	= "pusat\divsti.jkt1"; 
		$mail->Password   	= "P@ssw0rd!1";  
		
		$mail->From       = "developerpln123@gmail.com";
		$mail->FromName   = $asal;
		$mail->Subject    = $subject;
		$mail->AltBody    = "This is the body when user views in plain text format"; 
		$mail->WordWrap   = 50; // set word wrap

		$mail->MsgHTML($isi);
		$mail->AddAddress($tujuan);

		$mail->IsHTML(true); 

		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  echo "Message has been sent";
		}
	}
	
	function emailku(){
        $this->load->library("PHPMailerAutoload.php");
        $mail = new PHPMailer(); 
        
        // SMTP configuration
        $mail->Mailer   = "smtp"; 
        $mail->Host     = '10.1.2.65';
        $mail->SMTPAuth = false;
        $mail->Username = 'pusat/plndisjaya_khs';
        $mail->Password = 'Jakarta@123';
        
        
        $mail->setFrom('plndisjaya_khs@pln.co.id', 'Admin KHS');
        $mail->addReplyTo('info@example.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress('arief.cahbagust@gmail.com');
        
        // Add cc or bcc 
        $mail->addCC('arief.budiman2@pln.co.id');
        //$mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
	
	function tes_mail(){
	//function send_mail($subjek,$message,$penerima,$cc,$bcc){
		$config = array();
		$config['charset'] = 'utf-8';
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter';
		$config['protocol']= "smtp";
		$config['mailtype']= "html";
		$config['smtp_host']= "ssl://smtp.googlemail.com";
		$config['smtp_port']= "465";
		$config['smtp_timeout']= "5";
		$config['smtp_user']= "developerpln123@gmail.com";
		$config['smtp_pass']= "developerpln@123";
		$config['crlf']="\r\n"; 
		$config['newline']="\r\n"; 
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		
		$this->load->library('email');
		$this->email->initialize($config);
		
		$this->email->from('developerpln123@gmail.com','DIVSTI - Jakarta 1');
		$this->email->to('arief.cahbagust@gmail.com');
		$this->email->cc('arief.budiman2@pln.co.id');
		$this->email->bcc('lodaya46@gmail.com');
		$this->email->subject('testing');
		
		//$message = str_replace("\n","<br>",'testing');
		//$this->email->message('testing');
		$this->email->send();
		show_error($this->email->print_debugger());
	}
	
	function send_mail2($subjek, $message, $penerima, $cc, $bcc)
	{      
        $config['protocol'] = 'smtp'; // mail, sendmail, or smtp    The mail sending protocol.
        $config['mailpath'] = ''; // The server path to Sendmail.
        $config['smtp_host'] = '10.1.2.25'; // SMTP Server Address.
        $config['smtp_user'] = 'jaya\\taurisa.wijaya'; // SMTP Username.
        $config['smtp_pass'] = 'adadech'; // SMTP Password.
        $config['smtp_port'] = '25'; // SMTP Port.
        $config['smtp_timeout'] = '5'; // SMTP Timeout (in seconds).
        $config['wordwrap'] = FALSE; // TRUE or FALSE (boolean)    Enable word-wrap.
		$config['wrapchars'] = 1500; // Character count to wrap at.
        $config['mailtype'] = 'html'; // text or html Type of mail. If you send HTML email you must send it as a complete web page. 
        $config['charset'] = 'utf-8'; // Character set (utf-8, iso-8859-1, etc.).
        $config['validate'] = FALSE; // TRUE or FALSE (boolean)    Whether to validate the email address.
        $config['priority'] = 3; // 1, 2, 3, 4, 5    Email Priority. 1 = highest. 5 = lowest. 3 = normal.
		
		//load and initialize
        $this->load->library('email');
        $this->email->initialize($config);
		$this->email->set_newline("\r\n");  
        $this->email->clear();
		 
		$this->email->from('noreply@pln.co.id', 'MONAS AMR');
        $this->email->to($penerima);
		$this->email->cc($cc);
		$this->email->bcc($bcc);
        $this->email->subject($subjek);
		
		$message = str_replace("\n","<br>",$message);
		$this->email->message($message);
       
		//send the email
		$this->email->send();
    }
	
	
}

?>