<?php
include("PHPMailer/class.phpmailer.php");
include("PHPMailer/class.smtp.php"); 

	$asal = "Manajemen Disjaya"; //nama pengirim
	$tujuan = 'ibnu.prastowo@pln.co.id'; //email tujuan
	//$tujuan = 'hamid.abdul@iconpln.co.id'; //email tujuan
	$subject = "tes manajemen disjaayaaa"; //subjek email
	$isi = "manajemen disjaayaaa"; //isi email
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 3;
	//$mail->Host     = "10.1.2.65";
	$mail->Host     = "smtp.gmail.com";
	$mail->Port 	= 587;
	$mail->SMTPSecure = 'tls';
	//$mail->Mailer   = "smtp";
	$mail->SMTPAuth = true; 

	//$mail->Username   = "pusat\mailjaya"; 
	//$mail->Password   = "P@ssw0rd@j4y4";  
	
	$mail->Username   = "developerpln123@gmail.com"; 
	$mail->Password   = "developerpln@123";  

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


?>