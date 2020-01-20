<?php
include("PHPMailer/class.phpmailer.php");
include("PHPMailer/class.smtp.php"); 
	
	//$_GET['tujuan'] = 
	$asal = "Manajemen Disjaya"; //nama pengirim
	//$tujuan = 'arief.budiman2@pln.co.id'; //email tujuan
	$tujuan = $_GET['tujuan']; //email tujuan
	$subject = "tes manajemen disjaayaaa"; //subjek email
	$isi = "manajemen disjaayaaa"; //isi email
	
	$mail = new PHPMailer();
	$mail->SMTPDebug = 3;
	$mail->SMTPDebug = 3;
	//$mail->Host     = "10.1.2.65";
	$mail->Host     = "hub.pln.co.id";
	$mail->Mailer   = "smtp";
	$mail->SMTPAuth = false; 

	//$mail->Username   = "pusat\mailjaya"; 
	//$mail->Password   = "P@ssw0rd@j4y4";  
	
	$mail->Username   = "pusat\manajemen.disjaya"; 
	$mail->Password   = "P@ssw0rd";  

	$mail->From       = "manajemen.disjaya@pln.co.id";
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


?>